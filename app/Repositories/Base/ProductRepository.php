<?php

namespace App\Repositories\Base;

use App\Models\Base\Product;
use App\Models\Base\ProductCategory;
use App\Repositories\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories\Base
 * @version May 13, 2024, 7:47 am WIB
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description',
        'product_category_id',
        'image'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
    public function bahanMentah($value = null, $key = null)
    {
        $key = $key ?? $this->model->getKeyName();
        $value = $value ?? $this->model->getShowColumnOption();
        $query = $this->allQuery();

        return $query->bahanMentah()->pluck($value, $key)->toArray();
    }
    public function bahanBaku($value = null, $key = null)
    {
        $key = $key ?? $this->model->getKeyName();
        $value = $value ?? $this->model->getShowColumnOption();
        $query = $this->allQuery();

        return $query->bahanBaku()->pluck($value, $key)->toArray();
    }
}
