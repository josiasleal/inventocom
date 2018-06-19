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
      <!-- <link href="../../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
      <!-- fullCalendar -->
      <!-- <link href="../../css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
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
            <h1>
              Enviar Push:
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                      <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 505.145 505.145"><g fill="#010002"><path d="M68.54 164.715h-1.293c-16.588 0-30.113 13.568-30.113 30.113v131.107c0 16.61 13.525 30.134 30.113 30.134h1.316c16.588 0 30.113-13.57 30.113-30.135V194.827c-.022-16.544-13.568-30.112-30.135-30.112zM113.085 376.54c0 15.23 12.446 27.632 27.675 27.632h29.574v70.817c0 16.63 13.568 30.155 30.113 30.155h1.294c16.61 0 30.157-13.546 30.157-30.156V404.17h41.33v70.817c0 16.63 13.61 30.155 30.156 30.155h1.273c16.61 0 30.134-13.546 30.134-30.156V404.17h29.595c15.207 0 27.654-12.403 27.654-27.632V169.525H113.084V376.54zM322.04 43.983l23.492-36.26c1.51-2.287.84-5.414-1.467-6.903-2.286-1.51-5.414-.884-6.903 1.467L312.81 39.8c-18.27-7.486-38.677-11.692-60.227-11.692-21.57 0-41.934 4.206-60.247 11.69l-24.31-37.51C166.538-.065 163.388-.69 161.08.82c-2.308 1.488-2.977 4.616-1.467 6.903l23.512 36.26c-42.387 20.773-70.968 59.924-70.968 104.834 0 2.76.173 5.48.41 8.175H392.62c.237-2.696.388-5.414.388-8.175 0-44.91-28.602-84.06-70.967-104.834zM187.656 108.91c-7.442 0-13.482-5.996-13.482-13.46 0-7.462 6.04-13.438 13.482-13.438 7.485 0 13.482 5.975 13.482 13.44s-6.04 13.46-13.482 13.46zm129.835 0c-7.442 0-13.482-5.996-13.482-13.46 0-7.462 6.04-13.438 13.482-13.438 7.463 0 13.46 5.975 13.46 13.44 0 7.462-5.997 13.46-13.46 13.46zM437.876 164.715h-1.25c-16.59 0-30.157 13.568-30.157 30.113v131.107c0 16.61 13.59 30.134 30.155 30.134h1.273c16.61 0 30.113-13.57 30.113-30.135V194.827c0-16.544-13.546-30.112-30.134-30.112z"/></g></svg>
                      Android:
                    </h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <form id="sendAndroid" class="col-xs-12">
                      <div class="form-group">
                        <label for="title-android">Título</label>
                        <input type="text" class="form-control" id="title-android" name="title-android" placeholder="Título" required minlength="3" maxlength="30">
                        <small>Máximo 30 caracteres</small>
                      </div>
                      <div class="form-group">
                        <label for="msg-android">Mensagem Rápida</label>
                        <input type="text" class="form-control" id="msg-android" name="msg-android" placeholder="Mensagem Rápida" required minlength="3" maxlength="80">
                        <small>Máximo 80 caracteres</small>
                      </div>
                      <div class="form-group text-right">
                        <button class="btn btn-success" type="submit">Enviar</button>
                      </div>
                    </form>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
           <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                      <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 305 305"><path d="M40.738 112.12c-25.785 44.744-9.393 112.647 19.12 153.82C74.093 286.522 88.503 305 108.24 305c.373 0 .746-.007 1.128-.022 9.273-.37 15.974-3.225 22.453-5.984 7.273-3.1 14.796-6.305 26.596-6.305 11.226 0 18.39 3.1 25.318 6.098 6.828 2.954 13.86 6.01 24.253 5.815 22.232-.414 35.882-20.352 47.925-37.94 12.567-18.366 18.87-36.197 20.998-43.01l.086-.272c.405-1.21-.167-2.532-1.328-3.065-.032-.015-.15-.064-.183-.078-3.915-1.6-38.257-16.836-38.618-58.36-.335-33.736 25.763-51.6 30.997-54.84l.244-.15c.567-.366.962-.945 1.096-1.607.134-.66-.006-1.35-.386-1.905-18.014-26.362-45.624-30.335-56.74-30.813-1.613-.16-3.278-.242-4.95-.242-13.056 0-25.563 4.93-35.61 8.893-6.937 2.735-12.928 5.097-17.06 5.097-4.643 0-10.668-2.39-17.645-5.16-9.33-3.702-19.905-7.898-31.1-7.898-.267 0-.53.003-.79.008-26.03.383-50.625 15.275-64.185 38.86z"/><path d="M212.1.002c-15.762.642-34.67 10.345-45.973 23.583-9.605 11.127-18.988 29.68-16.516 48.38.156 1.17 1.108 2.072 2.285 2.163 1.064.083 2.15.125 3.232.126 15.413 0 32.04-8.527 43.395-22.257 11.95-14.498 17.994-33.104 16.166-49.77C214.544.92 213.395-.05 212.1.002z"/></svg>
                      iOS
                    </h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                  <form id="sendIOs" class="col-xs-12">
                      <div class="form-group">
                        <label for="msg-ios">Mensagem</label>
                        <input type="text" class="form-control" id="msg-ios" name="msg-ios" placeholder="Mensagem" required minlength="3" maxlength="80">
                        <small>Máximo 80 caracteres</small>
                      </div>
                      <div class="form-group text-right">
                        <button class="btn btn-success">Enviar</button>
                      </div>
                    </form>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
      </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- add new calendar event modal -->


    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script>
      $(function(){
        $('#sendAndroid').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            url: 'sendPush.php',
            type: 'POST',
            data: {
              titleAndroid: $('#title-android').val(),
              msgAndroid: $('#msg-android').val(),
              platform: 'Android',
              registerToken: '059d7a3ecce6a74f5a7040a99de136bc'
            },
          })
          .done(function(response) {
            (JSON.parse(response).success) ? alert('Push enviado com sucesso!') : alert('Erro ao enviar, tente novamente! Erro:' + response );
            $('#title-android, #msg-android').val('');
          })
          .fail(function(err) {
            console.log(err);
            alert('Erro ao enviar, tente novamente! Erro:' + err );
          });
        })
        $('#sendIOs').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            url: 'sendPush.php',
            type: 'POST',
            data: {
              msgIOs: $('#msg-ios').val(),
              platform: 'iOS',
              registerToken: '059d7a3ecce6a74f5a7040a99de136bc'
            },
          })
          .done(function(response) {
            console.log(response)
            // (JSON.parse(response).success) ? alert('Push enviado com sucesso!') : alert('Erro ao enviar, tente novamente! Erro:' + response );
            $('#msg-ios').val('');
          })
          .fail(function(err) {
            console.log(err);
            alert('Erro ao enviar, tente novamente! Erro:' + err );
          });
        })
      });
    </script>
    <!-- jQuery UI 1.10.3 -->
    <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- <script src="../../js/jquery.mask.js" type="text/javascript"></script> -->
    <!-- Bootstrap -->
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <!-- <script src="../../js/plugins/morris/morris.min.js" type="text/javascript"></script>-->
    <!-- Sparkline -->
    <!-- <script src="../../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script> -->
    <!-- jvectormap -->
    <!-- <script src="../../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script> -->
    <!-- <script src="../../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script> -->
    <!-- fullCalendar -->
    <!-- <script src="../../js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="../../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script> -->
    <!-- daterangepicker -->
    <!-- <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script> -->
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <!-- <script src="../../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script> -->

    <!-- AdminLTE App -->
    <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

  </body>
</html>