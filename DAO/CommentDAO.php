<?php
class HomeDAO
{
    private $PDO;
    public function __construct()
    {
        require_once('config/PDO.php');
        $this->PDO = $pdo;
    }
    public function show($id_pro)
    {
    }
    public function add($id_pro, $text, $id_u, $day)
    {
    }
    public function delete($id)
    {
    }
}
