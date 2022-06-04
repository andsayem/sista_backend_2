<?php

namespace App\Repositories;

use App\Models\ProductFile;
use App\Repositories\BaseRepository;

/**
 * Class ProductFileRepository
 * @package App\Repositories
 * @version January 8, 2022, 1:31 pm UTC
*/

class ProductFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'file_name'
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
        return ProductFile::class;
    }
}
