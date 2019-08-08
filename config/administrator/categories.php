<?php

use App\Models\Category;

return [
    'title' => '分类',
    'single' => '分类',
    'model' => Category::class,

    'action_permissions' => [
        'delete' => function(){
            return Auth::user()->hasRole('Founder');
        },
    ],
    'columns' => [
        'id' => [
            'title' => '分类ID',
        ],
        'name' => [
            'title' => '标题',
            'sortable' => false,
        ],
        'description' => [
            'title' => '描述',
            'sortable' => false,
        ],
        'opreation' => [
            'title' => '管理',
            'sortable' => false,
        ],

    ],
    'edit_fields' => [
        'name' => [
            'title' => '标题',
        ],
        'description' => [
            'title' => '描述',
            'type' => 'textarea',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '分类ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'description' => [
            'title' => '描述',
        ],
    ],
    'rules' => [
        'name' => 'required|min:1|unique:categories'
    ],
    'messages' => [
        'name.unique' => '分类名称在数据库已存在，请选用其他名称',
        'name.required' => '请确保名字至少一个字符以上',
    ],


];

 ?>
