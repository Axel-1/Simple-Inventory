<?php


namespace App\Model;


use PDO;

class SiteDAO extends DAO
{
    public static function getAll(): array
    {
        $siteCollection = array();
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT ID_site, Nom_site, Adresse, CP, Ville, ID_supervision FROM Site");
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach ($rs as $key => $val) {
            $siteCollection[$val['ID_site']] = new Site($val['ID_site'], $val['Nom_site'], $val['Adresse'], $val['Ville'], $val['CP'], MonitoringDAO::getMonitoringByID($val['ID_supervision']));
        }
        return $siteCollection;
    }

    public static function getSiteByID(int $siteID): Site
    {
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT ID_site, Nom_site, Adresse, CP, Ville, ID_supervision FROM Site WHERE ID_site = :siteID");
        $stmt->bindValue(':siteID', $siteID, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return new Site($rs[0]['ID_site'], $rs[0]['Nom_site'], $rs[0]['Adresse'], $rs[0]['Ville'], $rs[0]['CP'], MonitoringDAO::getMonitoringByID($rs[0]['ID_supervision']));
    }
}