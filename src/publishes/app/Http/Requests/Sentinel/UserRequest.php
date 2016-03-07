<?php 
namespace App\Http\Requests\Sentinel;

use App\Http\Requests\Request;
use App\Models\Distributor;
use Sentinel;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Sentinel::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'    => 'required|unique:users',
        ];
    }
    
}

