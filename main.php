<?php
/**
 * Created by PhpStorm.
 * User: Bernd Czoalla
 * Date: 2016-09-18
 * Time: 16:22
 */
use BCzogalla\TaskList\App;

require_once('app\Task.php');
require_once('app\TaskList.php');

$taskList1 = new App\TaskList("School");
$task1 = new App\Task("Do maths");
$task2 = new App\Task("Read book");
$task2->setDone();
$taskList1->addTask($task1);
$taskList1->addTask($task2);
echo $taskList1->printTask();

$taskList2 = new App\TaskList("Sport");
$task3 = new App\Task("Clean shoes");
$task3->setDone();
$task4 = new App\Task("Go running");
$taskList2->addTask($task3);
$taskList2->addTask($task4);

$taskList3 = new App\TaskList("Basketball");
$taskList3->addTask(new App\Task("Get Ball"));
$taskList3->addTask(new App\Task("Practice bouncing"));
$taskList2->addTask($taskList3);
$taskList1->addTask($taskList2);
echo $taskList1->printTask();
$taskList1->setDone();
echo $taskList1->printTask();
$task4->delete();
$taskList2->delete();
echo $taskList1->printTask();
