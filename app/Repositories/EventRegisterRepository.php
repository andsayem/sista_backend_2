<?php

namespace App\Repositories;

use App\Models\EventRegister;
use App\Repositories\BaseRepository;

/**
 * Class EventRegisterRepository
 * @package App\Repositories
 * @version April 1, 2022, 1:19 pm UTC
*/

class EventRegisterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'event_date',
        'event_id'
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
        return EventRegister::class;
    }
}
