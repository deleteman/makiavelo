<div class="page-header">
<h1>
		Latest posts
		<?php
		if(user_logged_in()) {?>
			<?=link_to(post_new_path(), 
					 '<i class="icon-plus-sign icon-white"></i> Add new post',
					 array("class" => "btn btn-primary"))?>
				
		<?php } ?>
</h1>
</div>

<div class="list-of-posts">
	<?= $this->renderView("../Post/_posts", array("locals" => array("posts" => $this->entity_list)))?>
</div>

