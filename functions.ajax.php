<?php
  header('Content-Type: application/json; charset=utf-8');
  // close session for write for a fast response
  session_write_close();
  // load the class
  require_once('./products.class.inc.php');
  require_once('./currencies.class.inc.php');
  require_once('./weather.class.inc.php');

  $result['REQUEST_METHOD']=$_SERVER['REQUEST_METHOD'];
  $result['REQUEST'] = $_REQUEST;
  $result['result']=false;

  require_once('./pdo.php');

  function getProdList( $listType ){
    global $pdo;
    $products = new product( $pdo );
    if( $prodList = $products->getProdList() ){
      echo json_encode( $prodList );
    }
    return false;
  }

  if( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']==='GET' ){
    switch($_GET['action']){
      case 'getProdList':
        $products = new product( $pdo );
        if( $prodList = $products->getProdList() ){
          $result['prodList'] = $prodList;
          $result['result']=true;
        }
        break;

      case 'checkProdPrice':
        if( $cProd = new product( $pdo, str_replace('row_', '', $_GET['prodCode'] ) ) ){
          $result['product']=$cProd;
          if( ($cProd->price !== $_GET['price'] || $cProd->specialPrice !== $_GET['price']) && $cProd->specialStatus==1 ){
            $result['result']=true;
          }
        }
        break;

      case 'getCurrency':
        $currencyObj = new currencies( $pdo );
        if( $result['data']=$currencyObj->getCurrency( $_GET['date'] ) ){
          $result['result']=true;
        }
        break;

      case 'getWeather':
        $weatherObj = new weather( $pdo );
        if( $result['data']=$weatherObj->getWeather( urlencode($_GET['location']), $_GET['date'] ) ){
          $result['result']=true;
        }
        break;

      default:
        #code ...
        break;
    }
  } else if( $_SERVER['REQUEST_METHOD']==='POST' ){
    switch($_POST['action']){
      case 'populateProductsTables':
        require_once('./pdoRemote.php');
        $sql = "SELECT * FROM `PRODUCTS` WHERE `status`='1' ORDER BY `prodNamePTBR`";
        $result['sql'] = $sql;
        $stmt = $pdoRemote->prepare( $sql );
        $stmt->execute();
        if( $stmt->rowCount() ){
          while( $row = $stmt->fetchObject() ){
            $result['prodList'][] = $row;
          }
          $result['result']=true;
        }
        break;

      case 'reload-browser':
        $result['output']=shell_exec('xdotool search --onlyvisible --class chromium|head -1');
        $result['result']=true;
        break;

      case 'saveWeather':
        $weatherObj = new weather( $pdo );
        $result['result'] = $weatherObj->setWeather( $_POST['date'], $_POST['time'], $_POST['location'], $_POST['weather'], $_POST['description'], $_POST['temp'], $_POST['temp_min'], $_POST['temp_max'] );
        break;

      case 'saveCurrency':
        $currencyObj = new currencies( $pdo );
        $result['result'] = $currencyObj->setCurrency( $_POST['date'], $_POST['time'], $_POST['currency'], $_POST['value']);
        break;

      default:
        #code ...
        break;
    }
  }
  echo json_encode( $result );
  return false;
?>