<?php


namespace App\Model;


use PDO;

class ProductDAO extends DAO
{
    public static function getAll(): array
    {
        $productCollection = array();
        $rs = self::query("SELECT * FROM Produit");
        foreach ($rs as $key => $val) {
            if ($val['Type'] == "p") {
                $productCollection[$val['ID_produit']] = new PhysicalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Nom_hote'], WarrantyDAO::getWarrantyByProductID($val['ID_produit']), RoomDAO::getRoomByID($val['ID_piece']), ($val['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($val['ID_supervision'])));
            } elseif ($val['Type'] == "d") {
                $productCollection[$val['ID_produit']] = new DigitalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Activation'], date_create($val['Date_expiration']));
            }
        }
        return $productCollection;
    }

    public static function getProductByID(int $productID): Product
    {
        $rs = self::prepare("SELECT * FROM Produit WHERE ID_produit = :productID", array(":productID" => $productID));
        if ($rs[0]['Type'] == "p") {
            return new PhysicalProduct($rs[0]['ID_produit'], $rs[0]['Nom_produit'], $rs[0]['Fabricant'], $rs[0]['Num_modele'], $rs[0]['Num_serie'], date_create($rs[0]['Date_achat']), $rs[0]['Chemin_facture'], $rs[0]['Nom_hote'], WarrantyDAO::getWarrantyByProductID($rs[0]['ID_produit']), RoomDAO::getRoomByID($rs[0]['ID_piece']), ($rs[0]['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($rs[0]['ID_supervision'])));
        } elseif ($rs[0]['Type'] == "d") {
            return new DigitalProduct($rs[0]['ID_produit'], $rs[0]['Nom_produit'], $rs[0]['Fabricant'], $rs[0]['Num_modele'], $rs[0]['Num_serie'], date_create($rs[0]['Date_achat']), $rs[0]['Chemin_facture'], $rs[0]['Activation'], date_create($rs[0]['Date_expiration']));
        }
    }

    public static function getProductByType(string $productType): array
    {
        $productCollection = array();
        $rs = self::prepare("SELECT * FROM Produit WHERE Type = :productType", array(":productType" => $productType));
        foreach ($rs as $key => $val) {
            if ($val['Type'] == "p") {
                $productCollection[$val['ID_produit']] = new PhysicalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Nom_hote'], WarrantyDAO::getWarrantyByProductID($val['ID_produit']), RoomDAO::getRoomByID($val['ID_piece']), ($val['ID_supervision'] == null ? null : MonitoringDAO::getMonitoringByID($val['ID_supervision'])));
            } elseif ($val['Type'] == "d") {
                $productCollection[$val['ID_produit']] = new DigitalProduct($val['ID_produit'], $val['Nom_produit'], $val['Fabricant'], $val['Num_modele'], $val['Num_serie'], date_create($val['Date_achat']), $val['Chemin_facture'], $val['Activation'], date_create($val['Date_expiration']));
            }
        }
        return $productCollection;
    }
}