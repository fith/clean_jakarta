<?php // $Id: comment.tpl.php,v 1.1.2.4.2.2.2.3 2009/12/30 17:06:50 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>

  <?php if ($title): ?>
    <h2 class='comment-title'>
      <?php if ($new): ?>
        <a class="new">*</a>
      <?php endif; ?>
      <?php print $title; ?>
    </h2>
  <?php endif; ?>

  <?php if ($submitted): ?>
    <div class='comment-submitted clear-block'>
      <?php if ($submitted): ?>
        <div class='node-submitted clear-block'>
          <?php
            if ($submitted) { 
              print 'by ' . theme('username', $node) . ' | ';
              print format_date($node->created, 'custom', 'F d, Y');
              if ($terms) {
                  print ' | in ' . $terms;
              }
            } 
            ?>
        </div>
      <?php endif; ?>
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
