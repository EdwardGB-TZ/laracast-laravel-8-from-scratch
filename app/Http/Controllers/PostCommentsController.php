<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        // Validation
        request()->validate(
            [
            'body' => 'required'
            ]
        );
    
        // When Model::unguard() has been set in the AppServiceProvider, never do
        // Post::create(request()->all());
        // By being explicit with the fields there should be no issues

        // Add a comment for the given post
        $post->comments()->create(
            [
                'user_id' => request()->user()->id,
                'body' => request('body')
            ]
        );

        return back();
    }
}
