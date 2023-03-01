<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\Admin\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class ProjectsApiController extends Controller
{

   /**
     *  @OA\Post(
     *      path="/login",
     *      summary="Login para gerar o token",
     *      tags={"Projects"},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Donec sollicitudin molestie malesuada.",
     *          @OA\JsonContent(ref="#/components/schemas/User") 
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="Forbidden"
     *      )
     *  )
     */

   public function login(LoginRequest $request)
   {
       $credentials = $request->only('email', 'password');
       
       if(!auth()->attempt($credentials))
       {
           abort(401, 'Invalid Crendentials');
       }
       
       $token = auth()->user()->createToken('auth_token');
       return (new ProjectResource($token))
       ->response()
       ->setStatusCode(Response::HTTP_CREATED);;
   }
     /**
     * @OA\Get(
     *      path="/index",
     *      operationId="index",
     *      tags={"Projects"},
     *      summary="Get list of user",
     *      security={{"bearer_token":{}}},
     *      description="Returns list of user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */ 
    
   public function index()
   {
      return new ProjectResource(Project::All());
   }

   /**
    * @OA\Get(
    *     path="/show/{id}",
    *     operationId="show",
    *     tags={"Projects"},
    *     summary="Get user information",
    *      security={{"bearer_token":{}}},
    *     description="Returns user data",
    *     @OA\Parameter(
    *          name="id",
    *          description="User id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *               type="integer",
    *          )
    *    ),
    *     @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(ref="#/components/schemas/Project")
    *     ),  
    *     @OA\Response(
    *         response=400,
    *         description="Bad Request"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthenticated",
    *     ),
    *     @OA\Response(
    *        response=403,
    *        description="Forbidden"
    *     )         
    *)
    */

   public function show($id)
   {
      
      $project = Project::find($id);
      
      return new ProjectResource($project);
   }

    /**
     * @OA\Post(
     *      path="/store",
     *      operationId="store",
     *      tags={"Projects"},
     *      summary="Store new project",
     *      security={{"bearer_token":{}}},
     *      description="Returns project data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProjectRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Project")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

   public function store(StoreProjectRequest $request)
   {
      $data = $request->all();
      
        $project = Project::create($data);

        return (new ProjectResource($project))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);;   
   }

    /**
     *  @OA\Put(
     *      path="/update/{id}",
     *      operationId="update",
     *      tags={"Projects"},
     *      summary="Update existing user",
     *      security={{"bearer_token":{}}},
     *      description="Returns updated project data",
     *      @OA\Parameter(
     *         name="id",
     *         description="User id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *            type="integer"
     *         )            
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateProjectRequest")
     *      ),
     *      *@OA\Response(
     *         response=202,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Project")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
   public function update(UpdateProjectRequest $request, $id)
   {
     
     
      $project = Project::find($id);
   
      $project->update($request->all());

      return (new ProjectResource($project))
      ->response()
      ->setStatusCode(Response::HTTP_ACCEPTED); 
   }

    /**
     * @OA\Delete(
     *      path="/destroy/{id}",
     *      operationId="delete",
     *      tags={"Projects"},
     *      summary="Delete existing user",
     *      security={{"bearer_token":{}}},
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
   public function destroy($id)
   {
      $project = Project::find($id);
      $project->delete();
      return response(null, Response::HTTP_NO_CONTENT);
   }
}

