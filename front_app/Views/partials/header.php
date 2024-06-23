<header class="header">	
		<div id="top-bar">
		  <a class="cosmetics-button" href="cosmetics">COSMETICS</a>
		  <a class="skin-button" href="skin">SKIN</a>
		</div>
	
		<nav id="wrapper">
		  <div class="box-type1"> 
			  <div id="menu">
				<ul class="menu-ul">
				  <li class="collapsed">
					<a href="#"><i class="fa-solid fa-bars"></i></a>
					<ul class="submenu">
                        <li><a href="products">Products</a></li>
                        <li><a href="about">About Us</a></li>
                        <li><a href="contact">Contact</a></li>
                        <?= $_SESSION['is_admin'] ? '<li><a href="admin">Admin</a></li>' : '' ?>
                        <li><a href="logout">LogOut</a></li>
					</ul>
				  </li>
				</ul>
			  </div>
				
		  <div id="my-account">
			<a href="account">
			  <h3>
			  <i class="fa-regular fa-user"></i>Account
			  </h3>
			</a>
			</div>
		  </div> 
		  <div class="box-type2"> 
			<h2 id="logo">muse</h2>
		  </div>
		  <div class="box-type3"> 
			  <div id="left-section">
				<form action="/products" method = "GET">
				  <span><i class="fa-solid fa-magnifying-glass"></i></span>
				  <input class="search-box" type="text" name="search" placeholder="Search...">
				</form>
			  </div>			
			  <div id="right-section">
			  <a class="fa-solid fa-heart" href="favorites"></a>
			</div>
		  </div>
	  </nav> 
</header>