<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) { echo ' :'; } ?> <?php bloginfo( 'name' ); ?></title>

    <link href="http://www.google-analytics.com/" rel="dns-prefetch"><!-- dns prefetch -->
    <!-- meta -->

    <!-- icons -->
    <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">

    <!-- css + javascript -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <!-- Pushy Menu -->
  <nav class="pushy pushy-left">
    <?php wpeMobileNav(); ?>
  </nav>
  <!-- Site Overlay -->
  <div class="site-overlay"></div>
  <!-- Your Content -->
  <div id="container">
    <div id="wrapper">
      <div id="header">
        <div class="menu-btn"><span>menu</span></div>
        <div class="container">
          <?php wpeHeadNav(); ?>
          <?php wpeHeadRNav(); ?>
          <a href="<?php echo home_url(); ?>" class="logo">Топ лучших игр</a>
        </div>
      </div>
      <div class="container">
        <div class="wrap">

