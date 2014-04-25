<?php
use Phalcon\Events\Event,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Acl;

class Security extends Plugin
{
    public function __construct($dependencyInjector)
    {
        $this->_dependencyInjector = $dependencyInjector;
    }

    //TODO Отрефакторить
    public function getAcl()
    {
        $acl = new \Phalcon\Acl\Adapter\Memory();
        $acl->setDefaultAction(Acl::DENY);
        $acl->addRole(new Phalcon\Acl\Role('guests'));
        $acl->addRole(new Phalcon\Acl\Role('user'));
        $acl->addRole(new Phalcon\Acl\Role('cook'), 'user');
        $acl->addResource(new Phalcon\Acl\Resource('Customer'), array('getRootDishes', 'getDishes', 'takeOrder'));
        $acl->addResource(new Phalcon\Acl\Resource('Cook'), array('index'));
        $acl->addResource(new Phalcon\Acl\Resource('index'), array('index'));
        $acl->addResource(new Phalcon\Acl\Resource('session'), array('login', 'end'));
        $acl->allow('guests', 'index', '*');
        $acl->allow('guests', 'session', '*');
        $acl->allow('user', 'Customer', '*');
        $acl->allow('user', 'index', '*');
        $acl->allow('user', 'session', '*');
        $acl->allow('cook', 'Cook', '*');

        return $acl;
    }

    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $role = $this->session->get('auth')['role'];
        if (!$role) {
            $role = 'guests';
        }
        $acl = $this->getAcl();;
        $allowed = $acl->isAllowed($role, $dispatcher->getControllerName(), $dispatcher->getActionName());
        if ($allowed != Acl::ALLOW) {
            $this->flash->error("Вам сюда нельзя");
            $dispatcher->forward(
                array(
                    'controller' => 'index',
                    'action' => 'index'
                )
            );
            return false;
        }
        return true;
    }
}