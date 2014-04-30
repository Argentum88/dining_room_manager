<?php
use Codeception\Util\Stub,
    Phalcon\Events\Event,
    Phalcon\Mvc\Dispatcher;

class SecurityTest extends \Codeception\TestCase\Test
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

    private function getDispatcherMock($controllerName, $actionName)
    {
        $dispatcherMock = $this->getMockBuilder('Phalcon\Mvc\Dispatcher')
            ->getMock();
        $dispatcherMock->expects($this->any())
            ->method('getControllerName')
            ->will($this->returnValue($controllerName));
        $dispatcherMock->expects($this->any())
            ->method('getActionName')
            ->will($this->returnValue($actionName));

        return $dispatcherMock;
    }

    private function getDispatcherMockWithForwardMethod($controllerName, $actionName)
    {
        $dispatcherMock = $this->getDispatcherMock($controllerName, $actionName);
        $dispatcherMock->expects($this->once())
                       ->method('forward')
                       ->with($this->equalTo(array(
                                'controller' => 'index',
                                'action' => 'index'
                              )));
        return $dispatcherMock;
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

    public function testAccessForGuests()
    {
        $this->setRole(null);
        $event = new Event('foo', $this);
        $security = new Security($this->di);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('index', 'index'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('session', 'login'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMockWithForwardMethod('Customer', 'getRootDishes'));
        $this->assertFalse($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMockWithForwardMethod('Cook', 'index'));
        $this->assertFalse($allow);
    }

    public function testAccessForUser()
    {
        $this->setRole('user');
        $event = new Event('foo', $this);
        $security = new Security($this->di);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('index', 'index'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('session', 'login'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('Customer', 'getRootDishes'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMockWithForwardMethod('Cook', 'index'));
        $this->assertFalse($allow);
    }

    public function testAccessForCook()
    {
        $this->setRole('cook');
        $event = new Event('foo', $this);
        $security = new Security($this->di);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('index', 'index'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('session', 'login'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('Customer', 'getRootDishes'));
        $this->assertTrue($allow);

        $allow = $security->beforeDispatch($event, $this->getDispatcherMock('Cook', 'index'));
        $this->assertTrue($allow);
    }

}