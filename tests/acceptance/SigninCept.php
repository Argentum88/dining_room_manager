<?php

$I = new WebGuy($scenario);
$I->wantTo('log in as cook');
$I->amOnPage('/');
$I->fillField('email','cook@mail.ru');
$I->fillField('password','cook');
$I->click('Войти');
$I->see('Welcome cook@mail.ru');
