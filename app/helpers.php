<?php

function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}
function category_nav_active($category_id){
    return active_class((if_route('categories.show') && if_route_param('category',$category_id)));
}
function make_excerpt($value,$length = 200){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt,$length);
}
function model_admin_link($title,$model){
    return model_link($title,$model,'admin');
}
function model_link($title,$model,$prefix=''){
    // 获取数据模型的复数蛇形命名
    $model_name = model_plural_name($model);
    // 初始化前缀
    $prefix = $prefix?"/$prefix/":'/';
    // 视同站点URL拼接全量URL
    $url = config('app.url').$prefix.$model_name.'/'.$model->id;
    // 拼接HTML A 标签  并返回
    return '<a href="'.$url.'" target="_blank">'.$title.'</a>';
}
function model_plural_name($model){
    // 从实体中获取完整类名，例如App\Models\User
    $full_class_name = get_class($model);
    // 获取基础类名，例如传入app\Models\User会得到User
    $class_name = class_basename($full_class_name);
    // 蛇形命名,例如 传入User会得到user,传入FooBar会得到foo_bar
    $snake_case_name = snake_case($class_name);
    //获取子串的复数形式,例如传参user会得到users
    return str_plural($snake_case_name);
}



 ?>

