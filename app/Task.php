<?php
/**
 * Created by PhpStorm.
 * User: Bernd Czogalla
 * Date: 2016-09-18
 * Time: 15:25
 */

namespace BCzogalla\TaskList\App;

require_once('TaskBase.php');
require_once('ITask.php');

/**
 * This is the model class for tasks
 *
 * @property boolean $status
 * @property string $name
 * */
class Task extends TaskBase implements ITask
{

    /**
     * create task
     * @param string $name name of task
     */
    public function create($name)
    {
        $this->setName($name);
    }

    /**
     * read task
     * @return string $name name of task
     */
    public function read()
    {
        return $this->getName();
    }

    /**
     * update task
     * @param string $name name of task
     */
    public function update($name)
    {
        $this->setName($name);
    }

    /**
     * delete task
     */
    public function delete()
    {
        $this->setName("");
    }

    /**
     * print name and status of task
    * @return string representation of task
     */
    public function printTask()
    {
        return 'Task: "' . $this->getName() . '" Status: ' . $this->getStatusText() . "\n";
    }
}