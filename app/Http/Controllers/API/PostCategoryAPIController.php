<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostCategoryAPIRequest;
use App\Http\Requests\API\UpdatePostCategoryAPIRequest;
use App\Models\PostCategory;
use App\Repositories\PostCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PostCategoryController
 * @package App\Http\Controllers\API
 */

class PostCategoryAPIController extends AppBaseController
{
    /** @var  PostCategoryRepository */
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepo)
    {
        $this->postCategoryRepository = $postCategoryRepo;
    }

    /**
     * Display a listing of the PostCategory.
     * GET|HEAD /postCategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $postCategories = $this->postCategoryRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        // );
        
       $postCategories =  PostCategory::all();

        return $this->sendResponse($postCategories->toArray(), 'Post Categories retrieved successfully');
    }

    /**
     * Store a newly created PostCategory in storage.
     * POST /postCategories
     *
     * @param CreatePostCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCategoryAPIRequest $request)
    {
        $input = $request->all();

        $postCategory = $this->postCategoryRepository->create($input);

        return $this->sendResponse($postCategory->toArray(), 'Post Category saved successfully');
    }

    /**
     * Display the specified PostCategory.
     * GET|HEAD /postCategories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostCategory $postCategory */
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            return $this->sendError('Post Category not found');
        }

        return $this->sendResponse($postCategory->toArray(), 'Post Category retrieved successfully');
    }

    /**
     * Update the specified PostCategory in storage.
     * PUT/PATCH /postCategories/{id}
     *
     * @param int $id
     * @param UpdatePostCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var PostCategory $postCategory */
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            return $this->sendError('Post Category not found');
        }

        $postCategory = $this->postCategoryRepository->update($input, $id);

        return $this->sendResponse($postCategory->toArray(), 'PostCategory updated successfully');
    }

    /**
     * Remove the specified PostCategory from storage.
     * DELETE /postCategories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PostCategory $postCategory */
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            return $this->sendError('Post Category not found');
        }

        $postCategory->delete();

        return $this->sendSuccess('Post Category deleted successfully');
    }
}
