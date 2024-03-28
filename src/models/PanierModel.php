<?php
namespace Boutique\Models;
use Boutique\App\Database;

class PanierModel
{
    private $db;
    private $shopModel;

    public function __construct()
    {
        $this->db = new Database();
        $this->shopModel = new ShopModel();
    }

    public function getPanier()
    {
        return $this->db->query('SELECT panier.id, panier.prix, quantite, nom, image FROM panier JOIN produit ON panier.id_produit = produit.id WHERE sessid = :id OR id_user = :id_user', ['id'=>session_id(), 'id_user'=>$_SESSION['login']??null])->fetchAll();
    }

    public function updateQte($id, $qte)
    {
        $this->db->query('UPDATE panier SET quantite = :qte WHERE id = :id', ['qte'=>$qte, 'id'=>$id]);
    }

    public function getQte($id)
    {
        return $this->db->query('SELECT quantite FROM panier WHERE id = :id', ['id'=>$id]);
    }

    public function deleteProduitPanier($id)
    {
        $this->db->query('DELETE FROM panier WHERE id = :id', ['id'=>$id]);
    }

    public function getProduitPanierByIdProduit($idProduit)
    {
        return $this->db->query('SELECT * FROM panier WHERE id_produit = :id', ['id'=>$idProduit])->fetch();
    }

    public function add($idProduit)
    {
        $produit = $this->shopModel->getProduitById($idProduit);
        if(isset($_SESSION['login'])){
            $this->db->query('INSERT INTO panier (prix, quantite, id_produit, sessid, id_user) VALUES (:prix, 1, :id_produit, :sessid, :id_user)', ['prix'=>$produit->prix, 'id_produit'=>$idProduit, 'sessid'=>session_id(), 'id_user'=>$_SESSION['login']]);
        } else {
            $this->db->query('INSERT INTO panier (prix, quantite, id_produit, sessid) VALUES (:prix, 1, :id_produit, :sessid)', ['prix'=>$produit->prix, 'id_produit'=>$idProduit, 'sessid'=>session_id()]);
        }
    }

}