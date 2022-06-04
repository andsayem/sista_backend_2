<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Repositories\BaseRepository;

/**
 * Class NotificationRepository
 * @package App\Repositories
 * @version April 27, 2022, 8:23 am UTC
*/

class NotificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'sender_id',
        'source_id',
        'source_type',
        'read',
        'content'
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
        return Notification::class;
    }
}
