<h2 class="centered">Wybrane</h2>
<?php
if ($numberOfPhotos): ?>
	<form method="post" action="remember">
		<?php foreach ($photos as $photo):
			if ($photo['u_id'] == null || (isset($_SESSION['user_id']) && $photo['u_id'] == $_SESSION['user_id'])):
				$id = $photo['_id'];
				if (isset($_SESSION["$id"])): ?>
					<div class="gallery">
						<a target="_blank" href="<?= substr($photo['path'] . '.water.png', strlen('/static')) ?>">
							<img src="<?= substr($photo['path'] . '.min.png', strlen('/static')) ?>" alt="<?= $photo['name'] ?>">
						</a>
						<div class="desc"> <?= $photo['name'] . ' - ' . $photo['author'] ?> </div>
						<input type="checkbox" name="<?= $photo['_id'] ?>"/>
					</div>
				<?php endif ?>
			<?php endif ?>
		<?php endforeach ?>
		<div class="logNoFill">
			<button class="logowanie" type="submit" name="usun">Usuń zaznaczone</button>
			<button class="logowanie" type="submit" name="wroc">Powrót do wszystkich</button>
		</div>
	</form>
<?php else: ?>
	<h3>Brak zdjęć!</h3>
<?php endif ?>