<?php


namespace App\Model;


class UserDAO extends DAO
{
    public static function getAll(): array
    {
        $usersCollection = array();
        $rs = self::query("SELECT * FROM Utilisateur");
        foreach ($rs as $key => $val) {
            $usersCollection[$val['ID_utilisateur']] = new User($val['ID_utilisateur'], $val['Prenom'], $val['Nom'], $val['Email'], $val['Mdp']);
        }
        return $usersCollection;
    }

    public static function updateUser(User $user): void
    {
        $userAttributes = array(':userID' => $user->getUserID(), ':firstName' => $user->getFirstName(), ':lastName' => $user->getLastName(), ':email' => $user->getEmail(), ':password' => $user->getPassword());
        self::write("UPDATE Utilisateur SET Prenom = :firstName, Nom = :lastName, Email = :email, Mdp = :password WHERE ID_utilisateur = :userID", $userAttributes);
    }

    public static function deleteUser(User $user): void
    {
        $userAttributes = array(':userID' => $user->getUserID());
        self::write("DELETE FROM Utilisateur WHERE ID_utilisateur = :userID", $userAttributes);
    }

    public static function createUser(string $firstName, string $lastName, string $email, string $password): User
    {
        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
        $userAttributes = array(':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':password' => $encryptedPassword);
        self::write("INSERT INTO Utilisateur (Prenom, Nom, Email, Mdp) VALUES (:firstName, :lastName, :email, :password)", $userAttributes);
        return self::getUserByID(self::getLastInsertID());
    }

    public static function getUserByID(int $userID): User
    {
        $rs = self::prepare("SELECT * FROM Utilisateur WHERE ID_utilisateur = :userID", array(":userID" => $userID));
        return new User($rs[0]['ID_utilisateur'], $rs[0]['Prenom'], $rs[0]['Nom'], $rs[0]['Email'], $rs[0]['Mdp']);
    }

    public static function getUserByEmail(string $email): ?User
    {
        $rs = self::prepare("SELECT * FROM Utilisateur WHERE Email = :email", array(":email" => $email));
        if (!$rs) {
            return null;
        } else {
            return new User($rs[0]['ID_utilisateur'], $rs[0]['Prenom'], $rs[0]['Nom'], $rs[0]['Email'], $rs[0]['Mdp']);
        }
    }
}