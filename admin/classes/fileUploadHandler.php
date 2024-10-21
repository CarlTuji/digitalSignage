<?php
  class fileUploadHandler{
    public $prodCode;
    public $targetFile;
    public $defaultImagesFolder = '/var/www/html/6288/assets/';

    public function __construct( $targetFolder=false ){
      if( $targetFolder ){
        $this->defaultImagesFolder = $targetFolder;
      }
    }

    public function uploadFile( $fileUploaded, $pCode ){
      /* UPLOAD FILE HANDLER */
      try{
        // Undefined | Multiple Files | $file Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if(
          !isset($fileUploaded['pImage']['error']) ||
          is_array($fileUploaded['pImage']['error'])
        ){
          throw new RuntimeException('Invalid parameters.');
        }

        // Check $file['pImage']['error'] value.
        switch( $fileUploaded['pImage']['error'] ){
          case UPLOAD_ERR_OK:
            break;
          case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
          case UPLOAD_ERR_INI_SIZE:
          case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
          default:
            throw new RuntimeException('Unknown errors.');
        }

        // You should also check filesize here.
        if( $fileUploaded['pImage']['size'] > 20971520 ){ // 20M
          throw new RuntimeException('Exceeded filesize limit.');
        }

        // DO NOT TRUST $file['pImage']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if( false === $ext = array_search(
          $finfo->file($fileUploaded['pImage']['tmp_name']),
          array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
          ),
          true
        ) ){
          throw new RuntimeException('Invalid file format.');
        }

        // You should name it uniquely.
        // DO NOT USE $file['pImage']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        //$tmp_name = sprintf( "{$defaultImagesFolder}%s.%s", sha1_file($file['pImage']['tmp_name']), $ext ); 
        $tmp_name = sprintf( "{$this->defaultImagesFolder}%s.%s", $pCode, $ext ); 
        if(!move_uploaded_file( $fileUploaded['pImage']['tmp_name'], $tmp_name )){
          throw new RuntimeException('Failed to move uploaded file.');
        }

        $result['result'] = 'File is uploaded successfully.';
        $result['errors'] = false;
        $this->prodCode = $pCode;
        $this->targetFile = "{$pCode}.{$ext}";
      } catch( RuntimeException $e ){
        $result['image']['result'] = false;
        $result['image']['errors'][] = $e->getMessage();
        $result['image']['errors'][] = $fileUploaded['pImage']['error'];
      }
      return $result;
    }

    public function getTargetFile(){
      return $this->targetFile;
    }
  }
?>