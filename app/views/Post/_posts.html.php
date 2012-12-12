<?php foreach($this->posts as $idx => $entity) { ?>
	<div class="post well">
		<div class="created-date">
			<?=l($entity->created_at)?>	
			<?php if($entity->getOwner()->is_checked) { ?>
				<span class="label label-success">Active user!</small>
			<?php } else { ?>
				<span class="label label-important">Inactive user!</small>
			<?php } ?>
		</div>
		<h2 class="title"><?=$entity->title?></h2>
		<p class="body"><?=$entity->content?></p>
		<div class="extra-data"></div>
	</div>
<?php } ?>