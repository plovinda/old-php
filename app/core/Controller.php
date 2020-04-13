<?php

class Controller
{
    /*
     * This controller creates two functions to instantiate the model and view class. The app class sends the name of the
     * controller and model class and this controller takes those values and creates objects of the same.
     * */
    public function model ($model)
    {
        require_once '../app/models/'.$model.'.php';
        return new $model;
    }

    public function view ($view,$data = [])
    {
        require_once '../app/views/'.$view.'.php';
    }
}