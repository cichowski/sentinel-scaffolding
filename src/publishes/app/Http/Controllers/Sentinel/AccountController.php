<?php
namespace App\Http\Controllers\Sentinel;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\Sentinel\UserRequest;
use App\Http\Requests\Sentinel\ChangePasswordRequest;
use View;
use Sentinel;
use Request;

class AccountController extends BaseController
{   
    public function edit(Country $countryModel, Distributor $distributorModel)
    {
        $user = Sentinel::getUser();       
        
        return View::make('sentinel.account.profile', compact('user'));
    }
    
    public function update(UserRequest $request)
    {
        if (Request::ajax()) {
            return $this->jsonResponseOk();
        }
        
        $user = Sentinel::getUser();
        
        $user->fill($request->all());
        
        if (! $user->save()) {
            
            return redirect()->back()->withInput();
        }
        
        return redirect()->route('account.edit');
    }
    
    public function changePassword()
    {
        return View::make('sentinel.account.password');
    }
    
    public function saveNewPassword(ChangePasswordRequest $request)
    {        
        if (Request::ajax()) {
            return $this->jsonResponseOk();
        }
        
        $user = Sentinel::getUser();
        
        if (Sentinel::validateCredentials($user, ['password' => $request->get('password_old')])) {
        
            if ($user->setPassword($request->get('password_new'))) {

                return redirect()->route('account.password')->with('message', trans('sentinel.messages.success'));        
            }                   
        }
        
        return redirect()->back()->with('message', trans('sentinel.errors.password-set'));
    }
}
