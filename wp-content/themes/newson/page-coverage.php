<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php bloginfo( 'name' ); ?> <?php wp_title( '|', true, 'left' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!-- Web Fonts -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <link href="<?php echo get_template_directory_uri(); ?>/css/ifie9.css" rel="stylesheet">
    <![endif]-->   
    <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon">
	<?php wp_head(); ?>  
    <script type="text/javascript">
		hljs.initHighlightingOnLoad();
	</script>
</head>
<body <?php body_class(); ?>>

<?php //intro
        while ( have_posts() ) : the_post();
                $title = get_the_title();
        endwhile;
?>

	<!-- || Start map-mobile -->
	<div class="map-mobile">
	<div class="header-map">
		<h4>
			<?php echo $title?>
		</h4>
		<a href="javascript:history.go(-1)" ><i class="fa fa-times"></i></a>
	</div>
	<div class="clearfix"></div>
	<div>
		<?php the_content()?>
	</div>
	</div> 
	<!-- // Stop map-mobile -->

<?php wp_footer(); ?>
</body>
</html>