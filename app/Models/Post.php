<?php

namespace App\Models;

use App\Models\Post\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['user', 'category'];

    /**
     * Model's Appended Columns
     */
    protected $appends = ['created_time'];

    public function createdTime(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->diffForHumans()
        );
    }

    /**
     * Model's Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Model's Scopes
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['hasLikes'] ?? false, fn ($query) => $query->where('likes', '>=', '1'));

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', "%$search%")->orWhere('title', 'like', "%$search");
        });

        // $query->when($filters['hasComments'] ?? false, fn($query, $hasComments) => $query->where('likes', '>=', '1'));

        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas('user', function ($query) use ($author) {
                $query->where('username', 'like', "%$author%");
            });
        });


        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $category = str_replace(',', '|', $category);
                $query->whereRaw("slug REGEXP '$category'");
            });
        });

        /**
         * @BUG :
         *  Filtering is ignoring all scope when searchScope is Active
         */
    }

    /**
     * Model's Binding Key Name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Model's additional functions
     */

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'id']
            ]
        ];
    }
}
