<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostLegacy
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;   
        $this->slug = $slug;   
    }


    public static function find($slug)
    {
        // Of all the blog posts, find the one with a slug that matches the one requested
        return static::all()->firstWhere('slug', $slug);


        // if (!file_exists($path = resource_path("/posts/{$slug}.html"))) {
        //     throw new ModelNotFoundException();
        // }

        // return cache()->remember("posts.{$slug}", 1200, fn () => file_get_contents($path));

    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);

        if (! $post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }

    public static function all()
    {
        return cache()->rememberForever(
            'posts.all', function () {
                return collect(File::files(resource_path("posts")))
                    ->map(fn($file) => YamlFrontMatter::parseFile($file))
                    ->map(
                        fn ($document) => new Post(
                            $document->title,
                            $document->excerpt,
                            $document->date,
                            $document->body(),
                            $document->slug
                        )
                    )
                    ->sortByDesc('date');
            }
        );

        
        // $files = File::files(resource_path("posts/"));

        // return array_map(fn ($file) => $file->getContents(), $files);
    }
}