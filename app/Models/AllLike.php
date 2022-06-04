<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth;

/**
 * Class AllLike
 * @package App\Models
 * @version February 21, 2021, 3:51 pm UTC
 *
 * @property integer $post_id
 * @property integer $comm_id
 * @property integer $user_id
 */
class AllLike extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'all_likes';
    

    protected $dates = ['deleted_at'];



    protected $fillable = [
        'post_id',
        'comm_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'comm_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required|numeric',
        'user_id' => 'required|numeric'
    ]; 
    
}
