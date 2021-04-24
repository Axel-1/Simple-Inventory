<?php


namespace App\Model;


class SiteDAO extends DAO
{
    public static function getAll(): array
    {
        $siteCollection = array();
        $rs = self::query("SELECT * FROM Site");
        foreach ($rs as $key => $val) {
            $siteCollection[$val['ID_site']] = new Site($val['ID_site'], $val['Nom_site'], $val['Adresse'], $val['Ville'], $val['CP'], MonitoringDAO::getMonitoringByID($val['ID_supervision']));
        }
        return $siteCollection;
    }

    public static function updateSite(Site $site): void
    {
        $siteAttributes = array(':siteName' => $site->getSiteName(),
            ':street' => $site->getStreet(),
            ':zipCode' => $site->getZipCode(),
            ':city' => $site->getCity(),
            ':siteID' => $site->getSiteID());
        self::update("UPDATE Site SET Nom_site = :siteName, Adresse = :street, CP = :zipCode, Ville = :city WHERE ID_site = :siteID", $siteAttributes);
    }

    public static function deleteSite(Site $site): void
    {
        $siteAttributes = array(':siteID' => $site->getSiteID());
        self::update("DELETE FROM Site WHERE ID_site = :siteID", $siteAttributes);
    }

    public static function createSite(string $siteName, string $street, string $zipCode, string $city, Monitoring $monitoring): Site
    {
        $siteAttributes = array(':siteName' => $siteName,
            ':street' => $street,
            ':zipCode' => $zipCode,
            ':city' => $city,
            ':monitID' => $monitoring->getMonitID());
        self::update("INSERT INTO Site (Nom_site, Adresse, CP, Ville, ID_supervision) VALUES (:siteName, :street, :zipCode, :city, :monitID)", $siteAttributes);
        return self::getSiteByID(self::getLastInsertID());
    }

    public static function getSiteByID(int $siteID): Site
    {
        $rs = self::prepare("SELECT * FROM Site WHERE ID_site = :siteID", array(":siteID" => $siteID));
        return new Site($rs[0]['ID_site'], $rs[0]['Nom_site'], $rs[0]['Adresse'], $rs[0]['Ville'], $rs[0]['CP'], MonitoringDAO::getMonitoringByID($rs[0]['ID_supervision']));
    }
}