<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(
 *        title="Login Request",
 *        description="Login request body data",
 *        type="object",
 *        required={"email"},
 *        required={"password"},    
 * )           
 */

class LoginRequest extends FormRequest
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
     * @OA\Property(
     *      title="email",
     *      description="email of user",
     *      example="teste@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of user",
     *      example="@Mudar123"
     * )
     *
     * @var string
     */
    public $password;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'É necessário informar o e-mail',
            'password.required' => 'É necessário informar a senha',
        ];
    }
}
