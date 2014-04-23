<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Front End Management</title>

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"> -->

    <!-- Optional theme -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Awesome Font -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css" rel="stylesheet">
    <!-- Datatable -->
    <link href='../script/dataTable/css/jquery.dataTables.css' rel='stylesheet' type='text/css'/>
    <link href='../script/dataTable/css/jquery.dataTables_themeroller.css' rel='stylesheet' type='text/css'/>
    <!-- Qtip2-->
    <link href='//cdn.jsdelivr.net/qtip2/2.2.0/jquery.qtip.min.css' rel='stylesheet' type='text/css'/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>
  <body>
    <?php 
        include("../include/_conn.php");
    ?>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Front End Package Management</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Packages</a></li>
            <li><a href="#">Pages</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class='active'><a href="../home/index.php">Overview</a></li>
            <li><a href="">Reports</a></li>
            <li><a href="">Analytics</a></li>
            <li><a href="">Export</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li data-url='../subPages/pageList.php'><a href="">Page List</a></li>
            <li data-url='../subPages/addPage.php'><a href="">Add a Page</a></li>
            <li id='menu-edit-page'><a href="">Edit a Page</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li data-url='../subPages/packageList.php'><a href="">Package List</a></li>
            <li data-url="../subPages/addPackage.php"><a href="">Add a Package</a></li>
            <li id='menu-edit-package'><a href="">Edit a Package</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id='result-panel'>

          <h1>Overview</h1>

          <div class="row placeholders">
            
          </div>

        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
    <!-- DataTable -->
    <script src="../script/dataTable/js/jquery.dataTables.min.js"></script>
    <!-- Qtip2 -->
    <script src="//cdn.jsdelivr.net/qtip2/2.2.0/jquery.qtip.min.js"></script>
    <!-- Custom Javascript Event -->
    <script type="text/javascript">
        // Toggle the active menu item
        jQuery("[data-url]").click(function(event) {
            jQuery(".container-fluid .active").removeClass('active');
            jQuery(this).addClass('active');
            var url=jQuery(this).data("url");
            jQuery("#result-panel").html("<div style='text-align:center'><i class='fa fa-refresh fa-spin fa-5x' style='margin-top:200px'></i></div>");
            jQuery.ajax({
              url: url,
              type: 'POST',
              dataType: 'html',
              data: {},
              success: function(data, textStatus, xhr) {
                jQuery("#result-panel").html(data);
              },
              error: function(xhr, textStatus, errorThrown) {
                jQuery("#result-panel").html("<div style='text-align:center;margin-top:200px'><p class='text-danger'>There's error when loading...</p></div>");
              }
            });
            
            event.preventDefault();
        });
    </script>
  </body>
</html>