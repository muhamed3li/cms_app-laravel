<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categorie;
use App\Models\Tag;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
      'title', 'description' , 'content','image','category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function tags() {
      return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tagId) {
      return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
    
}

