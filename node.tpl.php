<?php // $Id: node.tpl.php,v 1.1.2.3.2.2.2.6 2010/03/01 13:37:46 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>

  <div class="node-content clear-block">
    <?php if (!$page && $title): ?>
      <h2 class='node-title' style="background-image:url('<?php print $node->field_images[0]['filepath']; ?>') !important;">
        <?php print $title; ?>
      </h2>
    <?php endif; ?>

    <div id="inner-node-content">
      <?php if ($submitted): ?>
        <div class='node-submitted clear-block'>
          <?php
            if ($submitted) { 
              if($node->name !== "admin") {
                print 'by ' . theme('username', $node) . ' | ';
              }
              print format_date($node->created, 'custom', 'd/m/Y');
              if ($terms) {
                  print ' | in ' . $terms;
              }
            } 
            ?>
        </div>
      <?php endif; ?>

      <?php print $picture; ?>

      <?php print $content; ?>

        <?php if ($links): ?>
          <div class="node-links clear-block"><?php print $links; ?></div>
        <?php endif; ?>
    </div>
  </div>
</div>

<?php print $post; ?>
