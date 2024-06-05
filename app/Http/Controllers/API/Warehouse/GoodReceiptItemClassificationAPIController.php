<?php

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Requests\API\Warehouse\CreateGoodReceiptItemClassificationAPIRequest;
use App\Http\Requests\API\Warehouse\UpdateGoodReceiptItemClassificationAPIRequest;
use App\Models\Warehouse\GoodReceiptItemClassification;
use App\Repositories\Warehouse\GoodReceiptItemClassificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Warehouse\GoodReceiptItemClassificationResource;
use Response;

/**
 * Class GoodReceiptItemClassificationController
 * @package App\Http\Controllers\API\Warehouse
 */

class GoodReceiptItemClassificationAPIController extends AppBaseController
{
    /** @var  GoodReceiptItemClassificationRepository */
    private $goodReceiptItemClassificationRepository;

    public function __construct(GoodReceiptItemClassificationRepository $goodReceiptItemClassificationRepo)
    {
        $this->goodReceiptItemClassificationRepository = $goodReceiptItemClassificationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceiptItemClassifications",
     *      summary="Get a listing of the GoodReceiptItemClassifications.",
     *      tags={"GoodReceiptItemClassification"},
     *      description="Get all GoodReceiptItemClassifications",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/GoodReceiptItemClassification")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $goodReceiptItemClassifications = $this->goodReceiptItemClassificationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(GoodReceiptItemClassificationResource::collection($goodReceiptItemClassifications), 'Good Receipt Item Classifications retrieved successfully');
    }

    /**
     * @param CreateGoodReceiptItemClassificationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/goodReceiptItemClassifications",
     *      summary="Store a newly created GoodReceiptItemClassification in storage",
     *      tags={"GoodReceiptItemClassification"},
     *      description="Store GoodReceiptItemClassification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceiptItemClassification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceiptItemClassification")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/GoodReceiptItemClassification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGoodReceiptItemClassificationAPIRequest $request)
    {
        $input = $request->all();

        $goodReceiptItemClassification = $this->goodReceiptItemClassificationRepository->create($input);

        return $this->sendResponse(new GoodReceiptItemClassificationResource($goodReceiptItemClassification), 'Good Receipt Item Classification saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceiptItemClassifications/{id}",
     *      summary="Display the specified GoodReceiptItemClassification",
     *      tags={"GoodReceiptItemClassification"},
     *      description="Get GoodReceiptItemClassification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItemClassification",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/GoodReceiptItemClassification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var GoodReceiptItemClassification $goodReceiptItemClassification */
        $goodReceiptItemClassification = $this->goodReceiptItemClassificationRepository->find($id);

        if (empty($goodReceiptItemClassification)) {
            return $this->sendError('Good Receipt Item Classification not found');
        }

        return $this->sendResponse(new GoodReceiptItemClassificationResource($goodReceiptItemClassification), 'Good Receipt Item Classification retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGoodReceiptItemClassificationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/goodReceiptItemClassifications/{id}",
     *      summary="Update the specified GoodReceiptItemClassification in storage",
     *      tags={"GoodReceiptItemClassification"},
     *      description="Update GoodReceiptItemClassification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItemClassification",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceiptItemClassification that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceiptItemClassification")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/GoodReceiptItemClassification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGoodReceiptItemClassificationAPIRequest $request)
    {
        $input = $request->all();

        /** @var GoodReceiptItemClassification $goodReceiptItemClassification */
        $goodReceiptItemClassification = $this->goodReceiptItemClassificationRepository->find($id);

        if (empty($goodReceiptItemClassification)) {
            return $this->sendError('Good Receipt Item Classification not found');
        }

        $goodReceiptItemClassification = $this->goodReceiptItemClassificationRepository->update($input, $id);

        return $this->sendResponse(new GoodReceiptItemClassificationResource($goodReceiptItemClassification), 'GoodReceiptItemClassification updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/goodReceiptItemClassifications/{id}",
     *      summary="Remove the specified GoodReceiptItemClassification from storage",
     *      tags={"GoodReceiptItemClassification"},
     *      description="Delete GoodReceiptItemClassification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItemClassification",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var GoodReceiptItemClassification $goodReceiptItemClassification */
        $goodReceiptItemClassification = $this->goodReceiptItemClassificationRepository->find($id);

        if (empty($goodReceiptItemClassification)) {
            return $this->sendError('Good Receipt Item Classification not found');
        }

        $goodReceiptItemClassification->delete();

        return $this->sendSuccess('Good Receipt Item Classification deleted successfully');
    }
}
