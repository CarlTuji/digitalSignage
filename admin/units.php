<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIDADES</title>
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
      <a class="navbar-brand" href="javascript:void(0)">Digital Display</a>
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
            <a class="nav-link" href="makers.php">Makers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="units.php">Units</a>
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
        Unidades
        <button type="button" class="btn btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#addUnitModal"><i class="bi bi-plus"></i></button>
      </h1>
      <table class="table table-bordered table-striped table-hover dataTable" style="width:100%;">
        <thead><tr>
          <th>#</th>
          <th>Unidade</th>
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
  <div id="addUnitModal" name="addUnitModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar Nova Unidade</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="">
            <div class="form-floating mb-3">
              <input type="text" name="unit" id="unit" class="form-control">
              <label for="unit">Unidade</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveUnit();">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts Area -->
  <script src="../jquery/jquery-3.6.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="./js/datatables/DataTables/datatables.min.js"></script>
  <script>
    "use strict";

    $(function(e){
      window.addEventListener('resize', dataTablesRedraw );
    });

    var unitsDataTable = $('table.dataTable').DataTable({
      dom : 'ltipr',
      select : true,
      serverSide : true,
      ajax : {
        url : "products.datatable.ajax.php",
        data: function(d){
          d.table = "units"; // table name
          d.action = "populateDataTable"; // default action
        }
      },
      columns:[
        { data: 'unit_id', name:'unit_id' },
        { data: 'unit_text', name:'unit_text' }
      ],
      scrollX : true,
      //scrollY : 200,
      deferRender : true,
      scroller : true,
      language : {
        url : './js/datatables/DataTables/Internationalisation/Portuguese-Brasil.json'
      }
    });

    function dataTablesRedraw(){
      console.log('redraw DataTable...');
      unitsDataTable.columns.adjust().draw();
    }

    $('#dataTableSearch').on('keyup', function(){
      unitsDataTable.search( this.value ).draw();
    });

    function saveUnit(){
      // prepare data
      let unitText = document.getElementById('unit').value;

      $.ajax({
        url : 'products.datatable.ajax.php',
        method : 'POST',
        data : { 'action':'newUnit', 'unitText':unitText },
        dataType : 'json',
        beforeSend : function( jqXHR, settings ){},
        error : function( jqXHR, textStatus, errorThrown ){
          alert(`${textStatus} ${jqXHR.status}: ${errorThrown}`);
        },
        success : function( data, textStatus, jqXHR ){
          if( data.result ){
            dataTablesRedraw();
          }
        },
        complete : function( jqXHR, textStatus ){}
      });
    }
  </script>
</body>
</html>