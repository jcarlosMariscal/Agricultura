<?php
class Regex{
    private function regex(){
        $arrRegex = [
            'nombre' => '/^[a-zA-ZÀ-ÿ\s]{3,60}$/',
            'descripcion' => '/^[\wÀ-ÿ\s(\#\@\$\%\&\(\)\.\,\¿\?\¡\!]{5,255}$/',
            'nombre100' => '/^[\wÀ-ÿ\s(\#\@\$\%\&\(\))\.\,\¿\?\¡\!]{5,100}$/',
            'email' => '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'telefono' => '/^\d{7,14}$/',
            'url' => '/^https?:\/\/[\w\-]+(\.[\w\-]+)+[\#?]?.*$/'  
        ];
        return $arrRegex;
    }


    public function validateField($field,$value){
        // echo $value;
        if(preg_match($this->regex()[$field],$value)){
            return true;
        }else{
            return false;
        }
    }
}