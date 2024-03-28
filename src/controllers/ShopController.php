<?php
namespace Boutique\Controllers;
use Boutique\Models\ShopModel;

class ShopController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new ShopModel();
    }

    public function getCategories()
    {
        $categories = $this->model->getCategories();
        return $categories;
    }

    public function getSousCategories($id)
    {
        return $this->model->getSousCategories($id);
    }

    public function getProduitsBySousCat($id, $premier, $parPage, $order)
    {
        return $this->model->getProduitsBySousCat($id, $premier, $parPage, $order);
    }

    public function list($params)
    {
        if(!isset($_SESSION['order'])){
            $_SESSION['order'] = 1;
        }
        $order = $_GET['order'] ?? $_SESSION['order'];
        $_SESSION['order'] = $order;

        $id = $params['id'];
        $categories = $this->getCategories();
        
        $nbProduits = $this->model->getNbProduitsBySousCat($id)->nb;
        $currentPage = $params['page'] ?? 1;

        if(!isset($_SESSION['show'])){
            $_SESSION['show'] = 1;
        }
        $show = $_GET['show'] ?? $_SESSION['show'];
        $_SESSION['show'] = $show;

        $nbProduitsParPage = $_SESSION['show'];
        $nbPages = ceil($nbProduits / $nbProduitsParPage);
        $premier = ($currentPage * $nbProduitsParPage) - $nbProduitsParPage;
        
        $produits = $this->getProduitsBySousCat($id, $premier, $nbProduitsParPage, $_SESSION['order']);
        $this->render('shop', compact('categories', 'produits', 'nbPages', 'currentPage', 'id'));
    }

    public function index($params = [])
    {
        if(!isset($_SESSION['order'])){
            $_SESSION['order'] = 1;
        }
        $order = $_GET['order'] ?? $_SESSION['order'];
        $_SESSION['order'] = $order;
        
        $categories = $this->getCategories();

        $nbProduits = $this->model->getNbProduits();
        $currentPage = $params['page'] ?? 1;

        if(!isset($_SESSION['show'])){
            $_SESSION['show'] = 3;
        }
        $show = $_GET['show'] ?? $_SESSION['show'];
        $_SESSION['show'] = $show;

        $nbProduitsParPage = $_SESSION['show'];
        $nbPages = ceil($nbProduits/ $nbProduitsParPage);
        $premier = ($currentPage * $nbProduitsParPage) - $nbProduitsParPage;
        
        $produits = $this->model->getProduits($premier, $nbProduitsParPage, $_SESSION['order']);
        $this->render('shop', compact('categories', 'produits', 'nbPages', 'currentPage'));
    }

    public function show($params)
    {
        $produit= $this->model->getProduitById($params['id']);
        $this->render('product', compact('produit'));
    }
}