<?php
use Phalcon\Mvc\View;

class EventController extends ControllerBase{
  
  public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
    		 $this->response->redirect('authen');   
   } 
   public function indexAction(){
	
  }
  public function editAction(){
    if($this->request->isPost()){
      $name = trim($this->request->getPost('name')); // รับค่าจาก form
      $date = trim($this->request->getPost('date')); // รับค่าจาก form
      $detail = trim($this->request->getPost('detail')); // รับค่าจาก form
      $picture = trim($this->request->getPost('image')); 
      $id=$this->session->get('id');
      $event=Activities::findFirst("id = '$id'");
      $event->id=$this->session->get('memberAuthen');
      $event->name=$name;
      $event->date=$date;
      $event->detail=$detail;
      $event->picture=$picture;
      $event->save();
      $this->response->redirect('event');
      }
  }
  public function addAction(){
    if($this->request->isPost()){
      $name = trim($this->request->getPost('name')); // รับค่าจาก form
      $date = trim($this->request->getPost('date')); // รับค่าจาก form
      $detail = trim($this->request->getPost('detail')); // รับค่าจาก form
      $picture = trim($this->request->getPost('image')); 
      
      $event=new Activities();
      $event->id=$this->session->get('memberAuthen');
      $event->name=$name;
      $event->date=$date;
      $event->detail=$detail;
      $event->picture=$picture;
      $event->save();
      $this->response->redirect('event');
      }
  }
  public function setIdAction($temp){
    $this->session->set('id',$temp);
	  $this->response->redirect('event/edit');    
  }
  public function deleteIdAction($temp){
    $event = Activities::findFirst($temp);
    $event->delete();
	  $this->response->redirect('event');    
  }
  }