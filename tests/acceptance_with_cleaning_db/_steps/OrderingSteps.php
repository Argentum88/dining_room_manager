<?php
namespace AcdbGuy;

class OrderingSteps extends \AcdbGuy
{
    function userIsAuthenticated()
    {
        $I = $this;
        \LoginPage::of($I)->login('andreyevpv@mail.ru', 'admin');
    }
    function userOrdersTwoMimosaSalad()
    {
        $I = $this;
        $I->click('Выбери блюдо');
        $I->click('Салаты');
        $I->click('Холодные Салаты');
        $I->fillField('//input[1]', '2');
        $I->click('Заказать', '.item0');
    }
    function userOrdersOneCabbageSoup()
    {
        $I = $this;
        $I->click('Выбери блюдо');
        $I->click('Супы');
        $I->fillField('//input[1]', '1');
        $I->click('Заказать', '.item0');
    }
    function userExit()
    {
        $I = $this;
        $I->click('Выйти');
    }
    function cookIsAuthenticated()
    {
        $I = $this;
        \LoginPage::of($I)->login('cook@mail.ru', 'cook');
    }

    function cookOrdersTwoCabbageSoup()
    {
        $I = $this;
        $I->click('Выбери блюдо');
        $I->click('Супы');
        $I->fillField('//input[1]', '2');
        $I->click('Заказать', '.item0');
    }

}