<?php
get_header(); 
?>
<div class="news">
  	<div class="container">
		<div class="row">


 <div class="col-sm-7 col-xs-12">
<?php                
                // Start the Loop.
                while ( have_posts() ) : the_post();                
                    //$img =wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $meta = get_post_meta($query->post->ID);
                ?>
					<div class="news-block">
						<div class="post-body team-member">
							<h2><?php the_title();?></h2>
                            <em class="date"><?php echo $meta['position'][0]?></em>
                            <?php the_content();?>
                        </div>
                        <div class="clearfix"></div>
                       
                        <div class="clearfix"></div>
                        
					</div>	
	
                <?php endwhile;?>
</div>                
                <div class="col-sm-4 col-md-offset-1 col-xs-12">
                    <!-- || Start search-sidebar -->
				<div class="search-sidebar">
					<form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
					<div class="form-control">
						<div class="input-text">
							<input type="text" name="s" placeholder="Search" />
						</div>
						<button onclick="document.getElementById('searchform').submit();"><i class="fa fa-search"></i></button>
					</div>	
					</form>
				</div>
				<!-- // Stop search-sidebar -->
                    <?php if ( is_active_sidebar( 'team_post_sidebar' ) ) : ?>
                        <?php dynamic_sidebar( 'team_post_sidebar' ); ?>
                    <?php endif ?>
                </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>