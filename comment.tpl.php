<?php // $Id: comment.tpl.php,v 1.1.2.4.2.2.2.3 2009/12/30 17:06:50 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>
      <?php if ($submitted): ?>
        <div class='node-submitted clear-block'>
          <?php
              print 'by ' . theme('username', $node) . ' | ';
              print format_date($node->created, 'custom', 'F d, Y');
              if ($terms) {
                  print ' | in ' . $terms;
              }
          ?>
        </div>
      <?php endif; ?>
  <?php print $picture; ?>

  <div class="comment-content clear-block">
    <?php print $content; ?>
  </div>

  <?php if ($links): ?>
    <div class="comment-links clear-block"><?php print $links; ?></div>
  <?php endif; ?>

</div>

<?php print $post; ?>
