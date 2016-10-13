<?php
/**
 * Created by PhpStorm.
 * User: Bernd Czogalla
 * Date: 2016-10-06
 * Time: 11:33
 */

use BCzogalla\TaskList\App;

class TaskTest extends PHPUnit_Framework_TestCase
{
    const TASK_LIST_1 = "School";
    const TASK_LIST_2 = "Sport";
    const TASK_LIST_3 = "Basketball";
    const TASK_1 = "Do maths";
    const TASK_2 = "Read book";
    const TASK_3 = "Clean shoes";
    const TASK_4 = "Go running";
    const TASK_5 = "Get Ball";
    const TASK_6 = "Practice bouncing";

    public function setUp()
    {

        $this->taskList1 = new BCzogalla\TaskList\App\TaskList(self::TASK_LIST_1);
        $this->taskList2 = new BCzogalla\TaskList\App\TaskList(self::TASK_LIST_2);
        $this->taskList3 = new BCzogalla\TaskList\App\TaskList(self::TASK_LIST_3);

        $this->task1 = new BCzogalla\TaskList\App\Task(self::TASK_1);
        $this->task2 = new BCzogalla\TaskList\App\Task(self::TASK_2);
        $this->task3 = new BCzogalla\TaskList\App\Task(self::TASK_3);
        $this->task4 = new BCzogalla\TaskList\App\Task(self::TASK_4);
        $this->task5 = new BCzogalla\TaskList\App\Task(self::TASK_5);
        $this->task6 = new BCzogalla\TaskList\App\Task(self::TASK_6);

        $this->taskList1->addTask($this->task1);
        $this->taskList1->addTask($this->task2);

        $this->taskList2->addTask($this->task3);
        $this->taskList2->addTask($this->task4);

        $this->taskList3->addTask($this->task5);
        $this->taskList3->addTask($this->task6);

        $this->taskList2->addTask($this->taskList3);
        $this->taskList1->addTask($this->taskList2);

        $taskList = array();
        $taskList[] = $this->task1;
        $this->taskList = $taskList;
    }

    public function testTaskListIsInstance()
    {
        $this->assertInstanceOf(App\TaskList::class, $this->taskList3);
    }

    public function testTaskIsInstance()
    {
        $this->assertInstanceOf(App\Task::class, $this->task1);
    }

    public function testTaskListGetStatusIsUnDone()
    {
        $this->assertEquals(false, $this->taskList3->getStatus());
    }

    public function testTaskListSetStatus()
    {
        $this->assertEquals(false, $this->taskList3->setStatus(false));
        $this->assertEquals(true, $this->taskList3->setStatus(true));
        $this->assertEquals(false, $this->taskList3->setStatus(true));
        $this->assertEquals(true, $this->taskList3->setStatus(false));
        $this->assertEquals(false, $this->taskList3->setUndone());
    }

    public function testTaskSetStatus()
    {
        $this->assertEquals(false, $this->task1->setStatus(false));
        $this->assertEquals(true, $this->task1->setStatus(true));
        $this->assertEquals(false, $this->task1->setStatus(true));
        $this->assertEquals(true, $this->task1->setStatus(false));
        $this->assertEquals(false, $this->task1->setUndone());
    }

    public function testTaskListGetStatusTextIsUnDone()
    {
        $this->assertEquals(App\TaskList::UNDONE_TEXT, $this->taskList3->getStatusText());
    }

    public function testTaskListGetStatusIsDone()
    {
        $this->taskList3->setDone();
        $this->assertEquals(true, $this->taskList3->getStatus());
    }

    public function testTaskListGetStatusTextIsDone()
    {
        $this->taskList3->setDone();
        $this->assertEquals(App\TaskList::DONE_TEXT, $this->taskList3->getStatusText());
    }

    public function testTaskGetStatusIsUnDone()
    {
        $this->assertEquals(false, $this->task1->getStatus());
    }

    public function testTaskGetStatusTextIsUnDone()
    {
        $this->assertEquals(App\TaskList::UNDONE_TEXT, $this->task1->getStatusText());
    }

    public function testTaskGetStatusIsDone()
    {
        $this->task1->setDone();
        $this->assertEquals(true, $this->task1->getStatus());
    }

    public function testTaskGetStatusTextIsDone()
    {
        $this->task1->setDone();
        $this->assertEquals(App\TaskList::DONE_TEXT, $this->task1->getStatusText());
    }

    public function testTaskListCheckGetName()
    {
        $this->assertEquals(self::TASK_LIST_1, $this->taskList1->getName());
    }

    public function testTaskCheckName()
    {
        $this->assertEquals(self::TASK_1, $this->task1->getName());
    }

    public function testTaskListSetName()
    {
        $this->taskList1->setName(self::TASK_LIST_2);
        $this->assertEquals(self::TASK_LIST_2, $this->taskList1->getName());
    }

    public function testTaskSetName()
    {
        $this->task1->setName(self::TASK_2);
        $this->assertEquals(self::TASK_2, $this->task1->getName());
    }

    public function testTaskListAddTask()
    {
        $result = $this->taskList1->printTask();
        $this->assertContains(self::TASK_1, $result);
        $this->assertContains(self::TASK_4, $result);
    }

    public function testTaskListDelete()
    {
        $this->taskList3->delete();
        $this->assertEquals(null, $this->taskList3->read());
    }

    public function testTaskDelete()
    {
        $this->task4->delete();
        $this->assertEquals("", $this->task4->getName());
        $result = $this->taskList1->printTask();
        $this->assertNotContains(self::TASK_4, $result);
    }

    public function testTaskListAddTaskList()
    {
        $this->taskList3->setTaskList($this->taskList);
        $this->assertNotEquals(null, $this->taskList3->read());
    }

    public function testTaskListUpdate()
    {
        $this->taskList3->delete();
        $this->assertEquals(null, $this->taskList3->read());
        $this->taskList3->update($this->taskList);
        $this->assertNotEquals(null, $this->taskList3->read());
    }

    public function testTaskUpdate()
    {
        $this->task6->update(self::TASK_1);
        $this->assertEquals(self::TASK_1, $this->task6->read());
    }

    public function testTaskListCreate()
    {
        $task = new App\TaskList();
        $task->create($this->taskList);
        $task->setName(self::TASK_LIST_1);
        $this->assertNotEquals(null, $task->read());
        $this->assertEquals(self::TASK_LIST_1, $task->getName());
    }

    public function testTaskCreate()
    {
        $task = new App\Task();
        $task->create(self::TASK_1);
        $this->assertEquals(self::TASK_1, $task->read());
    }
}