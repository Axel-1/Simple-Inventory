<?php


namespace App\Model;


use PDO;

class DAO
{
    private static PDO $dbh;
    private static string $host = "localhost";
    private static string $db = "SimpleInventory";
    private static string $user = "util";
    private static string $password = "util";

    protected static function query($statement): array
    {
        $stmt = self::getPDO()->query($statement);
        return $stmt->fetchAll();
    }

    private static function getPDO(): PDO
    {
        if (!isset(self::$dbh)) {
            $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8", self::$user, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbh = $pdo;
        }
        return self::$dbh;
    }

    protected static function prepare($statement, $attributes): array
    {
        $stmt = self::getPDO()->prepare($statement);
        $stmt->execute($attributes);
        return $stmt->fetchAll();
    }

    protected static function write($statement, $attributes): void
    {
        $stmt = self::getPDO()->prepare($statement);
        $stmt->execute($attributes);
    }

    protected static function getLastInsertID(): string
    {
        return self::getPDO()->lastInsertId();
    }
}