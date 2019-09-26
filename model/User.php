<?php

namespace todo\model;

use RedBeanPHP\R;

class User
{
    private $bCrypt;

    public function __construct()
    {

    }

    public function userAuthOrRegister()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->validateUserInput();
        $user = $this->getUser($email);

        if (!is_null($user)) {
            return $this->userLogin($user, $password);
        } else {
            return $this->userRegister($email, $password);
        }
    }

    private function validateUserInput()
    {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return array(
                'data' => 'Email address is not valid',
                'status' => 0
            );
        }
    }

    private function getUser($email)
    {
        $user = R::findOne(
            'user', ' email LIKE ?', [$email]);

        return $user;
    }

    private function userLogin($user, $password)
    {
        if ($user->getProperties()['password'] == $password) {

            $this->storeUserInSession($user->getProperties()['id']);

            return array(
                'data' => "",
                'status' => true
            );
        } else {
            return array(
                'data' => "Incorrect password",
                'status' => false
            );
        }
    }

    private function userRegister($email, $password)
    {
        try {
            $newUser = R::dispense('user');
            $newUser->email = $email;
            $newUser->password = $password;

            $id = R::store($newUser);

            $this->storeUserInSession($id);

            return array('data' => 'User successfully created',
                "status" => true);
        } catch (\Exception $e) {
            return array('data' => 'Cannot create new user',
                "status" => false);
        }

    }

    private function storeUserInSession($id)
    {
        $_SESSION['user'] = $id;
    }
}
