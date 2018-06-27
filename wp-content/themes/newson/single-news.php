<?php
get_header(); 
?>

<!-- || Start news -->
<div class="news">
  	<div class="container">
		<div class="row">
        
            <div class="col-sm-7 col-xs-12">
<?php                
                // Start the Loop.
                while ( have_posts() ) : the_post();                
                    //$img =wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $currentPostCat = get_the_category($post->ID);
                    $currentPostCatId = $currentPostCat[0]->term_id;
                    
                    $nextPost = get_previous_post( true );
                    $nextPostCat = get_the_category($nextPost->ID);
                   
                    $prevPost = get_next_post( true );
                    $prevPostCat = get_the_category($prevPost->ID);
                ?>
					<div class="news-block">
						<div class="post-body">
							<h2><?php the_title();?></h2>
                            <em class="date"><?php the_time('F j, Y');?></em>
                            <?php the_content();?>
                        </div>
                        <div class="clearfix"></div>
                        <?php if(!empty($prevPost) and $prevPostCat[0]->term_id == $currentPostCatId){?>
                        <div class="pull-left">
                            <a class="more" href="<?php echo get_permalink($prevPost->ID)?>" title="">PREVIOUS POST</a>
                        </div>
                        <?php }?>
                        <?php if(!empty($nextPost) and $nextPostCat[0]->term_id == $currentPostCatId){?>
                        <div class="pull-right">
                            <a class="more" href="<?php echo get_permalink($nextPost->ID)?>" title="">Next post</a>
                        </div>
                        <?php }?>
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
                <?php if ( is_active_sidebar( 'blog_post_sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'blog_post_sidebar' ); ?>
                <?php endif ?>
            </div>
                
        </div>
    </div>
</div>
<?php
get_footer();
?>