<?php
  class weather{
    private $pdo;
    public $id;
    public $date;
    public $time;
    public $location;
    public $weather;
    public $description;
    public $temp;
    public $temp_min;
    public $temp_max;

    public function __construct( $pdo ){
      $this->pdo = $pdo;
    }

    public function getWeather( $location, $date ){
      $sql = "SELECT * FROM `weather` WHERE `location`=:locationX AND `date`=:dateX LIMIT 1";
      $stmt = $this->pdo->prepare( $sql );
      $stmt->bindParam(':locationX', $location, PDO::PARAM_STR);
      $stmt->bindParam(':dateX', $date, PDO::PARAM_STR);
      $stmt->execute();
      if( $stmt->rowCount() ){
        $row = $stmt->fetchObject();
        return $row;
      }
      return false;
    }

    public function setWeather( $date, $time, $location, $weather, $description, $temp, $temp_min, $temp_max ){
      // check if data already exists
      if( !$this->getWeather($location, $date) ){
        $sql = "INSERT INTO `weather` (`date`, `time`, `location`, `weather`, `description`, temp, `temp_min`, `temp_max`) VALUES (:dateX, :timeX, :locationX, :weatherX, :descriptionX, :tempX, :temp_minX, :temp_maxX)";
        $stmt = $this->pdo->prepare( $sql );
        $stmt->bindParam(':dateX', $date, PDO::PARAM_STR);
        $stmt->bindParam(':timeX', $time, PDO::PARAM_STR);
        $stmt->bindParam(':locationX', $location, PDO::PARAM_STR);
        $stmt->bindParam(':weatherX', $weather, PDO::PARAM_STR);
        $stmt->bindParam(':descriptionX', $description, PDO::PARAM_STR);
        $stmt->bindParam(':tempX', $temp, PDO::PARAM_STR);
        $stmt->bindParam(':temp_minX', $temp_min, PDO::PARAM_STR);
        $stmt->bindParam(':temp_maxX', $temp_max, PDO::PARAM_STR);
        $stmt->execute();
        if( $stmt->rowCount() ){
          return $this->pdo->lastInsertId();
        }
        return false;
      }
    }
  }
?>