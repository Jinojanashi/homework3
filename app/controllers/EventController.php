<?php
use Phalcon\Mvc\View;
class EventController extends ControllerBase{

  public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  if(!$this->session->has('memberAuthen')) // ตรวจสอบว่ามี session การเข้าระบบ หรือไม่
         $this->response->redirect('authen');  
   }
 
  public function indexAction(){
    $events=Activities::find();
    $this->view->data=$events;
  }

  public function editAction(){
    $id=$this->dispatcher->getParam("id");
    $event=Activities::findFirst("id=".$id);
    $this->view->data=$event;
    if($this->request->isPost()){
      $name = trim($this->request->getPost('name')); // รับค่าจาก form
      $date = trim($this->request->getPost('date')); // รับค่าจาก form
      $detail = trim($this->request->getPost('detail')); // รับค่าจาก form
      $image = trim($this->request->getPost('image')); // รับค่าจาก form
    $event->name=$name;
    $event->date=$date;
    $event->detail=$detail;
    $event->image=$image;
    $event->save();
    
    $this->flashSession->success('Succeed');
    }
  }

  public function addAction(){
    if($this->request->isPost()){
      $name = trim($this->request->getPost('name')); // รับค่าจาก form
      $date = trim($this->request->getPost('date')); // รับค่าจาก form
      $detail = trim($this->request->getPost('detail')); // รับค่าจาก form
      $image = trim($this->request->getPost('image')); // รับค่าจาก form

    $event=new Activities();
    $event->name=$name;
    $event->date=$date;
    $event->detail=$detail;
    $event->image=$image;
    $event->save();
    
    $this->flashSession->success('Succeed');
    $this->response->redirect('event');
    }
  }

  public function delAction(){
    $id=$this->dispatcher->getParam("id");
    $event=Activities::findFirst("id=".$id);
    $event->delete();
    $this->response->redirect('event');
  }
}  