<?php


class FieldManager
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}