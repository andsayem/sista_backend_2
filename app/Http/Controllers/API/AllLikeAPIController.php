<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAllLikeAPIRequest;
use App\Http\Requests\API\UpdateAllLikeAPIRequest;
use App\Models\AllLike;
use App\Models\AllComment;
use App\Models\PostData;
use App\Repositories\AllLikeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth ;

/**
 * Class AllLikeController
 * @package App\Http\Controllers\API
 */

class AllLikeAPIController extends AppBaseController
{
    /** @var  AllLikeRepository */
    private $allLikeRepository;

    public function __construct(AllLikeRepository $allLikeRepo)
    {
        $this->allLikeRepository = $allLikeRepo;
    }

    /**
     * Display a listing of the AllLike.
     * GET|HEAD /allLikes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $allLikes = $this->allLikeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($allLikes->toArray(), 'All Likes retrieved successfully');
    }
    public function postlike($id , Request $request){
        $user_data = Auth::user();
        //$post = PostData::find($id);
        if(AllLike::where('post_id',$id)->where('user_id', $user_data->id)->where('comm_id', 0)->exists()){
           $exists = AllLike::where('post_id',$id)->where('user_id', $user_data->id)->where('comm_id', 0);
           $exists->delete();
           return $this->sendResponse($id , ' Unlike successfully');
        }else{
            AllLike::create(array('post_id' => $id, 'user_id' =>$user_data->id , 'comm_id' => 0 )) ;
            return $this->sendResponse($id , ' Like successfully');
        }
    }
    
    public function commentlike($id,  Request $request){
        $user_data = Auth::user();
        $comment = AllComment::find($id);  
        if(AllLike::where('post_id',$comment->post_id)->where('comm_id', $id)->where('user_id',  $user_data->id)->exists()){
          $exists = AllLike::where('post_id',$comment->post_id)->where('comm_id', $id)->where('user_id',  $user_data->id);
          $exists->delete();
          return $this->sendResponse($id , ' Unlike successfully');
        }else{
            AllLike::create(array('post_id' => $comment->post_id, 'user_id' => $user_data->id, 'comm_id' => $id )) ;
            return $this->sendResponse($id , ' Like successfully');
        } 
    }
       

    /**
     * Store a newly created AllLike in storage.
     * POST /allLikes
     *
     * @param CreateAllLikeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAllLikeAPIRequest $request)
    {
        $input = $request->all();

        $allLike = $this->allLikeRepository->create($input);

        return $this->sendResponse($allLike->toArray(), 'All Like saved successfully');
    }

    /**
     * Display the specified AllLike.
     * GET|HEAD /allLikes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AllLike $allLike */
        $allLike = $this->allLikeRepository->find($id);

        if (empty($allLike)) {
            return $this->sendError('All Like not found');
        }

        return $this->sendResponse($allLike->toArray(), 'All Like retrieved successfully');
    }

    /**
     * Update the specified AllLike in storage.
     * PUT/PATCH /allLikes/{id}
     *
     * @param int $id
     * @param UpdateAllLikeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAllLikeAPIRequest $request)
    {
        $input = $request->all();

        /** @var AllLike $allLike */
        $allLike = $this->allLikeRepository->find($id);

        if (empty($allLike)) {
            return $this->sendError('All Like not found');
        }

        $allLike = $this->allLikeRepository->update($input, $id);

        return $this->sendResponse($allLike->toArray(), 'AllLike updated successfully');
    }

    /**
     * Remove the specified AllLike from storage.
     * DELETE /allLikes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AllLike $allLike */
        $allLike = $this->allLikeRepository->find($id);

        if (empty($allLike)) {
            return $this->sendError('All Like not found');
        }

        $allLike->delete();

        return $this->sendSuccess('All Like deleted successfully');
    }
}
