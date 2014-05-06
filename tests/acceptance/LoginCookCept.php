<?php

$I = new WebGuy($scenario);

UserLoginPage::of($I)->login('cook@mail.ru', 'cook');
