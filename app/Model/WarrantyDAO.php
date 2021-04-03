<?php


namespace App\Model;


use PDO;

class WarrantyDAO extends DAO
{
    public static function getAll(): array
    {
        $warrantyCollection = array();
        $rs = self::query("SELECT * FROM Garantie");
        foreach ($rs as $key => $val) {
            $warrantyCollection[$val['ID_garantie']] = new Warranty($val['ID_garantie'], $val['Nom_garantie'], date_create($val['Date_expiration']));
        }
        return $warrantyCollection;
    }

    public static function getWarrantyByID(int $warrantyID): Warranty
    {
        $rs = self::prepare("SELECT * FROM Garantie WHERE ID_garantie = :warrantyID", array(":warrantyID" => $warrantyID));
        return new Warranty($rs[0]['ID_garantie'], $rs[0]['Nom_garantie'], date_create($rs[0]['Date_expiration']));
    }

    public static function getWarrantyByProductID(int $productID): array
    {
        $warrantyCollection = array();
        $rs = self::prepare("SELECT * FROM Garantie WHERE ID_produit = :productID", array(":productID" => $productID));
        foreach ($rs as $key => $val) {
            $warrantyCollection[$val['ID_garantie']] = new Warranty($val['ID_garantie'], $val['Nom_garantie'], date_create($val['Date_expiration']));
        }
        return $warrantyCollection;
    }
}