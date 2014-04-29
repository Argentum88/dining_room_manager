<?php
namespace Codeception\Module;

// here you can define custom functions for CodeGuy 

class CodeHelper extends \Codeception\Module
{
    public function seeMyVar($var){
        $this->debug($var);
    }
}
