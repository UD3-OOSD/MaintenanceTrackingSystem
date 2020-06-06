<?php

interface ServiceState{
    // here we call and link to the busModel. ?if is it possible.
    public function stateChange($service);
    public function edit($service, $data);
    public function fillAction($params);
}