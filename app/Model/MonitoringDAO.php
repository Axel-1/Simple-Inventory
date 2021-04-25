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

    public static function getAllProductMonitoring(): array
    {
        $monitCollection = array();
        $rs = self::query("SELECT Supervision.ID_supervision, IP, Date_dernier_ping FROM Supervision JOIN Produit ON Supervision.ID_supervision = Produit.ID_supervision");
        foreach ($rs as $key => $val) {
            $monitCollection[$val['ID_supervision']] = new Monitoring($val['ID_supervision'], $val['IP'], date_create($val['Date_dernier_ping']));
        }
        return $monitCollection;
    }

    public static function updateMonitoring(Monitoring $monitoring): void
    {
        $monitoringAttributes = array(':IP' => $monitoring->getIP(), ':monitID' => $monitoring->getMonitID());
        self::write("UPDATE Supervision SET IP = :IP WHERE ID_supervision = :monitID", $monitoringAttributes);
    }

    public static function deleteMonitoring(Monitoring $monitoring): void
    {
        $monitoringAttributes = array(':monitID' => $monitoring->getMonitID());
        self::write("DELETE FROM Supervision WHERE ID_supervision = :monitID", $monitoringAttributes);
    }

    public static function createMonitoring(string $ip): Monitoring
    {
        $monitoringAttributes = array(':IP' => $ip);
        self::write("INSERT INTO Supervision (IP) VALUES (:IP)", $monitoringAttributes);
        return self::getMonitoringByID(self::getLastInsertID());
    }

    public static function getMonitoringByID(int $monitID): Monitoring
    {
        $rs = self::prepare("SELECT * FROM Supervision WHERE ID_supervision = :monitID", array(":monitID" => $monitID));
        return new Monitoring($rs[0]['ID_supervision'], $rs[0]['IP'], date_create($rs[0]['Date_dernier_ping']));
    }
}