<?php
/**
 * The footer template.
 * @package highwind
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

		</div><!-- /.content-wrapper -->

	</div><!-- /.inner-wrap -->

</div><!-- slider-wrap -->

		<?php highwind_footer_before(); ?>

		<footer class="footer content-wrapper" role="contentinfo">
			
			<div class="superfooter-content">
			
				<?php safetyline_superfooter(); ?>
			
			</div>

			<div class="footer-content">

				<?php highwind_footer(); ?>

			</div><!-- /.footer-content -->

		</footer>

		<?php highwind_footer_after(); ?>

</div><!-- /.outer-wrap -->

<?php highwind_body_bottom(); ?>

<?php wp_footer(); ?>

</body>
</html>