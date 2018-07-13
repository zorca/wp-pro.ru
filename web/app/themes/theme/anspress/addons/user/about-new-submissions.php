<div class="ap-about-inner">
	<canvas id="newposts" height="150"></canvas>
</div>
<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
			var ctx = document.getElementById('newposts').getContext('2d');
			var data = {
				labels: ["January", "February", "March", "April", "May", "June", "July"],
				datasets: [{
						label: "Questions",
						backgroundColor: "rgba(103, 58, 183, 0.4)",
						borderWidth: 0,
						data: [65, 59, 80, 81, 56, 55, 40],
					},
					{
						label: "Answers",
						backgroundColor: "rgba(139, 195, 74, 0.5)",
						borderWidth: 0,
						data: [22, 31, 28, 24, 23, 22, 31],
					},
					{
						label: "Comments",
						backgroundColor: "rgba(255, 193, 7, 0.4)",
						borderWidth: 0,
						data: [43, 31, 12, 27, 33, 46, 45],
					}
				]
			};

			var myLineChart = new Chart(ctx, {
				type: 'bar',
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
							gridLines: {
								display: false
							},
							ticks: {
								fontColor: "#CCC",
								fontSize: 10
							}
						}],
						yAxes: [{
							gridLines: {
								display: false
							},
							ticks: {
								fontColor: "#CCC",
								fontSize: 10
							}
						}]
					}
				}
			});
		});

	})(jQuery);
</script>
