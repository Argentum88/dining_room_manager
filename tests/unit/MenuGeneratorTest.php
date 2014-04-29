<?php
use Codeception\Util\Stub;

class MenuGeneratorTest extends \Codeception\TestCase\Test
{
    private $di;

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

    private function getMenuTemplateFromMenuGenerator()
    {
        $menuGenerator = new MenuGenerator();
        $menuGenerator->setDI($this->di);
        return $menuGenerator->genTemplateForMenu();
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
    public function testMenuTemplateForCook()
    {
        $this->setRole('cook');
        $this->assertEquals('cookMenuItems', $this->getMenuTemplateFromMenuGenerator());
    }

    public function testMenuTemplateForGuest()
    {
        $this->setRole(null);
        $this->assertEquals('loginForm', $this->getMenuTemplateFromMenuGenerator());
    }

    public function testMenuTemplateForUser()
    {
        $this->setRole('user');
        $this->assertEquals('userMenuItems', $this->getMenuTemplateFromMenuGenerator());
        //$this->codeGuy->seeMyVar($this->getMenuFromMenuGenerator());
    }

}