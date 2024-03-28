<?php
namespace Boutique\Controllers;
use Boutique\Models\LoginModel;

class LoginController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new LoginModel();
    }

    public function index()
    {
        $this->render('login');
    }

    public function verifLogin()
    {   
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $user = $this->model->verifLogin($username, $password);
        if($user && password_verify($password, $user->password)){
            $_SESSION['login'] = $user->id;
        } 
        header('Location: /');
    }

    public function logout()
    {
        unset($_SESSION['login']);
        $this->index();
    }
}