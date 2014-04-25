<?php
class CookController extends ControllerBase
{
    public function indexAction()
    {
        $listOrders = UserItem::find()->toArray();
        $this->view->setVar('listOrders', $listOrders);
    }
}