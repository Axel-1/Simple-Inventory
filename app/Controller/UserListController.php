<?php


namespace App\Controller;


use App\Model\UserDAO;

class UserListController
{
    private array $userList;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $userCollection = UserDAO::getAll();
        // Preparing the data that will be sent to the view
        $this->userList = array();
        foreach ($userCollection as $key => $val) {
            $this->userList[] = array('UserID' => $val->getUserID(),
                'FirstName' => $val->getFirstName(),
                'LastName' => $val->getLastName(),
                'Email' => $val->getEmail());
        }
    }

    public static function getInstance(): UserListController
    {
        return new self;
    }

    public function render()
    {
        $this->activePage = "userList";
        include_once "app/View/header.php";
        include_once "app/View/userListView.php";
        include_once "app/View/footer.php";
    }
}