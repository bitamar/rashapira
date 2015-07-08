<div id="node-<?php print $node->nid; ?>" class="node node-<?php print $node->type; ?>" <?php if (isset($node_width)): ?>style="width: <?php echo $node_width; ?>px;"<?php endif; ?>>

  <?php if (isset($edit_link)): ?>
    <div id="edit-links">
      <?php print $edit_link; ?>

      <?php if (isset($set_as_main_link)): ?><?php print $set_as_main_link; ?><?php endif; ?>
      <?php if (isset($set_as_sticky_link)): ?><?php print $set_as_sticky_link; ?><?php endif; ?>
      <?php if (isset($share_link)): ?><?php print $share_link; ?><?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if (!isset($hide_title)): ?>
    <h2><?php print $title; ?></h2>
  <?php endif; ?>

  <?php print render($content); ?>

  <?php if (isset($pager)): ?><?php print $pager; ?><?php endif; ?>
</div>
