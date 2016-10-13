<?php
/**
 * Created by PhpStorm.
 * User: Bernd Czogalla
 * Date: 2016-09-18
 * Time: 15:25
 */

namespace BCzogalla\TaskList\App;

/**
 * This is the interface for the task management tool
 *
 * */
interface ITask
{
    /**
     * create task
     * @param mixed $task
     */
    public function create($task);

    /**
     * read task
     * @return mixed $task
     */
    public function read();

    /**
     * update task
     * @param mixed $task
     */
    public function update($task);

    /**
     * delete task
     */
    public function delete();

    /**
     * prints all tasks of a task list
     * @return string representation of task list
     */
    public function printTask();

    /**
     * set status of task to done
     */
    public function setDone();

    /**
     * set status of task to undone
     */
    public function setUndone();
}