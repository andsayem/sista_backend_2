<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FilesPath
 * @package App\Models
 * @version February 21, 2021, 6:09 am UTC
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property string $path
 */
class FilesPath extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'files_paths';
    

    protected $dates = ['deleted_at'];



    protected $fillable = [
        'post_id',
        'user_id',
        'path'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'user_id' => 'integer',
        'path' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required|numeric',
        'user_id' => 'required|numeric',
        'path' => 'required'
    ];

    
}
