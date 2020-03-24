<header class="flex">
	<nav>
		<ul class="flex">
			<li> </li>
			<section class='nav flex'>
				<li><a href="./">Thomerlas</a></li>
				<li><a href="users_list.php">users list</a></li>
				<li><a href="forum.php">Forum</a> </li>
				<li><a href="#">Groupes d'énigmes</a> </li>
				<li><a href="#">Concours</a> </li>
				<?php
					if(isset($_SESSION['pseudo'])){
						echo '

							<li class="dropDown flex"> <a href="#">' . $_SESSION['pseudo'] . '</a>
								<ul class="underList">
									<li ><a href="#">Compte</a></li>
									<li ><a href="signOut.php">Déconnexion</a></li>
								</ul>
							</li>
						
						';
						if( $_SESSION['pseudo'] == 'administrateur' ){
							echo '<li><a href="admin.php">admin</a> </li>';		
						}
					}else {
						echo '<li><a href="signIn.php">Connexion</a></li>';
						echo '<li><a href="signUp.php">Inscription</a></li>';
					}
				?>
			</section>

		</ul>
	</nav>

</header>
