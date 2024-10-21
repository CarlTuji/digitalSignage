<?php
  class product{
    private $pdo;
    public $id;
    public $prodCode;
    public $namePTBR;
    public $nameJP;
    public $size;
    public $image;
    public $makerID;
    public $makerPTBR;
    public $makerJP;
    public $unitID;
    public $unit;
    public $price;
    public $specialPrice;
    public $specialStatus;
    public $active;

    public function __construct( $pdo, $prodCode=false ){
      $this->pdo = $pdo;
      if( $prodCode ){
        $this->prodCode = $prodCode;
        $this->getProdDetails();
      }
    }

    public function setProCode( $prodCode ){
      $this->prodCode = $prodCode;

      if( $this->prodCode ){
        $this->getProdDetails();
      }
    }

    public function getProdDetails(){
      $sql = "SELECT * FROM `viewProducts` WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        // set the variables values
        $this->id = $row->id;
        $this->namePTBR = $row->prodNamePTBR;
        $this->nameJP = $row->prodNameJP;
        $this->size = $row->prodSize;
        $this->image = $row->prod_image;
        $this->makerPTBR = $row->maker_name_ptbr;
        $this->makerJP = $row->maker_name_jp;
        $this->makerID = $this->getMakerID();
        $this->unit = $row->unit_text;
        $this->unitID = $this->getUnitID();
        $this->price = $row->normal_price;
        $this->specialPrice = $row->price_special;
        $this->specialStatus = $row->status;
        $this->active = $row->active;

        return $row;
      } else {
        // set the variables values
        $this->id = "";
        $this->namePTBR = "";
        $this->nameJP = "";
        $this->size = "";
        $this->image = "";
        $this->makerID = "";
        $this->makerPTBR = "";
        $this->makerJP = "";
        $this->unit = "";
        $this->price = "";
        $this->specialPrice = "";
        $this->specialStatus = "";
        $this->active = "";
      }
      return false;
    }

    public function getProdSize(){
      return $this->size;
    }

    public function setProdSize( $prodSize ){
      $sql = "UPDATE `products` SET `prodSize`=:prodSize WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodSize', $prodSize, PDO::PARAM_STR);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->size = $prodSize;
        return true;
      }
      return false;
    }

    public function getProdImage(){
      return $this->image;
    }

    public function setProdImage( $prodImageFileName ){
      $sql = "UPDATE `products` SET `prod_image`=:prodImageFileName WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodImageFileName', $prodImageFileName, PDO::PARAM_STR);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->image = $prodImageFileName;
        return true;
      }
      return false;
    }

    public function getMaker( $lang="ptbr" ){
      $makerLang = "maker" . strtoupper( $lang );
      return $this->$makerLang;
    }

    public function getMakerID(){
      $sql = "SELECT `maker_id` FROM `makers` WHERE `maker_name_ptbr`=:makerName OR `maker_name_jp`=:makerName LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':makerName', $this->makerPTBR, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        //$this->makerID = $row->maker_id;
        return $row->maker_id;
      }
      return false;
    }

    public function setMaker( $makerID ){
      $sql = "UPDATE `products` SET `makerID`=:makerID WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':makerID', $makerID, PDO::PARAM_STR);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        if( $makerDetails = $this->getMakerDetails( $makerID ) ){
          $this->makerPTBR = $makerDetails->maker_name_ptbr;
          $this->makerJP   = $makerDetails->maker_name_jp;
          return true;
        }
      }
      return false;
    }

    public function getMakerDetails( $makerID ){
      $sql = "SELECT * FROM `makers` WHERE `maker_id`=:makerID LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':makerID', $makerID, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        return $row;
      }
      return false;
    }

    public function getUnitID(){
      $sql = "SELECT `unit_id` FROM `units` WHERE `unit_text`=:unitText LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':unitText', $this->unit, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        return $row->unit_id;
      }
      return false;
    }

    public function getProdUnit(){
      return $this->unit;
    }

    public function setProdUnit( $unitID ){
      $sql = "UPDATE `products` SET `saleUnitID`=:unitID WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':unitID', $unitID, PDO::PARAM_INT);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->unit = $unitID;
        return true;
      }
      return false;
    }

    public function getProdPrice(){
      return $this->price;
    }

    public function setProdPrice( $price ){
      $sql = "UPDATE `price` SET `normal_price`=:price WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->price = $price;
        return true;
      }
      return false;
    }

    public function getProdSpecialPrice(){
      return $this->specialPrice;
    }

    public function setProdSpecialPrice( $specialPrice ){
      $sql = "UPDATE `price_special` SET `price_special`=:specialPrice WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt=$this->pdo->prepare( $sql );
      $stmt->bindParam(':specialPrice', $specialPrice, PDO::PARAM_STR);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->specialPrice = $specialPrice;
        return true;
      }
      return false;
    }

    public function getProdSpecialStatus(){
      return $this->specialStatus;
    }

    public function setProdSpecialStatus( $prodSpecialStatus ){
      $sql = "UPDATE `price_special` SET `status`=:prodSpecialStatus WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodSpecialStatus', $prodSpecialStatus, PDO::PARAM_INT);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->specialStatus = $prodSpecialStatus;
        return true;
      }
      return false;
    }

    public function removeProductSpecial(){
      // remove product special price entry
      $sql = "DELETE FROM `price_special` WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->specialStatus = "";
        return true;
      }
      return false;
    }

    public function productSpecialStatusToggle(){
      $newStatus = ( $this->getProdSpecialStatus() == 1 ) ? 0 : 1;
      $sql = "UPDATE `price_special` SET `status`=:newStatus WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->specialStatus = $newStatus;
        return true;
      }
      return false;
    }

    public function getProdList(){
      if( $this->pdo ){
        $sql = "SELECT * FROM `viewProducts` WHERE `active`=1";
        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        if( $stmt->rowCount() ){
          $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $products;
        }
      }
      return false;
    }

    public function getProductActive(){
      return $this->active;
    }

    public function setProductOn(){
      $sql = "UPDATE `products` set `active`=1 WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->active = 1;
        return true;
      }
      return false;
    }

    public function setProductOff(){
      $sql = "UPDATE `products` set `active`=0 WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->active = 0;
        return true;
      }
      return false;
    }

    public function productToggle(){
      if( $this->getProductActive() ){
        // turn product off
        $this->setProductOff();
      } else {
        // turn product on
        $this->setProductOn();
      }
    }

    public function deleteProduct(){
      $sql = "DELETE FROM `products` WHERE `prodCode`=:prodCode LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':prodCode', $this->prodCode, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $this->getProdDetails();
        return true;
      }
      return false;
    }
  }
?>