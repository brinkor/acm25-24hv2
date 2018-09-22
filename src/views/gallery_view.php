<?php
if ($numberOfPhotos): ?>
	<form method="post" action="remember">
		<?php foreach ($photos as $photo):
			if ($photo['u_id'] == null || (isset($_SESSION['user_id']) && $photo['u_id'] == $_SESSION['user_id'])):
				$id = $photo['_id']; ?>
				<div class="gallery">
					<a target="_blank" href="<?= substr($photo['path'] . '.water.png', strlen('/static')) ?>">
						<img src="<?= substr($photo['path'] . '.min.png', strlen('/static')) ?>" alt="<?= $photo['name'] ?>">
					</a>
					<div class="desc"> <?php echo $photo['name'] . ' - ' . $photo['author']; if(isset($_SESSION['user_id']) && $photo['u_id'] == $_SESSION['user_id']) echo "</br>prywatne"; ?> </div>
					<input type="checkbox" name="<?= $photo['_id'] ?>" <?php if (isset($_SESSION["$id"])) {echo 'checked="true"';} ?>/>
				</div>
			<?php endif ?>
		<?php endforeach ?>
		<div class="logNoFill">
			<button class="logowanie" type="submit" name="submit">zapamiętaj</button>
			<button class="logowanie" type="submit" name="pokaz">Pokaż wybrane</button>
		</div>
	</form>
<?php else: ?>
	<h3>Brak zdjęć!</h3>
<?php endif ?>