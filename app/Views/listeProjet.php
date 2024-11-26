<h1>Liste des projets</h1>
	<ul>
		<?php foreach ($projets as $projet): ?>
			<li>
				<?= $projet->nom ?>
			</li>
		<?php endforeach; ?>
	</ul>
