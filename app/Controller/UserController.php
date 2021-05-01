<?php


namespace App\Controller;


use App\Model\User;
use App\Model\UserDAO;

class UserController
{
    private User $user;
    private array $userDetails;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $this->user = UserDAO::getUserByID($_GET['userID']);
    }

    public static function getInstance(): UserController
    {
        return new self();
    }

    public function edit(): void
    {
        $this->prepareData();

        $this->activePage = "userList";

        // Loading view
        include_once "app/View/header.php";
        include_once "app/View/userEditView.php";
        include_once "app/View/footer.php";
    }

    private function prepareData(): void
    {
        // Preparing the data that will be sent to the view
        $this->userDetails = array('UserID' => $this->user->getUserID(),
            'FirstName' => $this->user->getFirstName(),
            'LastName' => $this->user->getLastName(),
            'Email' => $this->user->getEmail());
    }

    public function save(): void
    {
        // Setting object properties
        $this->user->setFirstName($_POST["inputUserFirstName"]);
        $this->user->setLastName($_POST["inputUserLastName"]);
        $this->user->setEmail($_POST["inputUserEmail"]);

        // Saving change in the database
        $this->user->persist();

        // Reloading details page
        header("Location: ?action=userList");
    }

    public function delete(): void
    {
        $this->user->delete();

        // Reloading sites list
        header("Location: ?action=userList");
    }
}