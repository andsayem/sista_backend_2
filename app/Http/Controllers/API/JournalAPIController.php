<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJournalAPIRequest;
use App\Http\Requests\API\UpdateJournalAPIRequest;
use App\Models\Journal;
use App\Repositories\JournalRepository;
use Illuminate\Http\Request;
use App\Http\Resources\JournalResource;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class JournalController
 * @package App\Http\Controllers\API
 */

class JournalAPIController extends AppBaseController
{
    /** @var  JournalRepository */
    private $journalRepository;

    public function __construct(JournalRepository $journalRepo)
    {
        $this->journalRepository = $journalRepo;
    }

    /**
     * Display a listing of the Journal.
     * GET|HEAD /journals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $journals = $this->journalRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        // );
        $journals = Journal::limit($request->limit ? $request->limit : 100)->orderBy('id','DESC')->get();
       // $data_return  =   JournalResource::collection($journals);

        return $this->sendResponse($journals->toArray(), 'Journals retrieved successfully');
    }

    /**
     * Store a newly created Journal in storage.
     * POST /journals
     *
     * @param CreateJournalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJournalAPIRequest $request)
    {
        $input = $request->all();

        $journal = $this->journalRepository->create($input);

        return $this->sendResponse($journal->toArray(), 'Journal saved successfully');
    }

    /**
     * Display the specified Journal.
     * GET|HEAD /journals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Journal $journal */
        $journal = $this->journalRepository->find($id);

        if (empty($journal)) {
            return $this->sendError('Journal not found');
        }

        return $this->sendResponse($journal->toArray(), 'Journal retrieved successfully');
    }

    /**
     * Update the specified Journal in storage.
     * PUT/PATCH /journals/{id}
     *
     * @param int $id
     * @param UpdateJournalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJournalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Journal $journal */
        $journal = $this->journalRepository->find($id);

        if (empty($journal)) {
            return $this->sendError('Journal not found');
        }

        $journal = $this->journalRepository->update($input, $id);

        return $this->sendResponse($journal->toArray(), 'Journal updated successfully');
    }

    /**
     * Remove the specified Journal from storage.
     * DELETE /journals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Journal $journal */
        $journal = $this->journalRepository->find($id);

        if (empty($journal)) {
            return $this->sendError('Journal not found');
        }

        $journal->delete();

        return $this->sendSuccess('Journal deleted successfully');
    }
}
