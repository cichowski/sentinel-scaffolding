<?php 
namespace App\Http\Controllers\Sentinel;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\Sentinel\RetrievePasswordRequest;
use App\Http\Requests\Sentinel\SetPasswordRequest;
use Sentinel
use Reminder;
use Request;
use Mail;
use View;

class PasswordController extends BaseController 
{    
    public function retrieve()
    {                       
        return View::make('sentinel.passwords.retrieve');
    }    
    
    public  function sendRetrieveLink(RetrievePasswordRequest $request)
    {
        if (Request::ajax()) {
            return response()->json( array(
                'status' => 'ok',
            ));
        }         
        
        $user = Sentinel::findByCredentials($request->all());
                
        if ($user) {
            
            $reminder = Reminder::createIfNotExists($user);
            
            $sent = Mail::send('sentinel.emails.retrieve', compact('user', 'reminder'), function($m) use ($user)
            {
                $m->to($user->email)->subject(trans('sentinel.emails.retrieve'));
            });
            
            if ( ! $sent) {
                
                return redirect()->back()
                        ->withInput()
                        ->withErrors(trans('sentinel.errors.send'));
            }
        }
        
        return redirect()->route('auth.login')
                ->with('message', trans('sentinel.messages.retrieve'));                                
    }
    
    public function create($userId, $code)
    {
        if (Reminder::exists(Sentinel::findById($userId), $code)) {
            
            return View::make('sentinel.passwords.set', ['userId' =>$userId , 'code' => $code]);                    
        }
        
        return redirect()->route('auth.login')
                ->withErrors(trans('sentinel.errors.link'));         
    }
    
    public function store(SetPasswordRequest $request)
    {
        if (Reminder::complete(Sentinel::findById($request->get('user_id')), $request->get('code'), $request->get('password'))) {
            
            return redirect()->route('auth.login')
                    ->with('message', trans('sentinel.messages.password-set')); 
        } 
        
        return redirect()->back()
                ->withErrors(trans('sentinel.errors.password-set'));
    }    
}