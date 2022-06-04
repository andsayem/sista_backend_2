<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth ;
use Str ;

/**
 * Class PostData
 * @package App\Models
 * @version February 20, 2021, 7:29 am UTC
 *
 * @property integer $user_id
 * @property integer $post_type
 * @property string $caption
 * @property integer $cat_id
 * @property integer $background_id
 * @property string $font_style
 * @property string $font_size
 */
class PostData extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'post_datas';
    

    protected $dates = ['deleted_at'];



    protected $fillable = [
        'user_id',
        'post_type',
        'caption',
        'cat_id',
        'background_id',
        'font_style',
        'font_size'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_type' => 'integer',
        'caption' => 'string',
        'cat_id' => 'integer',
        'background_id' => 'integer',
        'font_style' => 'string',
        'font_size' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
     public static $rules = [];
    // public static $rules = [
    //     'user_id' => 'required|numeric',
    //     'post_type' => 'required|numeric'  
    // ];

    public function userjoin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function catjoin()
    {
        return $this->belongsTo(PostCategory::class, 'cat_id');
    }
    public function filejoin()
    {
         return $this->belongsTo(FilesPath::class, 'id','post_id' );
        //return  FilesPath::find($this->id);
    } 
    public function getLikesAttribute()
    {
        //return $this->belongsTo(AllLike::class, 'id', 'post_id');
        return AllLike::where('post_id', $this->id)->where('comm_id',0)->count('id');
    }
    public function getCommentsAttribute()
    { 
        return AllComment::where('post_id', $this->id)->count('id');
    }
    public function comments()
    {
        return $this->belongsTo(AllComment::class, 'id', 'post_id');
    }
    public function MyLike(){
        $user = Auth::user();
        if(AllLike::where('user_id',$user->id)->where('post_id',$this->id)->exists()){
            return true ;
        }else{
            return false ;
        }
    }
    public function followings(){
         $user = Auth::user();
         if($this->user_id == $user->id){
               return 1 ;
         }
        if(Following::where('user_id',$user->id)->where('follower_id',$this->user_id)->exists()){
            return 1 ;
        }else{
            return 0 ;
        }
    }
    public function getShortCaptionAttribute(){
       return  Str::of( $this->caption)->limit(100);
    }
    public function getShareAttribute(){
       return '1.3k';
    }
    public function allComments(){
         return  AllComment::where('post_id',$this->id)->where('parent_id',0)->get();
    }
}
