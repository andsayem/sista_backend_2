<?php

namespace App\Repositories;

use App\Models\PostData;
use App\Repositories\BaseRepository;

/**
 * Class PostDataRepository
 * @package App\Repositories
 * @version February 20, 2021, 7:29 am UTC
*/

class PostDataRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'post_type',
        'caption',
        'cat_id',
        'background_id',
        'font_style',
        'font_size'
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
        return PostData::class;
    }
}
