<?php
class MenuGenerator extends \Phalcon\Mvc\User\Component
{
    public function genMenu()
    {
        $auth = $this->session->get('auth')['role'];
        if($auth) {
            $role = $this->session->get('auth')['role'];
            if ($role == 'user') {
                $this->printUserMenuItems();
            } else if($role == 'cook'){
                $this->printUserMenuItems();
                $this->printCookMenuItem();
            }
        } else {
             $this->printForm();
        }
    }

    private function printUserMenuItems()
    {
        echo '<ul class="nav navbar-nav navbar-right">'.
                '<li><a href="/session/end">Выйти</a></li>'.
             '</ul>';
        echo
            '<ul class="nav navbar-nav">'.
                '<li><a href="/Customer/getRootDishes">Выбери блюдо</a></li>'.
            '</ul>';
    }

    private function printCookMenuItem()
    {
        echo
            '<ul class="nav navbar-nav">'.
                '<li><a href="/Cook/index">Заказы</a></li>'.
             '</ul>';
    }

    private function printForm()
    {
        echo
            '<div class="navbar-collapse collapse">'.
                '<form class="navbar-form navbar-right" role="form" action="/session/login" method="post">'.
                    '<div class="form-group">'.
                        '<input name="email" type="text" placeholder="Email" class="form-control">'.
                    '</div>'.
                    '<div class="form-group">'.
                        '<input name="password" type="password" placeholder="Password" class="form-control">'.
                    '</div>'.
                    '<button type="submit" class="btn btn-success">Вoйти</button>'.
                '</form>'.
            '</div>';
    }

}