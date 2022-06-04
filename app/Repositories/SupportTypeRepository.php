<?php

namespace App\Repositories;

use App\Models\SupportType;
use App\Repositories\BaseRepository;

/**
 * Class SupportTypeRepository
 * @package App\Repositories
 * @version March 26, 2022, 11:08 am UTC
*/

class SupportTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'status',
        'order_by'
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
        return SupportType::class;
    }
}
