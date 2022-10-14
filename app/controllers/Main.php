<?php

class Main extends Controller
{ 
    public function __construct()
    {
        $this->mainModel = $this->model('mainModel');
    }
    public function index()
    {
        printf("d");
    }
}