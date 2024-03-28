<?php
namespace Boutique\Models;
use Boutique\App\Database;

class ShopModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProduits($premier, $parPage, $order)
    {
        $orderSql;
        $orderCol;
        switch ($order) {
            case '2':
                $orderSql = 'ASC';
                $orderCol = 'prix';
                break;
            case '3':
                $orderSql = 'DESC';
                $orderCol = 'prix';
                break;
            
            default:
                $orderSql = 'DESC';
                $orderCol = 'id';
                break;
        }
        return $this->db->query('SELECT * FROM produit ORDER BY '. $orderCol . ' ' . $orderSql .' LIMIT :premier, :parpage', ['premier'=> $premier, 'parpage' =>$parPage])->fetchAll();
    }

    public function getNbProduits()
    {
        return $this->db->query('SELECT COUNT(*) AS nb FROM produit')->fetch()->nb;
    }

    public function getDerniersProduits()
    {
        return $this->db->query('SELECT * FROM produit ORDER BY id DESC LIMIT 8')->fetchAll();
    }

    public function getCategories()
    {
       $categories =  $this->db->query('SELECT * FROM categorie')->fetchAll();
        foreach($categories as $i => $categorie) {
            $categories[$i]->sous_categories = $this->getSousCategories($categorie->id);
            $categories[$i]->nbProduits = $this->getNbProduitsByCat($categorie->id)->nb;
        }
        return $categories;
    }

    public function getNbProduitsByCat($id)
    {
        return $this->db->query('SELECT COUNT(*) AS nb FROM produit 
        JOIN sous_categorie ON produit.id_sous_categorie = sous_categorie.id 
        WHERE sous_categorie.id_categorie = :id', ['id'=>$id])->fetch();
    }

    public function getNbProduitsBySousCat($id)
    {
        return $this->db->query('SELECT COUNT(*) AS nb FROM produit 
        JOIN sous_categorie ON produit.id_sous_categorie = sous_categorie.id 
        WHERE sous_categorie.id = :id', ['id'=>$id])->fetch();
    }

    public function getSousCategories($id)
    {
        $categories = $this->db->query('SELECT * FROM sous_categorie WHERE id_categorie = :id', ['id' => $id])->fetchAll();
        foreach($categories as $i => $categorie) {
            $categories[$i]->nbProduits = $this->getNbProduitsBySousCat($categorie->id)->nb;
        }
        return $categories;
    }

    public function getProduitsBySousCat($id , $premier, $parPage, $order)
    {
        $orderSql;
        $orderCol;
        switch ($order) {
            case '2':
                $orderSql = 'ASC';
                $orderCol = 'prix';
                break;
            case '3':
                $orderSql = 'DESC';
                $orderCol = 'prix';
                break;
            
            default:
                $orderSql = 'DESC';
                $orderCol = 'id';
                break;
        }
        return $this->db->query('SELECT * FROM produit WHERE id_sous_categorie = :id ORDER BY '. $orderCol . ' ' . $orderSql .' LIMIT :premier, :parpage', ['id' => $id, 'premier'=>$premier, 'parpage'=>$parPage])->fetchAll();
    }

    public function getProduitById($id)
    {
        return $this->db->query('SELECT sous_categorie.nom AS cat, produit.id, produit.nom, sous_categorie.id AS idcat, image, prix FROM produit JOIN sous_categorie ON produit.id_sous_categorie = sous_categorie.id WHERE produit.id=:id', ['id'=>$id])->fetch();
    }

}