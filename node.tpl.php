<?php // $Id: node.tpl.php,v 1.1.2.3.2.2.2.6 2010/03/01 13:37:46 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>

  <div class="node-content clear-block">
    <?php if (!$page && $title): ?>
            <?php
            if(module_exists("imagecache") && isset($node->field_images[0]['filepath'])) {  
              $bg_image = imagecache_create_path('blog_header', $node->field_images[0]['filepath']);
              $bg_image = "style=\"background-image:url('/".$bg_image."') !important;\"";
            } else if (module_exists("imagecache")) {
              $header_image_query = "select files.filepath from files, content_field_images where files.fid = content_field_images.field_images_fid order by RAND() ASC limit 1";
              $header_image_queryResult =  db_query($header_image_query);
              $variables['random_header_image'] = db_fetch_object($header_image_queryResult);
              $bg_image = imagecache_create_path('blog_header', $variables['random_header_image']);
              $bg_image = "style=\"background-image:url('/".$bg_image."') !important;\"";
            }
            ?>
          
      <h2 class='node-title' <?=$bg_image?>>
        <?php print $title; ?>
      </h2>
    <?php endif; ?>

    <div id="inner-node-content">
        <?php if ($links): ?>
          <div class="node-links clear-block"><?php print $links; ?></div>
        <?php endif; ?>
      <?php //print $picture; ?>
      <?php if ($submitted && $teaser): ?>
        <div class='node-submitted clear-block'>
          <?php
              if($node->name !== "admin") {
                print 'by ' . theme('username', $node) . ' | ';
              }
              print format_date($node->created, 'custom', 'F d, Y');
          ?>
        </div>
      <?php endif; ?>
      <?php print $content; ?>
      <?php if ($submitted && !$teaser): ?>
        <div class='node-submitted clear-block'>
          <?php
              if($node->name !== "admin") {
                print '— ' . theme('username', $node) . ', ';
              }
              print format_date($node->created, 'custom', 'F d, Y');
              if ($terms) {
                  print 'Care of: ' . $terms;
              }
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php print $post; ?>
