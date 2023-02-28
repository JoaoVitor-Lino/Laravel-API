<?php
Use App\Project;
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Store Project request",
 *      description="Store Project request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class StoreProjectRequest extends FormRequest
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
     *      title="name",
     *      description="Name of the new User",
     *      example="User"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="sex",
     *      description="Sex of the new User",
     *      example="Male pr Female"
     * )
     *
     * @var string
     */
    public $sex;

    /**
     * @OA\Property(
     *      title="age",
     *      description="Age of new User",
     *      format="int64",
     *      example= 26
     * )
     *
     * @var integer
     */
    public $age;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules()
    {
        return [
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'sex.required'  => 'É obrigatório informar o gênero',
            'age.required'  => 'A idade é obrigatório',
        ];
    }
}
