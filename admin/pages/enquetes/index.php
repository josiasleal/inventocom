<?php include '../../aut.php' ?>
<?php include '../../access.php' ?>
<?php include '../../functions.php' ?>

<?php $baseUrl = '../../'; ?>

<?php date_default_timezone_set("Brazil/East"); ?>

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
    <?php include $baseUrl . "includes/header.php"; ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
      <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
          <div class="user-panel">
            <div class="info">
              <span>Olá, Usuário</span>
            </div>
          </div>
          <?php include $baseUrl . "includes/menu.php"; ?>
        </section>
      </aside>

      <aside class="right-side">
        <section class="content-header">
            <h1>Enquetes</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Crie uma enquete</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <form id="formEnquete" class="col s12" action="enquete-sendQuestion.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="pId" id="pId" >
										<div class="row">
                      <div class="form-group col-xs-12 col-sm-4">
                        <label for="pergunta">Pergunta</label>
                        <textarea rows="3" class="form-control" id="pergunta" name="pergunta" placeholder="Digite a pergunta" required ></textarea>
                      </div>
                      <div class="form-group col-xs-12 col-sm-2">
                        <label for="venc_dia">Dia de vencimento</label>
                        <select class="form-control" name="venc_dia" id="venc_dia" required>
                          <option value="" selected disabled>Dia</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-12 col-sm-3">
                        <label for="venc_mes">Mês do vencimento</label>
                        <select class="form-control" name="venc_mes" id="venc_mes" required>
                          <option value="" selected disabled>Mês</option>
                          <option value="01">Janeiro</option>
                          <option value="02">Fevereiro</option>
                          <option value="03">Março</option>
                          <option value="04">Abril</option>
                          <option value="05">Maio</option>
                          <option value="06">Junho</option>
                          <option value="07">Julho</option>
                          <option value="08">Agosto</option>
                          <option value="09">Setembro</option>
                          <option value="10">Outubro</option>
                          <option value="11">Novembro</option>
                          <option value="12">Dezembro</option>
                        </select>
                      </div>
                      <div class="form-group col-xs-12 col-sm-3">
                        <label for="venc_ano">Ano do vencimento</label>
                        <input type="number" min="<?php echo date("Y"); ?>" max="2036" class="form-control" id="venc_ano" name="venc_ano" value="<?php echo date("Y"); ?>" required />
                      </div>
										</div>
                    <div class="row">
                      <div class="form-group col-xs-12 col-sm-12">
                        <label for="respostaA">Resposta A</label>
                        <textarea rows="3" class="form-control" id="respostaA" name="respostaA" placeholder="Digite a resposta" required ></textarea>
                      </div>
                      <div class="form-group col-xs-12 col-sm-12">
                        <label for="respostaB">Resposta B</label>
                        <textarea rows="3" class="form-control" id="respostaB" name="respostaB" placeholder="Digite a resposta" required ></textarea>
                      </div>
                      <div class="form-group col-xs-12 col-sm-12">
                        <label for="respostaC">Resposta C</label>
                        <textarea rows="3" class="form-control" id="respostaC" name="respostaC" placeholder="Digite a resposta" required ></textarea>
                      </div>
                      <div class="form-group col-xs-12 col-sm-12">
                        <label for="respostaD">Resposta D</label>
                        <textarea rows="3" class="form-control" id="respostaD" name="respostaD" placeholder="Digite a resposta" required ></textarea>
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

						<div class="col-xs-12">
              <div class="box">
                <div class="box-header">  
                    <h3 class="box-title">Enquetes cadastradas</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <form id="formEnquete" class="col s12" method="POST" enctype="multipart/form-data">
                    <?php
                      $categoryDistinct = mysqli_query($conexao, "SELECT * from `app_enquetes_perguntas`");
                      while ($row = mysqli_fetch_assoc($categoryDistinct)) {
                        ?>
                          <div class="callout callout-danger">
                            <a href="enquete-delete.php?eqt=<?php echo $row["id"] ?>" style="float: right;">
                              <button class="btn btn-danger btn-sm" type="button">Excluir</button>
                            </a>
                            <a href="enquete-item.php?n=<?php echo $row["id"]?>">
                              <h4><?php echo $row["pergunta"]?></h4>
                            </a>
                            <div> Vencimento: <?php echo date("d/m/Y", strtotime($row["vencimento"])); ?></div>
                          </div>
                        <?php
                      }
                    ?>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
      </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
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
    <script src="../../js/enquetes.js" type="text/javascript"></script>
  </body>
</html>