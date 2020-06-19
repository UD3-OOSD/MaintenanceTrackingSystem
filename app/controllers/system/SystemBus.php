<?php


class SystemBus implements System
{
    private static $systembus = NULL;
    private static $BusMSModel;
    private static $BusMEModel;

    private function __construct(){
        SystemBus::$BusMSModel = ModelCommon::loading_model('BusMS');
        SystemBus::$BusMEModel = ModelCommon::loading_model('BusME');
    }

    public static function getInstance(){
        if(!isset(SystemBus::$systembus)){
            SystemBus::$systembus = new SystemBus();
        }
        return SystemBus::$systembus;
    }
    public function get($state = 'everything'){
        // return all busses on given  @devin
        #echo($state);
        #echo('<br>');
        #echo('did i break php');
        #dnd($state == '' && $state == 0);
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            #echo('is int');
            return SystemBus::$BusMSModel->selectAll('BusState',$state);
        }
        elseif ($state == 'everything'){
            #echo('is string');
            return SystemBus::$BusMSModel->selectAllWithDelete('deleted',0);
        }
        return false;
    }

    public function updateState($id,$state){
        $unique=['BusNumber'=>$id];
        $params = ['BusState'=>$state];
        return SystemBus::$BusMSModel->UpdateRow($unique,$params);
    }

    public function check($id){
        if(SystemBus::$BusMSModel->isBusNumberValid($id)){
            $ServicesGranted = SystemBus::$BusMEModel->populatechecklist($id);
            $bus = SystemBus::$BusMEModel->findByBusNumber($id);
            $AvailableServices = [];

            foreach ($ServicesGranted as $service=>$value){
                if (isset($bus->{$service}) && $bus->{$service}>=$value){
                    array_push($AvailableServices,$service);
                }
            }

            return $AvailableServices;
        }
        return false;
    }
}