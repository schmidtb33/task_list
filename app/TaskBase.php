<?php
/**
 * Created by PhpStorm.
 * User: Bernd Czogalla
 * Date: 2016-09-18
 * Time: 15:25
 */

namespace BCzogalla\TaskList\App;

/**
 * This is the base class for the task management tool
 *
 * @property boolean $status (task done?)
 * @property string $name
 * */
class TaskBase
{
    const DONE_TEXT = "done";
    const UNDONE_TEXT = "not done";

    /**
     * @var boolean $status true = task is done, false = task is undone
     */
    private $status = false;
    /**
     * @var string $name holds name of task
     */
    private $name;

    /**
     * construct task
     * @param string $name
     */
    public function __construct($name = "")
    {
        $this->name = $name;
    }

    /**
     * get name
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set name
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * get string representation of status
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
}

    /**
     * get string representation of status
     * @return string $status
     */
    public function getStatusText()
    {
        return $this->status ? self::DONE_TEXT:self::UNDONE_TEXT;
    }

    /**
     * set status
     * @param boolean $status
     * @return boolean true = status could be changed
     */
    public function setStatus($status)
    {
        if($status == true && $this->status == false)
        {
            $this->status = $status;
            return true;
        } elseif ($status == false && $this->status == true)
        {
            $this->status = $status;
            return true;
        } else{
            return false;
        }
    }

    /**
     * set status done
     */
    public function setDone()
    {
        return $this->setStatus(true);
    }

    /**
     * set status undone
     */
    public function setUndone()
    {
        return $this->setStatus(false);
    }
}