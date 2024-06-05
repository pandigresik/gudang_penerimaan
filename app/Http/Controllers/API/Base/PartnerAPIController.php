<?php

namespace App\Http\Controllers\API\Base;

use App\Http\Requests\API\Base\CreatePartnerAPIRequest;
use App\Http\Requests\API\Base\UpdatePartnerAPIRequest;
use App\Models\Base\Partner;
use App\Repositories\Base\PartnerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Base\PartnerResource;
use Response;

/**
 * Class PartnerController
 * @package App\Http\Controllers\API\Base
 */

class PartnerAPIController extends AppBaseController
{
    /** @var  PartnerRepository */
    private $partnerRepository;

    public function __construct(PartnerRepository $partnerRepo)
    {
        $this->partnerRepository = $partnerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/partners",
     *      summary="Get a listing of the Partners.",
     *      tags={"Partner"},
     *      description="Get all Partners",
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
     *                  @SWG\Items(ref="#/definitions/Partner")
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
        $partners = $this->partnerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PartnerResource::collection($partners), 'Partners retrieved successfully');
    }

    /**
     * @param CreatePartnerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/partners",
     *      summary="Store a newly created Partner in storage",
     *      tags={"Partner"},
     *      description="Store Partner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Partner that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Partner")
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
     *                  ref="#/definitions/Partner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePartnerAPIRequest $request)
    {
        $input = $request->all();

        $partner = $this->partnerRepository->create($input);

        return $this->sendResponse(new PartnerResource($partner), 'Partner saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/partners/{id}",
     *      summary="Display the specified Partner",
     *      tags={"Partner"},
     *      description="Get Partner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Partner",
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
     *                  ref="#/definitions/Partner"
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
        /** @var Partner $partner */
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return $this->sendError('Partner not found');
        }

        return $this->sendResponse(new PartnerResource($partner), 'Partner retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePartnerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/partners/{id}",
     *      summary="Update the specified Partner in storage",
     *      tags={"Partner"},
     *      description="Update Partner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Partner",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Partner that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Partner")
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
     *                  ref="#/definitions/Partner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePartnerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Partner $partner */
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return $this->sendError('Partner not found');
        }

        $partner = $this->partnerRepository->update($input, $id);

        return $this->sendResponse(new PartnerResource($partner), 'Partner updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/partners/{id}",
     *      summary="Remove the specified Partner from storage",
     *      tags={"Partner"},
     *      description="Delete Partner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Partner",
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
        /** @var Partner $partner */
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return $this->sendError('Partner not found');
        }

        $partner->delete();

        return $this->sendSuccess('Partner deleted successfully');
    }
}
