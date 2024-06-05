<?php

namespace App\Repositories\Base;

use App\Models\Base\ProductCategory;
use App\Repositories\BaseRepository;

/**
 * Class ProductCategoryRepository
 * @package App\Repositories\Base
 * @version May 13, 2024, 8:05 am WIB
*/

class ProductCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description'
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
        return ProductCategory::class;
    }
}
