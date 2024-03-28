<?php
namespace Boutique\Controllers;
use Boutique\Models\PanierModel;

class PanierController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new PanierModel();
    }

    public function index()
    {
        $panier = $this->getPanier();
        $this->render('panier', compact('panier'));
    }

    public function getPanier()
    {
        return $this->model->getPanier();
    }

    public function getQte($id)
    {
        return $this->model->getQte($id)->fetch()->quantite;
    }

    public function deleteProduitPanier($id)
    {
        $this->model->deleteProduitPanier($id);
    }

    public function updateQte($params)
    {
        $id = $params['id'];
        $updateOption = $params['option'];
        $qte = $this->getQte($id);

        if($updateOption == 1){
            $this->model->updateQte($id, $qte+1);
        } elseif ($updateOption == 2){
            if($qte - 1 == 0) {
                $this->deleteProduitPanier($id);
            } else {
                $this->model->updateQte($id, $qte-1);
            }
        }
        header('Location: /panier#table');
    }

    public function add($params)
    {
        $idProduit = $params['id'];
        $produit = $this->model->getProduitPanierByIdProduit($idProduit);
        if(isset($produit->id)){
            if($produit->sessid == session_id()){
                $this->model->updateQte($produit->id, $produit->quantite+1);
            }
        } else {
            $this->model->add($idProduit);
        }
        $this->index();
    }
}