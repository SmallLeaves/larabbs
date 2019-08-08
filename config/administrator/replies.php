<?php

use App\Models\Reply;

return [
    'title' => '回复',
    'single' => '回复',
    'model' => Reply::class,

    'columns' => [
        'id' => [
            'title' => '回复ID',
        ],
        'topic' => [
            'title' => '话题',
            'sortable' => false,
            'output' => function($value,$model){
                return '<div style="max-width:260px">'.model_admin_link(e($model->topic->title),$model->topic).'</div>';
            },
        ],
        'user_id' => [
            'title' => '用户',
            'sortable' => false,
            'output' => function($value,$model){
                $avatar = e($model->user->avatar);
                $value = empty($avatar)?'N/A':'<img src="'.$avatar.'" width="22" height="22">'.e($model->user->name);
                return model_link($value,$model->user);
            },
        ],
        'content' => [
            'title' => '内容',
            'sortable' => false,
            'output' => function($value,$model){
                return '<div style="max-width:260px">'.$value.'</div>';
            },
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id,' ',name)"),
            'option_sort_field' => 'id',

        ],
        'topic' => [
            'title' => '话题',
            'type' => 'relationship',
            'autocomplete' => true,
            'name_field' => 'title',
            'search_fields' => array("CONCAT(id,' ',name)"),
            'option_sort_field' => 'id',
        ],
        'content' => [
            'title' => '回复内容',
            'type' => 'textarea',
        ],
    ],
    'filters' => [
       'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id,' ',name)"),
            'option_sort_field' => 'id',
       ],
       'topic' => [
            'title' => '话题',
            'type' => 'relationship',
            'name_field' => 'title',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id,' ',name)"),
            'option_sort_field' => 'id',

       ],
       'content' => [
            'title' => '回复内容',
       ],
    ],
    'rules' => [
        'content' => 'required',
    ],
    'messages' => [
        'content.required' => '请填写回复内容',
    ],
];


 ?>
