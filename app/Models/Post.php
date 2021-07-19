<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'excerpt',
    //     'body'
    // ];

    protected $with = ['category', 'author'];

    // If we set unguarded method for the model in the AppServiceProvider
    // Model::unguard();
    // There's no need to set $guarded or $fillable here

    // protected $guarded = ['id'];

    public function scopeFilter($query, array $filters) // Post::newQuery()->filter()
    {
        $query->when(
            $filters['search'] ?? false, fn ($query, $search) => 
                $query->where(
                    fn($query) =>
                    $query->where('title', 'like', '%' . request('search') . '%')
                        ->orWhere('body', 'like', '%' . request('search') . '%')
                )
        );

        $query->when(
            $filters['category'] ?? false, fn ($query, $category) =>
                $query->whereHas(
                    'category', fn ($query) => 
                    $query->where('slug', $category)
                )
        );

        $query->when(
            $filters['author'] ?? false, fn ($query, $author) =>
                $query->whereHas(
                    'author', fn ($query) => 
                    $query->where('username', $author)
                )
        );

            //     $query
            //     ->whereExists(
            //         fn($query) => 
            //         $query->from('categories')
            //             ->whereColumn('categories.id', 'posts.category_id')
            //             ->where('categories.slug', $category)
            //     )
        //);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    
    // Define a custom field to find the register from the route

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}