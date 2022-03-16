<?php
class Regex{
    // VALIDACIÓN FORMLARIO LADO DEL SERVIDOR
    private function regex(){
        $arrRegex = [
            'nombre' => '/^[a-zA-ZÀ-ÿ\s]{3,60}$/',
            'descripcion' => '/^[\wÀ-ÿ\s(\#\@\$\%\&\(\)\.\,\¿\?\¡\!]{5,255}$/',
            'nombre100' => '/^[\wÀ-ÿ\s(\#\@\$\%\&\"\'\(\))\.\,\¿\?\¡\!]{5,100}$/',
            'email' => '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'telefono' => '/^\d{7,14}$/',
            'url' => '/^https?:\/\/[\w\-]+(\.[\w\-]+)+[\#?]?.*$/',
            'password' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/' 
        ];
        return $arrRegex;
    }


    public function validateField($field,$value){
        if(preg_match($this->regex()[$field],$value)){
            return true;
        }else{
            return false;
        }
    }
}