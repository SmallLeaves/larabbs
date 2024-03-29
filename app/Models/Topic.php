<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id','excerpt', 'slug'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function scopeWithOrder($query,$order){
        //不同的排序，使用不同的数据读取逻辑
        switch($order){
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
        //预加载防止N+1问题
        return $query->with('user','category');
    }

    public function scopeRecentReplied($query){
        return $query->orderBy('updated_at','desc');
    }
    public function scopeRecent($query){
        return $query->orderBy('created_at','desc');
    }
    public function link($params = []){
        return route('topics.show',array_merge([$this->id,$this->slug],$params));
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function updateReplyCount(){
        $this->reply_count = $this->replies->count();
        $this->save();
    }
}
