<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth;

/**
 * Class AllComment
 * @package App\Models
 * @version February 21, 2021, 6:17 am UTC
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $parent_id
 * @property string $comm_test
 */
class AllComment extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'all_comments';
    

    protected $dates = ['deleted_at'];



    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'comm_test'
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
        'parent_id' => 'integer',
        'comm_test' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required|numeric',
        'user_id' => 'required|numeric',
        'comm_test' => 'required'
    ];
    
    public function childs()
	{
	    return $this->hasMany(AllComment::class,'parent_id','id');
	}
	 public function reply(){
         return  AllComment::where('parent_id',$this->id)->get();
    }
        public function userjoin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function commentLike(){
        $user = Auth::user();
        if(AllLike::where('user_id',$user->id)->where('post_id',$this->post_id)->where('comm_id',$this->id)->exists()){
            return true ;
        }else{
            return false ;
        }
    }
   
    
}
