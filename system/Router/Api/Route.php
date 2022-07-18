<?php namespace System\Router\Api;

class Route{
    public static function get($url,$ExecuteMethod,$name=null){
        global $routes;
        $ExecuteMethod=explode("@",$ExecuteMethod);
        $class=$ExecuteMethod[0];
        $method=$ExecuteMethod[1];

        array_push($routes['get'],array('url'=>"Api/".trim($url,"/ "),'class'=>$class,'method'=>$method,'name'=>$name));

    }

    public static function post($url,$ExecuteMethod,$name=null){
        global $routes;
        $ExecuteMethod=explode("@",$ExecuteMethod);
        $class=$ExecuteMethod[0];
        $method=$ExecuteMethod[1];

        array_push($routes['post'],array('url'=>"Api/".trim($url,"/ "),'class'=>$class,'method'=>$method,'name'=>$name));

    }

}