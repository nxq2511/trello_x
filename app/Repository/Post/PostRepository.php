<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/6/2017
 * Time: 10:59 AM
 */

namespace App\Repository\Post;


use App\Post;
use App\Repository\EloquentRepository;

class PostRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return new Post;
    }

    public function getAllActive()
    {
        return Post::all();
    }
}