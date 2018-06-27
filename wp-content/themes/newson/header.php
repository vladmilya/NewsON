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
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
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
<?php 
$aMenu = make_menu( 'Top Menu');
$newsPageId = get_page_by_path('news')->ID;
$newsCatId = get_category_by_slug('news')->term_id;
$teamPageId = get_page_by_path('team')->ID;
$teamCatId = get_category_by_slug('team')->term_id;
$currentPostCat = get_the_category($post->ID);
$currentPostCatId = $currentPostCat[0]->term_id;
?>
  <!-- navigation -->
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="">
    <div class="container">
		<div class="row">
		  
		  <a class="navbar-brand" href="<?php echo site_url('/'); ?>" title="<?php bloginfo( 'name' ); ?> - <?php echo get_bloginfo( 'description');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo2.svg" alt="<?php bloginfo( 'name' ); ?> - <?php echo get_bloginfo( 'description');?>"></a>
	
		  <div class="collapse navbar-collapse" id="navbar-collapse-main">	
			<div class="local-news-nationwide pull-left"><a href="<?php echo site_url('/'); ?>"><?php echo get_bloginfo( 'description');?></a></div>
				<?php if(!empty($aMenu)){?>
                <ul class="nav navbar-nav navbar-right">
                  <?php foreach($aMenu as $mnu){?>
				  <li <?php if(isset($mnu['submenu'])) echo 'class="dropdown"';elseif($mnu['main']->object_id == $post->ID) echo 'class="active"';elseif($mnu['main']->object_id == $newsPageId and $currentPostCatId == $newsCatId) echo 'class="active"';elseif($mnu['main']->object_id == $teamPageId and $currentPostCatId == $teamCatId) echo 'class="active"'?>>
					<a href="<?php echo $mnu['main']->url?>" <?php if(isset($mnu['submenu'])) echo 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"'?> <?php if($mnu->target){?>target="_blank"<?}?>><?php echo $mnu['main']->title?> <?php if(isset($mnu['submenu'])) echo '<i class="fa fa-angle-down"></i>'?></a>
					<?php if(isset($mnu['submenu'])){?>
                    <ul class="dropdown-menu">
                    <?php foreach($mnu['submenu'] as $submnu){?>
					  <li><a href="<?php echo $submnu->url?>" <?php if($submnu->target){?>target="_blank"<?}?>><?php echo $submnu->title?></a></li>
                    <?php }?>
					</ul>
                    <?php }?>
				  </li>
                  <?php }?>
				</ul>
                <?php }?>
		  </div>
		  
		</div>
    </div>
  </nav>
  <!-- /navigation -->
  
    <!-- || Start mobile menu -->
  <div class="mobile-version-menu">
	  <div class="mobile-menu" style="right:-200px;">
	  
		<div class="icon close-icon">
			<i class="fa fa-bars"></i>
			<i class="fa fa-times"></i>
		</div>
		
		<div class="mobile-menu-ul">
        <?php 
        $aMobileMenu = make_menu( 'Mobile Menu');
        if(!empty($aMobileMenu)){?>
			<ul>              
              <?php foreach($aMobileMenu as $mnu){?>
			  <li <?php if(isset($mnu['submenu'])) echo 'class="dropdown"';elseif($mnu['main']->object_id == $post->ID) echo 'class="active"';elseif($mnu['main']->object_id == $newsPageId and $currentPostCatId == $newsCatId) echo 'class="active"';elseif($mnu['main']->object_id == $teamPageId and $currentPostCatId == $teamCatId) echo 'class="active"'?>>
                <?php if(isset($mnu['submenu'])){?>
				<span><?php echo $mnu['main']->title?></span>                
				<ul>
                    <?php foreach($mnu['submenu'] as $submnu){?>
					  <li><a href="<?php echo $submnu->url?>" <?php if($submnu->target){?>target="_blank"<?}?>><?php echo $submnu->title?></a></li>
                    <?php }?>
				</ul>
                <?php }else{?>
                <a href="<?php echo $mnu['main']->url?>" <?php if($mnu->target){?>target="_blank"<?}?>><?php echo $mnu['main']->title?></a>
                <?php }?>
			  </li>
              <?php }?>              			  
			</ul>
        <?php }?>
		</div>
		
	  </div>
  </div>
  <!-- // Stop mobile menu -->



