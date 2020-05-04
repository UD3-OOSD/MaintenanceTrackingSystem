<?php

class NewBus extends Controller implements BusState{

  public function __construct(){
    $this->fillAction();
  }

  public function stateChange($bus){
    $bus->setState(new EdittingBus());
  }

  public function fillAction(){
    $validation = new Validate();
    $posted_values = ['vehicle_num' => '', 'engine_num' => '', 'bus_type' => '' ]
    if(isset($_POST['vehicle_num'])){
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
        'vehicle_num' => [
          'display' => 'Vehicle Number',
          'require' => true.
          'unique' => 'bus_details'
          'min' => 6  #check
        ],
        'engine_num' => [
          'display' => 'Engine number',
          'require' => true,
          'unique' => 'bus_details',
          'min' => 6,
        ],
        'bus_type' => [
          'display' => 'Bus Type',
          'require' => true,
        ]
      ]);

      if ($validation->passed()){
        $this->BusMaintainanceDistances($_POST['bus_type']);
        $newBus = new BusM();
        $newBus->registerNewBus($_POST);
        Router::redirect('');  #will have to change
      }

    }
    //create a record and fill it.-> goto BusModel.
  }

  private function BusMaintainanceDistances($type){
    if(isset($type)){
      $details= [[
        'engine_maintanance'=> 5000,
        'engine_travelled' => 0,
        'tire_maintanance' => 2000,
        'tire_travelled' => 0
      ],[
        'engine_maintanance'=> 7000,
        'engine_travelled' => 0,
        'tire_maintanance' => 5000,
        'tire_travelled' => 0
      ],[
        'engine_maintanance'=> 1000,
        'engine_travelled' => 0,
        'tire_maintanance' => 7000,
        'tire_travelled' => 0]
    ];
      foreach($details[$type] as $key => $value){
        $_POST[$key] = $value ;
      }
      #method to assign the BusMainTanance Distance
    }
  }
}
