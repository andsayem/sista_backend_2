<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EventRegister
 * @package App\Models
 * @version April 1, 2022, 1:19 pm UTC
 *
 * @property integer $user_id
 * @property string $event_date
 * @property integer $event_id
 */
class EventRegister extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'event_registers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'event_date',
        'event_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'event_date' => 'string',
        'event_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'event_date' => 'required',
        'event_id' => 'required'
    ];

    
}
