<?php


namespace App\Controller;


use App\Model\SiteDAO;

class SiteListController
{
    private array $siteList;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $siteCollection = SiteDAO::getAll();
        // Preparing the data that will be sent to the view
        $this->siteList = array();
        foreach ($siteCollection as $key => $val) {
            $this->siteList[] = array('SiteID' => $val->getSiteID(), 'SiteName' => $val->getSiteName(),
                'Address' => $val->getStreet() . ", " . $val->getZipCode() . " " . $val->getCity(),
                'IP' => $val->getMonitoring()->getIP(), 'Status' => $val->getMonitoring()->isUp());
        }
    }

    public static function getInstance(): SiteListController
    {
        return new self();
    }

    public function render()
    {
        $this->activePage = "siteList";
        include_once "app/View/header.php";
        include_once "app/View/siteListView.php";
        include_once "app/View/footer.php";
    }
}