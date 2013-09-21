<?php

class Welcome {

    public function index () {
        View::display('welcome');
    }

    public function test ($any) {
        echo 'test '.$any;
    }

}

?>