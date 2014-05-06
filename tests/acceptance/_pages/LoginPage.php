<?php

class LoginPage
{
    // include url of current page
    static $URL = '/';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    static $loginButton = '.login-button';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
     public static function route($param)
     {
        return static::$URL.$param;
     }

    /**
     * @var WebGuy;
     */
    protected $webGuy;

    public function __construct(WebGuy $I)
    {
        $this->webGuy = $I;
    }

    /**
     * @return UserLoginPage
     */
    public static function of(WebGuy $I)
    {
        return new static($I);
    }

    public function login($email, $password)
    {
        $I = $this->webGuy;

        $I->wantTo('log in');
        $I->amOnPage(self::$URL);
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click(self::$loginButton);
        $I->see("Welcome $email");
    }
}