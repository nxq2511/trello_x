<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/7/2017
 * Time: 10:09 AM
 */

namespace App\Repository\Column;


use App\Column;
use App\Repository\EloquentRepository;

class ColumnRepository extends EloquentRepository
{
    protected $column;

    /**
     * ColumnRepository constructor.
     * @param Column $column
     */
    public function __construct(Column $column)
    {
        $this->column = $column;
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return $this->column;
    }

    /**
     * Max order column
     *
     * @return mixed
     */
    public function getMaxColumn()
    {
        return $this->column->select('order')->orderBy('order', 'desc')->first();
    }

    /**
     * Get Column From Board Id
     *
     * @param $board_id
     * @return mixed
     */
    public function getColumnFromBoard($board_id)
    {
        return $this->column->where(['board_id' => $board_id])->get();
    }
}