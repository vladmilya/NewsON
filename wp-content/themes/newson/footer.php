  <!-- footer -->
  <footer>
    <div class="container">
		<div class="col-sm-12">
		  <div class="pull-left">
            <?php $cd = getdate();?>
		  	<span>&copy; <?php echo $cd['year']?> NewsON</span>
			<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
                <?php dynamic_sidebar( 'footer1' ); ?>
            <?php endif ?>  	
		  </div>
		  <div class="pull-right">
            <?php if ( is_active_sidebar( 'footer2' ) ) : ?>
                <?php dynamic_sidebar( 'footer2' ); ?>
            <?php endif ?>		  	
		  </div>
		</div>
	</div>
  </footer>
  <!-- /footer -->
<?php wp_footer(); ?>
</body>
</html>