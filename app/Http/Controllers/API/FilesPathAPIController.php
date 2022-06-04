<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFilesPathAPIRequest;
use App\Http\Requests\API\UpdateFilesPathAPIRequest;
use App\Models\FilesPath;
use App\Repositories\FilesPathRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FilesPathController
 * @package App\Http\Controllers\API
 */

class FilesPathAPIController extends AppBaseController
{
    /** @var  FilesPathRepository */
    private $filesPathRepository;

    public function __construct(FilesPathRepository $filesPathRepo)
    {
        $this->filesPathRepository = $filesPathRepo;
    }

    /**
     * Display a listing of the FilesPath.
     * GET|HEAD /filesPaths
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $filesPaths = $this->filesPathRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($filesPaths->toArray(), 'Files Paths retrieved successfully');
    }

    /**
     * Store a newly created FilesPath in storage.
     * POST /filesPaths
     *
     * @param CreateFilesPathAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFilesPathAPIRequest $request)
    {
        $input = $request->all();

        $filesPath = $this->filesPathRepository->create($input);

        return $this->sendResponse($filesPath->toArray(), 'Files Path saved successfully');
    }

    /**
     * Display the specified FilesPath.
     * GET|HEAD /filesPaths/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var FilesPath $filesPath */
        $filesPath = $this->filesPathRepository->find($id);

        if (empty($filesPath)) {
            return $this->sendError('Files Path not found');
        }

        return $this->sendResponse($filesPath->toArray(), 'Files Path retrieved successfully');
    }

    /**
     * Update the specified FilesPath in storage.
     * PUT/PATCH /filesPaths/{id}
     *
     * @param int $id
     * @param UpdateFilesPathAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFilesPathAPIRequest $request)
    {
        $input = $request->all();

        /** @var FilesPath $filesPath */
        $filesPath = $this->filesPathRepository->find($id);

        if (empty($filesPath)) {
            return $this->sendError('Files Path not found');
        }

        $filesPath = $this->filesPathRepository->update($input, $id);

        return $this->sendResponse($filesPath->toArray(), 'FilesPath updated successfully');
    }

    /**
     * Remove the specified FilesPath from storage.
     * DELETE /filesPaths/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var FilesPath $filesPath */
        $filesPath = $this->filesPathRepository->find($id);

        if (empty($filesPath)) {
            return $this->sendError('Files Path not found');
        }

        $filesPath->delete();

        return $this->sendSuccess('Files Path deleted successfully');
    }
}
