<?php


namespace App\Model;


final class Site
{
    private int $siteID;
    private string $siteName;
    private string $street;
    private string $city;
    private string $zipCode;
    private Monitoring $monitoring;

    /**
     * Site constructor.
     * @param int $siteID
     * @param string $siteName
     * @param string $street
     * @param string $city
     * @param string $zipCode
     * @param Monitoring $monitoring
     */
    public function __construct(int $siteID, string $siteName, string $street, string $city, string $zipCode, Monitoring $monitoring)
    {
        $this->siteID = $siteID;
        $this->siteName = $siteName;
        $this->street = $street;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->monitoring = $monitoring;
    }

    /**
     * @return int
     */
    public function getSiteID(): int
    {
        return $this->siteID;
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @return Monitoring
     */
    public function getMonitoring(): Monitoring
    {
        return $this->monitoring;
    }

}