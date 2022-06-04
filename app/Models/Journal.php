<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Journal
 * @package App\Models
 * @version August 20, 2021, 4:11 am UTC
 *
 * @property string $title
 * @property string $details
 * @property integer $user_id
 */
class Journal extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'journals';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'details',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'details' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function userjoin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
