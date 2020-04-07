<?php

namespace App;

use App\Category;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;


    public function deleteImage()
    {
        Cloudder::delete($this->image_id);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
