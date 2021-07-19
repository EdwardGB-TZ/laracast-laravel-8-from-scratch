<?php

/**
 * PHP version 7
 *
 * @category Template_Class
 * @package  Template_Class
 * @author   Author <author@domain.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Services\MailChimpNewsletter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\NewsLetterController;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\PostCommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::post('newsletter', NewsLetterController::class);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
























// Always try to stick to the seven RESTFUL actions
// index, show, create, store, edit, update, delete

// Route::get(
//     'authors/{author:username}', function (User $author) {
//         return view(
//             'posts.index',
//             [
//                 'posts' => $author->posts
//             ]
//         );
//     }
// );

// Route::get(
//     'categories/{category:slug}', function (Category $category) {
//         return view(
//             'posts',
//             [
//                 'posts' => $category->posts,
//                 'currentCategory' => $category,
//                 'categories' => Category::all()
//             ]
//         );
//     }
// )->name('category');



// Search for post functionality 
// The messy way
// Route::get(
//     '/', function () {
//         $posts = Post::latest();

//         if (request('search')) {
//             $posts
//                 ->where('title', 'like', '%' . request('search') . '%')
//                 ->orWhere('body', 'like', '%' . request('search') . '%');
//         }
        
//         return view(
//             'posts',
//             [
//                 'posts' => $posts->get(),
//                 'categories' => Category::all()
//             ]
//         );
//     }   
// )->name('home');


// Route::get(
//     '/', function () {
//         return view(
//             'posts',
//             [
//                 'posts' => Post::latest()->get(),
//                 'categories' => Category::all()
//             ]
//         );
//     }   
// )->name('home');

// Route::get(
//     // Retrieve the register using Route Model Binding
//     // By a different field than the id

//     'posts/{post:slug}', function (Post $post) {  // Post::where('slug', $post)->firstOrFail()

//         return view(
//             'post', 
//             ['post' => $post]
//         );
//     }
// );






















// Route::get(
//     '/', function () {
        
        // Recommended Using Collections

        // return view(
        //     'posts',
        //     ['posts' => Post::all()]
        // );

        // Using array_map

        // $posts = array_map(
        //     function($file) {
        //         $document = YamlFrontMatter::parseFile($file);
                
        //         return new Post(
        //             $document->title,
        //             $document->excerpt,
        //             $document->date,
        //             $document->body(),
        //             $document->slug
        //         );
        //     }, $files
        // );



        // Using foreach over an array
        // $posts = [];

        // foreach ($files as $file) {
        //     $document = YamlFrontMatter::parseFile($file);

        //     $posts[] = new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug
        //     );
        // }

        // return view(
        //     'posts',
        //     ['posts' => $posts]
        // );
//     }   
// );


// Route::get(
//     'posts/{post}', function ($id) {  

        // Find a post by its slug and pass it to a view called post

        // return view(
        //     'post', 
        //     ['post' => Post::findOrFail($id)]
        // );

        // if (!file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        //     //dd("File does not exist");
        //     //abort(404);
        //     return redirect('/');
        // }

        // /* $post = cache()->remember(
        //     "posts.{$slug}", 1200, function () use ($path) {
        //         return file_get_contents($path);
        //     }
        // ); */

        // $post = cache()->remember("posts.{$slug}", 1200, fn () => file_get_contents($path));

        // return view(
        //     'post',
        //     ['post' => $post]
        // );
    // }
// );
//)->where('post', '[A-z_\-]+');



// Route::get(
//     // Retrieve the register using Route Model Binding
//     // The wildcard name has to match up with the variable name
//     'posts/{post}', function (Post $post) {  

//         return view(
//             'post', 
//             ['post' => $post]
//         );
//     }
// );


// Route::get(
//     // Retrieve the register using Route Model Binding
//     // By a different field than the id

//     // There's also the option to set the custom field from the Model 
//     // Defining the function getRouteKeyName and returning the name of the custom field
//     // Previously this was the only way to achieve this

//     'posts/{post}', function (Post $post) {

//         return view(
//             'post', 
//             ['post' => $post]
//         );
//     }
// );


// Route::get(
//     '/', function () {

//         // A way to log the queries executed manually

            // But there's another more suitable way, using a composer package
            // along with a browser extension called clockwork

            // A N+1 problem is when there are too many queries being executed

//         DB::listen(
//             function ($query) {
//                 logger($query->sql, $query->bindings);
//             }
//         );

//         return view(
//             'posts',
//             ['posts' => Post::all()]
//         );
//     }   
// );