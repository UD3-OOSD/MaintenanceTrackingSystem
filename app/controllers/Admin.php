<?php

require_once(ROOT.DS.'app/controllers/bus/Bus.php');
require_once(ROOT.DS.'app/controllers/labour/Labour.php');

class Admin extends Controller{

  private $busses , $labours; // just assume or can to set seperate arrays to diff states. @avishka

  public function indexAction(){
    $this->view->render('admin/index');
  }

  public function show_busses(){
    // just a example is below.
    foreach ($busses as $bus) {
      //here some JQuery and html padding.
      $bus->show();
    }
  }

  public function show_labours(){
    // just a example is below.
    foreach ($labours as $labour) {
      //here some JQuery and html padding.
      $labour->show();
    }
  }

  public function addNewBusAction(){  // this is call by button in the index page of Admin. @uda
    $this->view->render('admin/bus_form');
    // here calls to the bus->stateChange.
     $bus = new Bus();    // ?$busses UPDATE

  }

  public function addNewLabourAction(){  // this is call by button in the index page of Admin. @uda
    $this->view->render('admin/user_form');

    $lab = new Labour();
  }

  public function editBusAction($bus,$data){  // call by button press @uda
    $bus->stateChange();
    $bus->getState()->fitAction($bus,$data);
  }

  public function editLabourAction($lab,$data){
    $lab->stateChange();
    $lab->getState()->edit($lab,$data);
  }

  public function deleteBus($bus){
    // jQuery code in here to fade @devin.
    $bus->set_trigger(true);
    $bus->stateChange();

  }
}
