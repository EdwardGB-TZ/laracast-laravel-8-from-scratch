<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create(
            ['name' => 'Jon Doe']
        );

        Post::factory(5)->create(
            ['user_id' => $user->id]
        );
    }
}



















//     public function run()
//     {
//         User::truncate();
//         Category::truncate();
//         Post::truncate();

//         Post::factory()->create();

//         // $user = User::factory()->create();

//         // $personal = Category::create(
//         //     [
//         //         'name' => 'Personal',
//         //         'slug' => 'personal',
//         //     ]
//         // );

//         // $family = Category::create(
//         //     [
//         //         'name' => 'Family',
//         //         'slug' => 'family',
//         //     ]
//         // );

//         // $work = Category::create(
//         //     [
//         //         'name' => 'Work',
//         //         'slug' => 'work',
//         //     ]
//         // );

//         // Post::create(
//         //     [
//         //         'user_id' => $user->id,
//         //         'category_id' => $family->id,
//         //         'title' => 'My family post',
//         //         'slug' => 'my-first-post',
//         //         'excerpt' => '<p>Lorem ipsum dolor sit amet.</p>',
//         //         'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate, nesciunt. Nisi dolore suscipit beatae neque corrupti voluptates optio, ullam cupiditate commodi quae, non aspernatur inventore, debitis architecto excepturi voluptatem aut.</p>'
//         //     ]
//         // );

//         // Post::create(
//         //     [
//         //         'user_id' => $user->id,
//         //         'category_id' => $work->id,
//         //         'title' => 'My work post',
//         //         'slug' => 'my-work-post',
//         //         'excerpt' => '<p>Lorem ipsum dolor sit amet.</p>',
//         //         'body' => '<p>Lor1em ipsum dolor sit amet consectetur adipisicing elit. Voluptate, nesciunt. Nisi dolore suscipit beatae neque corrupti voluptates optio, ullam cupiditate commodi quae, non aspernatur inventore, debitis architecto excepturi voluptatem aut.</p>'
//         //     ]
//         // );
//     }
// }
