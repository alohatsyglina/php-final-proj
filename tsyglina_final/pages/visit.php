<!DOCTYPE html >
<?php include '../config.php';
session_start();?>
<head>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Erwin Aligam - styleshout.com" />
<meta name="description" content="Site Description Here" />
<meta name="keywords" content="keywords, here" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />

<link rel="stylesheet" type="text/css" media="screen" href="../css/screen.css" />

<title>Оформить визит</title>
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
				<li><a href="personalinfo.php">Личный кабинет</a></li>
				<li id="current"><a href="visit.php">Запись</a></li>
			</ul>		
		</div>		
		
		<div id="header-image"></div> 		
						
	
	<!-- header ends here -->
	</div></div>
	
	<!-- content starts -->
	<div id="content-outer"><div id="content-wrapper" class="container_16">
	
		<!-- main -->
		<div id="main" class="grid_8">
				
			<a name="TemplateInfo"></a>
			<h2>Оформить визит</h2>
			
			<p class="post-info">Какой салон вы хотите посетить?</p>
			<?php include '../helpers/choose.php';?>
            <p>			
			</p>

            <p></p>
				
			<p></p>
						
			<p></p>			
			
		
		<!-- main ends -->
		</div>
		
			<!-- left-columns starts -->
			<div id="left-columns" class="grid_8">
		
		<div class="grid_4 alpha">
		
			<div class="sidemenu">
				<h2>Наши услуги</h2>	
				<h3>Парикмахерские услуги</h3>
				<ul>				
					<li>Женская стрижка</li>
					<li>Мужская стрижка</li>
					<li>Укладка</li>
				</ul>	
			</div>
			
			<div class="sidemenu">
				<h3>Ногтевой сервис</h3>
				<ul>
					<li>Маникюр без покрытия</li>
					<li>Маникюр с покрытием</li>					
					<li>Педикюр</li>				
				</ul>
			</div>
		
			<div class="sidemenu">
				<h3>Косметология</h3>
				<ul>
					<li>Коррекция бровей</li>
					<li>Механический пилинг</li>
					<li>Химический пилинг</li>
				</ul>
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
