<?php


namespace App\Model;

use DateTime;

final class PhysicalProduct extends Product
{
    private string $hostname;
    private array $warranties;
    private Room $productRoom;
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
     * @param Room $productRoom
     * @param Monitoring|null $productMonitoring
     */
    public function __construct(string $productID, string $productName, string $manufacturer, string $modelNo, string $serialNo, DateTime $purchaseDate, string $billPath, string $hostname, array $warranties, Room $productRoom, ?Monitoring $productMonitoring)
    {
        parent::__construct($productID, $productName, $manufacturer, $modelNo, $serialNo, $purchaseDate, $billPath);
        $this->hostname = $hostname;
        $this->warranties = $warranties;
        $this->productRoom = $productRoom;
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
     * @return array
     */
    public function getWarranties(): array
    {
        return $this->warranties;
    }

    /**
     * @return Room
     */
    public function getProductRoom(): Room
    {
        return $this->productRoom;
    }

    /**
     * @return Monitoring|null
     */
    public function getProductMonitoring(): ?Monitoring
    {
        return $this->productMonitoring;
    }

}