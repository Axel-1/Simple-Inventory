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

    public function persist(): void
    {
        SiteDAO::updateSite($this);
    }

    public function delete(): void
    {
        SiteDAO::deleteSite($this);
    }

    /**
     * @return int
     */
    public function getSiteID(): int
    {
        return $this->siteID;
    }

    /**
     * @param int $siteID
     */
    public function setSiteID(int $siteID): void
    {
        $this->siteID = $siteID;
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName
     */
    public function setSiteName(string $siteName): void
    {
        $this->siteName = $siteName;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return Monitoring
     */
    public function getMonitoring(): Monitoring
    {
        return $this->monitoring;
    }

    /**
     * @param Monitoring $monitoring
     */
    public function setMonitoring(Monitoring $monitoring): void
    {
        $this->monitoring = $monitoring;
    }

}