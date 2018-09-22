<div class="log">
	<h1>Wgraj obrazek</h1>
	<form method="post" enctype="multipart/form-data" action="main">
		<input type="file" name="zdjecie"/></br></br>
		Tytuł: <input type="text" name="tytul" placeholder="Wpisz tytuł"/></br>
		Autor: <input type="text" name="autor" placeholder="Podaj autora zdjęcia" <?php if(isset($_SESSION['login'])) {echo 'value="' . $_SESSION['login'] . '"';} ?> /></br>
		Znak wodny: <input type="text" name="watermark" placeholder="Wpisz znak wodny"/></br>
		<?php if(isset($_SESSION['login'])): ?>
		Publiczny: <input type="radio" name="type" value="public" checked="true"/> Prywatny: <input type="radio" name="type" value="private" /></br>
		<?php endif ?>
		<button class="logowanie" type="submit" name="submit">Wyślij</button></br>
	</form>
	<?php
	if (isset($badType) && $badType == 1)
	{
		echo "Plik jest niepoprawnego typu.</br>";
	}
	if (isset($tooBig) && $tooBig == 1)
	{
		echo "Plik jest zbyt duży.</br>";
	}
	if (isset($fileOK) && $fileOK == 1)
	{
		echo "Plik został zuploadowany.</br>";
	}
	?>
</div>