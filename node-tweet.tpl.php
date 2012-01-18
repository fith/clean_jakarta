<?php // $Id: node.tpl.php,v 1.1.2.3.2.2.2.6 2010/03/01 13:37:46 psynaptic Exp $ ?>
<?php print $pre; ?>

<div <?php print drupal_attributes($attr); ?>>
            <?php
              $bird = new stdClass ();
              $bird->img_height = 1304;
              $bird->img_width = 1110;
              $bird->width = 696;
              $bird->height = 300;
              $bird->site = "jakartaorbust.com";
              //$bird->site = "default";
              $bird->x = rand(0, ($bird->img_width - $bird->width));
              $bird->y = rand(0, ($bird->img_height - $bird->height));
              
              $bg_image_url = "sites/".$bird->site."/themes/clean_jakarta/images/tweet-birds.jpg";
              $bg_image = " style=\"";
              $bg_image .= "background-position:-".$bird->x."px -".$bird->y."px; ";
              $bg_image .= "background-size:".$bird->img_width."px ".$bird->img_height."px; ";
              $bg_image .= $bg_image_margin;
              $bg_image .= "background-image:url('/".$bg_image_url."') !important;\"";
            ?>
  <div class="twitter-badge">
    <a href="<?php print $node->feedapi_node->url ?>">View Original</a>
  </div>
  <div class="tweet-content clear-block" <?=$bg_image?>>
    <?php if (!$page && $title): ?>

      
      <div class='tweet'>
        <?php 
          
          //if($node->feedapi_node->url != null) {
          //  $title_out = "<a href=\"" . $node->feedapi_node->url . "\">" . $node->title . "</a>";
          //} else {
            $count = 1;
            $title_out = _filter_url(str_replace("JakartaOrBust: ", "", $node->title, $count), '');
          //}
        ?>
        <?php print $title_out; ?>
      </div>
      <?php if ($links): ?>
          <div class="node-links clear-block"><?php print format_date($node->created, 'custom', 'F d, Y');?> <a href="<?php print $node->feedapi_node->url ?>">via Twitter</a></div>
        <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<?php print $post; ?>
