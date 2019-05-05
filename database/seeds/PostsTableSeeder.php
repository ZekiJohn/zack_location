<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('posts')->insert([
        //     'title' => 'first post',
        //     'description' => 'this is test seeder for laravel',
        // ]);
        factory(Post::class, 20)->create();
    }
}
