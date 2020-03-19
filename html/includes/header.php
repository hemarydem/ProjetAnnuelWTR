<header class="flex">
	<nav>
		<ul class="flex">
			<li> </li>
			<section class='nav flex'>
				<li><img src="https://thomerlas.online/img/logo/ThomerlasWhite.svg" alt="logo" height="130px" style="margin-top: 50px;"></li>
				<li><a href="https://thomerlas.online">Thomerlas</a></li>
				<li><a href="https://thomerlas.online/pages/forum.php">Forum</a> </li>
				<li><a href="#">Groupes d'énigmes</a> </li>
				<li><a href="#">Concours</a> </li>
				<?php
					if(isset($_SESSION['pseudo'])){
						echo '

							<li class="dropDown flex"> <a href="#">' . $_SESSION['pseudo'] . '</a>
								<ul class="underList">
									<li ><a href="#">Compte</a></li>
									<li ><a href="https://thomerlas.online/sign/signOut.php">Déconnexion</a></li>
								</ul>
							</li>
						';
					}else {
						echo '<li><a href="https://thomerlas.online/sign/signIn/signIn.php">Connexion</a></li>';
						echo '<li><a href="https://thomerlas.online/sign/signUp/signUp.php">Inscription</a></li>';
					}
				?>
			</section>

		</ul>
	</nav>

</header>
