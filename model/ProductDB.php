<?php


namespace Model;

use Model\Product;

class ProductDB
{
    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function getAllProduct()
    {
        $sql = "SELECT productCode as ID,productName as Name,productLine as Type, buyPrice as Price FROM myProducts";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function getProduct1($id)
    {
        $sql = "SELECT productName as Name,productLine as Type,buyPrice as Price FROM myProducts where productCode = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch();

    }

    public function updateProduct($id,$name,$type,$price)
    {
        $sql = "update myProducts set productName = ?,productLine= ?,buyPrice = ? where productCode = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $id);
        $stmt->execute();
    }
    public function search($searchkey)
    {
        $sql = "SELECT productCode as ID,productName as Name,productLine as Type,buyPrice as Price FROM myProducts where productName like '%$searchkey%'";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $search = $stmt->fetchAll();
        return $search;
    }

    public function deleteDB($code)
    {
        $sql = "DELETE FROM myProducts where productCode = ?";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(1, $code);
        $stmt->execute();
    }

    public function addProduct($id,$name,$type,$price)
    {
        $sql = "INSERT INTO myProducts(productCode, productName, productLine, buyPrice) VALUES ('$id','$name','$type','$price')";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    }
    public function addReview($id,$name,$type,$review)
    {
        $sql = "INSERT INTO usersReviews(Code, Name, Type, Reviews) VALUES ('$id','$name','$type','$review')";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
    }

}