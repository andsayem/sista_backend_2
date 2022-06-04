<?php

namespace App\Repositories;

use App\Models\AllComment;
use App\Repositories\BaseRepository;

/**
 * Class AllCommentRepository
 * @package App\Repositories
 * @version February 21, 2021, 6:17 am UTC
*/

class AllCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'user_id',
        'parent_id',
        'comm_test'
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
        return AllComment::class;
    }
}
