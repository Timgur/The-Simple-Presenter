<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 */

 get_header(); ?>
    <div id="fullscreen">
		<div id="navigation" class="fixed left bottom">
			<div class="overlay bottom left"></div>
			<ul id="toolbar">
				<li class="btn" ng-click="prevSlide()"><span class="prev">prev</span></li>
				<li class="btn" ng-click="toggleFullScreen(event)"><span class="fs">fullscreen</span></li>
				<li class="btn" ng-click="nextSlide()"><span class="next">next</span></li>
				<li class="number-counter">{{slidePos+1}}/{{slides.length+1}}</li>
			</ul>
		</div>
		<ul id="slideshow-container">
			<li id="slide-0" class="slide active" ng-class="{active : slidePos == 0, topTransition : lastPos == 0}" data-slideNumber="0">
				<div class="bg repeat imgur-grid"></div>
				<h1><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"></h1>
			</li>
			<li id="slide-{{$index+1}}" class="slide" ng-class="{active : slidePos == $index+1, topTransition : lastPos == $index+1}" ng-repeat="slide in slides | orderBy:orderProp" data-slideNumber="{{$index+1}}">
				<h1>{{slide.title}}</h1>
				<div ng-switch on='slide.template'>
					<div ng-switch-when="Text">text</div>
					<div ng-switch-when="Image">image</div>
					<div ng-switch-when="Data">data</div>
					<div ng-switch-when="Background Gallery">bg</div>
				</div>
			</li>
		</ul>
	</div>
<?php get_footer(); ?>
