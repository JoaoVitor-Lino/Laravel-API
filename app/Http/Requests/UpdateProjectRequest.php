<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Update Project request",
 *      description="Update Project request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class UpdateProjectRequest extends FormRequest
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
     *      description="Name of the new user",
     *      example="Name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="sex",
     *      description="Sex of the new user",
     *      example="Male or Female"
     * )
     *
     * @var string
     */
    public $sex;

    /**
     * @OA\Property(
     *      title="age",
     *      description="Age of the new user",
     *      example="20"
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
        ];
    }
}
