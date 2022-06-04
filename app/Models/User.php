<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp_code',
        'age_range',
        'description',
        'gender',
        'zip_code',
        'pro_image',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // public static $rules = [ 
    //     'name' => 'required',
    //     'email' => 'required|unique:users,email,'.$this->user->email,
    //     'password' => 'required',
    // ];

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'user';

    public function isAdmin()    {        
        return $this->type === self::ADMIN_TYPE;    
    }
     public function totalPost(){
        return  PostData::where('user_id',$this->id)->count();
        // return  AllComment::where('post_id',$this->id)->where('parent_id',0)->get();
    }
     public function totalFollowers(){
        return  Following::where('user_id',$this->id)->count();
        // return  AllComment::where('post_id',$this->id)->where('parent_id',0)->get();
    }
     public function totalPhotos(){
        return  PostData::where('post_datas.user_id',$this->id)->join('files_paths','files_paths.post_id','post_datas.id')->where('post_datas.post_type',1)->count();
        // return  AllComment::where('post_id',$this->id)->where('parent_id',0)->get();
    }
      public function Photos(){
        return  PostData::where('user_id',$this->id) 
        ->limit(3)
        ->orderBy('id','DESC')
        ->where('post_type',1)->get(); 
    }
    public function totalVideo(){
        return  PostData::where('post_datas.user_id',$this->id)->join('files_paths','files_paths.post_id','post_datas.id')->where('post_datas.post_type',2)->count();
        // return  AllComment::where('post_id',$this->id)->where('parent_id',0)->get();
    }
     public function videos(){
        return  PostData::where('post_datas.user_id',$this->id)
        ->join('files_paths','files_paths.post_id','post_datas.id')
        ->limit(2)
        ->orderBy('post_datas.id','DESC')
        ->where('post_datas.post_type',2)->get();
       
    }
    

}
