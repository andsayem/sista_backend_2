<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\BaseRepository;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version August 13, 2021, 4:07 pm UTC
*/

class EventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'details',
        'event_date',
        'event_time',
        'location'
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
        return Event::class;
    }
}
