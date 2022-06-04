<?php

namespace App\Repositories;

use App\Models\Following;
use App\Repositories\BaseRepository;

/**
 * Class FollowingRepository
 * @package App\Repositories
 * @version September 12, 2021, 4:27 pm UTC
*/

class FollowingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'follower_id'
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
        return Following::class;
    }
}
