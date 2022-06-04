<?php

namespace App\Repositories;

use App\Models\AllLike;
use App\Repositories\BaseRepository;

/**
 * Class AllLikeRepository
 * @package App\Repositories
 * @version February 21, 2021, 3:51 pm UTC
*/

class AllLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'comm_id',
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
        return AllLike::class;
    }
}
