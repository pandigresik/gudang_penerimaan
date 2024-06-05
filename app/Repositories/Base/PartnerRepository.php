<?php

namespace App\Repositories\Base;

use App\Models\Base\Partner;
use App\Repositories\BaseRepository;

/**
 * Class PartnerRepository
 * @package App\Repositories\Base
 * @version May 15, 2024, 5:32 am WIB
*/

class PartnerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description',
        'active',
        'address',
        'city',
        'email',
        'phone',
        'mobile',
        'additional_info'
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
        return Partner::class;
    }
}
