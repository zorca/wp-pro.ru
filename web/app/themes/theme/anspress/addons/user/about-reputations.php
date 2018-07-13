<?php
/**
 * User reputation meta box template
 * Shows in AnsPress user profile about page.
 *
 * @link https://anspress.io
 * @since 3.0.0
 * @package WordPress/AskBug
 */

$rep_by_month = ap_get_reputation_month_log( ap_current_user_id() );
$labels = [];
$counts = [];

foreach ( (array) $rep_by_month as $day => $count ) {
	$labels[] = substr( $day, strrpos( $day, '-' ) + 1 );
	$counts[] = $count;
}
?>
<div class="ap-about-inner">
	<canvas id="repcanvas" height="100"></canvas>
	<div class="ap-user-repl">
		<?php while ( $reputations->have() ) : $reputations->the_reputation(); ?>
			<div class="ap-user-repli">
				<div class="col-icon">
					<i class="<?php $reputations->the_icon(); ?> <?php $reputations->the_event(); ?>"></i>
				</div>
				<div class="col-event ap-reputation-event"><?php $reputations->the_activity(); ?></div>
				<div class="col-date ap-reputation-date"><?php $reputations->the_date(); ?></div>
				<div class="col-points ap-reputation-points"><span><?php $reputations->the_points(); ?></span></div>
			</div>
		<?php endwhile; ?>
	</div>
</div>
<script type="text/javascript">

	(function($) {
		$(document).ready(function(){
			var ctx = document.getElementById('repcanvas').getContext('2d');
			var data = {
				barBackground: "rgba(221, 224, 229, 1)",
				labels: <?php echo wp_json_encode( $labels ); ?>,
				datasets: [{
					label: "Reputation",
					backgroundColor: "rgba(255, 193, 7, 0.5)",
					borderWidth: 0,
					data: <?php echo wp_json_encode( $counts ); ?>,
					pointRadius: 0,
					borderWidth: 0
				}]
			};

			var myLineChart = new Chart(ctx, {
				type: 'line',
				data: data,
				options: {
					legend: {
						labels: {
							boxWidth: 10,
							fontColor: "#777",
							fontSize: 11
						}
					},
					scales: {
						xAxes: [{
							display: false
						}],
						yAxes: [{
							display: false
						}]
					}
				}
			});
		});
	})(jQuery);
</script>
