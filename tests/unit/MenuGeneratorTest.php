<?php
use Codeception\Util\Stub;

class MenuGeneratorTest extends \Codeception\TestCase\Test
{
    private $di;

    private function getCookMenu()
    {
        return
            '<ul class="nav navbar-nav navbar-right">'.
                '<li><a href="/session/end">Выйти</a></li>'.
            '</ul>'.
            '<ul class="nav navbar-nav">'.
                '<li><a href="/Customer/getRootDishes">Выбери блюдо</a></li>'.
            '</ul>'.
            '<ul class="nav navbar-nav">'.
                '<li><a href="/Cook/index">Заказы</a></li>'.
            '</ul>';
    }

    private function getGuestMenu()
    {
        return
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

    private function getUserMenu()
    {
        return
            '<ul class="nav navbar-nav navbar-right">'.
                '<li><a href="/session/end">Выйти</a></li>'.
            '</ul>'.
            '<ul class="nav navbar-nav">'.
                '<li><a href="/Customer/getRootDishes">Выбери блюдо</a></li>'.
            '</ul>';
    }

    private function setRole($role)
    {
        $di = $this->getModule('Phalcon1')->di;
        $di->get('session')->set('auth', array(
            'id' => 1,
            'email' => '',
            'role' => $role
        ));
        $this->di = $di;
    }

    private function getMenuFromMenuGenerator()
    {
        $menuGenerator = new MenuGenerator();
        $menuGenerator->setDI($this->di);
        ob_start();
            $menuGenerator->genMenu();
            $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }

    /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMenuForCook()
    {
        $this->setRole('cook');
        $this->assertEquals($this->getCookMenu(), $this->getMenuFromMenuGenerator());
    }

    public function testMenuForGuest()
    {
        $this->setRole(null);
        $this->assertEquals($this->getGuestMenu(), $this->getMenuFromMenuGenerator());
    }

    public function testMenuForUser()
    {
        $this->setRole('user');
        $this->assertEquals($this->getUserMenu(), $this->getMenuFromMenuGenerator());
        //$this->codeGuy->seeMyVar($this->getMenuFromMenuGenerator());
    }

}