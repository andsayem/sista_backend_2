<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SupportType
 * @package App\Models
 * @version March 26, 2022, 11:08 am UTC
 *
 * @property string $title
 * @property integer $status
 * @property integer $order_by
 */
class SupportType extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'support_types';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'status',
        'order_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'status' => 'integer',
        'order_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
