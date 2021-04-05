<?php


namespace App\Controller;


use App\Model\SiteDAO;

class SiteListController
{
    private static SiteListController $_instance;
    private array $siteList;
    private string $activePage;

    private function __construct()
    {
        // Retrieving data from the database and instantiating objects
        $siteCollection = SiteDAO::getAll();
        // Preparing the data that will be sent to the view
        $this->siteList = array();
        foreach ($siteCollection as $key => $val) {
            $this->siteList[] = array('SiteName' => $val->getSiteName(),
                'Address' => $val->getStreet() . ", " . $val->getZipCode() . " " . $val->getCity(),
                'IP' => $val->getMonitoring()->getIP(), 'Status' => $val->getMonitoring()->isUp());
        }
    }

    public static function getInstance(): SiteListController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "siteList";
        include_once "app/View/header.php";
        include_once "app/View/siteListView.php";
        include_once "app/View/footer.php";
    }
}