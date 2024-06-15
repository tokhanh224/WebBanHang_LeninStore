<?php    
class SlideShow{
  public $id;
  public $name;
  public $path;
  public $desc;
  public function __construct($id, $name, $path, $desc)
  {
      $this->$id = $id;
      $this->name = $name;
      $this->$path = $path;
      $this->$desc = $desc;
  }

}