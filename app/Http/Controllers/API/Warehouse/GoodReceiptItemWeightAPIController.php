<?php

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Requests\API\Warehouse\CreateGoodReceiptItemWeightAPIRequest;
use App\Http\Requests\API\Warehouse\UpdateGoodReceiptItemWeightAPIRequest;
use App\Models\Warehouse\GoodReceiptItemWeight;
use App\Repositories\Warehouse\GoodReceiptItemWeightRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Warehouse\GoodReceiptItemWeightResource;
use Response;

/**
 * Class GoodReceiptItemWeightController
 * @package App\Http\Controllers\API\Warehouse
 */

class GoodReceiptItemWeightAPIController extends AppBaseController
{
    /** @var  GoodReceiptItemWeightRepository */
    private $goodReceiptItemWeightRepository;

    public function __construct(GoodReceiptItemWeightRepository $goodReceiptItemWeightRepo)
    {
        $this->goodReceiptItemWeightRepository = $goodReceiptItemWeightRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceiptItemWeights",
     *      summary="Get a listing of the GoodReceiptItemWeights.",
     *      tags={"GoodReceiptItemWeight"},
     *      description="Get all GoodReceiptItemWeights",
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
     *                  @SWG\Items(ref="#/definitions/GoodReceiptItemWeight")
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
        $goodReceiptItemWeights = $this->goodReceiptItemWeightRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(GoodReceiptItemWeightResource::collection($goodReceiptItemWeights), 'Good Receipt Item Weights retrieved successfully');
    }

    /**
     * @param CreateGoodReceiptItemWeightAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/goodReceiptItemWeights",
     *      summary="Store a newly created GoodReceiptItemWeight in storage",
     *      tags={"GoodReceiptItemWeight"},
     *      description="Store GoodReceiptItemWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceiptItemWeight that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceiptItemWeight")
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
     *                  ref="#/definitions/GoodReceiptItemWeight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGoodReceiptItemWeightAPIRequest $request)
    {
        $input = $request->all();

        $goodReceiptItemWeight = $this->goodReceiptItemWeightRepository->create($input);

        return $this->sendResponse(new GoodReceiptItemWeightResource($goodReceiptItemWeight), 'Good Receipt Item Weight saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceiptItemWeights/{id}",
     *      summary="Display the specified GoodReceiptItemWeight",
     *      tags={"GoodReceiptItemWeight"},
     *      description="Get GoodReceiptItemWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItemWeight",
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
     *                  ref="#/definitions/GoodReceiptItemWeight"
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
        /** @var GoodReceiptItemWeight $goodReceiptItemWeight */
        $goodReceiptItemWeight = $this->goodReceiptItemWeightRepository->find($id);

        if (empty($goodReceiptItemWeight)) {
            return $this->sendError('Good Receipt Item Weight not found');
        }

        return $this->sendResponse(new GoodReceiptItemWeightResource($goodReceiptItemWeight), 'Good Receipt Item Weight retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGoodReceiptItemWeightAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/goodReceiptItemWeights/{id}",
     *      summary="Update the specified GoodReceiptItemWeight in storage",
     *      tags={"GoodReceiptItemWeight"},
     *      description="Update GoodReceiptItemWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItemWeight",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceiptItemWeight that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceiptItemWeight")
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
     *                  ref="#/definitions/GoodReceiptItemWeight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGoodReceiptItemWeightAPIRequest $request)
    {
        $input = $request->all();

        /** @var GoodReceiptItemWeight $goodReceiptItemWeight */
        $goodReceiptItemWeight = $this->goodReceiptItemWeightRepository->find($id);

        if (empty($goodReceiptItemWeight)) {
            return $this->sendError('Good Receipt Item Weight not found');
        }

        $goodReceiptItemWeight = $this->goodReceiptItemWeightRepository->update($input, $id);

        return $this->sendResponse(new GoodReceiptItemWeightResource($goodReceiptItemWeight), 'GoodReceiptItemWeight updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/goodReceiptItemWeights/{id}",
     *      summary="Remove the specified GoodReceiptItemWeight from storage",
     *      tags={"GoodReceiptItemWeight"},
     *      description="Delete GoodReceiptItemWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItemWeight",
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
        /** @var GoodReceiptItemWeight $goodReceiptItemWeight */
        $goodReceiptItemWeight = $this->goodReceiptItemWeightRepository->find($id);

        if (empty($goodReceiptItemWeight)) {
            return $this->sendError('Good Receipt Item Weight not found');
        }

        $goodReceiptItemWeight->delete();

        return $this->sendSuccess('Good Receipt Item Weight deleted successfully');
    }
}
