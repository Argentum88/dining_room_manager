<?php
$I = new AcdbGuy\OrderingSteps($scenario);
$I->userIsAuthenticated();
$I->userOrdersTwoMimosaSalad();
$I->userOrdersOneCabbageSoup();
$I->userExit();
$I->cookIsAuthenticated();
$I->cookOrdersTwoCabbageSoup();

$I = new AcdbGuy($scenario);
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