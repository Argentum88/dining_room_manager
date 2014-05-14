<?php
use Codeception\Util\Stub;

class ConvertOrdersTest extends \Codeception\TestCase\Test
{
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

    public function testConversionUser_ItemResultsetInArrayDishes_Quantity()
    {
        $userItem = new UserItem();
        $userItem->setUserId(1); //user
        $userItem->setItemId(2); //Салат из свиного фарша с рисовой лапшой
        $userItem->setQuantity(2);
        $userItem->save();

        $userItem = new UserItem();
        $userItem->setUserId(2); //cook
        $userItem->setItemId(3); //Щи
        $userItem->setQuantity(1);
        $userItem->save();

        $user_itemResulset = UserItem::find();
        $this->assertEquals($user_itemResulset->count(), 2);
        $expectedResult = array(
            'Салат из свиного фарша с рисовой лапшой'=>2,
            'Щи'=>1
        );
        $this->assertEquals($expectedResult, $userItem::convertOrders($user_itemResulset));
    }

    public function testThatOrdersOfSameDishesAreSummed()
    {
        $userItem = new UserItem();
        $userItem->setUserId(1); //user
        $userItem->setItemId(2); //Салат из свиного фарша с рисовой лапшой
        $userItem->setQuantity(2);
        $userItem->save();

        $userItem = new UserItem();
        $userItem->setUserId(2); //cook
        $userItem->setItemId(3); //Щи
        $userItem->setQuantity(1);
        $userItem->save();

        $userItem = new UserItem();
        $userItem->setUserId(2); //cook
        $userItem->setItemId(2); //Салат из свиного фарша с рисовой лапшой
        $userItem->setQuantity(2);
        $userItem->save();

        $user_itemResulset = UserItem::find();
        $this->assertEquals($user_itemResulset->count(), 3);
        $expectedResult = array(
            'Салат из свиного фарша с рисовой лапшой'=>4,
            'Щи'=>1
        );
        $this->assertEquals($expectedResult, $userItem::convertOrders($user_itemResulset));
    }

}