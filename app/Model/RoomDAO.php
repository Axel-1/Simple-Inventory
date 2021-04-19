<?php


namespace App\Model;


class RoomDAO extends DAO
{
    public static function getAll(): array
    {
        $roomCollection = array();
        $rs = self::query("SELECT * FROM Piece");
        foreach ($rs as $key => $val) {
            $roomCollection[$val['ID_piece']] = new Room($val['ID_piece'], $val['Nom_piece'], SiteDAO::getSiteByID($val['ID_site']));
        }
        return $roomCollection;
    }

    public static function getRoomByID(int $roomID): Room
    {
        $rs = self::prepare("SELECT * FROM Piece WHERE ID_piece = :roomID", array(":roomID" => $roomID));
        return new Room($rs[0]['ID_piece'], $rs[0]['Nom_piece'], SiteDAO::getSiteByID($rs[0]['ID_site']));
    }

    public static function getRoomBySiteID(int $siteID): array
    {
        $roomCollection = array();
        $rs = self::prepare("SELECT * FROM Piece WHERE ID_site = :siteID", array(":siteID" => $siteID));
        foreach ($rs as $key => $val) {
            $roomCollection[$val['ID_piece']] = new Room($val['ID_piece'], $val['Nom_piece'], SiteDAO::getSiteByID($val['ID_site']));
        }
        return $roomCollection;
    }

    public static function updateRoom(Room $room): void
    {
        $roomAttributes = array(':roomName' => $room->getRoomName(), ':roomID' => $room->getRoomID());
        self::update("UPDATE Piece SET Nom_piece = :roomName WHERE ID_piece = :roomID", $roomAttributes);
    }
}