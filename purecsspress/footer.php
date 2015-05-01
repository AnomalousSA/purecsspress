<?php

/**
 * Default Footer
 *
 * @package WordPress
 * @subpackage PurecssPress
 * @since Purecsspress 1.0
 *
 * Last Revised: May 01, 2015
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