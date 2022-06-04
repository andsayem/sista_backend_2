<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFollowingAPIRequest;
use App\Http\Requests\API\UpdateFollowingAPIRequest;
use App\Models\Following;
use App\Repositories\FollowingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use  Auth ;

/**
 * Class FollowingController
 * @package App\Http\Controllers\API
 */

class FollowingAPIController extends AppBaseController
{
    /** @var  FollowingRepository */
    private $followingRepository;

    public function __construct(FollowingRepository $followingRepo)
    {
        $this->followingRepository = $followingRepo;
    }

    /**
     * Display a listing of the Following.
     * GET|HEAD /followings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $followings = $this->followingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($followings->toArray(), 'Followings retrieved successfully');
    }
    public function following($id , Request $request){
        $user_data = Auth::user();
        if(Following::where('follower_id' , $id)->where('user_id' , $user_data->id)->exists()){
            $exists = Following::where('follower_id',$id)->where('user_id', $user_data->id);
            $exists->delete();
            return $this->sendResponse(1, 'Following saved successfully');
        }else{
             Following::create(['follower_id' => $id , 'user_id' => $user_data->id]);
             return $this->sendResponse(1, 'Following saved successfully');
        } 
    }
     
    /**
     * Store a newly created Following in storage.
     * POST /followings
     *
     * @param CreateFollowingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFollowingAPIRequest $request)
    {
        $input = $request->all();

        $following = $this->followingRepository->create($input);

        return $this->sendResponse($following->toArray(), 'Following saved successfully');
    }

    /**
     * Display the specified Following.
     * GET|HEAD /followings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Following $following */
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            return $this->sendError('Following not found');
        }

        return $this->sendResponse($following->toArray(), 'Following retrieved successfully');
    }

    /**
     * Update the specified Following in storage.
     * PUT/PATCH /followings/{id}
     *
     * @param int $id
     * @param UpdateFollowingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFollowingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Following $following */
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            return $this->sendError('Following not found');
        }

        $following = $this->followingRepository->update($input, $id);

        return $this->sendResponse($following->toArray(), 'Following updated successfully');
    }

    /**
     * Remove the specified Following from storage.
     * DELETE /followings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Following $following */
        $following = $this->followingRepository->find($id);

        if (empty($following)) {
            return $this->sendError('Following not found');
        }

        $following->delete();

        return $this->sendSuccess('Following deleted successfully');
    }
}
