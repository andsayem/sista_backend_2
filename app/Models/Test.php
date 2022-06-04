<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Test
 * @package App\Models
 * @version February 12, 2021, 5:03 pm UTC
 *
 * @property string $ta
 */
class Test extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'tests';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'ta'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ta' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
