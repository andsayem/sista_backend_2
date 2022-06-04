<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\BaseRepository;

/**
 * Class SupportRepository
 * @package App\Repositories
 * @version March 26, 2022, 11:17 am UTC
*/

class SupportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'support_type_id'
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
        return Support::class;
    }
}
