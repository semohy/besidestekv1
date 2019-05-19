<?php 

class BaseController{

	 public function view($name, $data = [])

    {   
        $ds = explode('/', $name);
        $new_ds = '';
        if( count($ds) > 1 ){
            foreach ($ds as $v) {
                $new_ds .= $v.'/';
            }
         $new_ds = substr($new_ds, 0, -1);
        }
        
        extract($data);

        require __DIR__ . '/../../Resources/Views/' . $new_ds . '.php';

    }



    public function model($name)

    {

        require __DIR__ . '/../Models/' . $name . '.php';
        $name = explode('/',$name);
        $name = end($name);
        return new $name();

    }

}