<?php
use Phalcon\Mvc\Model;
class Activities  extends Model{
  public function initialize()
    {
        $this->setSource('event');
    }
	public function getSource(){
    return "event"; // name table for event
  }
}