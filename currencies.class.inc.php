<?php
  class currencies{
    private $pdo;
    private $id;
    public $date;
    public $time;
    public $currency;
    public $value;

    public function __construct( $pdo ){
      $this->pdo = $pdo;
    }

    public function getCurrencyExists( $currency, $date){
      $sql = "SELECT `value` FROM `currencies` WHERE `currency`=:currencyX AND `date`=:dateX LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':currencyX', $currency, PDO::PARAM_STR);
      $stmt->bindParam(':dateX', $date, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        return $row->value;
      }
      return false;
    }
    
    public function getCurrency( $date, $currency=false ){
      $sql = "SELECT * FROM `currencies` WHERE `date`=:dateX";
      if( $currency ){
        $sql.=" AND `currency`=:currencyX LIMIT 1";
      }
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':dateX', $date, PDO::PARAM_STR);
      if( $currency ){
        $stmt->bindParam(':currencyX', $currency, PDO::PARAM_STR);
      }
      $stmt->execute();
      if( $stmt->rowCount() ){
        if( $stmt->rowCount() > 1 ){
          while( $row = $stmt->fetchObject() ){
            $currencies[ $row->currency ]=$row->value;
          }
        } else {
          $row = $stmt->fetchObject();
          $currencies = $row->value;
        }
        return $currencies;
      }
      return false;
    }

    public function setCurrency( $date, $time, $currency, $value ){
      if( !$this->getCurrencyExists( $currency, $date ) ){
        $sql = "INSERT INTO `currencies` (`date`, `time`, `currency`, `value`) VALUES (:dateX, :timeX, :currencyX, :valueX)";
        $stmt = $this->pdo->prepare( $sql );
        $stmt->bindParam(':dateX', $date, PDO::PARAM_STR);
        $stmt->bindParam(':timeX', $time, PDO::PARAM_STR);
        $stmt->bindParam(':currencyX', $currency, PDO::PARAM_STR);
        $stmt->bindParam(':valueX', $value, PDO::PARAM_STR);
        $stmt->execute();
        if( $stmt->rowCount() ){
          return $this->pdo->lastInsertId();
        }
      }
      return false;
    }
  }
?>