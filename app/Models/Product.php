<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Product
 * @package App\Models
 * @version January 8, 2022, 1:19 pm UTC
 *
 * @property string $title
 * @property integer $category_id
 * @property string $details
 * @property string $price
 * @property string $price_offer
 * @property string $offer_type
 * @property numeric $status
 */
class Product extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'category_id',
        'details',
        'price',
        'file',
        'price_offer',
        'offer_type',
        'offer_value',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'category_id' => 'integer',
        'details' => 'string',
        'price' => 'string',
        'price_offer' => 'string',
        'offer_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'category_id' => 'numeric'
    ];
        public function filejoin()
    {
         return $this->belongsTo(ProductFile::class, 'id','product_id' );
        //return  FilesPath::find($this->id);
    } 
    
}
