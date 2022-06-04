<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupportTypeAPIRequest;
use App\Http\Requests\API\UpdateSupportTypeAPIRequest;
use App\Models\SupportType;
use App\Repositories\SupportTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SupportTypeController
 * @package App\Http\Controllers\API
 */

class SupportTypeAPIController extends AppBaseController
{
    /** @var  SupportTypeRepository */
    private $supportTypeRepository;

    public function __construct(SupportTypeRepository $supportTypeRepo)
    {
        $this->supportTypeRepository = $supportTypeRepo;
    }

    /**
     * Display a listing of the SupportType.
     * GET|HEAD /supportTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $supportTypes = $this->supportTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($supportTypes->toArray(), 'Support Types retrieved successfully');
    }

    /**
     * Store a newly created SupportType in storage.
     * POST /supportTypes
     *
     * @param CreateSupportTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupportTypeAPIRequest $request)
    {
        $input = $request->all();

        $supportType = $this->supportTypeRepository->create($input);

        return $this->sendResponse($supportType->toArray(), 'Support Type saved successfully');
    }

    /**
     * Display the specified SupportType.
     * GET|HEAD /supportTypes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SupportType $supportType */
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            return $this->sendError('Support Type not found');
        }

        return $this->sendResponse($supportType->toArray(), 'Support Type retrieved successfully');
    }

    /**
     * Update the specified SupportType in storage.
     * PUT/PATCH /supportTypes/{id}
     *
     * @param int $id
     * @param UpdateSupportTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupportTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var SupportType $supportType */
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            return $this->sendError('Support Type not found');
        }

        $supportType = $this->supportTypeRepository->update($input, $id);

        return $this->sendResponse($supportType->toArray(), 'SupportType updated successfully');
    }

    /**
     * Remove the specified SupportType from storage.
     * DELETE /supportTypes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SupportType $supportType */
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            return $this->sendError('Support Type not found');
        }

        $supportType->delete();

        return $this->sendSuccess('Support Type deleted successfully');
    }
}
