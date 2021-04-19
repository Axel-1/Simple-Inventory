<?php


namespace App\Model;


final class Room
{
    private string $roomID;
    private string $roomName;
    private Site $site;

    /**
     * Room constructor.
     * @param string $roomID
     * @param string $roomName
     * @param Site $site
     */
    public function __construct(string $roomID, string $roomName, Site $site)
    {
        $this->roomID = $roomID;
        $this->roomName = $roomName;
        $this->site = $site;
    }

    public function persist(): void
    {
        RoomDAO::updateRoom($this);
    }

    /**
     * @return string
     */
    public function getRoomID(): string
    {
        return $this->roomID;
    }

    /**
     * @param string $roomID
     */
    public function setRoomID(string $roomID): void
    {
        $this->roomID = $roomID;
    }

    /**
     * @return string
     */
    public function getRoomName(): string
    {
        return $this->roomName;
    }

    /**
     * @param string $roomName
     */
    public function setRoomName(string $roomName): void
    {
        $this->roomName = $roomName;
    }

}