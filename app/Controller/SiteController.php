<?php


namespace App\Controller;


use App\Model\RoomDAO;
use App\Model\Site;
use App\Model\SiteDAO;

class SiteController
{
    private static SiteController $_instance;
    private Site $site;
    private array $siteDetails;
    private ?array $roomsList;
    private array $monitoringDetails;
    private string $activePage;

    private function __construct(int $siteID)
    {
        // Retrieving data from the database and instantiating objects
        $this->site = SiteDAO::getSiteByID($siteID);

        // Retrieving data from the database and instantiating objects
        $roomsCollection = RoomDAO::getRoomBySiteID($siteID);
        // List of warranties
        foreach ($roomsCollection as $key => $val) {
            $this->roomsList[] = array('RoomName' => $val->getRoomName());
        }

        // Preparing the data that will be sent to the view
        $this->siteDetails = array('SiteID' => $this->site->getSiteID(),
            'SiteName' => $this->site->getSiteName(),
            'Street' => $this->site->getStreet(),
            'ZipCode' => $this->site->getZipCode(),
            'City' => $this->site->getCity(),
            'IP' => $this->site->getMonitoring()->getIP(),
            'Status' => $this->site->getMonitoring()->isUp(),
            'LastPing' => $this->site->getMonitoring()->getLastPing()->format("Y-m-d h:i A"),
            'Rooms' => isset($this->roomsList) ? $this->roomsList : null);
    }

    public static function getInstance(int $siteID): SiteController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self($siteID);
        }
        return self::$_instance;
    }

    public function edit()
    {
        $this->activePage = "siteList";
        include_once "app/View/header.php";
        include_once "app/View/siteEditView.php";
        include_once "app/View/footer.php";
    }

    public function save()
    {
        $this->site->setSiteName($_POST["inputSiteName"]);
        $this->site->setStreet($_POST["inputSiteStreet"]);
        $this->site->setZipCode($_POST["inputSiteZip"]);
        $this->site->setCity($_POST["inputSiteCity"]);
        $this->site->persist();
        self::$_instance = new self($_GET['siteID']);
        self::$_instance->details();
    }

    public function details()
    {
        $this->activePage = "siteList";
        include_once "app/View/header.php";
        include_once "app/View/siteDetailsView.php";
        include_once "app/View/footer.php";
    }
}