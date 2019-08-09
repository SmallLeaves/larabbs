<?php

return [
    'title' => '站点设置',
    'permission' => function(){
        return Auth::user()->hasRole('Founder');
    },
    'edit_fields' => [
        'site_name' => [
            'title' => '站点名称',
            'type' => 'text',
            'limit' => 50,
        ],
        'contact_email' => [
            'title' => '联系人邮箱',
            'type' => 'text',
            'limit' => 50,
        ],
        'seo_description' => [
            'title' => 'SEO - Description',
            'type' => 'textarea',
            'limit' => 250,
        ],
        'seo_keyword' => [
            'title' => 'SEO - Keywords',
            'type' => 'textarea',
            'limit' => 250,
        ],
    ],
    'rules' => [
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
    ],
    'messages' => [
        'site_name.required' => '请填写站点名称',
        'contact_email.email' => '请填写正确的联系人邮箱格式',
    ],
    // 数据即将保存的触发钩子,可以对用户提交的数据做修改
    'before_save' => function(&$data){
        // 为网站名称加上后缀,加上判断是为了防止多次添加
        if(strpos($data['site_name'],'Powered By LaraBBS') === false){
            $data['site_name'].= ' - Powered By LaraBBS';
        }
    },
    // 你可以紫东苑多个动作,每一个动作为设置页面底部的[其他操作]区块
    'actions' => [
        // 清空缓存
        'clear_clean' => [
            'title' => '更新系统缓存',
            // 不同状态时页面的提醒
            'messages' => [
                'active' => '正在清空缓存...',
                'success' => '缓存已清空!',
                'error' => '清空缓存时出错!',
            ],
            // 动作执行代码 注意你可以通过修改$data参数更改配置信息
            'action' => function(&$data){
                \Artisan::call('cache:clear');
                return false;
            }
        ],
    ],
];

 ?>
