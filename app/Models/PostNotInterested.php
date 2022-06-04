<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PostNotInterested
 * @package App\Models
 * @version March 28, 2022, 1:12 am UTC
 *
 * @property integer $post_id
 * @property integer $user_id
 */
class PostNotInterested extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'post_not_interesteds';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'post_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'post_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
