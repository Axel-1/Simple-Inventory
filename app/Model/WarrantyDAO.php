<?php


namespace App\Model;


use PDO;

class WarrantyDAO extends DAO
{
    public static function getAll(): array
    {
        $warrantyCollection = array();
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT * FROM Garantie");
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach ($rs as $key => $val) {
            $warrantyCollection[$val['ID_garantie']] = new Warranty($val['ID_garantie'], $val['Nom_garantie'], date_create($val['Date_expiration']));
        }
        return $warrantyCollection;
    }

    public static function getWarrantyByID(int $warrantyID): Warranty
    {
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT * FROM Garantie WHERE ID_garantie = :warrantyID");
        $stmt->bindValue(':warrantyID', $warrantyID, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return new Warranty($rs[0]['ID_garantie'], $rs[0]['Nom_garantie'], date_create($rs[0]['Date_expiration']));
    }

    public static function getWarrantyByProductID(int $productID): array
    {
        $warrantyCollection = array();
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT * FROM Garantie WHERE ID_produit = :productID");
        $stmt->bindValue(':productID', $productID, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach ($rs as $key => $val) {
            $warrantyCollection[$val['ID_garantie']] = new Warranty($val['ID_garantie'], $val['Nom_garantie'], date_create($val['Date_expiration']));
        }
        return $warrantyCollection;
    }
}