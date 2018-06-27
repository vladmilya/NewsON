<?php
get_header(); 
?>
<?php 
$hiddenH1 = get_option('hidden_h1');
if(!empty($hiddenH1)){?>
<h1 class="additionalH1"><?php echo $hiddenH1; ?></h1> 
<?php }?>

<script type="text/javascript">
	  jQuery(document).ready(function(){    
		jQuery('.bxslider').bxSlider({
		  auto: true,
		  autoControls: true,
		});
	  });
	</script>

<?php //intro
        while ( have_posts() ) : the_post();
                $title = get_the_title();
                $content = get_the_content();
                $meta = get_post_meta($post->ID); //header_text
                $img =wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        endwhile;
?>
  <div class="intro background-parallax padding" style="background-image:url(<?php echo $img?>);">
    <div class="text-vcenter">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				  <h1>
					<?php echo $meta['header_text'][0]?>
				  </h1>
				  <p>
					<?php echo $content?>
				  </p>
                  <?php // markets
                  $aMarketTypes = get_sub_categories('app-markets');
                  foreach($aMarketTypes as $type){?>
                  <h3><?php echo $type['name']?></h3>
                  <?php //markets logos
    $args = array(   
        'showposts'=>-1,
        'category_name' => $type['slug']       
    ); 
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $img =wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            $meta = get_post_meta($query->post->ID);?>				  
				  <a href="<?php echo $meta['link'][0]?>" title="<?php echo $query->post->post_title?>" target="_blank"><img src="<?php echo $img?>" alt="<?php echo $query->post->post_title?>"/></a>
				  <?php
        }
    }
    wp_reset_postdata();
    ?>
				  <div class="clearfix"></div>
                  <?php }?>				  
				</div>
			</div>
		</div>		
    </div>
    <?php /*<a class="arrow-down" href="#" title=""><i class="fa fa-arrow-down"></i></a>*/?>
  </div>
  <!-- /intro -->

<!-- PRODUCT HIGHLIGHTS -->
  <div class="slide-1 padding">
    <div class="container-fluid">
		
		<div class="container">
			<h3>PRODUCT HIGHLIGHTS:</h3>
		</div>
		
		<!-- SLIDER -->			
		<ul class="bxslider">
        <?php //slides
    $args = array(   
        'showposts'=>-1,
        'category_name' => 'home-slideshow'       
    ); 
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $img =wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            $meta = get_post_meta($query->post->ID);?>
		  <li>
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<h2><?php the_title()?></h2>
						<p>
							<?php the_content()?>
						</p>
					</div>
					<div class="col-sm-8">
						<img src="<?php echo $img?>" alt="<?php the_title()?>" />
					</div>
				</div>
			</div>
		  </li>
          <?php
        }
    }
    wp_reset_postdata();
?>		  
		</ul>
		<!-- END SLIDER -->

    </div>
	<?php /*<a class="arrow-down" href="#" title=""><i class="fa fa-arrow-down"></i></a>*/?>
  </div>
  <!-- /PRODUCT HIGHTLIGHTS: -->
  
  <!-- About -->
<?php
$about_post = get_page_by_path('about-our-partners-and-affilates',OBJECT,'post');
if(!empty($about_post)){
    $img =wp_get_attachment_url( get_post_thumbnail_id($about_post->ID) );
    ?>
  <div class="about background-parallax padding" style="background-image:url(<?php echo $img?>);">
    <div class="container">
      <div class="row">
        
        <div class="col-sm-4">
        	<h2><?php echo $about_post->post_title?></h2>
			<p>
				<?php echo $about_post->post_content?>
			</p>
        </div>
        
        <div class="col-sm-1"></div>
        
        <?php
        /*$aStations = array();
        $args = array(   
            'showposts'=>-1,
            'category_name' => 'station-groups'       
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
                $meta = get_post_meta($query->post->ID);
                $aStation = array();
                $aStation['img'] = $img;
                $aStation['link'] = $meta['link'][0];
                $aStation['row'] = $meta['row'][0];
                $aStation['title'] = $query->post->post_title;
                $aStations[] = $aStation;
            }
        }
        wp_reset_postdata();
        $aStationsGroups = array();
        if(!empty($aStations)){
            foreach($aStations as $stat){
                $aStationsGroups[$stat['row']][] = $stat;                
            }
            
        }*/
        $aStations = array();
        $args = array(   
            'showposts'=>-1,
            'category_name' => 'station-groups',
            'orderby' => 'post_title',
            'order'   => 'ASC',
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $img =wp_get_attachment_url( get_post_thumbnail_id($query->post->ID) );
                $meta = get_post_meta($query->post->ID);
                $aStation = array();
                $aStation['img'] = $img;
                $aStation['link'] = $meta['link'][0];
                $aStation['title'] = $query->post->post_title;
                $aStations[] = $aStation;
            }
        }
        wp_reset_postdata();
        $aStationsGroups = array_chunk($aStations, 3);  
        ?>
		
		<div class="col-sm-7">
			<div class="row">
			<?php if(!empty($aStationsGroups)){?>
				<div class="col-sm-12">
					<h3>Participating station groups</h3>
				</div>
				<?php foreach($aStationsGroups as $pair){?>
				<div class="col-sm-12">
					<div class="row">
                        <?php if(isset($pair[0])){?>
						<div class="col-sm-4 col-xs-6">
							<a href="<?php echo $pair[0]['link']?>" title="<?php echo $pair[0]['title']?>" target="_blank">
								<img src="<?php echo $pair[0]['img']?>" alt="<?php echo $pair[0]['title']?>" />
							</a>
						</div>
                        <?php }?>
						<?php if(isset($pair[0])){?>
						<div class="col-sm-4 col-xs-6">
							<a href="<?php echo $pair[1]['link']?>" title="<?php echo $pair[1]['title']?>" target="_blank">
								<img src="<?php echo $pair[1]['img']?>" alt="<?php echo $pair[1]['title']?>" />
							</a>
						</div>
                        <?php }?>
                        <?php if(isset($pair[2])){?>
						<div class="col-sm-4 col-xs-6">
							<a href="<?php echo $pair[2]['link']?>" title="<?php echo $pair[2]['title']?>" target="_blank">
								<img src="<?php echo $pair[2]['img']?>" alt="<?php echo $pair[2]['title']?>" />
							</a>
						</div>
                        <?php }?>
					</div>
				</div>
                <?php }?>
            <?php }?>
			</div>
		</div>
        
      </div>
    </div>
	<?php /*<a class="arrow-down aboutsection" href="#" title=""><i class="fa fa-arrow-down"></i></a>*/?>
  </div>
<?php }?>
  <!-- /About -->

  <!-- google map -->
  <div class="google-map">
  	<?php echo do_shortcode('[put_wpgm id=3]')?>
	<?php /*<a class="arrow-down mapsection" href="#" title=""><i class="fa fa-arrow-down"></i></a>*/?>
  </div>
  <!-- /google map -->

  
<!-- NewsON Nationwide Coverage -->
  <div class="newson-nationwide-coverage padding mobile-version">
  	<div class="container">
		<h2>NewsON Nationwide Coverage</h2>
		<a href="<?php echo site_url('/coverage'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/asm.png" alt="" /></a>
	</div>
	<?php /*<a class="arrow-down" href="#" title=""><i class="fa fa-arrow-down"></i></a>*/?>
  </div>
  <!-- /NewsON Nationwide Coverage -->

<?php /*
<!-- || Start myModal map-mobile-pop -->
<div class="modal fade" id="map-mobile-pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
			<h4 class="modal-title">
				Affiliate stations map
			</h4>
		  </div>
		  <div class="modal-body" >
		  	<?php echo do_shortcode('[put_wpgm id=2]')?>
		  </div> 
    </div>
  </div>
</div>
<!-- // Stop myModal map-mobile-pop -->*/?>
  
  <!-- Our Company -->
<?php 
$company_post = get_page_by_path('our-company',OBJECT,'post');
if(!empty($company_post)){
   $img =wp_get_attachment_url( get_post_thumbnail_id($company_post->ID) );?>
  <div class="company background-parallax padding" style="background-image:url(<?php echo $img?>);">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
			<h2><?php echo $company_post->post_title?></h2>
			<p>
				<?php echo $company_post->post_content?>
			</p>
        </div>
        <div class="col-sm-4">
        <?php
        $aLatestNews = latest_news_posts(3);
        if(!empty($aLatestNews)){?>
			<h3>News & press releases</h3>
            <?php foreach($aLatestNews as $news){?>
			<div class="block-com">
				<p>
					<a href="<?php echo $news['link']?>"><?php echo $news['title']?></a> 
				</p>
				<span class="date"><?php echo $news['date']?></span>
			</div>
            <?php }?>
        <?php }?>			
			<div class="block-com-more">
				<a href="<?php echo site_url('/news'); ?>" title="">More</a>
			</div>
        </div>
        <div class="col-sm-4">
        <?php
    $aTeam = team_posts();
    if(!empty($aTeam)){?>
			<h3>Leadership team</h3>
            <?php foreach($aTeam as $team){?>
			<div class="block-com">
				<p>
					 <a href="<?php echo $team['link']?>"><?php echo $team['title']?></a>
				</p>
				<span class="date"><?php echo $team['position']?></span>
			</div>
            <?php }?>
    <?php }?>
			
        </div>
      </div>
    </div>
	<?php /*<a class="arrow-down" href="#" title=""><i class="fa fa-arrow-down"></i></a>*/?>
  </div>
<?php }?>
  <!-- /Our Company -->



<?php //forms
$forms_post = get_page_by_path('homepage-forms',OBJECT,'post');
if(!empty($forms_post)){?>
<!-- Interested in Learning More About NewsON? -->
<div class="form-1 padding">
<a name="contact-forms"></a>
<?php echo apply_filters('the_content', $forms_post->post_content);?>
</div>
<!-- /Interested in Learning More About NewsON? -->
<?php }?>

<?php
get_footer();
?>