<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PostReport
 * @package App\Models
 * @version March 28, 2022, 1:05 am UTC
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $report_id
 */
class PostReport extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'post_reports';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'post_id',
        'user_id',
        'report_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'post_id' => 'integer',
        'user_id' => 'integer',
        'report_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
