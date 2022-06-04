<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEventRegisterAPIRequest;
use App\Http\Requests\API\UpdateEventRegisterAPIRequest;
use App\Models\EventRegister;
use App\Repositories\EventRegisterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EventRegisterController
 * @package App\Http\Controllers\API
 */

class EventRegisterAPIController extends AppBaseController
{
    /** @var  EventRegisterRepository */
    private $eventRegisterRepository;

    public function __construct(EventRegisterRepository $eventRegisterRepo)
    {
        $this->eventRegisterRepository = $eventRegisterRepo;
    }

    /**
     * Display a listing of the EventRegister.
     * GET|HEAD /eventRegisters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $eventRegisters = $this->eventRegisterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($eventRegisters->toArray(), 'Event Registers retrieved successfully');
    }

    /**
     * Store a newly created EventRegister in storage.
     * POST /eventRegisters
     *
     * @param CreateEventRegisterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEventRegisterAPIRequest $request)
    {
        $input = $request->all();

        $eventRegister = $this->eventRegisterRepository->create($input);

        return $this->sendResponse($eventRegister->toArray(), 'Event Register saved successfully');
    }

    /**
     * Display the specified EventRegister.
     * GET|HEAD /eventRegisters/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EventRegister $eventRegister */
        $eventRegister = $this->eventRegisterRepository->find($id);

        if (empty($eventRegister)) {
            return $this->sendError('Event Register not found');
        }

        return $this->sendResponse($eventRegister->toArray(), 'Event Register retrieved successfully');
    }

    /**
     * Update the specified EventRegister in storage.
     * PUT/PATCH /eventRegisters/{id}
     *
     * @param int $id
     * @param UpdateEventRegisterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRegisterAPIRequest $request)
    {
        $input = $request->all();

        /** @var EventRegister $eventRegister */
        $eventRegister = $this->eventRegisterRepository->find($id);

        if (empty($eventRegister)) {
            return $this->sendError('Event Register not found');
        }

        $eventRegister = $this->eventRegisterRepository->update($input, $id);

        return $this->sendResponse($eventRegister->toArray(), 'EventRegister updated successfully');
    }

    /**
     * Remove the specified EventRegister from storage.
     * DELETE /eventRegisters/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EventRegister $eventRegister */
        $eventRegister = $this->eventRegisterRepository->find($id);

        if (empty($eventRegister)) {
            return $this->sendError('Event Register not found');
        }

        $eventRegister->delete();

        return $this->sendSuccess('Event Register deleted successfully');
    }
}
