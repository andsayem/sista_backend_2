<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupportAPIRequest;
use App\Http\Requests\API\UpdateSupportAPIRequest;
use App\Models\Support;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Auth;
/**
 * Class SupportController
 * @package App\Http\Controllers\API
 */

class SupportAPIController extends AppBaseController
{
    /** @var  SupportRepository */
    private $supportRepository;

    public function __construct(SupportRepository $supportRepo)
    {
        $this->supportRepository = $supportRepo;
    }

    /**
     * Display a listing of the Support.
     * GET|HEAD /supports
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $supports = $this->supportRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($supports->toArray(), 'Supports retrieved successfully');
    }

    /**
     * Store a newly created Support in storage.
     * POST /supports
     *
     * @param CreateSupportAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupportAPIRequest $request)
    {
        $user_data = Auth::user();
        $request['user_id'] =  $user_data->id ;
        $input = $request->all();
        //return response()->json($input);
        $support = $this->supportRepository->create($input);

        return $this->sendResponse($support->toArray(), 'Support saved successfully');
    }

    /**
     * Display the specified Support.
     * GET|HEAD /supports/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Support $support */
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            return $this->sendError('Support not found');
        }

        return $this->sendResponse($support->toArray(), 'Support retrieved successfully');
    }

    /**
     * Update the specified Support in storage.
     * PUT/PATCH /supports/{id}
     *
     * @param int $id
     * @param UpdateSupportAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupportAPIRequest $request)
    {
        $input = $request->all();

        /** @var Support $support */
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            return $this->sendError('Support not found');
        }

        $support = $this->supportRepository->update($input, $id);

        return $this->sendResponse($support->toArray(), 'Support updated successfully');
    }

    /**
     * Remove the specified Support from storage.
     * DELETE /supports/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Support $support */
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            return $this->sendError('Support not found');
        }

        $support->delete();

        return $this->sendSuccess('Support deleted successfully');
    }
}
