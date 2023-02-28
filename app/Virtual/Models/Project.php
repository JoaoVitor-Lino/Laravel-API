<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Project",
 *     description="Project model",
 *     @OA\Xml(
 *         name="Project"
 *     )
 * )
 */
class Project
{

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the user",
     *      example="User"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="sex",
     *      description="Sex of the user",
     *      example="Male or Female "
     * )
     *
     * @var string
     */
    public $sex;

    /**
     * @OA\Property(
     *      title="age",
     *      description="Age of the user",
     *      example="20"
     * )
     *
     * @var string
     */
    public $age;
    }