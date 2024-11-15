<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MARCAS</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="makers.php">Makers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="units.php">Units</a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
          -->
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" id="dataTableSearch" name="dataTableSearch" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <main class="container">
    <div class="bg-light p-5 rounded">
      <h1>
        Marcas
        <button type="button" class="btn btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#addMakerModal" data-bs-title="Nova Marca"><i class="bi bi-plus"></i></button>
      </h1>
      <table class="table table-bordered table-striped table-hover dataTable" style="width:100%;">
        <thead><tr>
          <th>ID</th>
          <th>Maker Code</th>
          <th>Maker Name PTBR</th>
          <th>Maker Name JP</th>
          <th>Since</th>
        </tr></thead>
        <tfoot></tfoot>
        <tbody></tbody>
      </table>
    </div>
  </main>
  <footer>
    &copy;K.K.TAKARA M.C.
  </footer>
  <!-- Modals Area -->
  <div id="addMakerModal" name="addMakerModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg"> <!-- Modal Size: .modal-sm/ None / .modal-lg / .modal-xl -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nova Marca</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form name="formAddMaker" id="formAddMaker" class="needs-validation" novalidate>
          <div class="modal-body">
            <div id="formHelper" class="alert" style="display:none;margin:1.5em;"></div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="makerId" name="makerId" placeholder="TAKARA" required>
              <label for="makerId">Maker Code</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="makerNamePtBr" name="makerNamePtBr" placeholder="TAKARA" required>
              <label for="makerNamePtBr">Maker Name PT-BR</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" id="makerNameJP" name="makerNameJP" placeholder="タカラ">
              <label for="makerNameJP">Maker Name JP</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnSubmitNewMaker" onclick="save();">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts Area -->
  <script src="../jquery/jquery-3.6.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="./js/datatables/DataTables/datatables.min.js"></script>
  <script>
    "use strict";

    var addMakerModal = document.getElementById('addMakerModal');
    var makerIdInput = document.getElementById('makerId');
    addMakerModal.addEventListener('shown.bs.modal', function(event){
      // log the node name of the element that trigged the modal
      console.log( 'trigger: ', event.relatedTarget);

      // focus the first input when modal shows up
      makerIdInput.focus();

      // get the button that trigged the modal
      var button = event.relatedTarget;
      // extract the info from data-bs-* attributes
      //var modalTitleText = button.getAttribute('data-bs-title');
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback
      //
      // Update the Modal's content.
      var modalTitle = addMakerModal.querySelector('.modal-title');
      var modalBodyInput = addMakerModal.querySelector('.modal-body input');

      //modalTitle.textContent = modalTitleText;
    });

    addMakerModal.addEventListener('hidden.bs.modal', function(event){
      $('form#formAddMaker').trigger('reset');
    });

    $(function(e){
      window.addEventListener('resize', dataTablesRedraw );
      window.addEventListener('keydown', (e) => {
        if( e.code == 'NumpadAdd' ){
          // trigger add maker modal and return false to stop propagation
          let editMakerModal = new bootstrap.Modal( addMakerModal );
          editMakerModal.show();
          return false;
        }
      });

      $('form').submit(function(event){
        event.preventDefault();
        event.stopPropagation();
      });
    });

    var makerDataTable = $('table.dataTable').DataTable({
      dom : 'ltipr',
      select : true,
      serverSide : true,
      ajax : {
        url : "products.datatable.ajax.php",
        data: function(d){
          d.table = "makers"; // table name
          d.action = "populateDataTable"; // default action
        }
      },
      columns:[
        { data: 'id',               name:'id' },
        { data: 'maker_id',         name:'maker_id' },
        { data: 'maker_name_ptbr',  name:'maker_name_ptbr' },
        { data: 'maker_name_jp',    name:'maker_name_jp' },
        { data: 'maker_entry_date', name:'maker_entry_date' }
      ],
      scrollX : true,
      //scrollY : 200,
      deferRender : true,
      scroller : true,
      rowCallback : function( row, data, displayNum, displayIndex, dataIndex ){
        $( row )
          .attr('data-bs-title','Edit Maker')
          .attr('data-maker-id', data.maker_id)
          .attr('data-maker-ptbr', data.maker_name_ptbr)
          .attr('data-maker-jp', data.maker_name_jp)
          .attr('onclick','editMaker( this );');
      },
      initComplete : function( settings, json ){},
      language : {
        url : './js/datatables/DataTables/Internationalisation/Portuguese-Brasil.json'
      }
    });

    function editMaker( element ){
      console.log( element );
      var id=$(element).data('id');
      var modalTitleText = $(element).data('bsTitle');
      var makerId = $(element).data('makerId');
      var makerNamePTBR = $(element).data('makerPtbr');
      var makerNameJP = $(element).data('makerJp');

      $('div.modal-title', 'div#addMakerModal').html( modalTitleText );
      $(':input#makerId').val( makerId );
      $(':input#makerNamePtBr').val( makerNamePTBR );
      $(':input#makerNameJP').val( makerNameJP );

      var editMakerModal = new bootstrap.Modal( addMakerModal );
      editMakerModal.show();
    }

    function dataTablesRedraw(){
      console.log('redraw DataTable...');
      makerDataTable.columns.adjust().draw();
    }

    $('#dataTableSearch').on('keyup', function(){
      makerDataTable.search( this.value ).draw();
    });

    function save(){
      // start save
      console.log('save start...');

      // update the form helper
      $('div#formHelper').removeClass('alert-danger').html('').hide(400,function(){
        $(this).removeClass('alert-danger').html('');
      });
      // update the submit button to show some animation
      var submitButtonOriginalText = $('button#btnSubmitNewMaker').text();
      
      var mID = document.getElementById('makerId');
      var mNamePTBR = document.getElementById('makerNamePtBr');
      var mNameJP = document.getElementById('makerNameJP');

      if( !mID.value || !mNamePTBR.value ){
        $('form').addClass('was-validated');
        $('button.submit:visible').removeClass('disabled').text(submitButtonOriginalText);
        $('div#formHelper')
          .addClass('alert-danger')
          .html('Existem erros no formulário! Corrijá-os e tente novamente')
          .show( 400, function(){
            setTimeout(function(){
              $(this).hide(400,function(){
                $(this).removeClass('alert-danger').html('');
              });
            },5000);
          });
        return false;
      }

      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'POST',
        data : { action:'newMaker', id:mID.value, namePTBR:mNamePTBR.value, nameJP:mNameJP.value },
        dataType : 'json',
        beforeSend : function( jqXHR, settings ){
          // change the submit button
          $('button#btnSubmitNewMaker')
            .attr('disabled', true)
            .addClass('disabled')
            .html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde...`);
        },
        error : function( jqXHR, textStatus, errorThrown ){
          alert(`${textStatus} ${jqXHR.status}: ${errorThrown}`);
        },
        success : function( data, textStatus, jqXHR ){
          console.log( 'data', data);
          if( !data.result ){
            $('div#formHelper')
              .addClass('alert-danger')
              .html( data.error )
              .show();
              setTimeout(function(){
                $('div#formHelper').hide(400, function(){
                  $(this).removeClass('alert-danger').html('');
                });
              }, 5000);
          } else {
            console.log('lastInsertId: ', data.lastInsertId);
            // redraw datatable
            makerDataTable.draw();
          }
        },
        complete : function( jqXHR, textStatus ){
          // change the submit button
          $('button#btnSubmitNewMaker')
            .attr('disabled', false)
            .removeClass('disabled')
            .html(submitButtonOriginalText);
          // clear form
          $('form#formAddMaker').trigger('reset');
          // close modal
          $('div#addMakerModal').modal('hide');
        }
      });
    }
  </script>
</body>
</html>