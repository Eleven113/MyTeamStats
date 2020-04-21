<?php

namespace MyteamStats\Model;

class DBFactory
{
  public static function ConnexionPDO()
  {
      try {
          $db = new \PDO('mysql:host=db5000305562.hosting-data.io;dbname=dbs298174;charset=utf8', 'dbu532818', 'zM@9sSX6EnWqm9z');
          $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          return $db;
      }
      catch (PDOException $e)
      {
          echo $e->getMessage();
          die();
      }
    


  }
}  