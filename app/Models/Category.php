<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Category extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'name',
    ];
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug']=Str::slug($name,'-');
    }
    private function articles():BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
