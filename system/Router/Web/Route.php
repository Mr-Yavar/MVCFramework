<?php namespace System\Router\Web;

class Route{
    public static function get($url,$ExecuteMethod,$name=null){
        //Get means Read Data
        global $routes;
        $ExecuteMethod=explode("@",$ExecuteMethod);
        $class=$ExecuteMethod[0];
        $method=$ExecuteMethod[1];

        array_push($routes['get'],array('url'=>trim($url,"/ "),'class'=>$class,'method'=>$method,'name'=>$name));

    }

    public static function post($url,$ExecuteMethod,$name=null){
        //Post means insert Data
        global $routes;
        $ExecuteMethod=explode("@",$ExecuteMethod);
        $class=$ExecuteMethod[0];
        $method=$ExecuteMethod[1];

        array_push($routes['post'],array('url'=>trim($url,"/ "),'class'=>$class,'method'=>$method,'name'=>$name));

    }
    public static function put($url,$ExecuteMethod,$name=null){
        //Put or Patch means Update Data, or Insert if a new Id
        global $routes;
        $ExecuteMethod=explode("@",$ExecuteMethod);
        $class=$ExecuteMethod[0];
        $method=$ExecuteMethod[1];

        array_push($routes['put'],array('url'=>trim($url,"/ "),'class'=>$class,'method'=>$method,'name'=>$name));

    }
    public static function delete($url,$ExecuteMethod,$name=null){
        //Delete means Delete Data
        global $routes;
        $ExecuteMethod=explode("@",$ExecuteMethod);
        $class=$ExecuteMethod[0];
        $method=$ExecuteMethod[1];

        array_push($routes['delete'],array('url'=>trim($url,"/ "),'class'=>$class,'method'=>$method,'name'=>$name));

    }
}