
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
		<!--[if lt IE 8]>
		<div class="row">
			<div class="alert alert-warning">
				&nbsp;您的浏览器版本实在是太低了，是时候考虑<a href="http://browsehappy.com/">换一个</a>了。 
				<del>&times;</del>
			</div>	
		</div>		
		<![endif]-->
			<div class="row">
				<div id="chart" class="col-md-9 col-sm-9">
					统计信息或巨幕
				</div>
				<div class="col-md-3 col-sm-3">
					<ul class="list-group">
						<li class="list-group-item"><a href="./discuss/discuss.php">讨论版</a></li>
						<li class="list-group-item"><a href="#">常见问答</a></li>
						<li class="list-group-item"><a href="#">代码便签盒</a></li>
						<li class="list-group-item"><a href="#">工具和向导</a></li>
						<li class="list-group-item"><a href="#">建议反馈箱</a></li>
						<li class="list-group-item"><a href="#">关于BLumiaOJ</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div id="news" class="doc">
						Loading News....
					</div>
				</div>
				<div class="col-md-3">
					<div class="well">
						<h3>Top 10 Problems</h3>
						
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function loadnews(num){
		NProgress.start();
		$.ajax({
			url:"./api/ajax_newslist.php?show="+num,
			async:false,
			contentType:"application/x-www-form-urlencoded; charset=utf-8",
			success:function(data, textStatus, jqXHR){
				document.getElementById("news").innerHTML=data;
				$(".alter").fadeIn();
			},
			complete:function(jqXHR, textStatus){
				NProgress.done();
			}
		});
	}
	
	loadnews(5);
	
	$(function(){
		var Accepted = [];
		var WrongAnswer = [];
		var Other = [];
		var DataText = [];
		var chart = new Highcharts.Chart({
			chart: { height: 300, renderTo: 'chart', type: 'area' },
			title: { text: '<?php echo L_WEEKY_SUBMIT_N_AC;?>' },
			xAxis: {
				categories: [],
				tickmarkPlacement: 'on', title: { enabled: false } 
			},
			yAxis: {
				title: { text: 'Submit Count' },
				allowDecimals: false,
				labels: { 
					formatter: function() {
						return this.value; 
					} 
				} 
			},
			tooltip: {
				shared: true,
				valueSuffix: ' Submits' 
			},
			plotOptions: {
				area: {
					stacking: 'normal',
					lineColor: '#666666',
					lineWidth: 1,
					marker: {
						lineWidth: 1, lineColor: '#666666' 
					} 
				} 
			},
			series: []
		});
		$.ajax({
			type:'get',
			url:'./api/ajax_weekychart.php',
			success:function(data){
				var json = eval("("+data+")");
				json = json['data'];

				for(var key in json){
					Accepted.push(json[key][4]);
					WrongAnswer.push(json[key][6]);
					Other.push(json[key]['count'] - json[key][4] - json[key][6])
					DataText.push(json[key]['date'])
				}
				chart.xAxis[0].setCategories(DataText);
				chart.addSeries({                       
					name: "<?php echo L_JUDGE_AC;?>",
					color: "#7fff00",
					data: Accepted
				},false);
				chart.addSeries({                       
					name: "<?php echo L_JUDGE_WA;?>",
					color: "#ff5151",
					data: WrongAnswer
				},false);
				chart.addSeries({                       
					name: "<?php echo L_OTHER;?>",
					color: "#d0d0d0",
					data: Other
				},false);
				chart.redraw();
			},
			error:function(e){
				chart.setTitle({ text: 'Error::Load data failed.' });
			} 
		});
	});

	</script>
		
	</body>