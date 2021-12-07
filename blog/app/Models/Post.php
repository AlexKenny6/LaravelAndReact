<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{

    public static function all() {

        $files = File::files("posts/");

        array_map(static function ($file) {
            return $file->getContents();
        }, $files);

    }

    public static function find($slug)
    {
        if (false === file_exists($path = resource_path("posts/{$slug}.html"))) {

            throw new ModelNotFoundException();

        }

        // putting file path in cache
        return cache()->remember("posts.{slug}", 1200, function () use ($path) {
            return file_get_contents($path);
        });

    }

}
