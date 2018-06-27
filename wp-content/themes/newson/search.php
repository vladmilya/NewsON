<?php
get_header(); 
?>
<div class="news">
    <div class="container">
        <div class="row">
        
 
            <div class="col-sm-7 col-xs-12">
                <div class="search-result-title">Search Results</div>
                <h1><?php echo "$s"; ?></h1>
                
                    <?php
                // Start the Loop.
                while ( have_posts() ) : the_post();                
                ?>
                
                    <div class="news-block">
						<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

					    <em class="date"><?php the_time('F j, Y');?></em>
					</div>
                
                <?php endwhile;?>
                    <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'base'               => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'format'             => '/page/%#%',
                            'type'               => 'array',
                            'total'              => $post->max_num_pages,
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
                    
                <?php if ( is_active_sidebar( 'search_sidebar' ) ) : ?>
                        <?php dynamic_sidebar( 'search_sidebar' ); ?>
                <?php endif ?>
            </div>
            
        </div>
    </div>
</div>

<?php
get_footer();
?>