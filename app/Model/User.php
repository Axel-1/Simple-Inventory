<?php


namespace App\Model;


final class User
{
    private string $userID;
    private string $firstName;
    private string $lastName;
    private string $email;
    private bool $admin;

    /**
     * User constructor.
     * @param string $userID
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param bool $admin
     */
    public function __construct(string $userID, string $firstName, string $lastName, string $email, bool $admin)
    {
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->admin = $admin;
    }

}