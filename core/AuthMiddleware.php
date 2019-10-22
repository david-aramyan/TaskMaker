<?php


class AuthMiddleware
{
    /**
     * Check if user authorized to make current request
     *
     * @return void
     */
    public static function checkAuth()
    {
        if (!isset($_SESSION['login'])) {
            $_SESSION['auth_error'] = "Пожалуйста авторизуйтесь и повторите попытку с нуля.";
            return false;
        }
        return true;
    }
}
