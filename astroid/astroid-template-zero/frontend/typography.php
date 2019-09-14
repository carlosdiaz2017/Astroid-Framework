<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 * 	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;
jimport('joomla.filesystem.helper');

extract($displayData);
//Font family
$ast_fontfamily = array();
// Body Font Styles
$body_font = $template->params->get('body_typography_options', NULL);
if ($body_font === NULL) {
   $body_font = new \stdClass();
}

$in_head = true;
if (isset($params) && !empty($params) && !$params['in_head']) {
   $in_head = false;
}

$style = $menu_style = $submenu_style = "";
$typography = array('body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6');
$style = '';
$tabletstyle = '';
$mobilestyle = '';


$libraryFonts = AstroidFrameworkHelper::getUploadedFonts($template->template);

// Body, H1 - H6 font styles.
foreach ($typography as $typo) {
   $typoType = $template->params->get($typo . '_typography');
   if (trim($typoType) == 'custom') {
      $typoOption = $typo . '_typography_options';
      $typoParams = $template->params->get($typoOption);
      $fontface = str_replace('+', ' ', explode(":", $typoParams->font_face));
      $style .= $typo . ',.' . $typo . '{';
	  
	  $tabletstyle .= $typo . ',.' . $typo . '{';
	  $mobilestyle .= $typo . ',.' . $typo . '{';
	  
      if (isset($fontface[0]) && !empty($fontface[0])) {
         if (isset($libraryFonts[$fontface[0]])) {
            $style .= 'font-family: ' . $libraryFonts[$fontface[0]]['name'] . ',' . $typoParams->alt_font_face . ';';
            AstroidFrameworkHelper::loadLibraryFont($libraryFonts[$fontface[0]], $template);
         } else {
            $style .= 'font-family: ' . $fontface[0] . ',' . $typoParams->alt_font_face . ';';
            if (!AstroidFrameworkHelper::isSystemFont($fontface[0])) {
               array_push($ast_fontfamily, $typoParams->font_face);
            }
         }
         //$document->addStyleSheet('https://fonts.googleapis.com/css?family='.$fontface[0]);
      }
	  
      if ((isset($typoParams->font_size) && !empty($typoParams->font_size)) && (is_object($typoParams->font_size))) {
		
		
		// desktop
		$font_size_unit = isset($typoParams->font_size_unit->desktop) ? $typoParams->font_size_unit->desktop : 'em';
		$style .= 'font-size: ' . $typoParams->font_size->desktop . $font_size_unit . ';';
		
		// tablet
		$font_size_unit = isset($typoParams->font_size_unit->tablet) ? $typoParams->font_size_unit->tablet : 'em';
		$tabletstyle .= 'font-size: ' . $typoParams->font_size->tablet . $font_size_unit . ';';
		
		// mobile
		$font_size_unit = isset($typoParams->font_size_unit->mobile) ? $typoParams->font_size_unit->mobile : 'em';
		$mobilestyle .= 'font-size: ' . $typoParams->font_size->mobile . $font_size_unit . ';';
		
      }else{
		  
		// desktop
		$font_size_unit = isset($typoParams->font_size_unit) ? $typoParams->font_size_unit : 'em';
        $style .= 'font-size: ' . $typoParams->font_size . $font_size_unit . ';';  
	  }
	  
      if (isset($typoParams->font_color) && !empty($typoParams->font_color)) {
         $style .= 'color: ' . $typoParams->font_color . ';';
      }
	  
      if ((isset($typoParams->letter_spacing) && !empty($typoParams->letter_spacing)) && (is_object($typoParams->letter_spacing))) {
		  
		  
		$letter_spacing_unit = isset($typoParams->letter_spacing_unit->desktop) ? $typoParams->letter_spacing_unit->desktop : 'em';
        $style .= 'letter-spacing: ' . $typoParams->letter_spacing->desktop. $letter_spacing_unit . ';';
		
		// tablet
		$letter_spacing_unit = isset($typoParams->letter_spacing_unit->tablet) ? $typoParams->letter_spacing_unit->tablet : 'em';
        $tabletstyle .= 'letter-spacing: ' . $typoParams->letter_spacing->tablet. $letter_spacing_unit . ';';
		
		// mobile
		$letter_spacing_unit = isset($typoParams->letter_spacing_unit->mobile) ? $typoParams->letter_spacing_unit->mobile : 'em';
        $mobilestyle .= 'letter-spacing: ' . $typoParams->letter_spacing->mobile. $letter_spacing_unit . ';';
		
      }else{
		$letter_spacing_unit = isset($typoParams->letter_spacing_unit) ? $typoParams->letter_spacing_unit : 'em';
        $style .= 'letter-spacing: ' . $typoParams->letter_spacing . $letter_spacing_unit . ';';
	  }
	  
      if (isset($typoParams->font_weight) && !empty($typoParams->font_weight)) {
         $style .= 'font-weight: ' . $typoParams->font_weight . ';';
      }
      if ((isset($typoParams->line_height) && !empty($typoParams->line_height)) && (is_object($typoParams->line_height))) {
         $line_height_unit = isset($typoParams->line_height_unit->desktop) ? $typoParams->line_height_unit->desktop : 'em';
         $style .= 'line-height: ' . $typoParams->line_height->desktop. $line_height_unit . ';';
		 
		 // tablet		 
		 $line_height_unit = isset($typoParams->line_height_unit->tablet) ? $typoParams->line_height_unit->tablet : 'em';
         $tabletstyle .= 'line-height: ' . $typoParams->line_height->tablet. $line_height_unit . ';';
		 
		 // mobile		 
		 $line_height_unit = isset($typoParams->line_height_unit->mobile) ? $typoParams->line_height_unit->mobile : 'em';
         $mobilestyle .= 'line-height: ' . $typoParams->line_height->mobile. $line_height_unit . ';';
		 
      }else{
		$line_height_unit = isset($typoParams->line_height_unit) ? $typoParams->line_height_unit : 'em';
        $style .= 'line-height: ' . $typoParams->line_height . $line_height_unit . ';';  
	  }
      if (isset($typoParams->text_transform) && !empty($typoParams->text_transform)) {
         $style .= 'text-transform: ' . $typoParams->text_transform . ';';
      }
      $style .= '}';
      $tabletstyle .= '}';
      $mobilestyle .= '}';
   }
}

// Menu Font Styles
$menuType = $template->params->get('menus_typography');
if (trim($menuType) == 'custom') {
   $menu_font = $template->params->get('menu_typography_options');
   $menu_fontface = str_replace('+', ' ', explode(":", $menu_font->font_face));
   $menu_style = '.astroid-nav>li>a,.astroid-sidebar-menu>li>a {';
   $tablet_menu_style = '.astroid-nav>li>a,.astroid-sidebar-menu>li>a {';
   $mobile_menu_style = '.astroid-nav>li>a,.astroid-sidebar-menu>li>a {';
   if (isset($menu_fontface[0]) && !empty($menu_fontface[0])) {

      if (isset($libraryFonts[$menu_fontface[0]])) {
         $menu_style .= 'font-family: ' . $libraryFonts[$menu_fontface[0]]['name'] . ';';
         AstroidFrameworkHelper::loadLibraryFont($libraryFonts[$menu_fontface[0]], $template);
      } else {
         $menu_style .= 'font-family: ' . $menu_fontface[0] . ';';
         if (!AstroidFrameworkHelper::isSystemFont($menu_fontface[0])) {
            array_push($ast_fontfamily, $menu_font->font_face);
         }
      }
   }
   if ((isset($menu_font->font_size) && !empty($menu_font->font_size)) && (is_object($menu_font->font_size))) {
      $font_size_unit = isset($menu_font->font_size_unit->desktop) ? $menu_font->font_size_unit->desktop : 'em';
      $menu_style .= 'font-size: ' . $menu_font->font_size->desktop . $font_size_unit . ';';
	  
	  // tablet
	  $font_size_unit = isset($menu_font->font_size_unit->tablet) ? $menu_font->font_size_unit->tablet : 'em';
      $tablet_menu_style .= 'font-size: ' . $menu_font->font_size->tablet . $font_size_unit . ';';
	  
	  // mobile
	  $font_size_unit = isset($menu_font->font_size_unit->mobile) ? $menu_font->font_size_unit->mobile : 'em';
      $mobile_menu_style .= 'font-size: ' . $menu_font->font_size->mobile . $font_size_unit . ';';
	  
   }else{
	$font_size_unit = isset($menu_font->font_size_unit) ? $menu_font->font_size_unit : 'em';
    $menu_style .= 'font-size: ' . $menu_font->font_size . $font_size_unit . ';';  
   }
   if (isset($menu_font->font_color) && !empty($menu_font->font_color)) {
      $menu_style .= 'color: ' . $menu_font->font_color . ';';
   }
   if ((isset($menu_font->letter_spacing) && !empty($menu_font->letter_spacing)) && (is_object($menu_font->letter_spacing))) {
      $letter_spacing_unit = isset($menu_font->letter_spacing_unit->desktop) ? $menu_font->letter_spacing_unit->desktop : 'em';
      $menu_style .= 'letter-spacing: ' . $menu_font->letter_spacing->desktop . $letter_spacing_unit . ';';
	  
	  // tablet
	  $letter_spacing_unit = isset($menu_font->letter_spacing_unit->tablet) ? $menu_font->letter_spacing_unit->tablet : 'em';
      $tablet_menu_style .= 'letter-spacing: ' . $menu_font->letter_spacing->tablet . $letter_spacing_unit . ';';
	  
	  //  mobile
	  $letter_spacing_unit = isset($menu_font->letter_spacing_unit->mobile) ? $menu_font->letter_spacing_unit->mobile : 'em';
      $mobile_menu_style .= 'letter-spacing: ' . $menu_font->letter_spacing->mobile . $letter_spacing_unit . ';';
	  
   }else{
	   $letter_spacing_unit = isset($menu_font->letter_spacing_unit) ? $menu_font->letter_spacing_unit : 'em';
      $menu_style .= 'letter-spacing: ' . $menu_font->letter_spacing . $letter_spacing_unit . ';';
   }
   if (isset($menu_font->font_weight) && !empty($menu_font->font_weight)) {
      $menu_style .= 'font-weight: ' . $menu_font->font_weight . ';';
   }
   
   
   if ((isset($menu_font->line_height) && !empty($menu_font->line_height)) && (is_object($menu_font->line_height))) {
      $line_height_unit = isset($menu_font->line_height_unit->desktop) ? $menu_font->line_height_unit->desktop : 'em';
      $menu_style .= 'line-height: ' . $menu_font->line_height->desktop . $line_height_unit . ';';
	  
	  // tablet
	   $line_height_unit = isset($menu_font->line_height_unit->tablet) ? $menu_font->line_height_unit->tablet : 'em';
      $tablet_menu_style .= 'line-height: ' . $menu_font->line_height->tablet . $line_height_unit . ';';
	  
	  // mobile
	   $line_height_unit = isset($menu_font->line_height_unit->mobile) ? $menu_font->line_height_unit->mobile : 'em';
      $mobile_menu_style .= 'line-height: ' . $menu_font->line_height->mobile . $line_height_unit . ';';
   }else{
	  $line_height_unit = isset($menu_font->line_height_unit) ? $menu_font->line_height_unit : 'em';
      $menu_style .= 'line-height: ' . $menu_font->line_height . $line_height_unit . ';';
   }
   if (isset($menu_font->text_transform) && !empty($menu_font->text_transform)) {
      $menu_style .= 'text-transform: ' . $menu_font->text_transform . ';';
   }
   $menu_style .= '}';
   $mobile_menu_style .= '}';
   $tablet_menu_style .= '}';
   
   
   if ((isset($menu_font->line_height) && !empty($menu_font->line_height)) && (is_object($menu_font->line_height))) {
      $line_height_unit = isset($menu_font->line_height_unit->desktop) ? $menu_font->line_height_unit->desktop : 'em';
      $menu_style .= '.astroid-sidebar-menu li > .nav-item-caret{line-height: ' . $menu_font->line_height->desktop . $line_height_unit . ' !important;}';
	  
	  // tablet
	  $line_height_unit = isset($menu_font->line_height_unit->tablet) ? $menu_font->line_height_unit->tablet : 'em';
      $tablet_menu_style .= '.astroid-sidebar-menu li > .nav-item-caret{line-height: ' . $menu_font->line_height->tablet . $line_height_unit . ' !important;}';
	  
	  // mobile
	  $line_height_unit = isset($menu_font->line_height_unit->mobile) ? $menu_font->line_height_unit->mobile : 'em';
      $mobile_menu_style .= '.astroid-sidebar-menu li > .nav-item-caret{line-height: ' . $menu_font->line_height->mobile . $line_height_unit . ' !important;}';
   }else{
	  $line_height_unit = isset($menu_font->line_height_unit) ? $menu_font->line_height_unit : 'em';
      $menu_style .= 'line-height: ' . $menu_font->line_height . $line_height_unit . ';';
      $menu_style .= '.astroid-sidebar-menu li > .nav-item-caret{line-height: ' . $menu_font->line_height . $line_height_unit . ' !important;}';
   }
}

// SubMenu Font Styles
$submenuType = $template->params->get('submenus_typography');
if (trim($submenuType) == 'custom') {
   $submenu_font = $template->params->get('submenu_typography_options');
   $submenu_fontface = str_replace('+', ' ', explode(":", $submenu_font->font_face));
   $submenu_style = '.nav-submenu-container .nav-submenu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {';
   
   $tablet_submenu_style = '.nav-submenu-container .nav-submenu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {';
   
   $mobile_submenu_style = '.nav-submenu-container .nav-submenu > li, .jddrop-content .megamenu-item .megamenu-menu li, .nav-submenu {';
   if (isset($submenu_fontface[0]) && !empty($submenu_fontface[0])) {
      if (isset($libraryFonts[$submenu_fontface[0]])) {
         $submenu_style .= 'font-family: ' . $libraryFonts[$submenu_fontface[0]]['name'] . ',' . $submenu_font->alt_font_face . ';';
         AstroidFrameworkHelper::loadLibraryFont($libraryFonts[$submenu_fontface[0]], $template);
      } else {
         $submenu_style .= 'font-family: ' . $submenu_fontface[0] . ', ' . $submenu_font->alt_font_face . ';';
         if (!AstroidFrameworkHelper::isSystemFont($submenu_fontface[0])) {
            array_push($ast_fontfamily, $submenu_font->font_face);
         }
      }
   }
   if ((isset($submenu_font->font_size) && !empty($submenu_font->font_size)) && (is_object($submenu_font->font_size))) {
      $font_size_unit = isset($submenu_font->font_size_unit->desktop) ? $submenu_font->font_size_unit->desktop : 'em';
      $submenu_style .= 'font-size: ' . $submenu_font->font_size->desktop . $font_size_unit . ';';
	  
	  // tablet
	  $font_size_unit = isset($submenu_font->font_size_unit->tablet) ? $submenu_font->font_size_unit->tablet : 'em';
      $tablet_submenu_style .= 'font-size: ' . $submenu_font->font_size->tablet . $font_size_unit . ';';
	  
	  // mobile
	  $font_size_unit = isset($submenu_font->font_size_unit->mobile) ? $submenu_font->font_size_unit->mobile : 'em';
      $mobile_submenu_style .= 'font-size: ' . $submenu_font->font_size->mobile . $font_size_unit . ';';
   }else{
	$font_size_unit = isset($submenu_font->font_size_unit) ? $submenu_font->font_size_unit : 'em';
    $submenu_style .= 'font-size: ' . $submenu_font->font_size . $font_size_unit . ';';  
   }
   if (isset($submenu_font->font_color) && !empty($submenu_font->font_color)) {
      $submenu_style .= 'color: ' . $submenu_font->font_color . ';';
   }
   if ((isset($submenu_font->letter_spacing) && !empty($submenu_font->letter_spacing)) && (is_object($submenu_font->letter_spacing))) {
      $letter_spacing_unit = isset($submenu_font->letter_spacing_unit->desktop) ? $submenu_font->letter_spacing_unit->desktop : 'em';
      $submenu_style .= 'letter-spacing: ' . $submenu_font->letter_spacing->desktop . $letter_spacing_unit . ';';
	  
	  // tablet
	  $letter_spacing_unit = isset($submenu_font->letter_spacing_unit->tablet) ? $submenu_font->letter_spacing_unit->tablet : 'em';
      $tablet_submenu_style .= 'letter-spacing: ' . $submenu_font->letter_spacing->tablet . $letter_spacing_unit . ';';
	  
	  // mobile
	  $letter_spacing_unit = isset($submenu_font->letter_spacing_unit->mobile) ? $submenu_font->letter_spacing_unit->mobile : 'em';
      $mobile_submenu_style .= 'letter-spacing: ' . $submenu_font->letter_spacing->mobile . $letter_spacing_unit . ';';	  
   }else{
	$letter_spacing_unit = isset($submenu_font->letter_spacing_unit) ? $submenu_font->letter_spacing_unit : 'em';
    $submenu_style .= 'letter-spacing: ' . $submenu_font->letter_spacing . $letter_spacing_unit . ';';  
   }
   if (isset($submenu_font->font_weight) && !empty($submenu_font->font_weight)) {
      $submenu_style .= 'font-weight: ' . $submenu_font->font_weight . ';';
   }
   if ((isset($submenu_font->line_height) && !empty($submenu_font->line_height)) && (is_object($submenu_font->line_height))) {
      $line_height_unit = isset($submenu_font->line_height_unit->desktop) ? $submenu_font->line_height_unit->desktop : 'em';
      $submenu_style .= 'line-height: ' . $submenu_font->line_height->desktop . $line_height_unit . ';';
	  
	  // tablet
	   $line_height_unit = isset($submenu_font->line_height_unit->tablet) ? $submenu_font->line_height_unit->tablet : 'em';
      $tablet_submenu_style .= 'line-height: ' . $submenu_font->line_height->tablet . $line_height_unit . ';';
	  
	  // mobile
	   $line_height_unit = isset($submenu_font->line_height_unit->mobile) ? $submenu_font->line_height_unit->mobile : 'em';
      $mobile_submenu_style .= 'line-height: ' . $submenu_font->line_height->mobile . $line_height_unit . ';';
   }
   if (isset($submenu_font->text_transform) && !empty($submenu_font->text_transform)) {
      $submenu_style .= 'text-transform: ' . $submenu_font->text_transform . ';';
   }
   $submenu_style .= '}';
   $tablet_submenu_style .= '}';
   $mobile_submenu_style .= '}';
}


// styles for tablet
$tabletCSS = '';
$tabletCSS .= '@media (min-width:768px){';
$tabletCSS .= $tabletstyle;
$tabletCSS .= $tablet_menu_style;
$tabletCSS .= $tablet_submenu_style;
$tabletCSS .= '}';

// styles for mobile
$mobileCSS = '';
$mobileCSS .= '@media (min-width:576px){';
$mobileCSS .= $mobilestyle;
$mobileCSS .= $mobile_menu_style;
$mobileCSS .= $mobile_submenu_style;
$mobileCSS .= '}';
 



// Let's add combined style sheets here
$ast_fontfamily_list = implode("|", str_replace(" ", "+", array_unique($ast_fontfamily)));
if ($in_head) {	
   $document = JFactory::getDocument();
   if (!empty($ast_fontfamily_list)) {
      $document->addStyleSheet('https://fonts.googleapis.com/css?family=' . $ast_fontfamily_list);
   }
   
   
   $template->addStyleDeclaration($style);
   $template->addStyleDeclaration($menu_style);
   $template->addStyleDeclaration($submenu_style);
   
   $template->addStyleDeclaration($tabletCSS);
   $template->addStyleDeclaration($mobileCSS);
   
} else {
   if (!empty($ast_fontfamily_list)) {
      echo '<link href="' . 'https://fonts.googleapis.com/css?family=' . $ast_fontfamily_list . '" rel="stylesheet" type="text/css" />';
   }
   echo "<style>";
   echo $style;
   echo $menu_style;
   echo $submenu_style;   
   echo $mobileCSS;
   echo $tabletCSS;
   echo "</style>";
}
?>
