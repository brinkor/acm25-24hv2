<div class="log">
	<?php
	if (isset($_SESSION['login']))
	{
	?>
		<h3>Witaj, <?= $_SESSION['login'] ?>.</h3>
		<a href="logout">Wyloguj</a>
	<?php
	}
	else
	{
	?>
		<form method="post" action="login">
			Login: </br><input type="text" name="login" placeholder="Wpisz login"/></br>
			Hasło: </br><input type="password" name="pass" placeholder="Wpisz hasło"/></br>
			<a href="register">Nie masz konta?</a></br>
			<button class="logowanie" type="submit" name="submit" value="zaloguj">Zaloguj</button>
			<?php
			if (isset($wrong) && $wrong == 1)
			{
			echo "</br><span>Zły login lub hasło</span>";
			}
			?>
		</form>
	<?php
	}
	?>
</div>