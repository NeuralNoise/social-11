<?php

use Illuminate\Database\Seeder;
namespace App\Post;
class PostsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        Post::create([
        	'title' => 'first post',
        	'text' => 'win32_get_last_control_message(oid) win32_get_last_control_message(oid)'
        ]);

    }
}
