<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::insert([
            [
                'name'            	=> 'Mr. Admin',
                'email'           	=> 'admin@admin.com',
                'password'        	=> bcrypt('123456'),
                'admin'           	=> 1,
                'block'           	=> 0,
                'remember_token'  	=> str_random(60),
                'created_at'      	=> date("Y-m-d H:i:s")
            ],
            [
                'name'            	=> 'User One',
                'email'           	=> 'userone@user.com',
                'password'        	=> bcrypt('123456'),
                'admin'           	=> 0,
                'block'           	=> 0,
                'remember_token'  	=> str_random(60),
                'created_at'      	=> date("Y-m-d H:i:s")
            ],
            [
                'name'            	=> 'User Two',
                'email'           	=> 'usertwo@user.com',
                'password'        	=> bcrypt('123456'),
                'admin'           	=> 0,
                'block'           	=> 1,
                'remember_token'  	=> str_random(60),
                'created_at'      	=> date("Y-m-d H:i:s")
            ]
        ]);

        Message::insert([
        	[
        		'user_id' 		=> 2,
				'message_to' 	=> 3,
				'subject' 		=> 'Message Subject One',
				'body' 			=> 'Message body form user two to user three.',
                'created_at'    => date("Y-m-d H:i:s")
        	],
        	[
        		'user_id' 		=> 2,
				'message_to' 	=> 3,
				'subject' 		=> 'Message Subject Two',
				'body' 			=> 'Message body form user two to user three.',
                'created_at'    => date("Y-m-d H:i:s")
        	],
        	[
        		'user_id' 		=> 3,
				'message_to' 	=> 2,
				'subject' 		=> 'Message Subject Three',
				'body' 			=> 'Message body form user three to user two.',
                'created_at'    => date("Y-m-d H:i:s")
        	]
        ]);

    }
}
