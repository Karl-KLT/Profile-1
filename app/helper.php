<?php


function ActiveRoutes($url)
{
    try{
        if(is_array($url)){
            for($i = 0 ; $i <= count($url) ; $i++){
                if(in_array($url[$i],$url) && $url[$i] == request()->path()){
                    return "active";
                };
            }
        }
    }catch(Throwable $e){return '';};

    if($url == request()->path()){
        return "active";
    }
}
