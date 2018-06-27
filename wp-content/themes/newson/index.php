<?php
get_header(); 
?>
<div class="news">
  	<div class="container">
		<div class="row">


 <div class="col-sm-12 col-xs-12 textpage">
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
                
        </div>
    </div>
</div>
<?php
get_footer();
?>