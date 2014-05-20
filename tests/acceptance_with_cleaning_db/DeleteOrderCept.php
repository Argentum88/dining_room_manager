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
$I->see('Щи');
$I->see('3');
$I->see('Мимоза');
$I->fillField('#search-order', 'andreyevpv@mail.ru');
$I->click('Поиск');
$I->wait(1);
$I->click('Выдано');
$I->wait(1);
$I->see('Щи');
$I->see('2');
$I->dontSee('Мимоза');