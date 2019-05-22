<?php

/**
*  Router main class
*/
class Route 
{	

	public static function parse_url()

    {

    	$dirname = dirname($_SERVER['SCRIPT_NAME']);

		if( $dirname != '/'){ $dirname = null; }
		
		$basename = basename($_SERVER['SCRIPT_NAME']);

		$request_url  = str_replace([$dirname,$basename], null, $_SERVER['REQUEST_URI']);
		
		return $request_url;

    }



    public static function get($url, $callback)
    {
    	
        if ($_SERVER['REQUEST_METHOD'] ==  'GET'  )
        {	

        	$patterns = [

                '{url}' => '([0-9a-zA-Z]+)',

                '{id}' => '([0-9]+)'

            ];

	        $url = str_replace(array_keys($patterns), array_values($patterns), $url);

	        $request_url = self::parse_url();

	        if (preg_match('#' . $url . '$#', $request_url, $parameters)) {

	        	unset($parameters[0]);

	        	if (is_callable($callback)) { //fonksiyonsa

	        		call_user_func_array($callback, $parameters);

	        	} else {

	        		$controller = explode('@', $callback);

	        		$className = explode('/', $controller[0]);

	        		$className = end($className);

	        		$controllerFile = __DIR__ . '/../Controllers/' .$controller[0] . '.php';

	        		if (file_exists($controllerFile)) {

	        			require $controllerFile;


	        			call_user_func_array([new $className, $controller[1]], $parameters);

	                 }else{}

	                }

	            }
	    } 
	   
    }

    
    public static function post($url,$callback)
    {

        if ($_SERVER['REQUEST_METHOD'] ==  'POST' )
        {	

	        $request_url = self::parse_url();

	        if (preg_match('@' . $url . '@', $request_url)) {

	        	if (is_callable($callback)) { //fonksiyonsa

	        		call_user_func_array($callback);

	        	} else {

	        		$controller = explode('@', $callback);

	        		$className = explode('/', $controller[0]);

	        		$className = end($className);

	        		$controllerFile = __DIR__ . '/../Controllers/' .$controller[0] . '.php';

	        		
	        		if (file_exists($controllerFile)) {

	        			require_once $controllerFile;

	        			$parameters = $_POST;
	        			call_user_func_array([new $className, $controller[1]], $parameters);

	                 }

	                }

	            }
	    }

    }


	
} 