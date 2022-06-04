<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Notification
 * @package App\Models
 * @version April 27, 2022, 8:23 am UTC
 *
 * @property integer $user_id
 * @property integer $sender_id
 * @property integer $source_id
 * @property integer $source_type
 * @property integer $read
 * @property string $content
 */
class Notification extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'notifications';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'sender_id',
        'source_id',
        'source_type',
        'read',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'sender_id' => 'integer',
        'source_id' => 'integer',
        'source_type' => 'integer',
        'read' => 'integer',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
