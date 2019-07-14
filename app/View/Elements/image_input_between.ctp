<div class="logo_image file-upload">
    <?php if ($info['width'] > 0 && $info['height'] > 0) { ?>
        <p class="note image_desc">Image size <?php echo $info['width']; ?>px X <?php echo $info['height']; ?>px   </p>
    <?php } ?>
    <?php if (isset($id) && isset($base_name) && !is_array($base_name) && !empty($base_name)) { ?>
        <div class="file_settings">
            <span class="image_base_name file-name"><?php echo $base_name; ?></span>
            <img class="img-responsive" src="<?php echo Router::url('/' . $info['folder'] . $base_name); ?>">
            <?php
            if (!isset($dont_delete)) {
                echo $this->Html->link(__('Delete', true), array('action' => 'delete_field', 'image', $id, $field), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete this image?', true));
            }
            ?>
        </div>
    <?php }else {
          $path = 'https://placeholdit.imgix.net/~text?txtsize=84&txt=900%C3%97580&w=900&h=580';
          ?>
          <img style="width: 169px;" src="<?php echo $path; ?> " />
      <?php }?> 
</div>

