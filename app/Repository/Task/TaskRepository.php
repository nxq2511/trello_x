<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/7/2017
 * Time: 1:23 PM
 */

namespace App\Repository\Task;


use App\Repository\EloquentRepository;
use App\Task;

class TaskRepository extends EloquentRepository
{
    protected $task;

    /**
     * TaskRepository constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        parent::__construct();
    }

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return $this->task;
    }

    /**
     * Get max task
     *
     * @return mixed
     */
    public function getMaxTask()
    {
        return $this->task->select('order')->orderBy('order', 'desc')->first();
    }

    /**
     * Get task from order
     *
     * @param $column_id
     * @return mixed
     */
    public function getTaskFromColumn($column_id)
    {
        return $this->task->where(['column_id' => $column_id])->get();
    }
}