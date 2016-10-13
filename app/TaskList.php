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
 * This is the model class for managing task lists
 *
 * @property boolean $status
 * @property string $name
 * @property array TaskList array of $tasks
 * */
class TaskList extends TaskBase implements ITask
{
    /**
     * @var array TaskList array of $tasks
     */
    private $taskList = array();

    /**
     * get task list
     * @return array $taskList array of tasks
     */
    public function getTaskList()
    {
        return $this->taskList;
    }

    /**
     * set task list
     * @param array $taskList array of tasks
     */
    public function setTaskList($taskList)
    {
        $this->taskList = $taskList;
    }

    /**
     * create task list
     * @param array $taskList array of tasks
     */
    public function create($taskList)
    {
        $this->setTaskList($taskList);
    }

    /**
     * read task list
     * @return array $taskList array of tasks
     */
    public function read()
    {
        return $this->getTaskList();
    }

    /**
     * update task list
     * @param array $taskList array of tasks
     */
    public function update($taskList)
    {
        $this->setTaskList($taskList);
    }

    /**
     * delete task list
     */
    public function delete()
    {
        $this->taskList = null;
    }

    /**
     * prints all tasks of a task list
     * @return string representation of task list
     */
    public function printTask()
    {
        $result = "";
        if($this->taskList)
        {
            $result =  "\nTask-List: \"" . $this->getName() . "\" Status: " . $this->getStatusText() . "\n";
            foreach ($this->taskList as $task)
            {
                $result .= $task->printTask();
            }
        }
        return $result;
    }

    /**
     * adds task to task list
     * @param Task $task
     */
    public function addTask($task)
    {
        array_push($this->taskList, $task);
    }

    /**
     * sets status of task list and all tasks and sub task lists to done
     */
    public function setDone()
    {
        parent::setDone();
        foreach ($this->taskList as $task)
        {
            $task->setDone();
        }
    }
}