<nav class="navbar navbar-default">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">BLumiaOJ</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="problemset.php">Problem Set</a></li>
				<li><a href="status.php">Status</a></li>
				<li><a href="ranklist.php">Rank List</a></li>
				<li><a href="contestlist.php">Contest</a></li>
				
				<?php if ($VJ_ENABLED) {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Virtual Judge <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="problemset_vj.php">Problem Set</a></li>
						<li><a href="status_vj.php">Status</a></li>
					</ul>
				</li>
				<?php } ?>
				
			</ul>
			<?php if (isset($_SESSION['user_id'])) {?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><i class="fa fa-inbox"></i> In-box</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $_SESSION['user_id'];?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					<li><a href="#"><i class="fa fa-edit"></i> Modify User</a></li>
					<li><a href="./userinfo.php"><i class="fa fa-at"></i> User Zone</a></li>
					<li><a href="#"><i class="fa fa-history"></i> Recent Submit</a></li>
					<li class="divider"></li>
					<li><a href="./admin/index.php"><i class="fa fa-cogs"></i> Admin Panel</a></li>
					<li class="divider"></li>
					<li><a href="./api/logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
			<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><i class="fa fa-user-plus"></i> Sign Up</a></li>
				<li><a href="./loginpage.php"><i class="fa fa-sign-in"></i> Log In</a></li>
			</ul>
			<?php } ?>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>