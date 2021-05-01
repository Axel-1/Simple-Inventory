<?php


namespace App\Model;


class Authentication
{
    public static function login(string $email, string $password): bool
    {
        $user = UserDAO::getUserByEmail($email);

        if (isset($user)) {
            if (password_verify($password, $user->getPassword())) {
                session_start();
                $_SESSION["userEmail"] = $user->getEmail();
                $_SESSION["userPassword"] = $password;
                $_SESSION["userFirstName"] = $user->getFirstName();
                $_SESSION["userID"] = $user->getUserID();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getUserLoggedIn(): ?User
    {
        session_start();
        if (self::isLoggedIn()) {
            return UserDAO::getUserByEmail($_SESSION["userEmail"]);
        } else {
            return null;
        }
    }

    public static function isLoggedIn(): bool
    {
        session_start();
        if (isset($_SESSION["userEmail"]) && isset($_SESSION["userPassword"])) {
            $user = UserDAO::getUserByEmail($_SESSION["userEmail"]);
            if (isset($user)) {
                if (password_verify($_SESSION["userPassword"], $user->getPassword())) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function logout(): void
    {
        session_start();
        session_destroy();
        header("Location: ?action=authentication");
    }
}