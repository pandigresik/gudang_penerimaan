<?php

namespace App\Http\Controllers\Base;

use App\DataTables\Base\ProductDataTable;
use App\Http\Requests\Base\CreateProductRequest;
use App\Http\Requests\Base\UpdateProductRequest;
use App\Repositories\Base\ProductRepository;
use App\Repositories\Base\ProductCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = ProductRepository::class;
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('base.products.index');
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        return view('base.products.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = $this->getRepositoryObj()->create($input);
        if($product instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $product->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/products.singular')]));

        return redirect(route('base.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->getRepositoryObj()->find($id);

        if (empty($product)) {
            Flash::error(__('models/products.singular').' '.__('messages.not_found'));

            return redirect(route('base.products.index'));
        }

        return view('base.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->getRepositoryObj()->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('base.products.index'));
        }
        
        return view('base.products.edit')->with('product', $product)->with($this->getOptionItems());
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->getRepositoryObj()->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('base.products.index'));
        }

        $product = $this->getRepositoryObj()->update($request->all(), $id);
        if($product instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $product->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/products.singular')]));

        return redirect(route('base.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->getRepositoryObj()->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('base.products.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/products.singular')]));

        return redirect(route('base.products.index'));
    }

    /**
     * Provide options item based on relationship model Product from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $productCategory = new ProductCategoryRepository();
        return [
            'productCategoryItems' => ['' => __('crud.option.productCategory_placeholder')] + $productCategory->pluck()            
        ];
    }
}
