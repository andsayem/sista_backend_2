<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Following
 * @package App\Models
 * @version September 12, 2021, 4:27 pm UTC
 *
 * @property integer $user_id
 * @property integer $follower_id
 */
class Following extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'followings';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'follower_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'follower_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
