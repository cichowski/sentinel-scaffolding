<?php
namespace App\Http\Controllers\Sentinel;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\Sentinel\UserRequest;
use App\Http\Requests\Sentinel\SetPasswordRequest;
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
    
    public function saveNewPassword(SetPasswordRequest $request)
    {        
        if (Request::ajax()) {
            return $this->jsonResponseOk();
        }
        
        if (! Sentinel::getUser()->setPassword($request->get('password'))) {
            
            return redirect()->back();
        }        
        
        return redirect()->route('account.password');        
    }
}
