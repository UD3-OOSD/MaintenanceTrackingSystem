<?php

  class Home extends Controller{

    public function __construct($controller, $action){
      parent::__construct($controller, $action);
    }

    public function indexAction(){
      #echo $name;
      $db = DB::getInstance();
      $fields = [
        'f-name' => 'nipun',
        'mail' => 'deelaka@mail.com'
      ];
      $contacts = $db->find('contact',[
        'conditions' => ['l-name' => '?,', 'f-name' => 'Nip' ],
        'bind' => ['Parhan'],
        'order' => "l-name, f-name",
        'limit' => 5
      ]);
      #$contactQ = $db->update('contact',4, $fields);
      #$contactQ = $db->delete('contact',1);
      dnd($contacts);
      $this->view->render('home/index');
    }
  }
