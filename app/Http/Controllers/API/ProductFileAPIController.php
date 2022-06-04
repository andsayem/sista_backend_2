<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductFileAPIRequest;
use App\Http\Requests\API\UpdateProductFileAPIRequest;
use App\Models\ProductFile;
use App\Repositories\ProductFileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductFileController
 * @package App\Http\Controllers\API
 */

class ProductFileAPIController extends AppBaseController
{
    /** @var  ProductFileRepository */
    private $productFileRepository;

    public function __construct(ProductFileRepository $productFileRepo)
    {
        $this->productFileRepository = $productFileRepo;
    }

    /**
     * Display a listing of the ProductFile.
     * GET|HEAD /productFiles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productFiles = $this->productFileRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productFiles->toArray(), 'Product Files retrieved successfully');
    }

    /**
     * Store a newly created ProductFile in storage.
     * POST /productFiles
     *
     * @param CreateProductFileAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductFileAPIRequest $request)
    {
        $input = $request->all();

        $productFile = $this->productFileRepository->create($input);

        return $this->sendResponse($productFile->toArray(), 'Product File saved successfully');
    }

    /**
     * Display the specified ProductFile.
     * GET|HEAD /productFiles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductFile $productFile */
        $productFile = $this->productFileRepository->find($id);

        if (empty($productFile)) {
            return $this->sendError('Product File not found');
        }

        return $this->sendResponse($productFile->toArray(), 'Product File retrieved successfully');
    }

    /**
     * Update the specified ProductFile in storage.
     * PUT/PATCH /productFiles/{id}
     *
     * @param int $id
     * @param UpdateProductFileAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductFileAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductFile $productFile */
        $productFile = $this->productFileRepository->find($id);

        if (empty($productFile)) {
            return $this->sendError('Product File not found');
        }

        $productFile = $this->productFileRepository->update($input, $id);

        return $this->sendResponse($productFile->toArray(), 'ProductFile updated successfully');
    }

    /**
     * Remove the specified ProductFile from storage.
     * DELETE /productFiles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductFile $productFile */
        $productFile = $this->productFileRepository->find($id);

        if (empty($productFile)) {
            return $this->sendError('Product File not found');
        }

        $productFile->delete();

        return $this->sendSuccess('Product File deleted successfully');
    }
}
