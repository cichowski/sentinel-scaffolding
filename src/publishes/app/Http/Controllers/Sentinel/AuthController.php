<?php 
namespace App\Http\Controllers\Sentinel;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\Sentinel\LoginRequest;
use App\Http\Requests\Sentinel\RegisterRequest;
use App\Models\Sentinel\User;
use Sentinel;
use Activation;
use Request;
use Mail;
use View;
use App\Models\Reservation;

class AuthController extends BaseController 
{  
    /**
     * Show the form for logging the user in.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {                     
        return View::make('sentinel.auth.login');
    }
    
    /**
     * Handle posting of the form for logging the user in.
     *
     * @param App\Http\Requests\Sentinel\LoginRequest $request 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin(LoginRequest $request)
    {
        try {
            
            $remember = (bool) $request->get('remember', false);
            
            if (Sentinel::authenticate($request->all(), $remember)) {
                
                return redirect()->intended();
            }
            
            $errors = trans('sentinel.errors.credentials');
                       
        }
        catch (NotActivatedException $e) {
            
            $errors = trans('sentinel.errors.activation');            
        }
        catch (ThrottlingException $e) {
            
            $errors = trans('sentinel.errors.throttle', ['delay' => $e->getDelay()]);
        }
        
        return redirect()->back()
                ->withInput()
                ->withErrors($errors);
    }
    
    /**
     * Show the form for the user registration.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {   
        $roles = Sentinel::getRoleRepository()->all()->lists('slug', 'name');
        
        return View::make('sentinel.auth.register')->with('roles', $roles);
    }
    
    /**
     * Handle posting of the form for the user registration.
     *
     * @param App\Http\Requests\Sentinel\RegisterRequest $request 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processRegistration(RegisterRequest $request)
    {         
        if (Request::ajax()) {
            return response()->json( array(
                'status' => 'ok',
            ));
        }          
        
        $user = Sentinel::register($request->all());        
        
        if ($user) {
            
            $role = Sentinel::findRoleBySlug($request->get('role'));
            
            $role->users()->attach($user);
            
            $activation = Activation::createIfNotExists($user);                       
            
            $sent = Mail::send('sentinel.emails.activate', compact('user', 'activation'), function($m) use ($user)
            {
                $m->to($user->email)->subject(trans('sentinel.emails.activate'));
            });
            
            if ( ! $sent) {
                
                return redirect()->back()
                        ->withInput()
                        ->withErrors(trans('sentinel.errors.send'));
            }
            
            return redirect()->route('auth.login')
                    ->with('message', trans('sentinel.messages.account-created'))
                    ->with('userId', $user->getUserId());
        }
        
        return redirect()->back()
                ->withInput()
                ->withErrors(trans('sentinel.errors.register'));
    }
    
    public function activate($userId, $code)
    {
        if (Activation::complete(Sentinel::findById($userId), $code)) {
            
            return redirect()->route('auth.login')
                    ->with('message', trans('sentinel.messages.activated')); 
        }
        
        return redirect()->route('auth.login')
                ->withErrors(trans('sentinel.errors.link'));                      
    }
    
    public function logout()
    {
        Sentinel::logout();
        
        return redirect()->route('auth.login');                
    } 
    
    public function init()
    {         
        if ( ! User::all()->count()) {
            
            $initialRoleName = 'Admin';                        
            
            $role = Sentinel::findRoleByName($initialRoleName);
            
            if ( ! $role) {
                
                $role = Sentinel::getRoleRepository()->createModel()->create([
                    'name' => $initialRoleName,
                    'slug' => strtolower($initialRoleName),
                ]);
            }            
            
            return View::make('sentinel.auth.register')->with('role', $role);
        }
        
        abort(404);
    }
}