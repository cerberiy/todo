<?php

namespace todo\model;

use DateTime;
use RedBeanPHP\R;
use todo\components\Helper;

class Task
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Helper();
    }

    public function getTasks()
    {
        $user = $_SESSION['user'];

        $tasks = R::getAll("select * from task where user_id LIKE {$user} ORDER BY date");
        $tasks = $this->addSubtasks($tasks);

        return $tasks;
    }

    private function addSubtasks($tasks)
    {
        foreach ($tasks as &$task) {
            $task['subtask'] = R::getAll("select * from subtask where parent_id LIKE {$task['id']} ORDER BY date");
        }

        return $tasks;
    }

    public function deleteTask($id)
    {
        try {
            $task = R::load('task', $id);
            R::trash($task);

            return array('data' => 'Task successfully deleted');
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }
    }

    public function deleteTasksub($id)
    {
        try {
            $task = R::load('subtask', $id);
            R::trash($task);

            return array('data' => 'Task successfully deleted');
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }
    }

    public function addTask($data)
    {
        if (!$this->helper->notPastDate($data['date'])) {
            return array('error'=>'Date cannot be past');
        }

        try {
            $task = R::dispense('task');

            if (isset($data['header'])) {
                $task->head = $data['header'];
            }
            if (isset($data['text'])) {
                $task->body = $data['text'];
            }
            if (isset($data['status'])) {
                $task->status = $data['status'];
            }
            if (isset($data['date'])) {
                $task->date = DateTime::createFromFormat('Y-m-d', $data['date']);
            }
            $task->user_id = $_SESSION['user'];

            R::store($task);

            return array('data' => 'Task Successfully added');
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }

    }

    public function addSub($data)
    {
        if (!$this->helper->notPastDate($data['date'])) {
            return array('error'=>'Date cannot be past');
        }

        try {
            $task = R::dispense('subtask');

            if (isset($data['header'])) {
                $task->head = $data['header'];
            }
            if (isset($data['text'])) {
                $task->body = $data['text'];
            }
            if (isset($data['status'])) {
                $task->status = $data['status'];
            }
            if (isset($data['date'])) {
                $task->date = DateTime::createFromFormat('Y-m-d', $data['date']);
            }
            if (isset($data['parent'])) {
                $task->parent_id = $data['parent'];
            }
            $task->user_id = $_SESSION['user'];

            R::store($task);

            return array('data' => 'Task Successfully added');
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }
    }

    public function updateTask($data)
    {
        if (!$this->helper->notPastDate($data['date'])) {
            return array('error'=>'Date cannot be past');
        }

        try {
            $task = R::load('task', $data['id']);
            if (isset($data['header'])) {
                $task->head = $data['header'];
            }
            if (isset($data['text'])) {
                $task->body = $data['text'];
            }
            if (isset($data['status'])) {
                $task->status = $data['status'];
            }
            if (isset($data['date'])) {
                $task->date = DateTime::createFromFormat('Y-m-d', $data['date']);
            }
            R::store($task);
            return array('data' => 'Task Successfully updated');
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }

    }

    public function updateSubTask($data)
    {
        if (!$this->helper->notPastDate($data['date'])) {
            return array('error'=>'Date cannot be past');
        }

        try {
            $task = R::load('subtask', $data['id']);
            $task->head = $data['header'];
            $task->body = $data['text'];
            $task->status = $data['status'];
            $task->date = DateTime::createFromFormat('Y-m-d', $data['date']);
            R::store($task);
            return array('data' => 'Task Successfully updated');
        } catch (\Exception $e) {
            return array('error' => $e->getMessage());
        }

    }

    public function checkSubTasksStatus($id)
    {
        $allDone = true;

        $subtasksActive = R::getAll(
            "SELECT status FROM subtask WHERE parent_id = {$id}");

        foreach ($subtasksActive as $subtask) {
            if ($subtask['status'] == 0) {
                $allDone = false;
            }
        }

        return $allDone;
    }

    public function allSubtasksDone($id)
    {
        if ($this->checkSubTasksStatus($id)) {
            $data['id'] = $id;
            $data['status'] = 1;
            $this->updateTask($data);
        }
    }
}
