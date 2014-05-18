<?php
$I = new AcdbGuy($scenario);
$I->wantTo('enter the login user in the input field and see a table with orders Users');
LoginPage::of($I)->login('andreyevpv@mail.ru', 'admin');
$I->click('Выбери блюдо');
$I->click('Салаты');
$I->click('Холодные Салаты');
$I->fillField('//input[1]', '2'); //мимоза 2 штуки
$I->click('Заказать', '.item0');
$I->click('Выбери блюдо');
$I->click('Супы');
$I->fillField('//input[1]', '1'); //Щи 1 штука
$I->click('Заказать', '.item0');
$I->click('Выйти');
LoginPage::of($I)->login('cook@mail.ru', 'cook');
$I->click('Выбери блюдо');
$I->click('Супы');
$I->fillField('//input[1]', '2'); //Щи 2 штуки
$I->click('Заказать', '.item0');
$I->click('Заказы');
$I->fillField('#search-order', 'cook@mail.ru');
$I->click('Поиск');
$I->wait(1);
$I->see('Щи', '.modal-body');
$I->see('2', '.modal-body');
$I->click('.close', '.modal-header');
$I->fillField('#search-order', 'andreyevpv@mail.ru');
$I->click('Поиск');
$I->wait(1);
$I->see('Щи', '.modal-body');
$I->see('1', '.modal-body');