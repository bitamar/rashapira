<div id="page">
  <div id="main-wrapper">

    <div id="sidebar">
      <h1><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a></h1>

      <?php print render($page['sidebar_first']); ?>
    </div>

    <div id="content">
      <?php print $messages; ?>
      <?php print render($page['content']); ?>
    </div>
  </div>

  <div id="footer">
    <?php print render($page['footer']); ?>
  </div>

</div>
