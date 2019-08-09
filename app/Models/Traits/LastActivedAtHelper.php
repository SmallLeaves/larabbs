<?php

namespace App\Models\Traits;

use Redis;
use Carbon\Carbon;

trait LastActivedAtHelper{
    // 缓存相关
    protected $hash_prefix = 'larabbs_last_actived_at_';
    protected $field_prefix = 'user_';

    public function getHashFromDateString($date){
        return $this->hash_prefix.$date;
    }
    public function getHashField(){
        return $this->field_prefix.$this->id;
    }
    public function recordLastActivedAt(){
        // 获取今天的日期
        // Redis 哈希表的命名,如:larabbs_last_actived_at_2017-10-21
        $hash = $this->getHashFromDateString( Carbon::now()->toDateString());

        // 字段名称,如user_1
        $field = $this->getHashField();
        //dd(Redis::hGetAll($hash));
        // 当前时间,如:2017-10-21 07:00:00
        $now = Carbon::now()->toDateTimeString();

        // 数据写入Redis 字段已存在会被更新
        Redis::hSet($hash,$field,$now);
    }
    public function syncUserActivedAt()
    {
        // 获取昨天的日期  格式 2017-10-21
        // Redis哈希表命名,如larabbs_last_actived_at_0000-00-00
        $hash = $this->getHashFromDateString( Carbon::yesterday()->toDateString());

        // 从Redis中获取锁头哈希表的数据
        $dates = Redis::hGetAll($hash);
        
        // 遍历,并同步到数据库中
        foreach ($dates as $user_id => $actived_at) {
            
            // 会将user_id转换为1
            $user_id = str_replace($this->field_prefix,'',$user_id);
            // 只有当用户存在时才更新到数据库中
            if($user = $this->find($user_id)){
                $user->last_actived_at = $actived_at;
                $user->save();
            }
        }

        // 以数据库为中心的存储,同步到了数据库就可以删除Redis里面的数据了
        Redis::del($hash);
    }
    public function getLastActiveAtAttribute($value){
        $hash = $this->getHashFromDateString(Carbon::now()->toDateString());
        $field = $this->getHashField();
        $datetime = Redis::hGet($hash,$field) ? : $value;
        if($datetime){
            return new Carbon($datetime);
        }else{
            return $this->created_at;
        }
    }
}