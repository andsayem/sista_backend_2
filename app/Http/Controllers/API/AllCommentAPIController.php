<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAllCommentAPIRequest;
use App\Http\Requests\API\UpdateAllCommentAPIRequest;
use App\Http\Resources\CommentResource;
use App\Models\AllComment;
use App\Repositories\AllCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth ;

/**
 * Class AllCommentController
 * @package App\Http\Controllers\API
 */

class AllCommentAPIController extends AppBaseController
{
    /** @var  AllCommentRepository */
    private $allCommentRepository;

    public function __construct(AllCommentRepository $allCommentRepo)
    {
        $this->allCommentRepository = $allCommentRepo;
    }

    /**
     * Display a listing of the AllComment.
     * GET|HEAD /allComments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $allComments = $this->allCommentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        // $allComments = AllComment::where('parent_id','0')
        // ->with('childs')
        // ->get();
        $return_data = CommentResource::collection($allComments);

        return $this->sendResponse($return_data, 'All Comments retrieved successfully');
    }

    /**
     * Store a newly created AllComment in storage.
     * POST /allComments
     *
     * @param CreateAllCommentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAllCommentAPIRequest $request)
    {
        
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $allComment = $this->allCommentRepository->create($input);
        return $this->sendResponse($allComment->toArray(), 'All Comment saved successfully');
    }

    /**
     * Display the specified AllComment.
     * GET|HEAD /allComments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AllComment $allComment */
        $allComment = $this->allCommentRepository->find($id);

        if (empty($allComment)) {
            return $this->sendError('Comment not found');
        }

        return $this->sendResponse($allComment->toArray(), 'All Comment retrieved successfully');
    }

    /**
     * Update the specified AllComment in storage.
     * PUT/PATCH /allComments/{id}
     *
     * @param int $id
     * @param UpdateAllCommentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAllCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var AllComment $allComment */
        $allComment = $this->allCommentRepository->find($id);

        if (empty($allComment)) {
            return $this->sendError('All Comment not found');
        }

        $allComment = $this->allCommentRepository->update($input, $id);

        return $this->sendResponse($allComment->toArray(), 'AllComment updated successfully');
    }

    /**
     * Remove the specified AllComment from storage.
     * DELETE /allComments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AllComment $allComment */
        $allComment = $this->allCommentRepository->find($id);

        if (empty($allComment)) {
            return $this->sendError('All Comment not found');
        }

        $allComment->delete();

        return $this->sendSuccess('All Comment deleted successfully');
    }
}
