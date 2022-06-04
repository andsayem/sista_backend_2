<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ProductFile
 * @package App\Models
 * @version January 8, 2022, 1:31 pm UTC
 *
 * @property integer $product_id
 * @property string $file_name
 */
class ProductFile extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'product_files';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'file_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',
        'file_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'file_name' => 'required'
    ];

    
}
