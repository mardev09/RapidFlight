<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);
        
        require_once("src/Views/$view.php");
    }

    public function model($model)
    {
        require_once("src/Models/$model.class.php");
        return new $model();
    }
}