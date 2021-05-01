<?php


namespace App\Controller;


use App\Model\Authentication;

class AuthenticationController
{
    private bool $error = false;

    public static function getInstance(): AuthenticationController
    {
        return new self();
    }

    public function login(): void
    {
        if ($_POST['inputLoginEmail'] != null && isset($_POST['inputLoginPassword']) != null) {
            $this->error = !Authentication::login($_POST['inputLoginEmail'], $_POST['inputLoginPassword']);
        } else {
            $this->error = true;
            self::render();
        }

        if (!$this->error) {
            header("Location: ?action=dashboard");
        } else {
            self::render();
        }
    }

    public function render(): void
    {
        include_once "app/View/loginView.php";
    }

    public function logout(): void
    {
        Authentication::logout();
    }

    public function isLoggedIn(): bool
    {
        return Authentication::isLoggedIn();
    }
}