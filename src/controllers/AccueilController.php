<?php
namespace Boutique\Controllers;
use Boutique\Models\ShopModel;

class AccueilController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new ShopModel();
    }

    public function getDerniersProduits()
    {
        return $this->model->getDerniersProduits();
    }

    public function index()
    {
        $produits = $this->getDerniersProduits();
        $this->render('home', compact('produits'));
    }
}