<?php

namespace App\Repositories;

use App\Models\Journal;
use App\Repositories\BaseRepository;

/**
 * Class JournalRepository
 * @package App\Repositories
 * @version August 20, 2021, 4:11 am UTC
*/

class JournalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'details',
        'user_id'
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
        return Journal::class;
    }
}
