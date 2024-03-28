<?php
namespace Boutique\Models;
use Boutique\App\Database;

class LoginModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function verifLogin($username, $password)
    {
       return $this->db->query('SELECT * FROM user WHERE username = :username', ['username' => $username])->fetch();
    }
}