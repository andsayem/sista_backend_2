<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostNotInterestedAPIRequest;
use App\Http\Requests\API\UpdatePostNotInterestedAPIRequest;
use App\Models\PostNotInterested;
use App\Repositories\PostNotInterestedRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PostNotInterestedController
 * @package App\Http\Controllers\API
 */

class PostNotInterestedAPIController extends AppBaseController
{
    /** @var  PostNotInterestedRepository */
    private $postNotInterestedRepository;

    public function __construct(PostNotInterestedRepository $postNotInterestedRepo)
    {
        $this->postNotInterestedRepository = $postNotInterestedRepo;
    }

    /**
     * Display a listing of the PostNotInterested.
     * GET|HEAD /postNotInteresteds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $postNotInteresteds = $this->postNotInterestedRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($postNotInteresteds->toArray(), 'Post Not Interesteds retrieved successfully');
    }

    /**
     * Store a newly created PostNotInterested in storage.
     * POST /postNotInteresteds
     *
     * @param CreatePostNotInterestedAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostNotInterestedAPIRequest $request)
    {
        $input = $request->all();

        $postNotInterested = $this->postNotInterestedRepository->create($input);

        return $this->sendResponse($postNotInterested->toArray(), 'Post Not Interested saved successfully');
    }

    /**
     * Display the specified PostNotInterested.
     * GET|HEAD /postNotInteresteds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostNotInterested $postNotInterested */
        $postNotInterested = $this->postNotInterestedRepository->find($id);

        if (empty($postNotInterested)) {
            return $this->sendError('Post Not Interested not found');
        }

        return $this->sendResponse($postNotInterested->toArray(), 'Post Not Interested retrieved successfully');
    }

    /**
     * Update the specified PostNotInterested in storage.
     * PUT/PATCH /postNotInteresteds/{id}
     *
     * @param int $id
     * @param UpdatePostNotInterestedAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostNotInterestedAPIRequest $request)
    {
        $input = $request->all();

        /** @var PostNotInterested $postNotInterested */
        $postNotInterested = $this->postNotInterestedRepository->find($id);

        if (empty($postNotInterested)) {
            return $this->sendError('Post Not Interested not found');
        }

        $postNotInterested = $this->postNotInterestedRepository->update($input, $id);

        return $this->sendResponse($postNotInterested->toArray(), 'PostNotInterested updated successfully');
    }

    /**
     * Remove the specified PostNotInterested from storage.
     * DELETE /postNotInteresteds/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PostNotInterested $postNotInterested */
        $postNotInterested = $this->postNotInterestedRepository->find($id);

        if (empty($postNotInterested)) {
            return $this->sendError('Post Not Interested not found');
        }

        $postNotInterested->delete();

        return $this->sendSuccess('Post Not Interested deleted successfully');
    }
}
