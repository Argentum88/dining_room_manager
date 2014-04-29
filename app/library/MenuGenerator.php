<?php
class MenuGenerator extends \Phalcon\Mvc\User\Component
{
    private $templateName;

    public function genTemplateForMenu()
    {
        $auth = $this->session->get('auth')['role'];
        if($auth) {
            $role = $this->session->get('auth')['role'];
            if ($role == 'user') {
                $this->setUserMenuItems();
            } else if($role == 'cook'){
                $this->setCookMenuItems();
            }
        } else {
             $this->setLoginForm();
        }
        return $this->templateName;
    }

    private function setUserMenuItems()
    {
        $this->templateName = 'userMenuItems';
    }

    private function setCookMenuItems()
    {
        $this->templateName = 'cookMenuItems';
    }

    private function setLoginForm()
    {
        $this->templateName = 'loginForm';
    }

}