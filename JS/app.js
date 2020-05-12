$(document).ready(function()
{
		$.ajax({
				url: "Barchart.php",
				method:"GET",
				success:function(data1)
				{
					var data = JSON.parse(data1);
					console.log(data);
					var player =[];
					var score =[];
					player.push("Laptop");
					score.push(1);
					
					for(var i in data)
					{
						player.push("Laptop");
						score.push(data[i].price);
					}
					var chartdata = 
					{
						labels: player,
						datasets: 
						[{
							label: 'Price',
							backgroundColor: 'rgba(200,200,200,0.75)',
							borderColor: 'rgba(200,200,200,0.75)',
							hoverBackgroundColor: 'rgba(200,200,200,1)',
							hoverBorderColor: 'rgba(200,200,200,1)',
							data: score
						}]
					};
					var ctx = $('#mycanvas');
					
					var barGraph = new Chart(ctx, {
						type: 'bar',
						data: chartdata
					});
					barGraph.render();
				},
				error: function(data){
					console.log(data);
				}
		});
});