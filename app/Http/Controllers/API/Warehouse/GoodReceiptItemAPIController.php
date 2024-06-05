<?php

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Requests\API\Warehouse\CreateGoodReceiptItemAPIRequest;
use App\Http\Requests\API\Warehouse\UpdateGoodReceiptItemAPIRequest;
use App\Models\Warehouse\GoodReceiptItem;
use App\Repositories\Warehouse\GoodReceiptItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Warehouse\GoodReceiptItemResource;
use Response;

/**
 * Class GoodReceiptItemController
 * @package App\Http\Controllers\API\Warehouse
 */

class GoodReceiptItemAPIController extends AppBaseController
{
    /** @var  GoodReceiptItemRepository */
    private $goodReceiptItemRepository;

    public function __construct(GoodReceiptItemRepository $goodReceiptItemRepo)
    {
        $this->goodReceiptItemRepository = $goodReceiptItemRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceiptItems",
     *      summary="Get a listing of the GoodReceiptItems.",
     *      tags={"GoodReceiptItem"},
     *      description="Get all GoodReceiptItems",
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
     *                  @SWG\Items(ref="#/definitions/GoodReceiptItem")
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
        $goodReceiptItems = $this->goodReceiptItemRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(GoodReceiptItemResource::collection($goodReceiptItems), 'Good Receipt Items retrieved successfully');
    }

    /**
     * @param CreateGoodReceiptItemAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/goodReceiptItems",
     *      summary="Store a newly created GoodReceiptItem in storage",
     *      tags={"GoodReceiptItem"},
     *      description="Store GoodReceiptItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceiptItem that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceiptItem")
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
     *                  ref="#/definitions/GoodReceiptItem"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGoodReceiptItemAPIRequest $request)
    {
        $input = $request->all();

        $goodReceiptItem = $this->goodReceiptItemRepository->create($input);

        return $this->sendResponse(new GoodReceiptItemResource($goodReceiptItem), 'Good Receipt Item saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceiptItems/{id}",
     *      summary="Display the specified GoodReceiptItem",
     *      tags={"GoodReceiptItem"},
     *      description="Get GoodReceiptItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItem",
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
     *                  ref="#/definitions/GoodReceiptItem"
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
        /** @var GoodReceiptItem $goodReceiptItem */
        $goodReceiptItem = $this->goodReceiptItemRepository->find($id);

        if (empty($goodReceiptItem)) {
            return $this->sendError('Good Receipt Item not found');
        }

        return $this->sendResponse(new GoodReceiptItemResource($goodReceiptItem), 'Good Receipt Item retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGoodReceiptItemAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/goodReceiptItems/{id}",
     *      summary="Update the specified GoodReceiptItem in storage",
     *      tags={"GoodReceiptItem"},
     *      description="Update GoodReceiptItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItem",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceiptItem that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceiptItem")
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
     *                  ref="#/definitions/GoodReceiptItem"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGoodReceiptItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var GoodReceiptItem $goodReceiptItem */
        $goodReceiptItem = $this->goodReceiptItemRepository->find($id);

        if (empty($goodReceiptItem)) {
            return $this->sendError('Good Receipt Item not found');
        }

        $goodReceiptItem = $this->goodReceiptItemRepository->update($input, $id);

        return $this->sendResponse(new GoodReceiptItemResource($goodReceiptItem), 'GoodReceiptItem updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/goodReceiptItems/{id}",
     *      summary="Remove the specified GoodReceiptItem from storage",
     *      tags={"GoodReceiptItem"},
     *      description="Delete GoodReceiptItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceiptItem",
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
        /** @var GoodReceiptItem $goodReceiptItem */
        $goodReceiptItem = $this->goodReceiptItemRepository->find($id);

        if (empty($goodReceiptItem)) {
            return $this->sendError('Good Receipt Item not found');
        }

        $goodReceiptItem->delete();

        return $this->sendSuccess('Good Receipt Item deleted successfully');
    }
}
