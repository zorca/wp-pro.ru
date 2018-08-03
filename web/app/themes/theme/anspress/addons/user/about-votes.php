<?php
/**
 * User votes meta box template
 * Shows in AnsPress user profile about page.
 *
 * @link https://anspress.io
 * @since 3.0.0
 * @package WordPress/AskBug
 */

$counts = ab_count_votes_by_types( ap_current_user_id() );
?>

<div class="ap-about-inner">
	<canvas id="votescanvas" height="150"></canvas>
</div>
<script type="text/javascript">
	(function ($) {
		$(document).ready(function(){
			var ctx = document.getElementById('votescanvas').getContext('2d');
			var data = {
				labels: [
					"<?php _e( 'Received up votes', 'ab'); ?>",
					"<?php _e( 'Received down votes', 'ab'); ?>",
					"<?php _e( 'Casted up votes', 'ab'); ?>",
					"<?php _e( 'Casted down votes', 'ab'); ?>"
				],
				datasets: [{
					data: [<?php echo $counts['received_up_votes'] . ', ' . $counts['received_down_votes'] . ', ' . $counts['casted_up_votes'] . ', ' . $counts['casted_down_votes']; ?>],
					backgroundColor: ["#6ed2bb", "#ff837a", "#7eb9e8", "#fbaa32"],
					hoverBackgroundColor: ["#6ed2bb", "#ff837a", "#7eb9e8", "#fbaa32"]
				}]
			};

			var myLineChart = new Chart(ctx, {
				type: 'pie',
				data: data,
				options: {
					legend: {
						position: 'right',
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
