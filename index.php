<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//echo $_SERVER['HTTP_HOST'];

require_once ('admin/_inc/dbconfig.php');

$mysql_data = array();
$con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()){
	$result  = 'error';
	$message = 'Failed to connect to database: ' . mysqli_connect_error();
	$job     = '';
}

$query =  "SELECT * FROM empresa WHERE id_empresa = 1";
$resultado = mysqli_query($con, $query);
if (!$resultado){
	$result  = 'error';
	$message = 'query error';
} else {
	$result  = 'success';
	$message = 'query success';
	$row = mysqli_fetch_array($resultado);
	$mysql_data[] = array(
		"texto_principal_linea1"     => $row['texto_principal_linea1'],
		"texto_principal_linea2"     => $row['texto_principal_linea2'],
		"texto_principal_linea3"     => $row['texto_principal_linea3'],
		"url_video_principal"        => $row['url_video_principal'],
		"mensaje_principal_contacto" => $row['mensaje_principal_contacto'],
		"texto_historia"             => $row['texto_historia'],
		"clientes_atendidos"         => $row['clientes_atendidos'],
		"formulas_originales"        => $row['formulas_originales'],
		"kg_alimento"             	 => $row['kg_alimento'],
	);
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

//Calcular año
function obtener_edad_segun_fecha($fecha_nacimiento)
{
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}

// Probar
$fechas = ['1987-01-01'];
$anioservicio = 0;
foreach($fechas as $fecha){
	//printf("Edad para %s: %d\n", $fecha, obtener_edad_segun_fecha($fecha));
	$anioservicio = obtener_edad_segun_fecha($fecha);
}

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
	<meta property="og:title" content=" La Posta - Forrajería y Veterinaria"/>
	<meta property="og:description" content="" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON -->
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

	<!-- PAGE TITLE HERE -->
	<title> La Posta - Forrajería y Veterinaria</title>

	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="css/plugins.css">
	<link rel="stylesheet" type="text/css" href="css/style.min.css">
	<link class="skin"  rel="stylesheet" type="text/css" href="css/skin/skin-2.css">
	<link  rel="stylesheet" type="text/css" href="css/templete.min.css">

	<!-- REVOLUTION SLIDER CSS -->
	<link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/settings.css">
	<link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/navigation.css">

</head>
<body id="bg">
<div id="loading-area"></div>
<div class="page-wraper font-roboto">
    <!-- header -->
    <header class="site-header header header-style-6 dark mo-left">
        <div class="middle-bar">
			<div class="container header-contant-block">
				<div class="row">
					<div class="col-xl-4 col-lg-3 d-flex align-items-center">
						<div class="logo-header "><a href="index.php"><img src="images/logo.png" width="193" height="89" alt=""></a></div>
					</div>
					<div class="col-xl-8 col-lg-9">
						<ul class="contact-info clearfix">
							<li>
								<i class="fa fa-envelope-o"></i>
								<h4 class="m-a0"> Oficinas</h4>
								<span><?php echo $rowband['direccion_ubicacion'] ?></span>
							</li>
							<li>
								<i class="fa fa-phone"></i>
								<h4 class="m-a0"> Teléfonos</h4>
								<span style="font-size:13px !important;"><?php echo $rowband['telefono_ubicacion'] ?></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
        <!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="slide-up">
                    <div class="container clearfix">
                        <div class="logo-header mostion">
							<a href="index.php"><img src="images/logo.png" width="193" height="89" alt=""></a>
						</div>
						<!-- nav toggle button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
							<span></span>
							<span></span>
						</button>
                        <!-- extra nav -->
                        <!-- <div class="extra-nav">
                            <div class="extra-cell">
								<ul class="social-line">
									<li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a href="#" class="site-button bg-primary gradient">Get a Free Quote</a>
                            </div>
                        </div> -->
                        <!-- Quik search -->
                        <div class="dez-quik-search bg-primary">
                            <form action="#">
                                <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                                <span  id="quik-search-remove"><i class="fa fa-remove"></i></span>
                            </form>
                        </div>
                        <!-- main nav -->
                        <div class="header-nav navbar-collapse collapse" id="navbarNavDropdown">
                            <ul class="nav navbar-nav">
								<li class="active"> <a href="index.php">Inicio</a>
								</li>
                                <li class=""> <a href="nosotros.php">Nosotros</a>
								</li>
								<li class=""> <a href="productos.php">Productos</a>
								</li>
								<li class=""> <a href="blog.php">Blog</a>
								</li>
								<li class=""> <a href="galeria.php">Galería</a>
								</li>
								<!--<li class=""> <a href="contacto.php">Contacto</a>
								</li>-->
								<li> <a href="javascript:;">Contacto<i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">
										<li><a href="contacto/contacto-banderilla.php">Banderilla</a></li>
										<li><a href="contacto/contacto-acajete.php">Acajete</a></li>
										<li><a href="contacto/contacto-mata-oscura.php">Mata oscura</a></li>
									</ul>
								</li>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
    <!-- Content -->
    <div class="page-content">
        <!-- Slider -->
        <div class="main-slider style-two shap-bottom default-banner" id="home">
            <div class="tp-banner-container">
                <div class="tp-banner" >
					<div id="rev_slider_490_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="image-hero39" data-source="gallery" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
						<!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
						<div id="rev_slider_490_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
							<ul>	<!-- SLIDE  -->
								<li data-index="rs-1699" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="images/main-slider/slide3.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/main-slider/1.png"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
									<!-- LAYERS -->

									<!-- LAYER NR. 1 -->
									<div class="tp-caption tp-shape tp-shapewrapper  "
										id="slide-1699-layer-1"
										data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
										data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
										data-width="full"
										data-height="full"
										data-whitespace="nowrap"

										data-type="shape"
										data-basealign="slide"
										data-responsive_offset="on"
										data-responsive="off"
										data-frames='[{"from":"opacity:0;","speed":1500,"to":"o:1;","delay":750,"ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"ease":"nothing"}]'
										data-textAlign="['left','left','left','left']"
										data-paddingtop="[0,0,0,0]"
										data-paddingright="[0,0,0,0]"
										data-paddingbottom="[0,0,0,0]"
										data-paddingleft="[0,0,0,0]"

										style="z-index: 5;background-color:rgba(0, 0, 0, 0.0);border-color:rgba(0, 0, 0, 0.0);border-width:0px;"> </div>

									<div class="tp-caption NotGeneric-Title tp-resizeme"
										id="slide-1699-layer-2"
										data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']"
										data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-75','-70']"
										data-fontsize="['20','20','18','16']"
										data-lineheight="['20','20','18','16']"
										data-width="none"
										data-height="none"
										data-whitespace="wrap"

										data-type="text"
										data-responsive_offset="on"

										data-frames='[{"from":"z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;","ease":"Power2.easeInOut"}]'
										data-textAlign="['left','left','left','center']"
										data-paddingtop="[10,10,10,10]"
										data-paddingright="[25,25,20,25]"
										data-paddingbottom="[10,10,10,10]"
										data-paddingleft="[25,25,20,25]"

										style="z-index: 7; background:linear-gradient(90deg, rgba(250,180,0,1) 0%, rgba(229,245,3,1) 100%); font-family:Roboto; white-space: wrap; font-weight: 500; border-radius: 10px;"><?php echo $row['texto_principal_linea1']; ?> </div>

									<!-- LAYER NR. 3 -->
									<div class="tp-caption NotGeneric-Title   tp-resizeme"
										id="slide-1699-layer-3"
										data-x="['left','left','left','left']" data-hoffset="['0','0','30','30']"
										data-y="['middle','middle','middle','middle']" data-voffset="['0','0','-20','-15']"
										data-fontsize="['56','56','36','36']"
										data-lineheight="['56','56','36','36']"
										data-width="none"
										data-height="none"
										data-whitespace="wrap"

										data-type="text"
										data-responsive_offset="on"

										data-frames='[{"from":"z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;","ease":"Power2.easeInOut"}]'
										data-textAlign="['left','left','left','center']"
										data-paddingtop="[25,25,20,20]"
										data-paddingright="[50,50,40,40]"
										data-paddingbottom="[25,25,20,20]"
										data-paddingleft="[50,50,40,40]"

										style="z-index: 7; background-color: #fff; font-family:Roboto; color: rgb(250, 180, 0); white-space: wrap; border-radius: 10px;"><img src="images/la_posta_principal.png" alt=""></div>


									<!-- LAYER NR. 3 -->
									<div class="tp-caption NotGeneric-Title   tp-resizeme"
										id="slide-1699-layer-4"
										data-x="['left','left','left','left']" data-hoffset="['200','200','200','120']"
										data-y="['middle','middle','middle','middle']" data-voffset="['80','80','40','50']"
										data-fontsize="['30','30','24','24']"
										data-lineheight="['30','30','24','24']"
										data-width="none"
										data-height="none"
										data-whitespace="wrap"

										data-type="text"
										data-responsive_offset="on"

										data-frames='[{"from":"z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;","ease":"Power2.easeInOut"}]'
										data-textAlign="['left','left','left','center']"
										data-paddingtop="[20,20,15,20]"
										data-paddingright="[35,35,30,35]"
										data-paddingbottom="[20,20,15,20]"
										data-paddingleft="[35,35,30,35]"

										style="z-index: 8; white-space: nowrap; font-weight: 500; font-family:Roboto; background-color: #252220; border-radius: 10px;"><?php echo $row['texto_principal_linea3']; ?> </div>
								</li>
							</ul>
						<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>	</div>
					</div><!-- END REVOLUTION SLIDER -->
				</div>
			</div>
		</div>
		<!-- Slider END -->

		<!--VIDEO-->
		<div class="section-full content-inner about-info-area bg-white">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo substr($row['url_video_principal'],32,11);?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
		<!--FIN VIDEO-->
		<!-- Services -->
		<div class="section-full bg-white content-inner service-style1-area">
            <div class="container">
                <div class="row">
					<div class="col-xl-3 col-lg-12 wow fadeInLeft" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="section-head style1 text-left text-white bg-grading">
							<h3 class="h3">Para todo tipo de ganado</h3>
							<div class="dez-separator bg-white"></div>
							<p>Alimento balanceado</p>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="icon-bx-wraper service-style1 m-b30 center">
							<div class="icon-bx-xl">
								<a href="productos/bovinos/bovinos.php" class="icon-cell">
									<img src="images/icon/icon_vacas.png" alt="">
								</a>
							</div>
							<div class="icon-content">
								<h2 class="dez-tilte text-primary">Bovinos</h2>
								<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>-->
								<a href="productos/bovinos/bovinos.php" class="site-button italic light-gray">Ver más..</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 wow fadeInDown" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="icon-bx-wraper service-style1 m-b30 center">
							<div class="icon-bx-xl">
								<a href="productos/porcinos/porcinos.php" class="icon-cell">
									<img src="images/icon/icon_cerdos.png" alt="">
								</a>
							</div>
							<div class="icon-content">
								<h2 class="dez-tilte text-primary">Porcinos</h2>
								<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>-->
								<a href="productos/porcinos/porcinos.php" class="site-button italic light-gray">Ver más..</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="icon-bx-wraper service-style1 center">
							<div class="icon-bx-xl">
								<a href="productos/equinos/equinos.php" class="icon-cell">
									<img src="images/icon/icon_caballos.png" alt="">
								</a>
							</div>
							<div class="icon-content">
								<h2 class="dez-tilte text-primary">Equinos</h2>
								<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>-->
								<a href="productos/equinos/equinos.php" class="site-button italic light-gray">Ver más..</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="icon-bx-wraper service-style1 center">
							<div class="icon-bx-xl">
								<a href="productos/ovinos/ovinos.php" class="icon-cell">
									<img src="images/icon/icon_borregos.png" alt="">
								</a>
							</div>
							<div class="icon-content">
								<h2 class="dez-tilte text-primary">Ovinos</h2>
								<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>-->
								<a href="productos/ovinos/ovinos.php" class="site-button italic light-gray">Ver más..</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="icon-bx-wraper service-style1 center">
							<div class="icon-bx-xl">
								<a href="productos/aves/aves.php" class="icon-cell">
									<img src="images/icon/icon_aves.png" alt="">
								</a>
							</div>
							<div class="icon-content">
								<h2 class="dez-tilte text-primary">Aves</h2>
								<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>-->
								<a href="productos/aves/aves.php" class="site-button italic light-gray">Ver más..</a>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="icon-bx-wraper service-style1 center">
							<div class="icon-bx-xl">
								<a href="productos/perros/perros.php" class="icon-cell">
									<img width="100" height="100" src="images/icon/icon_perros.png" alt="">
								</a>
							</div>
							<div class="icon-content">
								<h2 class="dez-tilte text-primary">Perros</h2>
								<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>-->
								<a href="productos/perros/perros.php" class="site-button italic light-gray">Ver más..</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Services End -->
		<!-- Get A Quote -->
        <div class="section-full content-inner-1 shap-top shap-bottom dez-support1-area" style="background-image:url(images/background/vaca-full.jpg); background-size:cover; background-position:center;">
            <div class="container">
                <div class="row">
					<div class="col-lg-6 offset-lg-6 col-md-9 offset-md-3 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
						<div class="dez-support style1 bg-white">
							<?php
								echo $row['mensaje_principal_contacto'];
							?>
							<!--
							<div class="section-head style1 text-left text-black">
								<h3 class="h3">Alimenta con productos de calidad <span class="text-primary">La Posta</span></h3>
								<div class="dez-separator bg-primary"></div>
								<p>Pregunta por nuestros productos</p>
							</div>
							-->
							<a href="contacto/contacto-banderilla.php" class="site-button gradient m-b5 m-r10 wow zoomIn" data-wow-delay="2s" data-wow-duration="2s">Contacto Banderilla</a>
							<a href="contacto/contacto-acajete.php" class="site-button gradient m-b5 m-r10 wow zoomIn" data-wow-delay="2s" data-wow-duration="2s">Contacto Acajete</a>
							<a href="contacto/contacto-mata-oscura.php" class="site-button gradient m-b5 m-r10 wow zoomIn" data-wow-delay="2s" data-wow-duration="2s">Contacto Mata Oscura</a>
							<!-- <a href="#" class="site-button gradient wow zoomIn" data-wow-delay="2s" data-wow-duration="2s">Learn more</a> -->
						</div>
					</div>
				</div>
            </div>
        </div>
		<!-- Get A Quote -->
		<!-- About info -->
        <div class="section-full content-inner about-info-area bg-white">
            <div class="container">
				<div id="contenido-historia" class="row">
					<div class="col-lg-6 text-justify">
						<?php echo utf8_encode($row['texto_historia']);?>
					</div>
					<div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
						<img class="img-cover" src="images/about/home-about.png" alt="">
					</div>
				</div>
            </div>
        </div>
        <div class="section-full bg-white content-inner">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-lg-4 wow fadeInLeft" data-wow-delay="0.2s" data-wow-duration="2s">
							<div class="experience-box">
								<h2 class="exp-year"><?php echo $anioservicio; ?></h2>
								<h3>AÑOS DE</h3>
								<h4>EXPERIENCIA</h4>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="p-l30 counter-2-area">
								<div class="section-head style1 text-left wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="2s">
									<h6 class="h6">Una muestra de nosotros</h6>
									<h3 class="h3">Manejamos diferentes fórmulas <span class="text-primary">para ti.</span></h3>
									<div class="dez-separator bg-primary"></div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="2s">
										<div class="counter-style-2 m-b30">
											<!--<span class="counter-text text-primary">Más de</span>-->
											<span class="counter"><?php echo "+".$row['clientes_atendidos'];?></span>
											<span class="counter-text text-primary">Clientes atendidos</span>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="2s">
										<div class="counter-style-2 m-b30">
											<span class="counter"><?php echo $row['formulas_originales'];?></span>
											<span class="counter-text text-primary">Fórmulas originales</span>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-12 wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="2s">
										<div class="counter-style-2">
											<span class="counter"><?php echo $row['kg_alimento'];?></span>
											<span class="counter-text text-primary">Toneladas de Alimento</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content END-->
    <!-- Footer -->
    <footer class="site-footer footer-style1">
        <div class="footer-top shap-top">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
						<div class="footer-logo wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="2s">
							<img src="images/logo.png" alt="">
						</div>
						<p class="wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="2s">LLámanos: <?php echo $rowband['telefono_ubicacion'] ?></p>
						<p class="wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="2s"><?php echo $rowband['direccion_ubicacion'] ?></p>
					</div>
				</div>
            </div>
        </div>
		<!-- Footer Bottom Part -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
						<span>© 2022 Develop by <a style="color:white;" target="_blank" href="http://www.iwebyou.com.mx/">Iwebyou</a></span>
					</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END -->
    <!-- scroll top button -->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JavaScript  files ========================================= -->
<script src="js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="plugins/wow/wow.js"></script><!-- BOOTSTRAP.MIN JS -->
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
<script src="js/dz.carousel.js"></script><!-- SORTCODE FUCTIONS  -->
<!-- revolution JS FILES -->
<script src="plugins/revolution/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script  src="js/rev.slider.js"></script>
<script >
jQuery(document).ready(function() {
	'use strict';
	dz_rev_slider_5();
});	/*ready*/
</script>
</body>
</html>