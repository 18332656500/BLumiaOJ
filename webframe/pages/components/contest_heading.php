<div id="contestHeading" class="text-center">
	<h2><?php echo $contestItem['title'];?></h2>
	<div class="btn-group" role="group" aria-label="...">
		<a type="button" href="contest.php?cid=<?php echo $cid;?>" class="btn btn-default">Overview</a>
		<a type="button" href="contest_problemset.php?cid=<?php echo $cid;?>" class="btn btn-default">Problem List</a>
		<a type="button" href="contest_status.php?cid=<?php echo $cid;?>" class="btn btn-default">Status</a>
		<a type="button" href="contest_ranklist.php?cid=<?php echo $cid;?>" class="btn btn-default">Ranklist</a>
	</div>
	<div class="progress">
		<div id="bl-progress-bar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
			<span class="sr-only">Progress Bar</span>
		</div>
	</div>
	<br/>
</div>
<script>
	function run() {	
		var offset = new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
		var start_time=new Date(new Date("<?php echo $contestItem['start_time'];?>").getTime()+offset).getTime();  //开始时间
		var end_time=new Date(new Date("<?php echo $contestItem['end_time'];?>").getTime()+offset).getTime();   //结束时间
		var cur_time=new Date(new Date().getTime()+offset);    //当前时间

		//console.log(typeof end_time);
		//console.log(typeof start_time);
		
		var delta_time= end_time - start_time;  //时间差的毫秒数
		var passed_time= cur_time - start_time;  //过去的时间的毫秒数
		var percentage = passed_time / delta_time * 100;
		
		//console.log(percentage);
		//alert(percentage);
		$("div[id=bl-progress-bar]").css("width",percentage+"%");
		if (percentage<100) {
			var timer=setTimeout("run()",1000);
		} else {
			var progress_bar = document.getElementById('bl-progress-bar'); 
			progress_bar.className = 'progress-bar'; 
			$("div[id=bl-progress-bar]").css("width","100%");
			//alert("Contest Ended Nya ~");
		}
	}
	
	run();
</script>