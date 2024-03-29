<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasRoles;

    use Notifiable,MustVerifyEmailTrait;

    use Traits\ActiveUserHelper;

    use Traits\LastActivedAtHelper;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Notifiable {
        notify as protected laravelNotify;
    }
    public function notify($instance){
        if($this->id == Auth::id()){
            return ;
        }
        if(method_exists($instance,'toDatabase')){
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function topics(){
        return $this->hasMany(Topic::class);
    }
    public function isAuthorOf($model){
        return $this->id === $model->user_id;
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function markAsRead(){
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
    public function setPasswordAttribute($value){
        // 如果值得长度等于60  即认为是已经做过加密的情况
        if(strlen($value) != 60){
            // 不等于60  做密码加密处理
            $value = bcrypt($value);
        }
        $this->attributes['password'] = $value;
    }
    public function setAvatarAttribute($path){
        // 如果不是HTTP开头的 就是后台上传的  要补全URL
        if(! starts_with($path,'http')){
            // 拼接完整的URL
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }
        $this->attributes['avatar'] = $path;
    }
}
