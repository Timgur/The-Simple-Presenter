<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html ng-app id="ng-app" class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html ng-app class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html ng-app <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( 'The Simple Presentation |', true, 'left' ); ?></title>
<?php if(current_user_can('edit_post')) : ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="main" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php endif; ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" type="text/css" media="screen" />
<script src="<?php echo get_template_directory_uri(); ?>/js/lib/angular.unstable.min.js" type="text/javascript"></script>
<?php if(current_user_can('edit_post')) { wp_head(); } ?>
</head>

<body ng-controller="SlideListCtrl" ng-keydown="keyPress($event)" <?php body_class(); ?>>
