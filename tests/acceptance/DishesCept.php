<?php
$I = new WebGuy($scenario);
$I->wantTo('walk through the menu');
LoginPage::of($I)->login('andreyevpv@mail.ru', 'admin');
$I->seeLink('Выбери блюдо');
$I->click('Выбери блюдо');
$I->see('Салаты');
$I->see('Супы');
$I->see('Гарниры');
$I->click('Салаты');
$I->wait(1);
$I->see('Холодные Салаты');
$I->see('Горячие Салаты');
$I->click('Холодные Салаты');
$I->wait(1);
$I->see('Мимоза');
$I->see('Заказать');