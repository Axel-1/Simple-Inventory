<?php


namespace App\Model;


use PDO;
use PDOException;

class DAO
{
    protected static PDO $dbh;
    private static string $host = "localhost";
    private static string $db = "SimpleInventory";
    private static string $user = "util";
    private static string $password = "util";

    public static function init()
    {
        try {
            self::$dbh = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8", self::$user, self::$password);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}