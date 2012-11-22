<?php foreach($this->posts as $idx => $entity) { ?>
	<div class="post well">
		<div class="created-date">
			<?=l($entity->created_at)?>	
		</div>
		<h2 class="title"><?=$entity->title?></h2>
		<p class="body"><?=$entity->content?></p>
		<div class="extra-data"></div>
	</div>
<?php } ?>