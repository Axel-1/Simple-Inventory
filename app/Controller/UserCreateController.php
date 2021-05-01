<?php


namespace App\Controller;


use App\Model\UserDAO;

class UserCreateController
{
    private string $activePage;

    private function __construct()
    {

    }

    public static function getInstance(): UserCreateController
    {
        return new self();
    }

    public function create(): void
    {
        $this->activePage = "userList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/userCreateView.php";
        include_once "app/View/footer.php";
    }

    public function save(): void
    {
        $siteID = UserDAO::createUser($_POST['inputUserFirstName'], $_POST['inputUserLastName'], $_POST['inputUserEmail'], $_POST['inputUserPassword']);
        // Reloading products details
        header("Location: ?action=userList");
    }
}