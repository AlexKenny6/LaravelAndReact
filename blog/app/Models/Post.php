<?php

namespace App\Models;

class Post
{

    /**
     * @throws \Exception
     */
    public static function find($slug)
    {
        if (false === file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {

            return redirect('/');
            //abort(404);

        }

        // putting file path in cache

        return cache()->remember("posts.{slug}", now()->addWeek(),static function ($path) {

            $post = file_get_contents($path);

        });

    }

}
