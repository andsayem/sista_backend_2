<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Repositories\BaseRepository;
use Auth;

/**
 * Class ConversationRepository
 * @package App\Repositories
 * @version June 4, 2021, 5:05 pm UTC
 */

class ConversationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'receiver_id',
        'message'
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
        return Conversation::class;
    }
    public function chat_list($receiver_id = null)
    {
        $query = $this->model->newQuery();




        $query->whereRaw('(sender_id=' . Auth::user()->id . ' or receiver_id=' . Auth::user()->id . ') and (sender_id='.$receiver_id.' or receiver_id='.$receiver_id.')');

        return $query->get();
    }
}
