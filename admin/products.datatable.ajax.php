<?php
  // a new content type. make sure apache does not
  // gzip this type, else it would be get buffered
  header('Content-Type: text/event-stream');
  header('Cache-Control: no-cache'); // recommended to prevent caching of event data.
  session_write_close();

  /**
   * Constructs the SSE data format and flushes that data to the client
   */
  function send_message($id, $message, $progress){
    $d = array('message'=>$message, 'progress'=>$progress);

    echo "id:{$id}" . PHP_EOL;
    echo "data:".json_encode($d).PHP_EOL;
    echo PHP_EOL;

    // Push the data out by all FORCE POSSIBLE
    ob_flush();
    flush();
  }

  $result=array('result'=>false);
  $response=$_REQUEST;

  require_once('../pdo.php');
  require_once('./classes/DataTablesAjax.class.php');

  if( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST' ){
    switch ($_POST['action']) {
      case 'newMaker':
        // check if data already exists
        $sql = "SELECT `id` FROM `makers` WHERE `maker_id`=:maker_id LIMIT 1";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':maker_id', $_POST['id'], PDO::PARAM_STR);
        $stmt->execute();
        if( $stmt->rowCount() ){
          // the maker_id is already registered, update then
          $sql = "UPDATE `makers` SET `maker_name_ptbr`=:maker_name_ptbr, `maker_name_jp`=:maker_name_jp WHERE `maker_id`=:maker_id LIMIT 1";
          $stmt = $pdo->prepare( $sql );
          $stmt->bindParam(':maker_name_ptbr', $_POST['namePTBR'], PDO::PARAM_STR);
          $stmt->bindParam(':maker_name_jp', $_POST['nameJP'], PDO::PARAM_STR);
          $stmt->bindParam(':maker_id', $_POST['id']);
          $stmt->execute();
          if( $stmt->rowCount() ){
            $result['result']=true;
            $result['lastInsertId']=$_POST['id'];
          }
        } else {
          // insert the new data
          $sql = "INSERT INTO `makers` (`maker_id`, `maker_name_ptbr`, `maker_name_jp`) VALUES (:maker_id, :maker_name_ptbr, :maker_name_jp)";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':maker_id', $_POST['id'], PDO::PARAM_STR);
          $stmt->bindParam(':maker_name_ptbr', $_POST['namePTBR'], PDO::PARAM_STR);
          $stmt->bindParam(':maker_name_jp', $_POST['nameJP'], PDO::PARAM_STR);
          $stmt->execute();
          if( $stmt->rowCount() ){
            $result['result']=true;
            $result['lastInsertId']=$pdo->lastInsertId();
          }
        }
        echo json_encode( $result );
        break;
      
      case 'newProduct':
        // upload the image if exists
        if( isset($_FILES['pImage']) ){
          // create the file upload handler object
          require_once('./classes/fileUploadHandler.php');
          $imageFileUploadHandler = new fileUploadHandler();
          $result['image'] = $imageFileUploadHandler->uploadFile( $_FILES, $_POST['pCode'] );
          $target_file = $imageFileUploadHandler->getTargetFile();
        }
        // check if code already registered
        $testSQL = "SELECT `id` FROM `products` WHERE `prodCode`=:prodCode LIMIT 1";
        $testSTMT = $pdo->prepare( $testSQL );
        $testSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
        $testSTMT->execute();
        if( $testSTMT->rowCount() ){
          // product already registered
          $pID = $testSTMT->fetchObject();
          //$result['products']['error'][] = "Product Code already registered";

          // update product data
          $prodSQL = "UPDATE `products` SET `prodNamePTBR`=:prodNamePTBR,`prodNameJP`=:prodNameJP,`makerID`=:makerID,`prodSize`=:prodSize,`saleUnitID`=:saleUnitID, `active`=:prodActive";
          if( isset($_FILES['pImage']) ){
            $prodSQL.=",`prod_image`=:prod_image";
          }
          $prodSQL .=" WHERE `prodCode`=:prodCode LIMIT 1";
          $result['products']['sql']=$prodSQL;
          $prodSTMT = $pdo->prepare( $prodSQL );
          $prodSTMT->bindParam(':prodNamePTBR', $_POST['pNamePTBR'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodNameJP', $_POST['pNameJP'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':makerID', $_POST['pMakerID'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodSize', $_POST['pSize'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':saleUnitID', $_POST['pUnit'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodActive', $_POST['pActive'], PDO::PARAM_INT);
          if( isset($_FILES['pImage']) ){
            $prodSTMT->bindParam(':prod_image', $target_file, PDO::PARAM_STR);
          }
          $prodSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
          try{
            $prodSTMT->execute();
          }catch(PDOException $e){
            $result['errors'][] = $e->getMessage();
            //echo json_encode( $result );
            //return false;
          }
          
          // update data into price table
          $pattern = '/[^0-9.-]/';
          $_POST['pPriceNormal'] = (float)preg_replace($pattern,'',$_POST['pPriceNormal']);
          $_POST['pPriceSpecial'] = (float)preg_replace($pattern, '', $_POST['pPriceSpecial']);
          $_POST['pPriceSpecial'] ? $pPriceSpecialStatus = 1 : $pPriceSpecialStatus = 0; // if pPriceSpecialStatus, then status = true else false
          $result['price']['value'] = $_POST['pPriceNormal'];
          $result['priceSpecial']['value'] = $_POST['pPriceSpecial'];

          // update products price
          try{
            $priceSQL = "UPDATE `price` SET `normal_price`=:normalPrice WHERE `prodCode`=:prodCode LIMIT 1";
            $priceSTMT = $pdo->prepare( $priceSQL );
            $priceSTMT->bindParam(':normalPrice', $_POST['pPriceNormal'], PDO::PARAM_STR);
            $priceSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
            $priceSTMT->execute();
          }catch(PDOException $e){
            $result['errors'][] = $e->getMessage();
            //echo json_encode( $result );
            //return false;
          }

          // update products special price
          try{
            if($result['priceSpecial']['value'] > 0){
              // check if already exists or create new
              $specialPriceTestSQL = "SELECT `id` FROM `price_special` WHERE `prodCode`=:prodCode LIMIT 1";
              $specialPriceTestSTMT = $pdo->prepare( $specialPriceTestSQL );
              $specialPriceTestSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
              $specialPriceTestSTMT->execute();
              if( $specialPriceTestSTMT->rowCount() ){
                $specialPriceSQL = "UPDATE `price_special` SET `price_special`=:priceSpecial, `status`=:specialStatus WHERE `prodCode`=:prodCode LIMIT 1";
              }else{
                $specialPriceSQL = "INSERT INTO `price_special`(`prodCode`, `price_special`, `status`) VALUES (:prodCode, :priceSpecial, :specialStatus)";
              }
              $specialPriceSTMT = $pdo->prepare( $specialPriceSQL );
              $specialPriceSTMT->bindParam(':priceSpecial', $_POST['pPriceSpecial'], PDO::PARAM_STR);
              $specialPriceSTMT->bindParam(':specialStatus', $_POST['pSpecialStatus'], PDO::PARAM_INT);
              $specialPriceSTMT->bindParam(':prodCode',$_POST['pCode'],PDO::PARAM_STR);
            } else {
              $specialPriceSQL = "DELETE FROM `price_special` WHERE `prodCode`=:prodCode LIMIT 1";
              $specialPriceSTMT = $pdo->prepare( $specialPriceSQL );
              $specialPriceSTMT->bindParam(':prodCode',$_POST['pCode'],PDO::PARAM_STR);
            }
            $result['priceSpecial']['sql'] = $specialPriceSQL;
            $specialPriceSTMT->execute();
          }catch(PDOException $e){
            $result['errors'][] = $e->getMessage();
            //echo json_encode($result);
            //return false;
          }
        } else {
          /* Save remaining data to database */
          // Insert data into products table
          $prodSQL = "INSERT INTO `products` (`prodCode`,`prodNamePTBR`,`prodNameJP`,`makerID`,`prodSize`,`saleUnitID`,`active`";
          if( isset($_FILES['pImage']) ){
            $prodSQL .= ",`prod_image`";
          }
          $prodSQL.=") VALUES (:prodCode,:prodNamePTBR,:prodNameJP,:makerID,:prodSize,:saleUnitID:prodActive";

          if( isset($_FILES['pImage']) ){
            $prodSQL.=",:prod_image";
          }

          $prodSQL .= ")";
          
          $result['products']['sql'] = $prodSQL;
          $prodSTMT = $pdo->prepare( $prodSQL );
          $prodSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodNamePTBR', $_POST['pNamePTBR'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodNameJP', $_POST['pNameJP'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':makerID', $_POST['pMakerID'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodSize', $_POST['pSize'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':saleUnitID', $_POST['pUnit'], PDO::PARAM_STR);
          $prodSTMT->bindParam(':prodActive', $_POST['pActive'], PDO::PARAM_INT);
          if( isset($_FILES['pImage']) ){
            $prodSTMT->bindParam(':prod_image', $target_file, PDO::PARAM_STR);
          }
          
          try{
            $prodSTMT->execute();
          }catch(PDOException $e){
            $result['products']['errors'][] = $e->getMessage();
            echo json_encode( $result );
            return false;
          }
          if( $prodSTMT->rowCount() ){
            $result['products']['id']=$pdo->lastInsertId();
            $result['products']['errors'] = false;
          } else {
            $result['products']['errors'] = true;
          }
          
          // insert data into price table
          $pattern = '/[^0-9.-]/';
          $_POST['pPriceNormal'] = (float)preg_replace($pattern,'',$_POST['pPriceNormal']);
          $_POST['pPriceSpecial'] = (float)preg_replace($pattern, '', $_POST['pPriceSpecial']);
          $_POST['pPriceSpecial'] ? $pPriceSpecialStatus = 1 : $pPriceSpecialStatus = 0; // if pPriceSpecialStatus, then status = true else false
          $result['price']['value'] = $_POST['pPriceNormal'];
          $result['priceSpecial']['value'] = $_POST['pPriceSpecial'];
          
          $priceSQL = "INSERT INTO `price` (`prodCode`, `normal_price`) VALUES (:prodCode, :normalPrice)";
          $result['price']['sql']=$priceSQL;
          $priceSTMT = $pdo->prepare( $priceSQL );
          $priceSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
          $priceSTMT->bindParam(':normalPrice', $_POST['pPriceNormal'], PDO::PARAM_STR);
          $priceSTMT->execute();
          if( $priceSTMT->rowCount() ){
            $result['price']['id']=$pdo->lastInsertId();
            $result['price']['errors'] = false;
          } else {
            $result['price']['errors'] = false;
          }
          
          // insert data into price_special table
          if( $_POST['pPriceSpecial'] ){
            $priceSpecialSQL = "INSERT INTO `price_special` (`prodCode`, `price_special`, `status`) VALUES (:prodCode, :priceSpecial, :priceSpecialStatus)";
            $result['priceSpecial']['sql']=$priceSpecialSQL;
            $priceSpecialSTMT = $pdo->prepare( $priceSpecialSQL );
            $priceSpecialSTMT->bindParam(':prodCode', $_POST['pCode'], PDO::PARAM_STR);
            $priceSpecialSTMT->bindParam(':priceSpecial', $_POST['pPriceSpecial'], PDO::PARAM_STR);
            $priceSpecialSTMT->bindParam(':priceSpecialStatus', $pPriceSpecialStatus, PDO::PARAM_INT);
            $priceSpecialSTMT->execute();
            if( $priceSpecialSTMT->rowCount() ){
              $result['priceSpecial']['id']=$pdo->lastInsertId();
              $result['priceSpecial']['errors'] = false;
            } else {
              $result['priceSpecial']['errors'] = false;
            }
          }
        }
        // check errors
        if( 
          ( @!isset($result['image']['errors'])        || @!is_array($result['image']['errors'])        ) && 
          ( @!isset($result['products']['errors'])     || @!sizeof($result['products']['errors'])     ) && 
          ( @!isset($result['price']['errors'])        || @!sizeof($result['price']['errors'])        ) && 
          ( @!isset($result['priceSpecial']['errors']) || @!sizeof($result['priceSpecial']['errors']) )
        ){
          $result['result']=true;
        }
        echo json_encode($result);
        break;

      case 'newUnit':
        // check if data already exists
        $sql = "SELECT `id` FROM `units` WHERE `unit_text`=:unitText LIMIT 1";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':unitText', $_POST['unitText'], PDO::PARAM_STR);
        $stmt->execute();
        if( $stmt->rowCount() ){
          $row = $stmt->fetchObject();
          // the maker_id is already registered, update then
          $sql = "UPDATE `units` SET `unit_text`=:unitText WHERE `id`=:id LIMIT 1";
          $stmt = $pdo->prepare( $sql );
          $stmt->bindParam(':unitText', $_POST['unitText'], PDO::PARAM_STR);
          $stmt->bindParam(':id', $row->id, PDO::PARAM_INT);
          $stmt->execute();
          if( $stmt->rowCount() ){
            $result['result']=true;
            $result['lastInsertId']=$row->id;
          }
        } else {
          // prepare the new ID
          $sql = "SELECT COUNT(`id`) as `count` FROM `units` WHERE 1";
          $stmt = $pdo->prepare( $sql );
          $stmt->execute();
          if( $stmt->rowCount() ){
            $row = $stmt->fetchObject();
            $nextID = $row->count;
          } else {
            $nextID = 0;
          }
          $nextID++;
          
          // insert the new data
          $sql = "INSERT INTO `units` (`unit_id`, `unit_text`) VALUES (:unit_id, :unit_text)";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':unit_id', $nextID, PDO::PARAM_STR);
          $stmt->bindParam(':unit_text', $_POST['unitText'], PDO::PARAM_STR);
          $stmt->execute();
          if( $stmt->rowCount() ){
            $result['result']=true;
            $result['lastInsertId']=$pdo->lastInsertId();
          }
        }
        echo json_encode( $result );
        break;

      default:
        # code...
        echo json_encode($response);
        break;
    }
    
  } else if( $_SERVER['REQUEST_METHOD']=='GET' ){
    switch ($_GET['action']) {
      case 'populateDataTable':
        $data = new DataTablesAjax( $pdo, $_GET['table'], $_GET );
        echo json_encode( $data->get_data() );
        break;

      case 'getProdDetails':
        require_once('../products.class.inc.php');
        if( $product = new product( $pdo, $_GET['prodCode'] ) ){
          $result['result']=true;
          $result['prodData']=$product;
          echo json_encode( $result );
        }
        break;

      case 'getMakers':
        $sql = "SELECT * FROM `makers` WHERE 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        if( $stmt->rowCount() ){
          $result['result']=true;
          $result['makers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
          $result['error'] = "No makers";
        }
        echo json_encode( $result );
        break;

      case 'getUnits':
        $sql = "SELECT * FROM `units` WHERE 1";
        $stmt = $pdo->prepare( $sql );
        $stmt->execute();
        if( $stmt->rowCount() ){
          $result['result']=true;
          $result['units']=$stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
          $result['error'] = "No units";
        }
        echo json_encode( $result );
        break;
      
      
      case 'sys_get_temp_dir':
        $result['result']=true;
        $result['sys_get_temp_dir'] = sys_get_temp_dir();
        echo json_encode( $result );
      case 'updateDigitalDisplay':
        $serverTime = time();
        // LONG RUN TASK
        for($i=0; $i < 10; $i++){
          send_message( $serverTime, 'server time: ' . date("h:i:s", time()), ($i+1)*10);
          // Hard work!!
          sleep(1);
        }
        break;

      default:
        # code...
        break;
    }
  }
  return false;
?>
