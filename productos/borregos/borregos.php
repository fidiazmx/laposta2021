<?php

require_once ('../../admin/_inc/dbconfig.php');

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
$resblog2 = mysqli_query($con, $queryblog);        
// if (!$resblog){
// 	$result  = 'error';
// 	$message = 'query error';
// } else {
// 	$result  = 'success';
// 	$message = 'query success';       
// }

//TOTAL PRODUCTOS
$querytotprod =  "SELECT COUNT(*) tot_prod, c.descripcion_categoria
FROM productos p 
INNER JOIN categorias c ON p.fk_id_categoria = c.id_categoria
WHERE p.activo = 'A'
GROUP BY c.id_categoria"; 
$restotprod = mysqli_query($con, $querytotprod);    
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
	<meta property="og:title" content=" GardenZone - Gardening Template"/>
	<meta property="og:description" content="" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
	
	<!-- PAGE TITLE HERE -->
	<title> La Posta - Borregos</title>
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="../../css/plugins.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.min.css">
	<link class="skin"  rel="stylesheet" type="text/css" href="../../css/skin/skin-1.css">
	<link  rel="stylesheet" type="text/css" href="../../css/templete.min.css">

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
                    <div class="logo-header mostion"><a href="index.php"><img src="../../images/logo.png" width="193" height="89" alt=""></a></div>
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
                            <li class=""> <a href="../../nosotros.php">Nosotros<i class="fa fa-chevron-down"></i></a>									
                            </li>
                            <li class="active"> <a href="../../productos.php">Productos<i class="fa fa-chevron-down"></i></a>									
                            </li>
                            <li class=""> <a href="../../blog.php">Blog<i class="fa fa-chevron-down"></i></a>									
                            </li>
                            <li class=""> <a href="../../galeria.php">Galería<i class="fa fa-chevron-down"></i></a>									
                            </li>								
                            <li class=""> <a href="../../contacto.php">Contacto<i class="fa fa-chevron-down"></i></a>									
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
    <div class="page-content">    
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(../../images/banner/breadcumbs-caballos.png);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Borregos</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->    
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="#">Inicio</a></li>
                    <li>Productos</li>
                    <li>Borregos</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="content-inner section-full bg-white">
            <!-- Product -->
            <div class="container">
				<div class="row m-b40">
					<div class="col-lg-4 col-sm-6 m-b30">
						<div class="dez-box add-product">
							<div class="dez-media dez-img-effect"> <img src="images/ads/thum1.jpg" alt="">
								<div class="dez-info-has p-a20 bg-black no-hover">
									<div class="clearfix">
										<h3 class="m-t0 m-b5">We Have The Expertise</h3>
										<h2>150$<del class="m-lr15">180$</del></h2> 
									</div>
									<div class="clearfix">
										<a href="#" class="site-button">Add To Cart</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 m-b30">
						<div class="dez-box add-product">
							<div class="dez-media dez-img-effect"> <img src="images/ads/thum2.jpg" alt="">
								<div class="dez-info-has p-a20 bg-black no-hover">
									<div class="clearfix">
										<h3 class="m-t0 m-b5">We Have The Expertise</h3>
										<h2>910$<del class="m-lr15">2900$</del></h2> 
									</div>
									<div class="clearfix">
										<a href="#" class="site-button">Add To Cart</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 m-b30">
						<div class="dez-box add-product">
							<div class="dez-media dez-img-effect"> <img src="images/ads/thum3.jpg" alt="">
								<div class="dez-info-has p-a20 bg-black no-hover">
									<div class="clearfix">
										<h3 class="m-t0 m-b5">We Have The Expertise</h3>
										<h2>210$<del class="m-lr15">220$</del></h2> 
									</div>
									<div class="clearfix">
										<a href="#" class="site-button">Add To Cart</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-lg-3 col-md-4 col-sm-6">
						<aside class="side-bar">
                            <!--<div class="widget">
                                <h4 class="widget-title">Search</h4>
                                <div class="search-bx">
                                    <form role="search" method="post">
                                        <div class="input-group">
                                            <input name="text" type="text" class="form-control" placeholder="Write your text">
                                            <span class="input-group-btn">
												<button type="submit" class="site-button"><i class="fa fa-search"></i></button>
                                            </span> 
										</div>
                                    </form>
                                </div>
                            </div>-->
                            <div class="widget recent-posts-entry">
                                <h4 class="widget-title">Últimas noticias</h4>
                                <div class="widget-post-bx">
									<?php
                                	while ($rowblog = mysqli_fetch_array($resblog)) {                                                                 
                                	?>
									<div class="widget-post clearfix">
                                        <div class="dez-post-media"> <img src="../../blog/<?php echo $rowblog['imagen_nota'];?>" width="200" height="143" alt=""> </div>
                                        <div class="dez-post-info">
                                            <div class="dez-post-header">
                                                <h6 class="post-title"><a href="../../blog-single.php?id=<?php echo $rowblog['id_nota_blog']; ?>"><?php echo $rowblog['titulo_nota'];?></a></h6>
                                            </div>
                                            <div class="dez-post-meta">
                                                <ul>
                                                    <li class="post-date"><?php echo $rowblog["fecha_alta"]; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
									<?php
									}
									?>
									<!--
                                    <div class="widget-post clearfix">
                                        <div class="dez-post-media"> <img src="../../images/banner/bnr1.jpg" width="200" height="143" alt=""> </div>
                                        <div class="dez-post-info">
                                            <div class="dez-post-header">
                                                <h6 class="post-title"><a href="../../blog-single.php">Noticia 1</a></h6>
                                            </div>
                                            <div class="dez-post-meta">
                                                <ul>
                                                    <li class="post-date">3 de diciembre 2021</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-post clearfix">
                                        <div class="dez-post-media"> <img src="../../images/banner/bnr2.jpg" width="200" height="160" alt=""> </div>
                                        <div class="dez-post-info">
                                            <div class="dez-post-header">
                                                <h6 class="post-title"><a href="../../blog-single-2.php">Noticia 2</a></h6>
                                            </div>
                                            <div class="dez-post-meta">
                                                <ul>
                                                    <li class="post-date">3 de diciembre 2021</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-post clearfix">
                                        <div class="dez-post-media"> <img src="../../images/banner/bnr3.jpg" width="200" height="160" alt=""> </div>
                                        <div class="dez-post-info">
                                            <div class="dez-post-header">
                                                <h6 class="post-title"><a href="../../blog-single-3.php">Noticia 3</a></h6>
                                            </div>
                                            <div class="dez-post-meta">
                                                <ul>
                                                    <li class="post-date">3 de diciembre 2021</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
									-->	
                                </div>
                            </div>
							<div class="widget">
                                <img src="images/ads/add.png" alt=""/>
                            </div>
                            <div class="widget widget_categories">
                                <h4 class="widget-title">Categorías</h4>
                                <ul>
									<?php
                                	while ($rowtotp = mysqli_fetch_array($restotprod)) {                                                                 
                                	?>
									<li><a href="#"><?php echo $rowtotp["descripcion_categoria"]; ?> </a> <?php echo $rowtotp["tot_prod"]; ?></li>
									<!--
                                    <li><a href="../vacas/vacas.php">Vacas </a> (10)</li>
                                    <li><a href="../cerdos/cerdos.php">Cerdos </a> (05) </li>
                                    <li><a href="../caballos/caballos.php">Caballos </a> (08) </li>
                                    <li><a href="../borregos/borregos.php">Borregos</a> (06) </li>
                                    <li><a href="../aves/aves.php">Aves </a> (11) </li>                                    
									-->
									<?php
									}
									?>
                                </ul>
                            </div>
                            <!--<div class="widget widget_gallery">
								<h4 class="widget-title">Our services</h4>
                                <ul>
                                    <li><a href="#"><div class="dez-post-thum dez-img-overlay1 dez-img-effect zoom-slow">
										<img src="images/gallery/pic2.jpg" alt=""></div></a></li>
                                    <li><a href="#"><div class="dez-post-thum dez-img-overlay1 dez-img-effect zoom-slow">
										<img src="images/gallery/pic1.jpg" alt=""></div></a></li>
                                    <li><a href="#"><div class="dez-post-thum dez-img-overlay1 dez-img-effect zoom-slow">
										<img src="images/gallery/pic5.jpg" alt=""></div></a></li>
                                    <li><a href="#"><div class="dez-post-thum dez-img-overlay1 dez-img-effect zoom-slow">
										<img src="images/gallery/pic7.jpg" alt=""></div></a></li>
                                    <li><a href="#"><div class="dez-post-thum dez-img-overlay1 dez-img-effect zoom-slow">
										<img src="images/gallery/pic8.jpg" alt=""></div></a></li>
                                    <li><a href="#"><div class="dez-post-thum dez-img-overlay1 dez-img-effect zoom-slow">
										<img src="images/gallery/pic9.jpg" alt=""></div></a></li>
                                </ul>
                            </div>
                            <div class="widget widget_tag_cloud">
								<h4 class="widget-title">Tags</h4>
                                <div class="tagcloud"> 
									<a href="#">Design</a>
									<a href="#">User interface</a>
									<a href="#">SEO</a>
									<a href="#">WordPress</a>
									<a href="#">Development</a>
									<a href="#">Joomla</a>
									<a href="#">Design</a>
									<a href="#">User interface</a>
									<a href="#">SEO</a>
									<a href="#">WordPress</a>
									<a href="#">Development</a>
									<a href="#">Joomla</a>
									<a href="#">Design</a>
								</div>
                            </div>-->
                        </aside>
					</div>
                    <div class="col-lg-9 col-md-8 col-sm-6">
						<div class="text-center m-b50">
							<h2 class="m-t0">Últimos Productos</h2>
							<div class="dez-separator-outer "><div class="dez-separator bg-primary style-skew"></div> </div>
						</div>
						<div class="row" id="masonry">
							<?php
								$querydetprod =  "SELECT id_producto, descripcion_producto, imagen_catalogo FROM productos WHERE activo = 'A' and fk_id_categoria = 4"; 
								$resqrydetprod = mysqli_query($con, $querydetprod);
							?>
							<?php
                                while ($rowbdetprod = mysqli_fetch_array($resqrydetprod)) {                                                                 
                            ?>
								<div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
									<div class="dez-box">
										<div class="dez-thum-bx dez-img-effect">
											<img src="../../productos/borregos/<?php echo $rowbdetprod['imagen_catalogo']; ?>" alt="">										
										</div>
										<div class="dez-info p-a20 text-center">
											<div class="m-t15">
												<a href="../detalle-producto.php?idproducto=<?php echo $rowbdetprod['id_producto']; ?>&categoria=borregos&producto=<?php echo $rowbdetprod['descripcion_producto']; ?>" class="site-button">Ver detalle	</a>
											</div>
										</div>									
									</div>
								</div>
							<?php
								}
							?>
							<!--
							<div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/lechera_azul.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="lechera-azul-15.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/lechera_naranja.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="lechera-naranja-16.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/lechera18.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="lechera-dorada-18.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/lechera20.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="lechera-20.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/lechera22.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="lechera-22.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/preiniciador_becerras.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<h4 class="dez-title m-t0 m-b5 text-uppercase"><a href="#"></a></h4>
										<div class="m-t15">
											<a href="preiniciador-becerras.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/becerra.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="becerra.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/recria_becerras.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="becerras-recria.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>      
                            <div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box">
									<div class="dez-thum-bx dez-img-effect">
										<img src="../../productos/vacas/engorda_ganado.png" alt="">										
									</div>
									<div class="dez-info p-a20 text-center">
										<div class="m-t15">
											<a href="engorda-ganado.php" class="site-button">Ver detalle	</a>
										</div>
									</div>									
								</div>
                            </div>     
							-->
						</div>
						<!--<div class="row">
							<div class="text-center m-b50 m-t30 col-lg-12">
								<h2 class="m-t0">Best Sellers</h2>
								<div class="dez-separator-outer "><div class="dez-separator bg-primary style-skew"></div> </div>
							</div>
							<div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box ">
									<div class="dez-thum-bx dez-img-effect"> <img src="../../images/product/pic4.jpg" alt="">
										<div class="overlay-bx">
											<div class="overlay-icon"> <a href="javascript:void(0)"> <i class="fa fa-cart-plus icon-bx-xs"></i> </a> <a href="javascript:void(0)"> <i class="fa fa-search icon-bx-xs"></i> </a> <a href="javascript:void(0)"> <i class="fa fa-heart icon-bx-xs"></i> </a> </div>
										</div>
									</div>
									<div class="dez-info p-a20 text-center">
										<h4 class="dez-title m-t0 m-b5 text-uppercase"><a href="#">Measuring Squares</a></h4>
										<h2 class="m-b0"><del class="m-r10">$25.00</del> $20.00 </h2>
										<div class="m-t20">
											<a href="#" class="site-button">Add To Cart	</a>
										</div>
									</div>
									<div class="sale">
										<span class="site-button button-sm red">Sale</span>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-12 m-b30 product-item card-container">
								<div class="dez-box ">
									<div class="dez-thum-bx  dez-img-effect "> <img src="../../images/product/pic5.jpg" alt="">
										<div class="overlay-bx">
											<div class="overlay-icon"> <a href="javascript:void(0)"> <i class="fa fa-cart-plus icon-bx-xs"></i> </a> <a href="javascript:void(0)"> <i class="fa fa-search icon-bx-xs"></i> </a> <a href="javascript:void(0)"> <i class="fa fa-heart icon-bx-xs"></i> </a> </div>
										</div>
									</div>
									<div class="dez-info p-a20 text-center">
										<h4 class="dez-title m-t0 m-b5 text-uppercase"><a href="#">Measuring Squares</a></h4>
										<h2 class="m-b0">$20.00 </h2>
										<div class="m-t20">
											<a href="#" class="site-button">Add To Cart	</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-12 m-auto m-b30 product-item card-container">
								<div class="dez-box ">
									<div class="dez-thum-bx  dez-img-effect "> <img src="../../images/product/pic6.jpg" alt="">
										<div class="overlay-bx">
											<div class="overlay-icon"> <a href="javascript:void(0)"> <i class="fa fa-cart-plus icon-bx-xs"></i> </a> <a href="javascript:void(0)"> <i class="fa fa-search icon-bx-xs"></i> </a> <a href="javascript:void(0)"> <i class="fa fa-heart icon-bx-xs"></i> </a> </div>
										</div>
									</div>
									<div class="dez-info p-a20 text-center">
										<h4 class="dez-title m-t0 m-b5 text-uppercase"><a href="#">Measuring Squares</a></h4>
										<h2 class="m-b0"><del class="m-r10">$25.00</del> $20.00 </h2>
										<div class="m-t20">
											<a href="#" class="site-button">Add To Cart	</a>
										</div>
									</div>
									<div class="sale">
										<span class="site-button button-sm red">Sale</span>
									</div>
								</div>
							</div>
						</div>-->
					</div>
                </div>
				<!--<div class="row m-t30 product-service">
					<div class="col-lg-4 col-md-6 m-b30">
						<div class="icon-bx-wraper bx-style-1 p-a20 left bg-primary clearfix text-white">
							<div class="icon-bx-md  bg-white text-primary"> <a href="#" class="icon-cell "><i class="fa fa-plane"></i></a> </div>
							<div class="icon-content">
								<h3 class="dez-tilte text-uppercase m-b5">Free Shipping</h3>
								<p>Lorem ipsum dolor sit elit nonummy dolor is euismod end...</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 m-b30">
						<div class="icon-bx-wraper bx-style-1 p-a20 left bg-primary clearfix text-white">
							<div class="icon-bx-md bg-white text-primary"> 
								<a href="#" class="icon-cell "><i class="fa fa-briefcase"></i></a> 
							</div>
							<div class="icon-content">
								<h3 class="dez-tilte text-uppercase m-b5">Warehouse</h3>
								<p>Lorem ipsum dolor sit elit nonummy dolor is euismod end...</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 m-b30">
						<div class="icon-bx-wraper bx-style-1 p-a20 left bg-primary clearfix text-white">
							<div class="icon-bx-md bg-white text-primary"> 
								<a href="#" class="icon-cell"><i class="fa fa-cogs"></i></a>
							</div>
							<div class="icon-content">
								<h3 class="dez-tilte text-uppercase m-b5">Secure Shopping</h3>
								<p>Lorem ipsum dolor sit elit nonummy dolor is euismod end...</p>
							</div>
						</div>
					</div>
				</div>-->
				<div class="row">
					<div class="col-md-12">
						<div class="add-plat text-white shop-add" style="background-image:url(images/banner/bnr4.jpg); background-size:100%;
						background-position:center;">
							<h2 class="m-b0">Si tiene alguna duda de clic aquí</h2>
							<a href="../../contacto/contacto-banderilla.php" class="site-button outline yellow">Solicitar cotización</a>
						</div>
					</div>
				</div>
		   </div>
            <!-- Product END -->
        </div>
        <!-- contact area  END -->
    </div>
    <!-- Content END-->
    <!-- Footer -->
	<footer class="site-footer">
        <div class="footer-top" style="background-image:url(images/logo.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget_about">
                            <div class="logo-footer"><img src="../../images/logo.png" alt=""></div>
                            <p class="m-tb20"><?php echo $rowhist['texto_historia']; ?></p>
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
                                while ($rowblog2 = mysqli_fetch_array($resblog2)) {                                                                 
                                ?>
                                <div class="widget-post clearfix">
                                    <div class="dez-post-media"> <img src="../../blog/<?php echo $rowblog2['imagen_nota'];?>" alt="" width="200" height="143"> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-header">
                                            <h6 class="post-title"><a href="blog-single.php?id=<?php echo $rowblog2['id_nota_blog']; ?>"><?php echo $rowblog2['titulo_nota'];?></a></h6>
                                        </div>
                                        <div class="dez-post-meta">
                                            <ul>
                                                <li class="post-author">Por <a href="#"><?php echo $rowblog2['name'];?></a></li>
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
                                <li><a href="productos/vacas/vacas.php">Alimento Vacas</a></li>
                                <li><a href="productos/cerdos/cerdos.php">Alimento Cerdos</a></li>
                                <li><a href="productos/caballos/caballos.php">Alimento Caballos</a></li>
                                <li><a href="productos/borregos/borregos.php">Alimento Borregos</a></li>
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
    <!-- scroll top button -->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JavaScript  files ========================================= -->
<script src="../../js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="../../plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="../../plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="../../plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="../../plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="../../plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="../../plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="../../plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="../../plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="../../plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="../../plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="../../plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="../../js/dz.ajax.js"></script><!-- CONTACT JS  -->

<script src="../../js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="../../js/dz.carousel.min.js"></script><!-- SORTCODE FUCTIONS  -->
</body>
</html>