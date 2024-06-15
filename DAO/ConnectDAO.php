<?php
class BaseDAO
{
    protected $PDO;

    public function __construct()
    {
        global $pdo;
        require_once('config/PDO.php');
        $this->PDO = $pdo;
    }
}
