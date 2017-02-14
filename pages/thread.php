<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title><?php echo L_FORUM." - {$OJ_NAME}";?></title>
		<style>
.avatar {
	padding: 0 20px 10px;
}
span.label {
	margin-left: .3em;
}
		</style>
	</head>	
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
				<ol class="breadcrumb">
					<li><a href="discuss.php"><i class="icon-dashboard"></i> <?php echo L_FORUM;?></a></li>
					<li id="problemBreadcrumb" class="hidden"><i class="icon-file-alt"></i> <a id="probDiscussLink">Problem Discuss</a></li>
					<li class="active"><i class="icon-file-alt"></i> Thread Page</li>
				</ol>
				<h3 id="threadTitle">Loading...</h3>
				<hr/>
				<div class="col-sm-9">
					<div id="replyList"></div>
					<?php if (isset($_SESSION["user_id"])) { ?>
					<form id="postReplyForm" class="form-group">
						<input type="hidden" class="form-control" name="do" value="postreply">
						<input type="hidden" class="form-control" name="tid" value="<?php echo intval($_GET["tid"]);?>">
						<label for="contentInput">Reply:</label>
						<textarea class="form-control" id="contentInput" name="content" rows="4"></textarea>
					</form>
					<button class="btn btn-primary" id="doReplyBtn" style="margin: .4em 0;">Submit</button>
					<?php } else { ?>
					<div class="alert alert-info">
						<strong> 【提示信息】 </strong>您必须登陆以发表回复。
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-3">
					<div class="well">
						<h3>Discuss</h3>
						<button class="btn btn-primary btn-block">Post reply</button>
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<div class="modal fade" tabindex="-1" role="dialog" id="dialogModel">
		  <div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h4 class="modal-title" id="dialogTitle">Hey!</h4>
				</div>
				<div class="modal-body" id="dialogText"></div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <a type="button" class="btn btn-primary" id="btnPostSuccess">Go</a>
				</div>
			</div>
		  </div>
		</div>
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function fillThreadList(data) {
		if (data.threadInfo == false) {
			$("#threadTitle").text("Thread not exist!");
		} else {
			var labelText = "";
			switch (data.threadInfo.top_level) {
				case "1": labelText = "<?php echo L_TOP_1;?>"; break;
				case "2": labelText = "<?php echo L_TOP_2;?>"; break;
				case "3": labelText = "<?php echo L_TOP_3;?>"; break;
			}
			var $label = $("<span>").addClass("label label-primary").text(labelText);
			$("#threadTitle").text(data.threadInfo.title).append($label);
		}
		
		if (data.threadInfo.pid != undefined && data.threadInfo.pid != 0) {
			$("#problemBreadcrumb").attr("class","active");
			$("#probDiscussLink").attr("href","discuss.php?pid="+data.pid);
		}
		
		var $tableBody = $("#replyList").empty();
		$.each(data.replies, function (index, elem) {
			var $replyBlock = $("<div>").addClass("media");
			var $replyLeftBlock = $("<div>").addClass("media-left");
			var $userContainer = $("<a>").attr('href','userinfo.php?uid='+elem.author_id);
			var $userImg = $("<img>").attr("src","data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWEzMTM2ZDBjNSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YTMxMzZkMGM1Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=").addClass("avatar");
			var $userName = $("<div>").addClass("text-center").text(elem.author_id);
			$replyLeftBlock.append($userContainer.append($userImg).append($userName));
			
			var $replyMainBlock = $("<div>").addClass("media-body").html(elem.content);
			var $replyInfoBlock = $("<div>").addClass("pull-right text-muted").text(elem.time);
			
			$replyBlock.append($replyLeftBlock).append($replyMainBlock).append($replyInfoBlock);
			$tableBody.append($replyBlock);
		});
	}
	
	function button_doReplyBtn_onClick() {
<?php if (isset($_SESSION["user_id"])) { ?>
		var $divModal = $("#dialogModel");
		
		$.post('./api/ajax_discuss.php', 
			$('#postReplyForm').serialize(),
			function(data, status) {
				$("#dialogTitle").text("Post success!");
				$("#dialogText").text("Would you like reload this page now?");
				$("#btnPostSuccess").attr("href","thread.php?tid="+data.result.tid).show();
				$divModal.modal("show");
			}
		).error(function(data, status) {
			var ret = $.parseJSON(data.responseText);
			$("#dialogTitle").text("Post failed!");
			$("#dialogText").text(ret.message);
			$("#btnPostSuccess").hide();
			$divModal.modal("show");
		});
<?php } ?>
	}
	
	$(document).ready(function () {
		$('#doReplyBtn').click(button_doReplyBtn_onClick);
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: {
				"do": "replylist",
				"tid": <?php echo intval($_GET["tid"]);?>
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200) fillThreadList(data.result);
				else $("#threadTitle").text(data.message);
			}
		});
	});
	
	$(window).load(function(){
		prettyPrint();
	})
	</script>
	</body>
</html>