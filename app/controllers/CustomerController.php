<?php
//TODO добавить обработку ошибок
class CustomerController extends ControllerBase
{

    public function getRootDishesAction()
    {
        $types = $this->modelsManager->executeQuery("SELECT * FROM ItemType WHERE ItemType.parent IS NULL ")->toArray();
        $this->view->setVar('types', json_encode($types, JSON_UNESCAPED_UNICODE));
    }

    public function getDishesAction()
    {
        $parentDishes = ItemType::findFirst(array(
            'id=:id:',
            'bind'=>array('id' => $_GET['id'])
        ));
        $dishes = $parentDishes->ItemType->toArray();
        if (count($dishes) == 0) {
            $dishes = $parentDishes->Item->toArray();
        }
        return $this->response->setContent(json_encode($dishes, JSON_UNESCAPED_UNICODE));
    }

    public function takeOrderAction()
    {
        $dishes = Item::findFirst(array(
            'id=:id:',
            'bind'=>array('id' => $_GET['id'])
        ));
        $user_item = new UserItem;
        $user_item->setItemId($dishes->getId());
        $user_item->setUserId($this->session->get('auth')['id']);
        $user_item->save();
        return $this->response->setStatusCode(200, 'Ok');
    }
}
