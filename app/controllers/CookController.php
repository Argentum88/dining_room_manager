<?php
class CookController extends ControllerBase
{
    public function indexAction()
    {
        $Orders = UserItem::find();
        $this->view->setVar('listOrders', $this->convertOrders($Orders));
    }

    private function convertOrders($Orders)
    {
        $resultOfConverting = array();
        foreach($Orders as $order) {
            $dishes = Item::findFirst(array(
                'id=:id:',
                'bind'=>array('id' => $order->getItemId())
            ))->getName();
            if (!array_key_exists("$dishes", $resultOfConverting)) {
                $resultOfConverting["$dishes"] = $order->getQuantity();
            } else {
                $resultOfConverting["$dishes"] = $resultOfConverting["$dishes"] + $order->getQuantity();
            }
        }
        return $resultOfConverting;
    }
}