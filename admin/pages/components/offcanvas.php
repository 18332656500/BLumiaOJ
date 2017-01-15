<?php if (!is_pjax()) { ?>
<nav nav-pjax class="navmenu navmenu-inverse navmenu-fixed-left offcanvas-sm" role="navigation">
	<a class="navmenu-brand" href="./"><?php echo "{$OJ_NAME} ".LA_BKSTAGE_ADMIN; ?></a>
	
<?php if (isset($_SESSION['administrator'])||isset( $_SESSION['op_ProblemEditor'] )) { ?>
	<div class="navmenu-group-header"><?php echo LA_PROB_EDITOR; ?></div>
	<ul class="nav navmenu-nav">
		<li><a href="./problem_list.php"><?php echo LA_PROB_LIST;?></a></li>
		<li><a href="./problem_manager.php"><?php echo LA_PROB_MAN;?></a></li>
	</ul>
<?php } if (isset($_SESSION['administrator'])||isset( $_SESSION['op_ContestEditor'] )) { ?>
	<div class="navmenu-group-header"><?php echo LA_CONT_EDITOR; ?></div>
	<ul class="nav navmenu-nav">
		<li><a href="./contest_add.php"><?php echo LA_CONT_ADD; ?></a></li>
		<li><a href="./contest_list.php">管理竞赛</a></li>
	</ul>
<?php } if (isset($_SESSION['administrator'])||isset( $_SESSION['op_PageModifier'] )) { ?>
	<div class="navmenu-group-header"><?php echo LA_PAGE_MODIFIER; ?></div>
	<ul class="nav navmenu-nav">
		<li><a href="./news_manager.php">管理新闻</a></li>
		<li><a href="./broadcast_editor.php">管理广播</a></li>
	</ul>
<?php } if (isset($_SESSION['administrator'])||isset( $_SESSION['op_UserManager'] )) { ?>
	<div class="navmenu-group-header"><?php echo LA_USER_MGR;?></div>
	<ul class="nav navmenu-nav">
		<li><a href="./reset_password.php">重置密码</a></li>
		<li><a href="./account_gen.php">账号生成器</a></li>
	</ul>
<?php } if (isset($_SESSION['administrator'])) { ?>
	<div class="navmenu-group-header"><?php echo LA_SUPER_USER;?></div>
	<ul class="nav navmenu-nav">
		<li><a href="./privilege_manager.php">权限管理</a></li>
	</ul>
<?php } ?>
	<div class="navmenu-divider"></div>
	<ul class="nav navmenu-nav">
		<li><a href="../index.php"><?php echo LA_EXIT_ADMIN;?></a></li>
	</ul>
	
</nav>
<div class="navbar navbar-inverse navbar-fixed-top hidden-md hidden-lg">
	<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="#"><?php echo "{$OJ_NAME} ".LA_BKSTAGE_ADMIN; ?></a>
</div>
<?php } ?>