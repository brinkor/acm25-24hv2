<div class="log">
	<h2 class="centered">Wyniki wyszukiwań: </h2>
		<?php foreach ($photos as $photo):
			if ($photo['u_id'] == null || (isset($_SESSION['user_id']) && $photo['u_id'] == $_SESSION['user_id'])):
				$name = $photo['name'];
				if ($name == $matched["$name"]):
					$id = $photo['_id']; ?>
					<div class="gallery">
						<a target="_blank" href="<?= substr($photo['path'] . '.water.png', strlen('/static')) ?>">
							<img src="<?= substr($photo['path'] . '.min.png', strlen('/static')) ?>" alt="<?= $photo['name'] ?>">
						</a>
						<div class="desc"> <?php echo $photo['name'] . ' - ' . $photo['author']; if(isset($_SESSION['user_id']) && $photo['u_id'] == $_SESSION['user_id']) echo "</br>prywatne"; ?> </div>
					</div>
				<?php endif ?>
			<?php endif ?>
		<?php endforeach ?>
</div>