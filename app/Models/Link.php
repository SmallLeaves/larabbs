<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Link extends Model
{
    protected $fillable = ['link','title'];

    public $cache_key = 'larabbs_links';
    protected $cache_expire_in_seconds = 1440*60;

    public function getAllCached(){
        // 尝试从缓存中取出cache_key对应的数据,如果能够取到,便直接返回数据
        // 否则运行匿名函数中的代码并取出links表中所有的数据,返回的同时做了缓存
        return Cache::remember($this->cache_key,$this->cache_expire_in_seconds,function(){
            return $this->all();
        });
    }
}
