<?php

namespace App\Repositories;

use App\Models\PostCategory;
use App\Repositories\BaseRepository;

/**
 * Class PostCategoryRepository
 * @package App\Repositories
 * @version February 20, 2021, 7:07 am UTC
*/

class PostCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cat_name',
        'cat_image'
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
        return PostCategory::class;
    }
}
