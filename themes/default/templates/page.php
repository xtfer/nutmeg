<?php
/**
 * @file
 * Default page template.
 */

?>

<html>
<head>
  <title><?php print $title; ?></title>
  <link type="text/css" rel="stylesheet" href="/themes/default/reset.css" media="all"/>
  <link type="text/css" rel="stylesheet" href="/themes/default/styles.css" media="all"/>
</head>
<body>

<div id="body">
  <?php print $header; ?>


  <div id="main">
    <div class="container">
      <?php print $content; ?>

    </div>

  </div>

  <?php print $footer; ?>

</div>

</body>
</html>
