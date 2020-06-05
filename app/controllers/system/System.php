<?php

interface System{
    public function get($state='');
    public function updateState($id,$state);
    public function check($id);
}
