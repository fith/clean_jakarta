<?php // $Id: node.tpl.php,v 1.1.2.3.2.2.2.6 2010/03/01 13:37:46 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>

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
      </h2>
    <?php endif; ?>

    <div id="inner-node-content">
      <?php //print $picture; ?>

      <?php print $content; ?>
      <?php if ($submitted): ?>
        <div class='node-submitted clear-block'>
          <?php
            if ($submitted) { 
              if($node->name !== "admin") {
                print '— ' . theme('username', $node) . ', ';
              }
              print format_date($node->created, 'custom', 'F d, Y');
              if ($terms) {
                  print 'Care of: ' . $terms;
              }
            } 
            ?>
        </div>
      <?php endif; ?>
        <?php if ($links): ?>
          <div class="node-links clear-block"><?php print $links; ?></div>
        <?php endif; ?>
    </div>
  </div>
</div>

<?php print $post; ?>
