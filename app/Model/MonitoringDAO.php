<?php


namespace App\Model;

class MonitoringDAO extends DAO
{
    public static function getAll(): array
    {
        $monitCollection = array();
        $rs = self::query("SELECT * FROM Supervision");
        foreach ($rs as $key => $val) {
            $monitCollection[$val['ID_supervision']] = new Monitoring($val['ID_supervision'], $val['IP'], date_create($val['Date_dernier_ping']));
        }
        return $monitCollection;
    }

    public static function getMonitoringByID(int $monitID): Monitoring
    {
        $rs = self::prepare("SELECT * FROM Supervision WHERE ID_supervision = :monitID", array(":monitID" => $monitID));
        return new Monitoring($rs[0]['ID_supervision'], $rs[0]['IP'], date_create($rs[0]['Date_dernier_ping']));
    }

    public static function getMonitoringByProductID(int $productID): ?Monitoring
    {
        $rs = self::prepare("SELECT Supervision.* FROM Supervision JOIN Produit ON Supervision.ID_supervision = Produit.ID_supervision WHERE ID_produit = :productID", array(":productID" => $productID));
        if (empty($rs)) {
            return null;
        } else {
            return new Monitoring($rs[0]['ID_supervision'], $rs[0]['IP'], date_create($rs[0]['Date_dernier_ping']));
        }
    }

    public static function getAllProductMonitoring(): array
    {
        $monitCollection = array();
        $rs = self::query("SELECT Supervision.ID_supervision, IP, Date_dernier_ping FROM Supervision JOIN Produit ON Supervision.ID_supervision = Produit.ID_supervision");
        foreach ($rs as $key => $val) {
            $monitCollection[$val['ID_supervision']] = new Monitoring($val['ID_supervision'], $val['IP'], date_create($val['Date_dernier_ping']));
        }
        return $monitCollection;
    }
}