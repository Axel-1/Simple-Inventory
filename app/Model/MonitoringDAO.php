<?php


namespace App\Model;

use PDO;

class MonitoringDAO extends DAO
{
    public static function getAll(): array
    {
        $monitCollection = array();
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT ID_supervision, IP, Date_dernier_ping FROM Supervision");
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach ($rs as $key => $val) {
            $monitCollection[$val['ID_supervision']] = new Monitoring($val['ID_supervision'], $val['IP'], date_create($val['Date_dernier_ping']));
        }
        return $monitCollection;
    }

    public static function getMonitoringByID(int $monitID): Monitoring
    {
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT ID_supervision, IP, Date_dernier_ping FROM Supervision WHERE ID_supervision = :monitID");
        $stmt->bindValue(':monitID', $monitID, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return new Monitoring($rs[0]['ID_supervision'], $rs[0]['IP'], date_create($rs[0]['Date_dernier_ping']));
    }

    public static function getAllProductMonitoring(): array
    {
        $monitCollection = array();
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT Supervision.ID_supervision, IP, Date_dernier_ping FROM Supervision JOIN Produit ON Supervision.ID_supervision = Produit.ID_supervision");
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach ($rs as $key => $val) {
            $monitCollection[$val['ID_supervision']] = new Monitoring($val['ID_supervision'], $val['IP'], date_create($val['Date_dernier_ping']));
        }
        return $monitCollection;
    }
}