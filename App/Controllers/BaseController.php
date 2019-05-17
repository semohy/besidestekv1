<?php 

class BaseController{

	 public function view($name, $data = [])

    {

        extract($data);

        require __DIR__ . '/../../Resources/Views/' . strtolower($name) . '.php';

    }



    public function model($name)

    {

        require __DIR__ . '/../Models/' . strtolower($name) . '.php';

        return new $name();

    }

}