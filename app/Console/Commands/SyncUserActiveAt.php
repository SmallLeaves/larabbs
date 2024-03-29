<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SyncUserActiveAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabbs:su=ync-user-actived-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将用户最后登录事件从Redis同步到数据库中';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(User $user)
    {
        $user->syncUserActivedAt();
        $this->info("同步成功!");
    }
}
