<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PostCategory
 * @package App\Models
 * @version February 20, 2021, 7:07 am UTC
 *
 * @property string $cat_name
 * @property string $cat_image
 */
class PostCategory extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'post_categories';
    

    protected $dates = ['deleted_at'];



    protected $fillable = [
        'cat_name',
        'cat_image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cat_name' => 'string',
        'cat_image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cat_name' => 'required'
    ];

    
}
