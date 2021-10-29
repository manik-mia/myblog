<?php

namespace App\Models;

use PhpCollective\Tracker\Trackable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Article extends Model
{
    
    use HasFactory, SoftDeletes,Trackable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'description', 'status'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'views' => 0,
        'status' => "pending",
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status','=','approve');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    
    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the articles's image.
     */
    public function image():MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
