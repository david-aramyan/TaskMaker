<?php

class User
{

    /**
     * Initialize Db Instance.
     */
    private $db;

    /**
     * Constructor.
     *
     * @param  DBConnection  $db
     *
     * @return void
     */
    public function __construct(DBConnection $db)
    {
        $this->db =  $db;
    }

    /**
     * Check user logged In.
     *
     * @param  string  $username
     * @param  string  $password
     *
     * @return void
     */
    public function login($username, $password)
    {
        $password = md5($password);
        $sql = "SELECT id from admin WHERE username='$username' and password='$password'";
        //checking if the username exists
        $sth = $this->db->connection->prepare($sql);
        $sth->execute();
        $count_row = $sth->rowCount();
        if ($count_row == 1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $sth->fetchAll()[0]['id'];
        } else {
            $_SESSION['auth_error'] = 'Неправильные учетные данные';
        }
        header('location: /tasks');
    }

    /**
     * Logout user.
     *
     * @return void
     */
    public function logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
        header('location: /tasks');
    }

}
