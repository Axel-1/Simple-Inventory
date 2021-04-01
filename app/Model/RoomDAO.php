<?php


namespace App\Model;


use PDO;

class RoomDAO extends DAO
{
    public static function getAll(): array
    {
        $roomCollection = array();
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT ID_piece, Nom_piece, ID_site FROM Piece");
        $stmt->execute();
        $rs = $stmt->fetchAll();
        foreach ($rs as $key => $val) {
            $roomCollection[$val['ID_piece']] = new Room($val['ID_piece'], $val['Nom_piece'], SiteDAO::getSiteByID($val['ID_site']));
        }
        return $roomCollection;
    }

    public static function getRoomByID(int $roomID): Room
    {
        DAO::init();
        $stmt = self::$dbh->prepare("SELECT ID_piece, Nom_piece, ID_site FROM Piece WHERE ID_piece = :roomID");
        $stmt->bindValue(':roomID', $roomID, PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll();
        return new Room($rs[0]['ID_piece'], $rs[0]['Nom_piece'], SiteDAO::getSiteByID($rs[0]['ID_site']));
    }
}