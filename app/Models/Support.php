<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Support
 * @package App\Models
 * @version March 26, 2022, 11:17 am UTC
 *
 * @property integer $user_id
 * @property integer $support_type_id
 */
class Support extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'supports';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'details',
        'support_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'support_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'support_type_id' => 'numeric|'
    ];

    
}
