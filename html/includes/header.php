<header class="flex">
	<nav>
		<ul class="flex">
			<li> </li>
			<section class='nav flex'>
				<li><img src="http://localhost:8888/html/img/logo/ThomerlasWhite.svg" alt="logo" height="130px" style="margin-top: 50px;"></li>
				<li><a href="http://localhost:8888/html/">Thomerlas</a></li>
				<li><a href="http://localhost:8888/html/pages/forum.php">Forum</a> </li>
				<li><a href="#">Groupes d'énigmes</a> </li>
				<li><a href="#">Concours</a> </li>
				<?php
					if(isset($_SESSION['login']) && $_SESSION['login'] == 'administrateur') {
						echo '<li><a href = "http://localhost:8888/html/Administration/searchUser.php">searchUser</a></li>';
					}
					if(isset($_SESSION['pseudo'])){
						echo '

							<li class="dropDown flex"> <a href="#">' . $_SESSION['pseudo'] . '</a>
								<ul class="underList">
									<li ><a href="#">Compte</a></li>
									<li ><a href="http://localhost:8888/html/sign/signOut.php">Déconnexion</a></li>
								</ul>
							</li>
						';
					}else {
						echo '<li><a href="http://localhost:8888/html/sign/signIn/signIn.php">Connexion</a></li>';
						echo '<li><a href="http://localhost:8888/html/sign/signUp/signUp.php">Inscription</a></li>';
					}
				?>
			</section>

		</ul>
	</nav>

</header>