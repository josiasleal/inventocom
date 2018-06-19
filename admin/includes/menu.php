<!-- <?php $baseUrl = '/comerciarios/admin'?> //TODO: -->
<?php $baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . '/admin' ?>

<ul class="sidebar-menu">   
	<li class="active">
		<a href="<?php echo $baseUrl ?>/">
			<i class="fa fa-dashboard"></i> <span>Home</span>
		</a>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-file-text-o"></i>
			<span>Notícias</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseUrl ?>/pages/noticias/todas.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
			<li><a href="<?php echo $baseUrl ?>/pages/noticias/incluir.php"><i class="fa fa-angle-double-right"></i> Incluir</a></li>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-dribbble"></i>
			<span>Lazer</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseUrl ?>/pages/tabela/clubeDeCampo.php"><i class="fa fa-angle-double-right"></i> Clube de Campo</a></li>
			<li><a href="<?php echo $baseUrl ?>/pages/tabela/clubeDeCampo-fotos.php"><i class="fa fa-angle-double-right"></i> Clube de Campo - Galeria</a></li>
			<li><a href="<?php echo $baseUrl ?>/pages/tabela/coloniaDeFerias.php"><i class="fa fa-angle-double-right"></i> Colônia de Férias</a></li>
			<li><a href="<?php echo $baseUrl ?>/pages/tabela/coloniaDeFerias-fotos.php"><i class="fa fa-angle-double-right"></i> Colônia de Férias - Galeria</a></li>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-paperclip"></i>
			<span>Atendimento Jurídico</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo $baseUrl ?>/pages/atendimentoJuridico/faq.php"><i class="fa fa-angle-double-right"></i> FAQ </a></li>
		</ul>
	</li>
	<!-- <li><a href="<?php echo $baseUrl ?>/pages/enquetes/index.php"><i class="fa fa-file-text-o"></i> Enquetes</a></li> -->
	<li><a href="<?php echo $baseUrl ?>/pages/push/index.php"><i class="fa fa-mobile"></i> Push Notification</a></li>
</ul>