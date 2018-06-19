<?php include '../../aut.php' ?>
<?php include '../../access.php' ?>
<?php include '../../functions.php' ?>

<!-- <?php $baseUrl = '/comerciarios/admin'?> //TODO: -->
<?php $baseUrl = '../../' ?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>Sindicato dos comerciários</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <!-- bootstrap 3.0.2 -->
      <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- font Awesome -->
      <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <!-- Ionicons -->
      <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
      <!-- Morris chart -->
      <!-- <link href="../../css/morris/morris.css" rel="stylesheet" type="text/css" /> -->
      <!-- jvectormap -->
      <link href="../../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
      <!-- fullCalendar -->
      <link href="../../css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
      <!-- Daterange picker -->
      <link href="../../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
      <!-- bootstrap wysihtml5 - text editor -->
      <link href="../../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
      <!-- Theme style -->
      <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>
  <body class="skin-blue">
    <style>
        #formClubeDeCampo input{
            width: 95%;
        }
    </style>
      <!-- header logo: style can be found in header.less -->
      <?php include $baseUrl . "includes/header.php"; ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="info">
              <span>Olá, Usuário</span>
              <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
          </div>
          <?php include $baseUrl . "includes/menu.php"; ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Clube de campo - Galeria</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Incluir Foto:</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form method="POST" action="postGalleryPhotos.php" enctype="multipart/form-data">
                    <input type="hidden" name="tipoDeLazer" value="clubeDeCampo" />
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 text-right">
                        <br />
                        <input type="file" name="image[]" accept=".jpg,.jpeg" multiple>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 text-right">
                        <button class="btn btn-success">Enviar</button>
                      </div>
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Fotos atuais:</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                  <?php
                        $sql = "SELECT * FROM `app_lazer_gallery` WHERE `categoria` = 'clubeDeCampo' ORDER BY `id` asc";
                        $result = mysqli_query($conexao, $sql);
                        if (mysqli_num_rows($result) == 0) {
                          echo "<div class='col-xs-6 col-sm-4'>Não foi encontrada nenhuma foto.</div>";
                          exit;
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-xs-6 col-sm-4">
                      <img src="<?php echo $row["url"] ?>" class="img-responsive" />
                      <small><a href="./deleteGalleryPhotos.php?p=<?php echo $row["id"] ?>">Excluir</a></small>
                    </div>
                    <?php } ?>
                  </div>
                  <form action="enviaFoto.php" method="POST" id="formClubeDeCampo" class="col s12">
                    <div class="row">
                      <div class="col-xs-12 text-right">
                        <button class="btn btn-success">Enviar</button>
                      </div>
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
      </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- add new calendar event modal -->


    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <script src="../../js/jquery.mask.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- <script src="../../js/plugins/morris/morris.min.js" type="text/javascript"></script>-->
    <!-- Sparkline -->
    <script src="../../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- fullCalendar -->
    <script src="../../js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../js/AdminLTE/dashboard.js" type="text/javascript"></script>    

    <script>
        $(function(){
            $('.money').maskMoney({thousands:'.', decimal:','});
        });
    </script>    

  </body>
</html>