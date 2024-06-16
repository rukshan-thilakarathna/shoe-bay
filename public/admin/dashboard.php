<?php 
include "ADM_SESS.php";
include "ADM_HEAD.php"; ?>
<title>Dashboard - SukeeFashion</title>
<link href="<?php echo BASE; ?>admin/adm-x3-forms.css" rel="stylesheet">
<style>
.zi{width: 50px; display: block; margin:0 auto;transition:1s all;}
.zc{background:rgba(255,255,255,.2);
    width: 260px;
    padding: 20px;
    text-align: center;
    border-radius: 5px;}
.za{text-decoration: none; margin:20px;}
.za:hover .zi{transform:scale(1.5);}
#a1{color: #f14428; background:#f88408;}
</style>
<?php include "ADM_NAVI.php"; ?>
<div class="w">
	<h1>Admin Dashboard</h1>
	<p class="zp">Welcome to your site's content management dashboard</p>
	<div class="r">
		<a href="admin/manage-items.php" class="za">
			<div class="c zc">
				<img src="img/wine.svg" alt="Ads" class="zi">
				<h2>Manage Items</h2>
				<p>Edit/Delete Items</p>
			</div>
		</a>
		<a href="admin/manage-categories.php" class="za">
			<div class="c zc">
				<img src="img/categories.svg" alt="Users" class="zi">
				<h2>Manage Categories</h2>
				<p>Edit/Delete Categories</p>
			</div>
		</a>
		<a href="admin/manage-orders.php" class="za">
			<div class="c zc">
				<img src="img/orders.svg" alt="Banners" class="zi">
				<h2>Manage Orders</h2>
				<p>Edit/Delete Orders</p>
			</div>
		</a>
		<a href="admin/manage-customers.php" class="za">
			<div class="c zc">
				<img src="img/man.svg" alt="Banners" class="zi">
				<h2>Manage Customers</h2>
				<p>Edit/Delete Customers</p>
			</div>
		</a>
		<a href="admin/manage-slides.php" class="za">
			<div class="c zc">
				<img src="img/slider.svg" alt="Banners" class="zi">
				<h2>Manage Slides</h2>
				<p>Edit Slides</p>
			</div>
		</a>
		<a href="admin/settings.php" class="za">
			<div class="c zc">
				<img src="img/settings.svg" alt="Banners" class="zi">
				<h2>Settings</h2>
				<p>Update Admin Logins</p>
			</div>
		</a>
	</div>
</div>
<?php include "ADM_FOOT.php"; ?>