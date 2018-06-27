<?php
get_header(); 
?>
<div class="news">
    <div class="container">
        <div class="row">
        
        <?php //intro
        while ( have_posts() ) : the_post();
                $title = get_the_title();
        endwhile;
?>
    
            <div class="col-sm-7 col-xs-12">
            
                <h1><?php the_title()?></h1>
                    <div class="news-container">
                    <?php              
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(  
                        'posts_per_page' => 10,
                        'category_name' => 'news',                    
                        'orderby' => 'published',
                        'order'   => 'DESC',
                        'paged' => $paged 
                    ); 
                    $query = new WP_Query( $args );
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();
                    ?>
                
                    <div class="news-block">
						<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
						<em class="date"><?php the_time('F j, Y');?></em>
						<?php the_content();?>
					    <?php /*<a href="<?php the_permalink();?>" class="more">Read more</a>*/?>
					</div>
                
                  <?php }?>
                  </div>
                    <?php
                        $args = array(
                            'base'               => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'format'             => '/page/%#%',
                            'type'               => 'array',
                            'total'              => $query->max_num_pages,
                            'current'            => max( 1, $paged ),
                            'prev_next'          => true,
                            'prev_text'          => __('<span aria-hidden="true">Prev</span>'),
                            'next_text'          => __('<span aria-hidden="true">Next</span>')
                        );
                        $pager = paginate_links($args);
                        if($pager){?>
                    <nav>
						<ul class="pagination">
                            <?php foreach($pager as $k=>$p){?>
                            <li><?php echo $p?></li>
                            <?php }?>							
						</ul>
					</nav>
                  <?php }?>
              <?php }
                    wp_reset_postdata();
                    ?>                    
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
                <div class="widgets-area">   
                <?php if ( is_active_sidebar( 'blog_sidebar' ) ) : ?>
                        <?php dynamic_sidebar( 'blog_sidebar' ); ?>
                <?php endif ?>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
get_footer();
?>