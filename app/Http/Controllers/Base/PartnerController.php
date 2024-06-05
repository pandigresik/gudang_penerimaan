<?php

namespace App\Http\Controllers\Base;

use App\DataTables\Base\PartnerDataTable;
use App\Http\Requests\Base\CreatePartnerRequest;
use App\Http\Requests\Base\UpdatePartnerRequest;
use App\Repositories\Base\PartnerRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class PartnerController extends AppBaseController
{
    /** @var  PartnerRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = PartnerRepository::class;
    }

    /**
     * Display a listing of the Partner.
     *
     * @param PartnerDataTable $partnerDataTable
     * @return Response
     */
    public function index(PartnerDataTable $partnerDataTable)
    {
        return $partnerDataTable->render('base.partners.index');
    }

    /**
     * Show the form for creating a new Partner.
     *
     * @return Response
     */
    public function create()
    {
        return view('base.partners.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created Partner in storage.
     *
     * @param CreatePartnerRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnerRequest $request)
    {
        $input = $request->all();

        $partner = $this->getRepositoryObj()->create($input);
        if($partner instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $partner->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/partners.singular')]));

        return redirect(route('base.partners.index'));
    }

    /**
     * Display the specified Partner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partner = $this->getRepositoryObj()->find($id);

        if (empty($partner)) {
            Flash::error(__('models/partners.singular').' '.__('messages.not_found'));

            return redirect(route('base.partners.index'));
        }

        return view('base.partners.show')->with('partner', $partner);
    }

    /**
     * Show the form for editing the specified Partner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partner = $this->getRepositoryObj()->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('base.partners.index'));
        }
        
        return view('base.partners.edit')->with('partner', $partner)->with($this->getOptionItems());
    }

    /**
     * Update the specified Partner in storage.
     *
     * @param  int              $id
     * @param UpdatePartnerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnerRequest $request)
    {
        $partner = $this->getRepositoryObj()->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('base.partners.index'));
        }

        $partner = $this->getRepositoryObj()->update($request->all(), $id);
        if($partner instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $partner->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/partners.singular')]));

        return redirect(route('base.partners.index'));
    }

    /**
     * Remove the specified Partner from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partner = $this->getRepositoryObj()->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('base.partners.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/partners.singular')]));

        return redirect(route('base.partners.index'));
    }

    /**
     * Provide options item based on relationship model Partner from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        
        return [
                        
        ];
    }
}
