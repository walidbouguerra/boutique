<?php
session_start();
use Boutique\App\Router;

require_once '../vendor/autoload.php';

$router = (new Router())->get('/', 'accueil#index')
->get('/contact', 'contact#index')
->get('/panier', 'panier#index')
->get('/shop', 'shop#index')
->get('/shop/[i:id]', 'shop#show')
->get('/shop/page[i:page]', 'shop#index')
->get('/shop/cat[i:id]', 'shop#list')
->get('/panier/add/[i:id]', 'panier#add')
->get('/shop/cat[i:id]/page[i:page]', 'shop#list')
->get('/panier/[i:option]/[i:id]', 'panier#updateqte')
->get('/login', 'login#index')
->get('/login/logout', 'login#logout')
->post('/login/verif', 'login#veriflogin');
$router->run();
