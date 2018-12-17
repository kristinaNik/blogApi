<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 200)->create();

//        factory(App\Post::class, 200)->create()->each(function($post){
//            $post->save();
//        });
    }
}
