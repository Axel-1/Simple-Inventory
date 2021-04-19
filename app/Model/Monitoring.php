<?php


namespace App\Model;

use DateInterval;
use DateTime;

final class Monitoring
{
    private string $monitID;
    private string $IP;
    private DateTime $lastPing;

    /**
     * Monitoring constructor.
     * @param string $monitID
     * @param string $IP
     * @param DateTime $lastPing
     */
    public function __construct(string $monitID, string $IP, DateTime $lastPing)
    {
        $this->monitID = $monitID;
        $this->IP = $IP;
        $this->lastPing = $lastPing;
    }

    public function isUp(): bool
    {
        $now = new DateTime("now");
        $now->sub(DateInterval::createFromDateString("5 minutes"));
        if ($this->lastPing < $now) {
            return false;
        } else {
            return true;
        }
    }

    public function persist(): void
    {
        MonitoringDAO::updateMonitoring($this);
    }

    /**
     * @return string
     */
    public function getMonitID(): string
    {
        return $this->monitID;
    }

    /**
     * @param string $monitID
     */
    public function setMonitID(string $monitID): void
    {
        $this->monitID = $monitID;
    }

    /**
     * @return string
     */
    public function getIP(): string
    {
        return $this->IP;
    }

    /**
     * @param string $IP
     */
    public function setIP(string $IP): void
    {
        $this->IP = $IP;
    }

    /**
     * @return DateTime
     */
    public function getLastPing(): DateTime
    {
        return $this->lastPing;
    }

    /**
     * @param DateTime $lastPing
     */
    public function setLastPing(DateTime $lastPing): void
    {
        $this->lastPing = $lastPing;
    }

}