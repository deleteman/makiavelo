
<div class="well"><?= form_for($this->entity)?>
    <?php if(count($this->entity->errors) > 0) { ?>
      <div id="error_explanation">
        <h2>Error saving entity: </h2>
  
        <ul>
          <?php foreach($this->entity->errors as $msg) { ?>
                <?php foreach($msg as $err_msg) { ?>
                    <li><?= $err_msg ?></li>
          <?php } 
        } ?>
        </ul>
      </div>
      <?php } ?>
    <?=text_field($this->entity, "title", "Post title", array("class" => "span11"))?>
  
    <?=textarea_field($this->entity, "content", "Post body", array("class" => "span11", "rows" => 10))?>
  
    <?=hidden_field($this->entity, "owner_id")?>
  
  
  
    <input  type ="submit" value="Save" class="btn btn-primary"/>
    
  <?=form_end_tag()?></div>
