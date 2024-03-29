<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function($user,$index) use ($faker,$avatars){
                            $user->avatar = $faker->randomElement($avatars);
                        });
        $user_array = $users->makeVisible(['password','remember_token'])->toArray();
        User::insert($user_array);
        $user = User::find(1);
        $user->name = 'Leaves';
        $user->email = 'yezisi123456@qq.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();
        $user->assignRole('Founder');
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
