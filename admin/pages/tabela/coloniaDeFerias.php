<?php include '../../aut.php' ?>
<?php include '../../access.php' ?>
<?php include '../../functions.php' ?>

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
            #formColoniaFerias input{
                width: 95%;
            }
        </style>
        <!-- header logo: style can be found in header.less -->
        <?php
            define("BASE_URL", "../../");
            include BASE_URL . "includes/header.php";
        ?>
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
                    <?php include BASE_URL . "includes/menu.php"; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
							<!-- Content Header (Page header) -->
							<section class="content-header">
									<h1>
											Lazer
											<small></small>
									</h1>
							</section>

							<!-- Main content -->
							<section class="content">
								<div class="row">
								<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Colônia de Férias - Conteúdo</h3>                                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <form id="formDatacoloniaDeFerias" class="col s12" action="lazerSendData.php" method="POST" enctype="multipart/form-data">
										<div class="row">
												<?php
                            $sql = "SELECT * FROM `app_lazer` WHERE `categoria` = 'coloniaDeFerias'";
                            $result = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($result) == 0) {
                                echo "Não foi encontrado nenhum resultado.";
                                exit;
                            }

                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="titulo">Título</label>
														<input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $row["titulo"] ?>" />
														<input type="hidden" name="tipoDeLazer" value="coloniaDeFerias" />
													</div>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="description">Texto de Descrição</label>
                            <textarea rows="3" cols="3" required class="form-control" id="description" name="description" value="<?php echo $row["description"] ?>"><?php echo $row["description"] ?></textarea>
													</div>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="telefone">Telefone</label>
														<input type="text" required class="form-control" id="telefone" name="telefone" value="<?php echo $row["telefone"] ?>" size="10" maxlength="10" />
													</div>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="localizacao">Localização</label>
														<input type="text" required class="form-control" id="localizacao" name="localizacao" value="<?php echo $row["localizacao"] ?>" />
													</div>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="gmaps_embed">Google Maps Embed </label>
														<input type="text" required class="form-control" id="gmaps_embed" name="gmaps_embed" value="<?php echo htmlentities($row["gmaps_embed"]) ?>" />
													</div>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="gmaps_link">Link do Google Maps</label>
														<textarea rows="3" cols="3" required class="form-control" id="gmaps_link" name="gmaps_link" value="<?php echo $row["gmaps_link"] ?>"><?php echo $row["gmaps_link"] ?></textarea>
													</div>
													<div class="form-group col-xs-12 col-sm-3">
														<label for="img_cover">Imagem de capa atual:</label>
														<img src="/app-data/api/img/coloniaDeFerias/img_cover.jpg" alt="Imagem de capa atual" title="Imagem de capa atual" style="max-width: 100%;">
													</div>
													<div class="form-group col-xs-12 col-sm-3">
															<label for="img_cover">Alterar imagem de capa</label>
															<input type="file" name="img_cover" id="img_cover" accept=".jpg,.jpeg">
															<p class="help-block">Formato JPG</p>
													</div>
                        <?php } ?>
										</div>
                    <div class="row">
											<div class="col-xs-12 text-right">
												<button class="btn btn-success">Enviar</button>
											</div>
                    </div>
                  </form>
                  <div class="box-header">
                    <a href="<?php echo $baseUrl ?>/pages/tabela/coloniaDeFerias-fotos.php" class="btn btn-success" style="color: #fff;">Gerenciar fotos</a>                                    
                  </div><!-- /.box-header -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
									<div class="col-xs-12">
										<div class="box">
											<div class="box-header">
												<h3 class="box-title">Colônia de Férias - Tabela de Preços</h3>                                    
											</div><!-- /.box-header -->
											<div class="box-body table-responsive">
												<form action="preencheColoniaDeFerias.php" method="POST" id="formColoniaFerias" class="col s12">
													<table class="table table-bordered table-hover" style="margin-bottom: 50px">
															<thead>
																	<tr>
																			<th></th>
																			<th>Apartamento Comum</th>
																			<th>Suíte (casal)</th>
																	</tr>
															</thead>
															<tbody>
															<?php
																	$sql = "SELECT * FROM `app_coloniadeferiastable` WHERE `tipo` = 1";
																	$result = mysqli_query($conexao, $sql);

																	if (mysqli_num_rows($result) == 0) {
																			echo "Não foi encontrado nenhum resultado.";
																			exit;
																	}

																	while ($row = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																			<td><?php echo $row["titulo"]?></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Um" ?>" value="<?php echo realBR($row["valorUm"])?>"></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Dois" ?>" value="<?php echo realBR($row["valorDois"])?>"></td>
																	</tr>
															<?php } ?>
															</tbody>
													</table>
													<table class="table table-bordered table-hover" style="margin-bottom: 50px">
															<thead>
																	<tr>
																			<th colspan="3">Outros Parentes (serão considerados: Pai, Mãe, Sogro, Sogra, Irmãos(as), do sócio, Filhos maiores, Genros, Noras, Netos e Netas)</th>
																	</tr>
															</thead>
															<tbody>
																	<?php
																			$sql = "SELECT * FROM `app_coloniadeferiastable` WHERE `tipo` = 2";
																			$result = mysqli_query($conexao, $sql);

																			if (mysqli_num_rows($result) == 0) {
																					echo "Não foi encontrado nenhum resultado.";
																					exit;
																			}

																			while ($row = mysqli_fetch_assoc($result)) {
																	?>
																			<tr>
																					<td><?php echo $row["titulo"]?></td>
																					<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Um" ?>" value="<?php echo realBR($row["valorUm"])?>"></td>
																					<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Dois" ?>" value="<?php echo realBR($row["valorDois"])?>"></td>
																			</tr>
																	<?php } ?>
															</tbody>
													</table>
													<table class="table table-bordered table-hover" style="margin-bottom: 50px">
															<thead>
																	<tr>
																			<th colspan="3">Convidados do associado</th>
																	</tr>
															</thead>
															<tbody>
															<?php
																	$sql = "SELECT * FROM `app_coloniadeferiastable` WHERE `tipo` = 3";
																	$result = mysqli_query($conexao, $sql);

																	if (mysqli_num_rows($result) == 0) {
																			echo "Não foi encontrado nenhum resultado.";
																			exit;
																	}

																	while ($row = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																			<td><?php echo $row["titulo"]?></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Um" ?>" value="<?php echo realBR($row["valorUm"])?>"></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Dois" ?>" value="<?php echo realBR($row["valorDois"])?>"></td>
																	</tr>
															<?php } ?>
															</tbody>
													</table>
													<table class="table table-bordered table-hover" style="margin-bottom: 50px">
															<thead>
																	<tr>
																			<th colspan="3">Sócio Usuário</th>
																	</tr>
															</thead>
															<tbody>
															<?php
																	$sql = "SELECT * FROM `app_coloniadeferiastable` WHERE `tipo` = 4";
																	$result = mysqli_query($conexao, $sql);

																	if (mysqli_num_rows($result) == 0) {
																			echo "Não foi encontrado nenhum resultado.";
																			exit;
																	}

																	while ($row = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																			<td><?php echo $row["titulo"]?></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Um" ?>" value="<?php echo realBR($row["valorUm"])?>"></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Dois" ?>" value="<?php echo realBR($row["valorDois"])?>"></td>
																	</tr>
															<?php } ?>
															</tbody>
													</table>
													<table class="table table-bordered table-hover" style="margin-bottom: 50px">
															<thead>
																	<tr>
																			<th colspan="3">Outro parentes do Sócio Usuário</th>
																	</tr>
															</thead>
															<tbody>
															<?php
																	$sql = "SELECT * FROM `app_coloniadeferiastable` WHERE `tipo` = 5";
																	$result = mysqli_query($conexao, $sql);

																	if (mysqli_num_rows($result) == 0) {
																			echo "Não foi encontrado nenhum resultado.";
																			exit;
																	}

																	while ($row = mysqli_fetch_assoc($result)) {
															?>
																	<tr>
																			<td><?php echo $row["titulo"]?></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Um" ?>" value="<?php echo realBR($row["valorUm"])?>"></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Dois" ?>" value="<?php echo realBR($row["valorDois"])?>"></td>
																	</tr>
															<?php } ?>
															</tbody>
													</table>
													<table class="table table-bordered table-hover" style="margin-bottom: 50px">
															<thead>
																	<tr>
																			<th colspan="3">Convidados do Sócio Usuário</th>
																	</tr>
															</thead>
															<tbody>
															<?php
																	$sql = "SELECT * FROM `app_coloniadeferiastable` WHERE `tipo` = 6";
																	$result = mysqli_query($conexao, $sql);

																	if (mysqli_num_rows($result) == 0) {
																			echo "Não foi encontrado nenhum resultado.";
																			exit;
																	}

																	while ($row = mysqli_fetch_assoc($result)) {

															?>
																	<tr>
																			<td><?php echo $row["titulo"]?></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Um" ?>" value="<?php echo realBR($row["valorUm"])?>"></td>
																			<td>R$ <input type="text" class="money" name="<?php echo $row["id"] . "Dois" ?>" value="<?php echo realBR($row["valorDois"])?>"></td>
																	</tr>
															<?php } ?>
															</tbody>
													</table>
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
							</section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

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