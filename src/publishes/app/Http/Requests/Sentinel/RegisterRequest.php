<?php 
namespace App\Http\Requests\Sentinel;

use App\Http\Requests\Request;
use App\Models\Sentinel\User;

class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role'          => 'exists:roles,slug',
            'username'      => 'required|unique:users',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8',
            'password_confirmation' => 'required|same:password',                                    
        ];
    }
    
}
