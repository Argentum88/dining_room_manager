<?php

$I = new WebGuy($scenario);

$pageObject = LoginPage::of($I);
$pageObject->login('cook@mail.ru', 'cook');
