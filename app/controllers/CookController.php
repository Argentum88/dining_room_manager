<?php
class CookController extends ControllerBase
{
    public function indexAction()
    {
        $orders = UserItem::find();
        $this->view->setVar('listOrders', UserItem::convertOrders($orders));
    }

    public function getOrderAction()
    {
        $login = $this->request->getQuery('login');
        $user = User::findFirst(array(
            'email=:login:',
            'bind'=>array('login' => $login)
        ));
        $order = $user->UserItem;
        return $this->response->setContent(json_encode(UserItem::convertOrders($order), JSON_UNESCAPED_UNICODE));
    }
}