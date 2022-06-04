<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Event
 * @package App\Models
 * @version August 13, 2021, 4:07 pm UTC
 *
 * @property string $title
 * @property string $details
 * @property string $event_date
 * @property time $event_time
 * @property string $location
 */
class Event extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'events';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'bg_style_image',
        'event_type',
        'details',
        'event_date',
        'event_time',
        'location'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'bg_style_image' => 'string',
        'details' => 'string',
        'event_date' => 'date',
        'location' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        //'event_time' => 'required'
    ];

    
}
