<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Conversation
 * @package App\Models
 * @version June 4, 2021, 5:05 pm UTC
 *
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $message
 */
class Conversation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'conversations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'sender_id',
        'receiver_id',
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'sender_id' => 'required',
        'receiver_id' => 'required',
        'message' => 'required'
    ];
     public function userjoin($user){
         return  User::find($user);
    }
 
}
