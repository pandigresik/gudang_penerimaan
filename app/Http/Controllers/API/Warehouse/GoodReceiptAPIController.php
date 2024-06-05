<?php

namespace App\Http\Controllers\API\Warehouse;

use App\Http\Requests\API\Warehouse\CreateGoodReceiptAPIRequest;
use App\Http\Requests\API\Warehouse\UpdateGoodReceiptAPIRequest;
use App\Models\Warehouse\GoodReceipt;
use App\Repositories\Warehouse\GoodReceiptRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Warehouse\GoodReceiptResource;
use Response;

/**
 * Class GoodReceiptController
 * @package App\Http\Controllers\API\Warehouse
 */

class GoodReceiptAPIController extends AppBaseController
{
    /** @var  GoodReceiptRepository */
    private $goodReceiptRepository;

    public function __construct(GoodReceiptRepository $goodReceiptRepo)
    {
        $this->goodReceiptRepository = $goodReceiptRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceipts",
     *      summary="Get a listing of the GoodReceipts.",
     *      tags={"GoodReceipt"},
     *      description="Get all GoodReceipts",
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
     *                  @SWG\Items(ref="#/definitions/GoodReceipt")
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
        $goodReceipts = $this->goodReceiptRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(GoodReceiptResource::collection($goodReceipts), 'Good Receipts retrieved successfully');
    }

    /**
     * @param CreateGoodReceiptAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/goodReceipts",
     *      summary="Store a newly created GoodReceipt in storage",
     *      tags={"GoodReceipt"},
     *      description="Store GoodReceipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceipt that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceipt")
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
     *                  ref="#/definitions/GoodReceipt"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGoodReceiptAPIRequest $request)
    {
        $input = $request->all();

        $goodReceipt = $this->goodReceiptRepository->create($input);

        return $this->sendResponse(new GoodReceiptResource($goodReceipt), 'Good Receipt saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/goodReceipts/{id}",
     *      summary="Display the specified GoodReceipt",
     *      tags={"GoodReceipt"},
     *      description="Get GoodReceipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceipt",
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
     *                  ref="#/definitions/GoodReceipt"
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
        /** @var GoodReceipt $goodReceipt */
        $goodReceipt = $this->goodReceiptRepository->find($id);

        if (empty($goodReceipt)) {
            return $this->sendError('Good Receipt not found');
        }

        return $this->sendResponse(new GoodReceiptResource($goodReceipt), 'Good Receipt retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGoodReceiptAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/goodReceipts/{id}",
     *      summary="Update the specified GoodReceipt in storage",
     *      tags={"GoodReceipt"},
     *      description="Update GoodReceipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceipt",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="GoodReceipt that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/GoodReceipt")
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
     *                  ref="#/definitions/GoodReceipt"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGoodReceiptAPIRequest $request)
    {
        $input = $request->all();

        /** @var GoodReceipt $goodReceipt */
        $goodReceipt = $this->goodReceiptRepository->find($id);

        if (empty($goodReceipt)) {
            return $this->sendError('Good Receipt not found');
        }

        $goodReceipt = $this->goodReceiptRepository->update($input, $id);

        return $this->sendResponse(new GoodReceiptResource($goodReceipt), 'GoodReceipt updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/goodReceipts/{id}",
     *      summary="Remove the specified GoodReceipt from storage",
     *      tags={"GoodReceipt"},
     *      description="Delete GoodReceipt",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GoodReceipt",
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
        /** @var GoodReceipt $goodReceipt */
        $goodReceipt = $this->goodReceiptRepository->find($id);

        if (empty($goodReceipt)) {
            return $this->sendError('Good Receipt not found');
        }

        $goodReceipt->delete();

        return $this->sendSuccess('Good Receipt deleted successfully');
    }
}
