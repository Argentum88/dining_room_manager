<?php
class CookController extends ControllerBase
{
    public function indexAction()
    {
        $orders = UserItem::find();
        $this->view->setVar('listOrders', UserItem::convertOrders($orders));
    }
}