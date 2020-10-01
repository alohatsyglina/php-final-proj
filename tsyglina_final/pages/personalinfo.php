<!DOCTYPE html>
<?php session_start();
include '../config.php';
?>

<head>


<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Erwin Aligam - styleshout.com" />
<meta name="description" content="Site Description Here" />
<meta name="keywords" content="keywords, here" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />

<link rel="stylesheet" type="text/css" media="screen" href="../css/screen.css" />

<title>Личный кабинет</title>
</head>
<body>

	<!-- header starts-->
	<div id="header-wrap"><div id="header" class="container_16">						
		
		<h1 id="logo-text"><a href="../index.php" title="">This is a name</a></h1>
		<p id="intro">This is a slogan</p>
		
		<!-- navigation -->
		<div  id="nav">
			<ul>
				<li><a href="../index.php">Главная</a></li>
				<li id="current"><a href="personalinfo.php">Личный кабинет</a></li>
				<li><a href="visit.php">Запись</a></li>
			</ul>		
		</div>		
		
		<div id="header-image"></div> 		
						
	
	<!-- header ends here -->
	</div></div>
	
	<!-- content starts -->
	<div id="content-outer"><div id="content-wrapper" class="container_16">
	
		<!-- main -->
		<div id="main" class="grid_10">
				
			<a name="TemplateInfo"></a>
			<h2>Управление записями</h2>
			
			<?php
			if(isset($_SESSION['type'])){
				if($_SESSION['type']=='client')
				include '../helpers/client.php';
				elseif($_SESSION['type']=='admin')
					include '../helpers/admin.php';
				else
					echo "Вы рядовой сотрудник, идите работать";
			}
			?>

            <p></p>
				
			<p></p>
						
			<p></p>			
			
		
		<!-- main ends -->
		</div>
		
		<!-- left-columns starts -->
		<div id="left-columns" class="grid_4">
		
			<div class="grid_4 alpha">
			
				<div class="sidemenu">
					<h2></h2>						
				</div>
			</div>
		
			<div class="grid_4 omega">
		
			<h3>Адреса</h3>		
			
			<div class="featured-post">
			
				<h4>ул. Бармалеева, 27</h4>					
				<p>
				тел.8-965-256-68-96			 				
				</p>	
			</div>
	
			<div class="featured-post">
		
				<h4>пр.Стачек, 134</h4>
				<p>
				тел.8-981-659-12-89
				</p>	
			</div>		
		
			<div class="featured-post">
		
				<h4>ул.Оптиков, 11</h4>
				<p>
				тел.8-999-159-36-78
				</p>					
			</div>
			
			<div class="featured-post">
		
				<h4>ул. Первого Мая, 1</h4>
				<p>
				тел.8-985-333-11-22
				</p>					
			</div>		
			</div>	
		
		<!-- end left-columns -->
		</div>		
	
	<!-- contents end here -->	
	</div></div>

	<!-- footer starts here -->	
	<div id="footer-wrapper" class="container_16">
	
		<div id="footer-content">
		
			<div class="grid_8">
		
				<h3>О нас</h3>			
				<p>
				Здесь будет информация про то, какой замечателный салон красоты вы хотите посетить, и что-нибудь еще <a href="index.html">Read more...</a>
				</p>
				
			</div>
			
			<div class="grid_8">
					
				<h3>Наши довольные клиенты</h3>					
				<p class="thumbs">
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>	
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>													
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>													
					<a href="index.html"><img src="../images/thumb.jpg" width="40" height="40" alt="thumbnail" /></a>
				</p>	
			
				</div>	
		
		</div>			
	</div>
	<!-- footer ends here -->

</body>
</html>
