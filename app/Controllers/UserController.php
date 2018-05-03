<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\UserModel;
use App\Common\Password;

class UserController extends Controller
{
    public function loginAction()
    {
        $data = $this->getFormFields('login');

        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $data['username'] = $request->getPost('username');

            $userModel = new UserModel($this->getDatabase());
            $user = $userModel->findByName($request->getPost('username'));

            if ($user && Password::verify($request->getPost('password'), $user['password'])) {
                // found user
                $this->getSession()->set('user', $user);
                $this->redirect('/welcome');
            }
            else {
                // user not found, bad username or password
                $data['error'] = 'Username or password not correct, please try again';
            }
        }

        return $this->render('login', $data);
    }

    public function registerAction()
    {
        $request = $this->getRequest();

        $data = $this->getFormFields('register');

        if ($request->isMethod('POST')) {
            $data = $request->all();

            $userModel = new UserModel($this->getDatabase());
            $user = $userModel->findByName($request->getPost('username'));

            if ($user) {
                // the username is taken
                $data['error'] = 'The username has been taken, please choose different one';
            }
            else {
                // the username is available, register a new user
                $user = $request->all();

                $user['id'] = $userModel->addUser($user);

                $this->getSession()->set('user', $user);
                $this->redirect('/welcome');
            }
        }

        return $this->render('register', $data);
    }

    public function logoutAction()
    {
        // clear session
        $this->getSession()->destroy();

        // redirect home page
        $this->redirect('/');
    }

    public function welcomeAction()
    {
        // redirect user to login page if not logged in
        if (!$this->getSession()->has('user')) {
            $this->redirect('/login');
        }

        # fetch user from session
        $user = $this->getSession()->get('user');

        // welcome the logged in user with user infomation and a logout link
        return $this->render('welcome', $user);
    }

    protected function getFormFields($formName)
    {
        $formFields = array(
            'login'    => array('error', 'username'),
            'register' => array('error', 'username', 'email', 'telephone'),
        );

        return array_fill_keys($formFields[$formName], '');
    }
}
