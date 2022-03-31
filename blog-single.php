<?php

require_once ('admin/_inc/dbconfig.php');

$mysql_data = array();
$con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()){
	$result  = 'error';
	$message = 'Failed to connect to database: ' . mysqli_connect_error();
	$job     = '';
}

//DATOS BANDERILLA
$queryBand =  "SELECT * FROM empresa_contacto WHERE ubicacion = 'BANDERILLA'";
$resBand = mysqli_query($con, $queryBand);
if (!$resBand){
	$result  = 'error';
	$message = 'query error';
} else {
	$result  = 'success';
	$message = 'query success';
	$rowband = mysqli_fetch_array($resBand);
	$mysql_data[] = array(
		"ubicacion"           => $rowband['ubicacion'],
		"telefono_ubicacion"  => $rowband['telefono_ubicacion'],
		"correo_ubicacion"    => $rowband['correo_ubicacion'],
		"horario_1_ubicacion" => $rowband['horario_1_ubicacion'],
		"horario_2_ubicacion" => $rowband['horario_2_ubicacion'],
		"horario_3_ubicacion" => $rowband['horario_3_ubicacion'],
		"direccion_ubicacion" => $rowband['direccion_ubicacion']
	);
}

//DATOS NOTA
$queryNota =  "select *
from blog b
INNER JOIN users u ON b.fk_id_user = u.id WHERE id_nota_blog = ".$_GET['idblog']." ";
$resNota = mysqli_query($con, $queryNota);
$rowNota = mysqli_fetch_array($resNota);

//DATOS HISTORIA
$queryhist =  "SELECT * FROM empresa WHERE id_empresa = 1";
$reshist = mysqli_query($con, $queryhist);
if (!$reshist){
	$result  = 'error';
	$message = 'query error';
} else {
	$result  = 'success';
	$message = 'query success';
	$rowhist = mysqli_fetch_array($reshist);
	$mysql_data[] = array(
		"texto_principal_linea1"     => $rowhist['texto_principal_linea1'],
		"texto_principal_linea2"     => $rowhist['texto_principal_linea2'],
		"texto_principal_linea3"     => $rowhist['texto_principal_linea3'],
		"url_video_principal"        => $rowhist['url_video_principal'],
		"mensaje_principal_contacto" => $rowhist['mensaje_principal_contacto'],
		"texto_historia"             => $rowhist['texto_historia']
	);
}

//ULTIMOS TRES POST
$queryblog =  "SELECT * FROM blog b
INNER JOIN users u ON b.fk_id_user = u.id
ORDER BY b.id_nota_blog DESC LIMIT 3";
$resblog = mysqli_query($con, $queryblog);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="" />
	<meta property="og:title" content=""/>
	<meta property="og:description" content="" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON -->
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

	<!-- PAGE TITLE HERE -->
	<title> La posta - <?php echo utf8_encode($rowNota['titulo_nota']); ?></title>

	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/plugins.css">
	<link rel="stylesheet" type="text/css" href="css/style.min.css">
	<link class="skin"  rel="stylesheet" type="text/css" href="css/skin/skin-1.css">
	<link  rel="stylesheet" type="text/css" href="css/templete.min.css">

</head>
<body id="bg">
<div id="loading-area"></div><div class="page-wraper">
    <!-- header -->
    <header class="site-header header header-style-2 dark-primary mo-left">
        <!-- top bar -->
        <div class="top-bar bg-primary">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="dez-topbar-left">
                        <ul class="social-line text-center pull-right">
                            <li><a href="javascript:void(0);"><i class="fa fa-phone"></i> <span><?php echo $rowband['telefono_ubicacion']; ?></span> </a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-clock-o"></i> <span><?php echo $rowband['correo_ubicacion']; ?></span></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-envelope-o"></i> <span><?php echo $rowband['horario_1_ubicacion']; ?>&nbsp;<?php echo $rowband['horario_2_ubicacion']; ?>&nbsp;<?php echo $rowband['horario_3_ubicacion']; ?></span></a></li>
                        </ul>
                    </div>
                    <div class="dez-topbar-right">
                        <ul class="social-line text-center pull-right">
                            <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                            <!-- <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-google-plus"></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- top bar END-->
        <!-- main header -->
        <div class="sticky-header  main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion"><a href="index.php"><img src="images/logo.png" width="193" height="89" alt=""></a></div>
                    <!-- nav toggle button -->
					<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <!-- extra nav -->
                    <!-- <div class="extra-nav">
                        <div class="extra-cell">
                            <button id="quik-search-btn" type="button" class="site-button-link"><i class="fa fa-search"></i></button>
                        </div>
                    </div> -->
                    <!-- Quik search -->
                    <!-- <div class="dez-quik-search bg-primary">
                        <form action="#">
                            <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                            <span  id="quik-search-remove"><i class="fa fa-remove"></i></span>
                        </form>
                    </div> -->
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse" id="navbarNavDropdown">
                        <ul class="nav navbar-nav">
                            <li class=""> <a href="index.php">Inicio<i class="fa fa-chevron-down"></i></a>
                            </li>
                            <li> <a href="nosotros.php">Nosotros<i class="fa fa-chevron-down"></i></a>
                            </li>
                            <li class=""> <a href="productos.php">Productos<i class="fa fa-chevron-down"></i></a>
                            </li>
                            <li class=""> <a href="blog.php">Blog<i class="fa fa-chevron-down"></i></a>
                            </li>
                            <li class=""> <a href="galeria.php">Galería<i class="fa fa-chevron-down"></i></a>
                            </li>
                            <li class=""> <a href="contacto.php">Contacto<i class="fa fa-chevron-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/banner/bnr1.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white"><?php echo utf8_encode($rowNota['titulo_nota']); ?></h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="#">Home</a></li>
                    <li><?php echo utf8_encode($rowNota['titulo_nota']); ?></li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <div class="section-full content-inner">
            <div class="container">
                <!-- blog start -->
                <div class="blog-post blog-single">
                    <div class="dez-post-title ">
                        <h3 class="post-title"><a href="#"><?php echo utf8_encode($rowNota['titulo_nota']); ?></a></h3>
                    </div>
                    <div class="dez-post-meta m-b20">
                        <ul>
                            <li class="post-date"> <i class="fa fa-calendar"></i><?php echo $rowNota['fecha_alta']; ?></li>
                            <li class="post-author"><i class="fa fa-user"></i>Por <a href="#"><?php echo utf8_encode($rowNota['name']); ?></a> </li>
                            <!--<li class="post-comment"><i class="fa fa-comments"></i> <a href="#">0 Comentarios</a> </li>-->
                        </ul>
                    </div>
                    <div class="dez-post-media dez-img-effect zoom-slow"> <a href="#"><img src="blog/<?php echo $rowNota['imagen_nota']; ?>" alt=""></a> </div>
                    <div class="dez-post-text">
                        <?php echo utf8_encode($rowNota['texto_nota']); ?>
                        <!--
                        <p>El subsector agrícola mexicano proporciona la mayoría de los insumos para alimentar al ganado mexicano, lo que da como resultado colocar a México en el 7mo lugar a nivel mundial en la producción de proteína animal</p>
                        <p>La buena nutrición del sector pecuario es clave para garantizar la seguridad alimentaria y el abasto de proteína animal principalmente para consumo interno y para que los ganaderos accedan a más mercados internacionales,
                            del mismo modo que una adecuada nutrición también contribuye a posicionar a México como el séptimo lugar a nivel mundial en la producción de proteína animal.</p>
                        <p>El subsector ganadero va de la mano con el sector agrícola mexicano, pues éstos últimos son quienes le proporcionan la mayoría de sus insumos alimentación, éste produce:</p>
                        <p>Granos como:</p>
                        <p>
                            <ul>
                                <li>Sorgo 3 millones 601 mil 545 t</li>
                                <li>Maíz   16 millones 768 mil 431 t</li>
                                <li>Avena            8 millones 331 mil 396 t</li>
                                <li>Pastos y pradera 52 millones 069 mil 061 t</li>
                            </ul>
                        </p>

                        <p>Según datos del Consejo Nacional de Fabricantes de Alimentos Balanceados y de la Nutrición Animal (Conafab) México es el sexto productor mundial de alimentos balanceados para animales, con más de 34.8 toneladas anuales,
                            lo que lo convierte en una pieza clave en el desarrollo económico y social del país. De la producción total, 48.9 por ciento se destina a la avicultura, 15.9 a la porcicultura, 11.1 para bovinos y 15.7 por ciento para el sector lechero.</p>
                        <p>Fuente: https://www.gob.mx/agricultura/es/articulos/que-come-el-ganado?idiom=es</p>
                        -->
                    </div>
                </div>
                <!-- blog END -->
            </div>
        </div>
    </div>
    <!-- Content END-->
<!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top" style="background-image:url(images/logo.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget_about">
                            <div class="logo-footer"><img src="images/logo.png" alt=""></div>
                            <p class="m-tb20"><?php echo utf8_encode($rowhist['texto_historia']); ?></p>
                            <ul class="dez-social-icon dez-social-icon-lg">
                                <li><a href="javascript:void(0);" class="fa fa-facebook fb-btn"></a></li>
                                <!-- <li><a href="javascript:void(0);" class="fa fa-twitter tw-btn"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-linkedin link-btn"></a></li>
                                <li><a href="javascript:void(0);" class="fa fa-pinterest-p pin-btn"></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget recent-posts-entry">
                            <h4 class="m-b15 text-uppercase">Últimas publicaciones</h4>
                            <div class="dez-separator bg-primary"></div>
                            <div class="widget-post-bx">
                                <!--
                                $mysql_data[] = array(
                                        "texto_principal_linea1"     => $rowblog['texto_principal_linea1'],
                                        "texto_principal_linea2"     => $rowblog['texto_principal_linea2']
                                );
                                -->
                                <?php
                                while ($rowblog = mysqli_fetch_array($resblog)) {
                                ?>
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="blog/<?php echo $rowblog['imagen_nota'];?>" alt="" width="200" height="143"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single.php?idblog=<?php echo $rowblog['id_nota_blog']; ?>"><?php echo utf8_encode($rowblog['titulo_nota']);?></a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">Por <a href="#"><?php echo utf8_encode($rowblog['name']);?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!--
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="images/banner/bnr1.jpg" alt="" width="200" height="143"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single.php">¿Qué come el ganado?</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="#">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 0</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="images/banner/bnr2.jpg" alt="" width="200" height="160"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single-2.php">México ya es 5° productor mundial de alimentos balanceados</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="#">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 0</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="images/banner/bnr3.jpg" alt="" width="200" height="160"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single-3.php">México, cuarto productor de alimentos balanceados en el mundo</a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">By <a href="#">Admin</a></li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 0</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget_services">
                            <h4 class="m-b15 text-uppercase">Nuestros servicios</h4>
                            <div class="dez-separator bg-primary"></div>
                            <ul>
                                <li><a href="productos/vacas/vacas.php">Alimento Bovinos</a></li>
                                <li><a href="productos/cerdos/cerdos.php">Alimento Porcinos</a></li>
                                <li><a href="productos/caballos/caballos.php">Alimento Equinoss</a></li>
                                <li><a href="productos/borregos/borregos.php">Alimento Ovinos</a></li>
                                <li><a href="productos/aves/aves.php">Alimento Aves</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget_getintuch">
                            <h4 class="m-b15 text-uppercase">Contacto</h4>
                            <div class="dez-separator bg-primary"></div>
                            <ul>
                                <li><i class="fa fa-map-marker"></i><strong>Dirección</strong><?php echo $rowband['direccion_ubicacion']; ?></li>
                                <li><i class="fa fa-phone"></i><strong>Teléfonos</strong><?php echo $rowband['telefono_ubicacion']; ?></li>
                                <li><i class="fa fa-fax"></i><strong>Correo</strong><?php echo $rowband['correo_ubicacion']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom part -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 text-left"> <span>© 2021 La Posta</span> </div>
                    <div class="col-lg-4 text-center"> <span> Develop by <i class="fa fa-heart text-primary heart"></i> By Iwebyou</span> </div>
                    <div class="col-lg-4 text-right "> <a href="nosotros.php"> Nosotros</a></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END-->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JavaScript  files ========================================= -->
<script src="js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="js/dz.ajax.js"></script><!-- CONTACT JS  -->

<script src="js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="js/dz.carousel.min.js"></script><!-- SORTCODE FUCTIONS  -->
</body>
</html>
