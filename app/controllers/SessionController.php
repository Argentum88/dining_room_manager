<?php

class SessionController extends ControllerBase
{

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email');

            $password = $this->request->getPost('password');
            $password = md5($password);

            $user = User::findFirst("email='$email' AND password='$password'");
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->getEmail());
                return $this->forward('index/index');
            }

            $this->flash->error('Wrong email/password');
        }

        //return $this->response->redirect('index/index');
        return $this->forward('index/index');
    }

    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ));
    }

    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('index/index');
    }

}

