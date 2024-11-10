<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DigitalDISPLAY Main Page</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/bootstrap_icons/bootstrap-icons.css">
  <style>
    div.col button.btn:last-child{
      margin-bottom: 0;
    }
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
            <a class="nav-link active" aria-current="page" href="javascript:void(0)">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="makers.php">Makers</a>
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
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <main class="container mb-3">
    <div class="bg-light p-5 rounded">
      <div class="row">
        <div class="col">
          <button class="btn btn-lg btn-secondary" data-url="products.php">PRODUTOS</button>
          <button class="btn btn-lg btn-secondary" data-url="makers.php">MARCAS</button>
          <button class="btn btn-lg btn-secondary" data-url="units.php">UNIDADES</button>
        </div>
        <div class="col">
          <button class="btn btn-lg btn-secondary" data-url="banners.php">BANNERS</button>
          <button class="btn btn-lg btn-secondary" data-url="#">Button 5</button>
          <button class="btn btn-lg btn-secondary" data-url="#">Button 6</button>
        </div>
      </div>
    </div>
    
  </main>
  <footer class="text-center">&copy; K.K. TAKARA M.C.</footer>
  <script src="../jquery/jquery-3.6.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script>
    "use strict";

    // capture window resize event
    window.addEventListener('resize', adjustButtonsHeight);

    $(function(e){
      adjustButtonsHeight();

      // add click event to buttons
      $('button', 'main.container').click(function(e){
        //alert( $(this).data('url') );
        window.location.href=$(this).data('url');
      }).mouseenter(function(){
        $(this).removeClass('btn-secondary').addClass('btn-primary');
      }).mouseleave(function(){
        $(this).removeClass('btn-primary').addClass('btn-secondary');
      });
    });

    function adjustButtonsHeight(){
      var windowHeight = $(window).height() - 250;
      var navHeight = $('nav').height();
      var footerHeight = $('footer').height();
      var sectionHeight = windowHeight - ( navHeight + footerHeight );
      var columns = $('div.col', 'main.container').length;
      var btns = $('button.btn','main.container').length;

      var btnPerColumn = btns / columns;
      var btnHeight = sectionHeight / btnPerColumn;
      console.log('windowHeight', windowHeight);
      console.log('navHeight', navHeight);
      console.log('btnHeight', btnHeight);

      $('button.btn','main.container').css('height', btnHeight).css('width','100%').css('margin-bottom', '1em').css('margin-top','1em');
    }
  </script>
</body>
</html>
