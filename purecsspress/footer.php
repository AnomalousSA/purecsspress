<?php

/**
 * Default Footer
 *
 * @package WordPress
 * @subpackage Monstrosity
 * @since Monstrosity 0.1
 *
 * Last Revised: Dec 12, 2013
 */
$options = get_option( 'my_option_name' );
global $childDir;
?>
		<footer class="container">
			<div class="row">
				<hr>
				<div class="col-md-12"><p><small><?php echo $options['footer_print'];?></small></p></div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>