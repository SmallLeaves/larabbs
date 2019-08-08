<?php

use App\Models\User;

return [
    //页面标题
    'title' => '用户',
    // 模型单数。用作页面 新建$single
    'single' => '用户',
    // 数据模型，用作数据的crud
    'model' => User::class,
    // 设置当前页面的访问权限，通过返回布尔值来控制权限
    // 返回true即通过验证，false就是无权访问并从menu隐藏
    'permission' => function(){
        return Auth::user()->can('manage_users');
    },
    // 字段副总渲染数据表格  由无数的列组成
    'columns' => [
        // 列的标示，这是一个最小化列的信息配置的例子，读取的是模型对应的属性值，如$model->id
        'id',
        'avatar' => [
            // 数据表格里列的名称，默认会使用列标识
            'title' => '头像',
            // 默认情况下回直接输出数据，你也可以使用output选项来控制输出的内容
            'output' => function($avatar,$model){
                return empty($avatar)?'N/A':'<img src="'.$avatar.'" width="40">';
            },
            // 是否允许排序
            'sorttable' => false,
        ],
        'name' => [
            'title' => '用户名',
            'sorttable' => false,
            'output' => function($name,$model){
                return '<a href="/users/'.$model->id.'" target=_blank>'.$name.'</a>';
            },
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'operation' => [
            'title' => '管理',
            'sorttable' => false,
        ],
    ],
    // 模型表单设置项
    'edit_fields' => [
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'password' => [
            'title' => '密码',
            'type'  => 'password',
        ],
        'avatar'    => [
            'title' => '用户头像',
            'type'  => 'image',
            'location' => public_path().'/uploads/images/avatars',
        ],
        'roles'     => [
            'title' => '用户角色',
            'type'      => 'relationship',
            'name_field' => 'name',
        ],
    ],
    // 数据过滤设置
    'filters' => [
        'id' => [
            // 过滤表单条目显示名称
            'title' => '用户ID',
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
    ],
];

 ?>
