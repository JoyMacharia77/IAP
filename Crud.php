<?php

interface CRUD{
//LAB 1
    public function save();
    public function readAll();
    public function readUnique();
    public function search();
    public function update();
    public function removeOne();
    public function removeAll();

//LAB2
    public function validateForm();
    public function createFormErrorSessions();

}

?>