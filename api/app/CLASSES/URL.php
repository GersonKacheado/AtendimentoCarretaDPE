<?php
namespace App\CLASSES;
class URL
{
    private $url;
    
     function setValidarPagina($url){
        if ($url) {
            $this->$url=$url;
        }else{
            $this->$url="api";
        }
        
    }

	public function getLink($url)
	{
        self::setValidarPagina($url);   
        include_once "includes/paginas/".$this->$url.".php";       
    }
}
 ?>