<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostReportAPIRequest;
use App\Http\Requests\API\UpdatePostReportAPIRequest;
use App\Models\PostReport;
use App\Repositories\PostReportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PostReportController
 * @package App\Http\Controllers\API
 */

class PostReportAPIController extends AppBaseController
{
    /** @var  PostReportRepository */
    private $postReportRepository;

    public function __construct(PostReportRepository $postReportRepo)
    {
        $this->postReportRepository = $postReportRepo;
    }

    /**
     * Display a listing of the PostReport.
     * GET|HEAD /postReports
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $postReports = $this->postReportRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($postReports->toArray(), 'Post Reports retrieved successfully');
    }

    /**
     * Store a newly created PostReport in storage.
     * POST /postReports
     *
     * @param CreatePostReportAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostReportAPIRequest $request)
    {
        $input = $request->all();

        $postReport = $this->postReportRepository->create($input);

        return $this->sendResponse($postReport->toArray(), 'Post Report saved successfully');
    }

    /**
     * Display the specified PostReport.
     * GET|HEAD /postReports/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostReport $postReport */
        $postReport = $this->postReportRepository->find($id);

        if (empty($postReport)) {
            return $this->sendError('Post Report not found');
        }

        return $this->sendResponse($postReport->toArray(), 'Post Report retrieved successfully');
    }

    /**
     * Update the specified PostReport in storage.
     * PUT/PATCH /postReports/{id}
     *
     * @param int $id
     * @param UpdatePostReportAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostReportAPIRequest $request)
    {
        $input = $request->all();

        /** @var PostReport $postReport */
        $postReport = $this->postReportRepository->find($id);

        if (empty($postReport)) {
            return $this->sendError('Post Report not found');
        }

        $postReport = $this->postReportRepository->update($input, $id);

        return $this->sendResponse($postReport->toArray(), 'PostReport updated successfully');
    }

    /**
     * Remove the specified PostReport from storage.
     * DELETE /postReports/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PostReport $postReport */
        $postReport = $this->postReportRepository->find($id);

        if (empty($postReport)) {
            return $this->sendError('Post Report not found');
        }

        $postReport->delete();

        return $this->sendSuccess('Post Report deleted successfully');
    }
}
