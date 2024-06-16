</head>
<body>
<header class="w">
	<nav id="n1">
		<a href="admin/dashboard.php" class="a1" id="a1">Dashboard</a>	
		<a href="" class="a1" id="a2" target="_blank">Website</a>
	<?php
		if($ADM){
	?>
		<a href="admin/manage-items.php" class="a1" id="a3">Items</a>	
		<a href="admin/manage-categories.php" class="a1" id="a4">Categories</a>	
		<a href="admin/manage-orders.php" class="a1" id="a5">Orders</a>	
		<a href="admin/manage-customers.php" class="a1" id="a6">Customers</a>
		<a href="admin/manage-slides.php" class="a1" id="a9">Slides</a>
		<a href="admin/settings.php" class="a1" id="a7">Settings</a>	
		<a href="admin/logout.php" class="a1" id="a8">Logout</a>
<?php	} ?>	
	</nav>	
</header>
