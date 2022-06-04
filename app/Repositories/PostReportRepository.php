<?php

namespace App\Repositories;

use App\Models\PostReport;
use App\Repositories\BaseRepository;

/**
 * Class PostReportRepository
 * @package App\Repositories
 * @version March 28, 2022, 1:05 am UTC
*/

class PostReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'user_id',
        'report_id'
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
        return PostReport::class;
    }
}
