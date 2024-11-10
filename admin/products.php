<?php
// Define the locale
setlocale(LC_ALL, 'pt_BR.UTF-8');

// Translations Directory
bindtextdomain( 'digitalSignage', __DIR__ . '/languages' );
bind_textdomain_codeset( 'digitalSignage', 'UTF-8' );

// Define the translation domain
textdomain( 'digitalSignage' );
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=_('PRODUCTS');?></title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">-->
  <link rel="stylesheet" href="../styles/bootstrap_icons/bootstrap-icons.css">
  <link rel="stylesheet" href="./js/datatables/DataTables/datatables.min.css">
  <style>
    main.container{
      margin-top: 60px;
    }
    footer{
      position: fixed;
      background-color: white;
      box-shadow: 0 0px 5px rgba(0, 0, 0, 0.37);
      bottom: 0;
      width: 100%;
      text-align: center;
      padding: 10px;
    }

    .form-floating > .form-control,
    .form-floating > .form-select{
      height : calc( 3.8em + 2px );
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./"><?=_('Digital Display');?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./"><?=_('Home');?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="products.php"><?=_('Products');?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="makers.php"><?=_('Makers');?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="units.php"><?=_('Units');?></a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
          -->
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" id="dataTableSearch" name="dataTableSearch" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit"><?=_('Search');?></button>
        </form>
      </div>
    </div>
  </nav>

  <main class="container-fluid">
    <div class="bg-light p-5 rounded">
      <h1>
        <?=_('Products');?>
        <button type="button" class="btn btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#addProdModal" data-bs-title="<?=_('Add Product');?>"><i class="bi bi-plus"></i></button>
      </h1>
      <table class="table table-bordered table-striped table-hover dataTable" style="width:100%;">
        <thead><tr>
          <th>#</th>
          <th><?=_('Product Code');?></th>
          <th><?=_('Product Name');?></th>
          <th><?=_('Product Name JP');?></th>
          <th><?=_('Size');?></th>
          <th><?=_('Image');?></th>
          <th><?=_('Maker');?></th>
          <th><?=_('Maker JP');?></th>
          <th><?=_('Unit');?></th>
          <th><?=_('Price Normal');?></th>
          <th><?=_('Price Sale');?></th>
          <th><?=_('Status');?></th>
          <th><?=_('Active');?></th>
        </tr></thead>
        <tfoot></tfoot>
        <tbody></tbody>
      </table>
    </div>
  </main>
  <footer>
    &copy;Solutions Koubou
  </footer>
  <!-- Modals Area -->
  <div id="addProdModal" name="addProdModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form name="formAddProd" id="formAddProd" class="needs-validation" novalidate enctype="multipart/form-data">
            <div id="formHelper"></div>
            <input type="hidden" name="pID" id="pID" value="" />
            <div class="row">
              <div class="col-md-6">
                <div class="row align-items-center">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="pCode" name="pCode" placeholder="12345" required>
                      <label for="pCode"><?=_('Product Code');?></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="file" class="form-control" name="pImageFile" id="pImageFile" accept="image/*">
                      <div id="pImageFileStaticText" style="padding: 1.5em .75em 1em; border-radius: .25rem; border: 1px solid #ced4da;" onclick="$(':input#pImageFile').trigger('click');"></div>
                      <label for="pImageFile"><?=_('Product Image');?></label>
                    </div>
                  </div>
                </div>
              </div><!-- /.col -->
              <div class="col-md-6 d-flex mb-3">
                <div class="d-flex" style="padding: 1em .75em; border: 1px solid #ced4da; border-radius: .25rem; flex-grow: 1; color:white; background-color: #949494;">
                  <div id="imgPreview" class="mx-auto" style="line-height: 5.5;"> <?=_('IMAGE');?> </div>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="prodNamePtBr" name="prodNamePtBr" placeholder="<?=_('Product Phonetic Name');?>" required>
                  <label for="prodNamePtBr"><?=_('Product Name');?></label>
                </div>    
              </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="prodNameJP" name="prodNameJP" placeholder="<?=_('Product Name in Japanese Style');?>" required>
                  <label for="prodNameJP"><?=_('Product Name JP');?></label>
                </div>
              </div>
            </div><!-- /.row -->
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="prodSize" id="prodSize" placeholder="<?=_('weight or qty within the product');?>">
                  <label for="prodSize"><?=_('Size / Weight');?></label>
                </div>
              </div><!-- /.col -->
              <div class="col">
                <div class="form-floating mb-3">
                  <select class="form-select" id="selectMaker" name="selectMaker" required></select>
                  <label for="selectMaker"><?=_('Maker');?></label>
                </div>
              </div><!-- /.col -->
              <div class="col">
                <div class="form-floating mb-3">
                  <select class="form-select" id="selectUnit" name="selectUnit" required></select>
                  <label for="selectUnit"><?=_('Unit');?></label>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col">
                <div class="form-floating">
                  <input type="text" class="form-control number" name="prodPriceNormal" id="prodPriceNormal" placeholder="<?=_('Product Standard Price');?>" required>
                  <label for="prodPriceNormal"><?=_('Product Price');?></label>
                </div>
              </div><!-- /.col -->
              <div class="col">
                <div class="form-floating">
                  <input type="text" class="form-control number" name="prodPriceSpecial" id="prodPriceSpecial" placeholder="<?=_('Product Special Sale Price');?>">
                  <label for="prodPriceSpecial"><?=_('Product Price Special');?></label>
                </div>
              </div><!-- /.col -->
              <div class="col">
                <div class="form-floating">
                  <select class="form-select" name="specialStatus" id="specialStatus" aria-label="Special Status">
                    <option value="1" selected><?=_('Active');?></option>
                    <option value="0"><?=_('Inactive');?></option>
                  </select>
                  <label for="specialStatus"><?=_('Special Status');?></label>
                </div>
              </div><!-- /.col -->
              <div class="col">
                <div class="form-floating">
                  <select class="form-select" name="prodActive" id="prodActive" aria-label="<?=_('Product Active');?>">
                    <option value="1" selected><?=_('Active');?></option>
                    <option value="0"><?=_('Inactive');?></option>
                  </select>
                  <label for="prodActive"><?=_('Product Active');?></label>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnSubmitNewProd" onclick="save();"><?=_('Save Changes');?></button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts Area -->
  <script src="../jquery/jquery-3.7.1.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="js/datatables/DataTables/datatables.js"></script>
  <script>
    "use strict";
    var floatNumbersRegex = /[^\d.-]/g;
    console.log(`dirname(__DIR__):<?=dirname(__DIR__);?>`);

    $(function(e){
      window.addEventListener('resize', dataTablesRedraw );
      window.addEventListener('keydown', (e) => {
        if( e.code == 'NumpadAdd' ){
          // trigger add maker modal and return false to stop propagation
          let editProdModal = new bootstrap.Modal( addProdModal );
          editProdModal.show();
          return false;
        }
      });

      $('form').submit(function(event){
        event.preventDefault();
        event.stopPropagation();
      });

      // format input:number
      $(':input.number').css('text-align', 'right').keyup(function(e){
        // format number
        let value = Number( this.value.replace(floatNumbersRegex, '') );
        //console.log( 'value', value);
        if( this.value > 0 ){
          this.value = Intl.NumberFormat().format( value );
        }
      });

      // populate the makers select
      makeMakersSelect();
      // populate the units select
      makeUnitsSelect();

      //capture new file upload
      const fileInput = document.getElementById('pImageFile');
      const imgPreview = document.getElementById('imgPreview');
      fileInput.style.opacity = 0; // hide the input element
      fileInput.style.height = 0;
      fileInput.style.padding = 0;
      fileInput.style.margin = 0;
      fileInput.addEventListener('change',updateImageDisplay);

      function updateImageDisplay(){
        while( imgPreview.firstChild ){
          imgPreview.removeChild( imgPreview.firstChild );
        }

        const curFiles = fileInput.files;
        if( curFiles.length === 0 ){
          const para = document.createElement('p');
          para.textContent = 'No files currently selected for upload';
          imgPreview.appendChild(para);
        } else {
          const list = document.createElement('div');
          imgPreview.appendChild(list);

          for( const file of curFiles ){
            const listItem = document.createElement('figure');
            listItem.style.marginBottom = "0";
            listItem.style.width = "200px";
            const para = document.createElement('figcaption');
            para.classList.add("figure-caption");
            para.classList.add("text-end");
            const staticImageName = document.getElementById('pImageFileStaticText');

            if( validFileType(file) ){
              //para.innerHTML = `${file.name} [${returnFileSize(file.size)}]`;
              staticImageName.innerHTML = `${file.name} [${returnFileSize(file.size)}]`;
              const image = document.createElement('img');
              image.src = URL.createObjectURL( file );
              image.classList.add("figure-img");
              image.classList.add("img-fluid");
              image.classList.add("rounded");

              listItem.appendChild( image );
              //listItem.appendChild( para );
            } else {
              para.innerHTML = `<p>File name ${file.name}: Not a valid file type.</p><p>Update your selection.</p>`;
              listItem.appendChild( para );
            }

            list.appendChild( listItem );

            // update modal
            /*
            var modal = bootstrap.Modal.getInstance( addProdModal );
            modal.handleUpdate();
            */

            $(':input#pCode').select();
          }
        }
      }

      const fileTypes = [
        "image/apng",
        "image/bmp",
        "image/gif",
        "image/jpeg",
        "image/pjpeg",
        "image/png",
        "image/svg+xml",
        "image/tiff",
        "image/webp",
        "image/x-icon"
      ];

      function validFileType(file){
        return fileTypes.includes(file.type);
      }

      function returnFileSize(number){
        if( number < 1024 ){
          return number + 'bytes';
        } else if( number >= 1024 && number < 1048576 ){
          return ( number / 1024 ).toFixed(1) + 'KB';
        } else if( number >= 1048576 ){
          return ( number /1048576 ).toFixed(1) + 'MB';
        }
      }
    });

    const addProdModal = document.getElementById('addProdModal');
    var prodIdInput = document.getElementById('pCode');
    addProdModal.addEventListener('shown.bs.modal', function(event){
      // log the node name of the element that trigged the modal
      console.log( 'trigger: ', event.relatedTarget);
      
      // get the button that trigged the modal
      let buttonTrigger = event.relatedTarget;
      console.log('buttonTrigger', buttonTrigger);
      if( buttonTrigger ){
        // focus the first input when modal shows up
        prodIdInput.removeAttribute('readonly');
        prodIdInput.classList.remove('disabled');
        prodIdInput.select();
        // extract the info from data-bs-* attributes
        var modalTitleText = buttonTrigger.getAttribute('data-bs-title');
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback
        //
        // Update the Modal's content.
        var modalTitle = addProdModal.querySelector('.modal-title');
        //var modalBodyInput = addProdModal.querySelector('.modal-body input');
  
        modalTitle.textContent = modalTitleText;
      } else {
        document.getElementById('prodNamePtBr').select();
      }
    });

    addProdModal.addEventListener('hidden.bs.modal', function(event){
      // reset form
      $('form#formAddProd').trigger('reset');
      // clear static fields too
      document.getElementById('pImageFileStaticText').textContent="";
      // remove old image
      $(imgPreview).html( 'IMAGE' );

      // clear modal title
      addProdModal.querySelector('.modal-title').textContent = "";
    });

    const productsDataTable = $('table.dataTable').DataTable({
      dom : 'lrtip',
      //select : true,
      //paging : true,
      ordering  :true,
      serverSide : true,
      ajax : {
        url : "products.datatable.ajax.php",
        data: function(d){
          d.table  = "viewProducts"; // table name
          d.action = "populateDataTable"; // default action
          d.length = 50;
          console.log( `d`, d );
        },
        isLocal : true,
        method : 'GET',
        beforeSend:function( jqXHR, settings ){
          //console.log( `jqXHR:`,jqXHR );
          //console.log( `settings:`,settings );
        },
        error:function(jqXHR, textStatus, errorThrown ){
          alert( `${textError}: ${errorThrown}` );
        },/*
        success:function( data, textStatus, jqXHR ){
          console.log( `data`, data );
        },
        //complete:function( jqXHR, textStatus ){}
        */
      },
      columns:[
        { data: 'id',              name: 'id' },
        { data: 'prodCode',        name: 'prodCode' },
        { data: 'prodNamePTBR',    name: 'prodNamePTBR' },
        { data: 'prodNameJP',      name: 'prodNameJP' },
        { data: 'prodSize',        name: 'prodSize' },
        { data: 'prod_image',      name: 'prod_image' },
        { data: 'maker_name_ptbr', name: 'maker_name_ptbr' },
        { data: 'maker_name_jp',   name: 'maker_name_jp' },
        { data: 'unit_text',       name: 'unit_text' },
        { data: 'normal_price',    name: 'normal_price' },
        { data: 'price_special',   name: 'price_special' },
        { data: 'status' ,         name: 'status' },
        { data: 'active',          name: 'active' }
      ],
      scrollX : true,
      scrollY : "70vh",
      scrollCollapse : true,
      deferRender : true,
      scroller : true,
      rowCallback : function( row, data, displayNum, displayIndex, dataIndex ){
        $( row )
          .attr('data-bs-title','Edit Product')
          .attr('data-prod-code',                 data.prodCode)/*
          .attr('data-prod-ptbr',                 data.prodNamePTBR)
          .attr('data-prod-jp',                   data.prodNameJP)
          .attr('data-prod-size',                 data.prodSize)
          .attr('data-prod-image',                data.prod_image)
          .attr('data-prod-maker-ptbr',           data.maker_name_ptbr)
          .attr('data-prod-maker-jp',             data.maker_name_jp)
          .attr('data-prod-unit',                 data.unit_text)
          .attr('data-prod-price-normal',         data.normal_price)
          .attr('data-prod-price-special',        data.price_special)
          .attr('data-prod-price-special-status', data.status)*/
          .attr('onclick','editProd( this );');

          /*
          $('td:eq(0)').html( data.id );
          $('td:eq(1)').html( data.prodCode );
          $('td:eq(2)').html( data.prodNamePTBR + '<br />' + data.prodNameJP );
          $('td:eq(3)').html( data.maker );
          $('td:eq(4)').html( data.prodSize );
          $('td:eq(5)').html( data.unit );
          $('td:eq(6)').html( data.normalPrice );
          $('td:eq(7)').html( data.specialPrice );
          */
      },
      initComplete : function( settings, json ){},
      language : {
        url : '<?=_('./js/datatables/DataTables/Internationalisation/Portuguese-Brasil.json');?>'
      }
    });

    function dataTablesRedraw(){
      console.log('redraw DataTable...');
      productsDataTable.columns.adjust().draw();
    }

    $('#dataTableSearch').on('keyup', function(){
      productsDataTable.search( this.value ).draw();
    });

    function editProd( element ){
      console.log( element );
      // remove class warning from previous selected element
      $(element).closest('tbody').find('tr.warning').removeClass('warning');
      // apply the class warning for the new selected element
      $(element).addClass('warning');
      let id=$(element).attr('id');
      let modalTitle = addProdModal.querySelector('.modal-title');
      modalTitle.textContent = $(element).data('bsTitle');
      let prodCode = $(element).data('prodCode');

      // get the data
      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'GET',
        data : { 'action':'getProdDetails', 'prodCode':prodCode },
        dataType : 'json',
        beforeSend : function( jqXHR, settings ){},
        error : function( jqXHR, textStatus, errorThrown ){
          alert(`${textStatus} ${jqXHR.status}: ${errorThrown}`);
        },
        success : function( data, textStatus, jqXHR ){
          if( data.result ){
            console.log('data.prodData', data.prodData);
            let prodID = document.getElementById('pID');
            let prodCode = document.getElementById('pCode');
            prodCode.setAttribute('readonly', true);
            prodCode.classList.add('disabled');

            let prodNamePTBR = document.getElementById('prodNamePtBr');
            let prodNameJP = document.getElementById('prodNameJP');
            let prodSize = document.getElementById('prodSize');
            let prodMaker = document.getElementById('selectMaker');
            let prodUnit = document.getElementById('selectUnit');
            let prodPrice = document.getElementById('prodPriceNormal');
            let prodPriceSpecial = document.getElementById('prodPriceSpecial');
            let prodSpecialStatus = document.getElementById('specialStatus');
            let prodActive = document.getElementById('prodActive');
            let prodImageStatic = document.getElementById('pImageFileStaticText');
            let prodImageInput = document.getElementById('pImageFile');
            let prodImageHolder = document.getElementById('imgPreview');

            // fill data
            prodID.value = data.prodData.id;
            prodCode.value = data.prodData.prodCode;
            prodNamePTBR.value = data.prodData.namePTBR;
            prodNameJP.value = data.prodData.nameJP;
            prodSize.value = data.prodData.size;
            prodMaker.value = data.prodData.makerID;
            prodUnit.value = data.prodData.unitID;
            prodPrice.value = Intl.NumberFormat().format( data.prodData.price );
            prodPriceSpecial.value = Intl.NumberFormat().format( data.prodData.specialPrice );
            prodSpecialStatus.value = data.prodData.specialStatus ? data.prodData.specialStatus : 0;
            prodActive.value = data.prodData.active;
            prodImageStatic.textContent = `../assets/${data.prodData.image}`;
            // clear imgPreview Contents
            imgPreview.textContent = "";
            // create the image element and append to the page
            let listItem = document.createElement('figure');
            listItem.style.marginBottom = "0";
            listItem.style.width = "200px";
            let image = document.createElement('img');
            image.src = `../assets/${data.prodData.image}`;
            image.classList.add("figure-img");
            image.classList.add("img-fluid");
            image.classList.add("rounded");
            listItem.appendChild( image );
            let list = document.createElement('div');
            list.appendChild( listItem );
            imgPreview.appendChild(list);
          }
        },
        complete : function( jqXHR, textStatus ){
          $(addProdModal).modal('show');
        }
      });

      /*
      $('div.modal-title', 'div#addMakerModal').html( modalTitleText );
      $(':input#makerId').val( makerId );
      $(':input#makerNamePtBr').val( makerNamePTBR );
      $(':input#makerNameJP').val( makerNameJP );
      */

      /*
      var editMakerModal = new bootstrap.Modal( addMakerModal );
      editMakerModal.show();
      */
    }

    function save(){
      // start save
      console.log('<?=_('save process started ...');?>');

      // update the submit button to show some animation
      var submitButtonOriginalText = $('button#btnSubmitNewProd').html();
      
      var formAddProd = document.getElementById('formAddProd');
      var pID = document.getElementById('pID').value;
      var pCode = document.getElementById('pCode').value;
      var pNamePTBR = document.getElementById('prodNamePtBr').value;
      var pNameJP = document.getElementById('prodNameJP').value;
      var pSize = document.getElementById('prodSize').value;
      var pMakerID = document.getElementById('selectMaker').value;
      var pUnit = document.getElementById('selectUnit').value;
      var pImage = document.getElementById('pImageFile');
      var pPriceNormal = document.getElementById('prodPriceNormal').value;
      var pPriceSpecial = document.getElementById('prodPriceSpecial').value;
      var pSpecialStatus = document.getElementById('specialStatus').value;
      var pActive = document.getElementById('prodActive').value;
      const floatNumbersRegex = /[^\d.-]/gm;
      const emptyString = ``;

      // sanitize and parse numbers
      pPriceNormal = Number( pPriceNormal.replace(floatNumbersRegex, emptyString) );
      pPriceSpecial = Number( pPriceSpecial.replace(floatNumbersRegex, emptyString) );

      if( !pCode || !pNamePTBR || !pNameJP || !pMakerID || !pUnit || !pPriceNormal ){
        $('form').addClass('was-validated');
        $('button.submit:visible').removeClass('disabled').text(submitButtonOriginalText);
        $('<div/>',{
          class : 'alert alert-dismissible alert-danger',
          html : '<p><?=_('There are errors in the form! Fix then and try again');?></p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?=_('Close');?>"></button>'
        }).append('div#formHelper');
        console.log('<?=_('STOPPED FOR ERRORS');?>');
        return false;
      }

      console.log('pCode', pCode);
      console.log('pNamePTBR', pNamePTBR);
      console.log('pNameJP', pNameJP);
      console.log('pMakerID', pMakerID);
      console.log('pSize', pSize);
      console.log('pUnit', pUnit);
      console.log('pPriceNormal', pPriceNormal);
      console.log('pPriceSpecial', pPriceSpecial);
      console.log('pSpecialStatus', pSpecialStatus);
      console.log('pActive', pActive);

      //var formData = new FormData( formAddProd );
      var formData = new FormData();
      formData.append('action', 'newProduct');
      formData.append('id', pID);
      formData.append('pCode', pCode);
      formData.append('pNamePTBR', pNamePTBR);
      formData.append('pNameJP', pNameJP);
      formData.append('pMakerID', pMakerID);
      formData.append('pSize', pSize);
      formData.append('pUnit', pUnit);
      formData.append('pImage', pImage.files[0]);
      formData.append('pPriceNormal', pPriceNormal);
      formData.append('pPriceSpecial', pPriceSpecial);
      formData.append('pSpecialStatus', pSpecialStatus);
      formData.append('pActive', pActive);

      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'POST',
        data : formData,
        dataType : 'json',
        processData : false,
        contentType : false,
        beforeSend : function( jqXHR, settings ){
          console.log('<?=_('save: AJAX request started...');?>');
          // change the submit button
          $('button#btnSubmitNewProd')
            .attr('disabled', true)
            .addClass('disabled')
            .html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <?=_('Wait a moment ...');?>`);
        },
        error : function( jqXHR, textStatus, errorThrown ){
          alert(`${textStatus} ${jqXHR.status}: ${errorThrown}`);
          return false;
        },
        success : function( data, textStatus, jqXHR ){
          console.log( 'data', data);
          if( !data.result ){
            $('<div/>',{
              class : 'alert alert-dismissible alert-danger',
              html : '<p>' + data.error + '</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?=_('Close');?>"></button>'
            }).append('div#formHelper');
          } else {
            console.log('data.products.id: ', data.products.id);
            console.log('data.price.id: ', data.price.id);
            console.log('data.priceSpecial.id: ', data.priceSpecial.id);
          }
        },
        complete : function( jqXHR, textStatus ){
          console.log('<?=_('... save finished!');?>');
          // redraw datatable
          var tr = $('tr.warning', 'table.dataTable');
          productsDataTable
            .row( tr )
            .invalidate()
            .draw();
          // change the submit button
          $('button#btnSubmitNewProd')
            .attr('disabled', false)
            .removeClass('disabled')
            .html(submitButtonOriginalText);
          // clear form
          $('form#formAddProd').trigger('reset');
          // remove old image
          $('div#imgPreview').html('');
          $('div#pImageFileStaticText').html('IMAGE');
          // close modal
          $('div#addProdModal').modal('hide');
        }
      });
    }

    function makeMakersSelect(){
      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'GET',
        data : { action:'getMakers' },
        dataType : 'json',
        beforeSend : function( jqXHR, settings ){
          console.log('<?=_('get Makers start...');?>')
        },
        error : function( jqXHR, textStatus, errorThrown ){
          alert(`ERROR! ${textStatus}\n${errorThrown}`);
        },
        success : function( data, textStatus, jqXHR ){
          console.log('makers data: ', data.makers );
          if( data.makers ){
            console.log('getMakers data.result: ', data.result );
            let option=[];
            $.each(data.makers, function(idx, maker){
              option.push(`<option value="${maker.maker_id}">${maker.maker_name_ptbr}</option>`);
            });

            $('#selectMaker').html( option.join("\n") );
          } else {
            alert('ERROR! ' + data.error );
          }
        },
        complete : function( jqXHR, textStatus ){
          console.log('...get Makers finish');
        }
      });
    }

    function makeUnitsSelect(){
      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'GET',
        data : { action:'getUnits' },
        dataType : 'json',
        beforeSend : function( jqXHR, settings ){
          console.log('get Units start...');
        },
        error : function( jqXHR, textStatus, errorThrown ){
          alert(`ERROR! ${textStatus} \n ${errorThrown}`);
        },
        success : function( data, textStatus, jqXHR ){
          if( data.result ){
            let options=[];
            $.each(data.units,function(idx,unit){
              options.push(`<option value="${unit.unit_id}">${unit.unit_text}</option>`);
            });

            let selectUnit = window.document.getElementById('selectUnit');
            selectUnit.innerHTML = options.join("\n");
          } else {
            alert(`ERROR!\n${data.error}`);
          }
        },
        complete : function( jqXHR, textStatus ){
          console.log('... get Units finished');
        }
      });
    }

    function get_sys_temp_dir(){
      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'GET',
        data : { action : 'sys_get_temp_dir' },
        dataType : 'json',
        success : function(data){
          console.log('sys_get_temp_dir()', data.sys_get_temp_dir);
        }
      });
      return false;
    }
  </script>
</body>
</html>
