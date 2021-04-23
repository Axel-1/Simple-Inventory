<?php


namespace App\Model;

use DateTime;

final class PhysicalProduct extends Product
{
    private string $hostname;
    private array $warranties;
    private ?Monitoring $productMonitoring;

    /**
     * PhysicalProduct constructor.
     * @param string $productID
     * @param string $productName
     * @param string $manufacturer
     * @param string $modelNo
     * @param string $serialNo
     * @param DateTime $purchaseDate
     * @param string $billPath
     * @param string $hostname
     * @param array $warranties
     * @param Monitoring|null $productMonitoring
     */
    public function __construct(string $productID, string $productName, string $manufacturer, string $modelNo, string $serialNo, DateTime $purchaseDate, string $billPath, string $hostname, array $warranties, ?Monitoring $productMonitoring)
    {
        parent::__construct($productID, $productName, $manufacturer, $modelNo, $serialNo, $purchaseDate, $billPath);
        $this->hostname = $hostname;
        $this->warranties = $warranties;
        $this->productMonitoring = $productMonitoring;

    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     */
    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    /**
     * @return array
     */
    public function getWarranties(): array
    {
        return $this->warranties;
    }

    /**
     * @param array $warranties
     */
    public function setWarranties(array $warranties): void
    {
        $this->warranties = $warranties;
    }

    /**
     * @return Monitoring|null
     */
    public function getProductMonitoring(): ?Monitoring
    {
        return $this->productMonitoring;
    }

    /**
     * @param Monitoring|null $productMonitoring
     */
    public function setProductMonitoring(?Monitoring $productMonitoring): void
    {
        $this->productMonitoring = $productMonitoring;
    }

}