<?php

namespace App\Repositories;

use App\Models\FilesPath;
use App\Repositories\BaseRepository;

/**
 * Class FilesPathRepository
 * @package App\Repositories
 * @version February 21, 2021, 6:09 am UTC
*/

class FilesPathRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'user_id',
        'path'
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
        return FilesPath::class;
    }
}
