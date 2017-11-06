<?php

namespace App\Repository\Board;
use App\Board;
use App\Repository\EloquentRepository;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/6/2017
 * Time: 2:19 PM
 */
class BoardRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return new Board();
    }
}