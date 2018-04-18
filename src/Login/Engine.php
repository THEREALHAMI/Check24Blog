<?php

namespace Login;

use Check24Framework\Exception\LoginMistake;
use Check24Framework\Request;
use Factory\User;

class Engine
{
    private $loginStatus;
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
    /**
     * @param Request $request
     * @return bool
     * @throws LoginMistakea
     */
    public function validate(Request $request) :bool
    {

        $username = $request->getFromPost('login');
        $password = $request->getFromPost('password');

        $user = $this->user;
        $users = $user->checkUserByUsername($username);

        if(empty($username) || empty($password)){
            throw new LoginMistake('Das sind keine gultige Angaben');
        }
        $_SESSION['ID'] = $users->getID();

        if ($users->getLoginname() !== false && password_verify($password, $users->getPassword())) {
            $this->loginStatus = true;
        } else {
            throw new LoginMistake('Das sind keine gultige Angaben');
        }
        return $this->loginStatus;
    }
}