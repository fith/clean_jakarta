<?php // $Id: comment.tpl.php,v 1.1.2.4.2.2.2.3 2009/12/30 17:06:50 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>
      <?php if ($submitted): ?>
        <div class='node-submitted clear-block'>
          <?php
              if($new) print '<span class="new">*</span>' ;
              print format_date($comment->timestamp, 'custom', 'M d, Y g:ia'); 
              print '<br/>';
              print 'by ' . $comment->registered_name . '<br/>';
              print $picture;
          ?>
        </div>
      <?php endif; ?>
  

  <div class="comment-content clear-block">
    <?php print $content; ?>
  </div>

  <?php if ($links && !strstr($links, "to post comments")): ?>
    <div class="comment-links clear-block"><?php print $links; ?></div>
  <?php endif; ?>

</div>

<?php print $post; ?>
