<?php

class Validator
{

    public static function validateText($string){
        return strlen(trim($string)) > 0;
    }

    public static function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
