<?php

namespace App\Repositories;

use App\Models\PostNotInterested;
use App\Repositories\BaseRepository;

/**
 * Class PostNotInterestedRepository
 * @package App\Repositories
 * @version March 28, 2022, 1:12 am UTC
*/

class PostNotInterestedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
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
        return PostNotInterested::class;
    }
}
