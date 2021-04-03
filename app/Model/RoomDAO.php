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
}