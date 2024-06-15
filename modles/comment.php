<?php
class comment
{
    public $id_cm;
    public $name_user;
    public $text;
    public $id_pro;
    public $day;
    public function __construct($id_cm, $name_user, $text, $id_pro, $day)
    {
        $this->id_cm = $id_cm;
        $this->name_user = $name_user;
        $this->text = $text;
        $this->id_pro = $id_pro;
        $this->$day = $day;
    }
}
class commentshow
{

    public $name_user;
    public $text;
    public $day;
    public function __construct($name_user, $text, $day)
    {

        $this->name_user = $name_user;
        $this->text = $text;
        $this->$day = $day;
    }
}