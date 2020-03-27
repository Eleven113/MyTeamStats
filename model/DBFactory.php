<?php

class DBFactory
{
  public static function ConnexionPDO()
  {
      try {
          $db = new PDO('mysql:host=db5000305562.hosting-data.io;dbname=dbs298174;charset=utf8', 'dbu532818', 'Oh7811bm!=');
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $db;
      }
      catch (PDOException $e)
      {
          echo $e->getMessage();
          die();
      }
    


  }
}  