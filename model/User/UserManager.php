<?php


class UserManager
{

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


}