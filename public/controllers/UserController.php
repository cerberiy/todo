<?php

namespace todo\controllers;

use todo\model\User;
use todo\model\Task;

class UserController
{

    private $userModel;

    private $taskModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->taskModel = new Task();
    }

    public function actionLogin()
    {
        if (isset($_SESSION['user'])) {
            $tasks = $this->taskModel->getTasks();
            require_once(ROOT . '/views/task/view.php');
        } else {
            require_once(ROOT . '/views/user/login.php');
        }
    }

    public function actionRegister()
    {
        $json = json_encode($this->userModel->userAuthOrRegister());
        return $json;
    }
}

