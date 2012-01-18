<?php // $Id: node.tpl.php,v 1.1.2.3.2.2.2.6 2010/03/01 13:37:46 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>
<pre>
<?php print_r($node); ?>
</pre>
  <div class="node-content clear-block">
    <?php if (!$page && $title): ?>
            <?php
            if(module_exists("imagecache") && isset($node->field_images[0]['filepath'])) {  
              $bg_image = imagecache_create_path('blog_header', $node->field_images[0]['filepath']);
              $bg_image = "style=\"background-image:url('/".$bg_image."') !important;\"";
            } else if (module_exists("imagecache") && isset($variables['random_header_image'])) {
              $bg_image = imagecache_create_path('blog_header', $variables['random_header_image']);
              $bg_image = "style=\"background-image:url('/".$bg_image."') !important;\"";
            }
            ?>
                
      <h2 class='node-title' <?=$bg_image?>>
        <?php print $title; ?>
        <?php
          if ($submitted) { 
            print format_date($node->created, 'custom', 'F d, Y g:ia');
          } 
        ?>
      </h2>
    <?php endif; ?>
FART
    <div id="inner-node-content">
      <?php if ($submitted): ?>
        <div class='node-submitted clear-block'>

        </div>
      <?php endif; ?>
      <?php //print $picture; ?>

      <?php print $content; ?>

        <?php if ($links): ?>
          <div class="node-links clear-block"><?php print $links; ?></div>
        <?php endif; ?>
    </div>
  </div>
</div>

<?php print $post; ?>
