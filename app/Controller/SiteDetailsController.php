<?php


namespace App\Controller;


use App\Model\RoomDAO;
use App\Model\SiteDAO;

class SiteDetailsController
{
    private static SiteDetailsController $_instance;
    private array $siteDetails;
    private ?array $roomsList;
    private array $monitoringDetails;
    private string $activePage;

    private function __construct(int $siteID)
    {
        // Retrieving data from the database and instantiating objects
        $site = SiteDAO::getSiteByID($siteID);

        // Retrieving data from the database and instantiating objects
        $roomsCollection = RoomDAO::getRoomBySiteID($siteID);
        // List of warranties
        foreach ($roomsCollection as $key => $val) {
            $this->roomsList[] = array('RoomName' => $val->getRoomName());
        }

        // Preparing the data that will be sent to the view
        $this->siteDetails = array('SiteName' => $site->getSiteName(),
            'Address' => $site->getStreet() . ", " . $site->getZipCode() . " " . $site->getCity(),
            'IP' => $site->getMonitoring()->getIP(),
            'Status' => $site->getMonitoring()->isUp(),
            'LastPing' => $site->getMonitoring()->getLastPing()->format("Y-m-d h:i A"),
            'Rooms' => isset($this->roomsList) ? $this->roomsList : null);
    }

    public static function getInstance(int $siteID): SiteDetailsController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self($siteID);
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "siteList";
        include_once "app/View/header.php";
        include_once "app/View/siteDetailsView.php";
        include_once "app/View/footer.php";
    }
}