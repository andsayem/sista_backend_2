<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Resources\UserDataResource;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth ; 
use Storage;
use Str;
/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * GET|USER /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }
    public function users_search($key)
    {
        $users = User::limit(20)
        ->where('name', 'like', '%'.$key.'%')->get();
        
        
        // $this->userRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        // );

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }
    
    public function userInfo(Request $request){
         $user_data = Auth::user();
         return $this->sendResponse( $user_data, 'User data successfully');
        
    }
    public function  user_profile($id ,Request $request){
        $user_data = User::where('id',$id)->first();
        $data = New UserDataResource($user_data );
        return $this->sendResponse( $data , 'User profile successfully');
    }
   public function  change_profile_image(Request $request){
       
    
      
        $user_data = Auth::user();
         if($request['files_base']){ 
           // foreach ($request->files_base as $key => $value) { 
                $image_64 = $request->files_base ; 
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(20) . '.' . $extension;
                Storage::disk('posts')->put($imageName, base64_decode($image)); 
                // $fileInput['post_id'] = $postData->id;
                // $fileInput['user_id'] = $user_data->id;
                // $fileInput['path'] = $imageName; 
                // $filesController = $this->filesPathRepository->create($fileInput); 
            //}  
            
               User::where('id',$user_data->id) 
              ->update(['pro_image' => $imageName]);
      

        }
        
        $user_data = User::where('id',$user_data->id)->first();
        $data = New UserDataResource($user_data );
        return $this->sendResponse( $data , 'User profile successfully');
    }
    /**
     * Store a newly created User in storage.
     * POST /Users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->except(['password']);
        $input['password'] = bcrypt($request->password);

        $user = $this->userRepository->create($input);

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|USER /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var Head $head */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified Head from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }
}
