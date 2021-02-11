<?php
/*------------------------------------------------------------------------

# TZ Infinite Carousel Module

# ------------------------------------------------------------------------

# Author:    Sonny

# Copyright: Copyright (C) 2011-2019 tzportfolio.com. All Rights Reserved.

# @License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website: http://www.tzportfolio.com

# Technical Support:  Forum - http://tzportfolio.com/forum

# Family website: http://www.templaza.com

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

JLoader::import('com_tz_portfolio_plus.libraries.helper.modulehelper', JPATH_ADMINISTRATOR.'/components');

JHtml::_('jquery.framework');

$list            = ModTZ_Infinite_CarouselHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

if($list) {
    $doc = JFactory::getDocument();
	$doc -> addStyleSheet('components/com_tz_portfolio_plus/css/all.min.css');
    $doc->addStyleSheet('modules/mod_tz_infinite_carousel/css/style.css');
	$doc->addScript('modules/mod_tz_infinite_carousel/js/script.js');
	$column                            =   $params->get('infinite_carousel_column',4);
	$height                            =   $params->get('slider_height','450px');
	$timer                             =   $params->get('timer',1000);
	if($params -> get('enable_bootstrap', 1)) {
		if( $params -> get('bootstrapversion', 4) == 4) {
			$doc->addScript(TZ_Portfolio_PlusUri::base(true) . '/vendor/bootstrap/js/bootstrap.min.js',
				array('version' => 'auto'));
			$doc->addStyleSheet(TZ_Portfolio_PlusUri::base(true) . '/vendor/bootstrap/css/bootstrap.min.css',
				array('version' => 'auto'));
			$doc->addScript(TZ_Portfolio_PlusUri::base(true) . '/vendor/bootstrap/js/bootstrap.bundle.min.js',
				array('version' => 'auto'));
		}else{
			$doc->addStyleSheet(TZ_Portfolio_PlusUri::base(true)
				. '/bootstrap/css/bootstrap.min.css', array('version' => 'auto'));
			$doc -> addScript(TZ_Portfolio_PlusUri::base(true).'/bootstrap/js/bootstrap.min.js',
				array('version' => 'auto'));
		}
	}
	$categories = ModTZ_Infinite_CarouselHelper::getCategoriesByArticle($params);
	$tags = ModTZ_Infinite_CarouselHelper::getTagsByArticle($params);
	$doc->addStyleDeclaration('#tz-infinite-carousel-'.$module -> id.', #tz-infinite-carousel-'.$module -> id.' .tz-item-container {height:'.$height.'}');
	$doc->addScriptDeclaration('
			jQuery(function($){
			    $(document).ready(function(){
			        tz_infinite_carousel.init( \'tz-infinite-carousel-'.$module -> id.'\', '.$timer.', $);
			    });
			});
		');
	if ($params -> get('show_lightbox', 1)){
		$doc -> addStyleSheet('components/com_tz_portfolio_plus/css/jquery.fancybox.min.css');
		$doc -> addScript('components/com_tz_portfolio_plus/js/jquery.fancybox.min.js');
		$lightboxopt                            =   $params->get('article_lightbox_option',array('zoom', 'slideShow', 'fullScreen', 'thumbs', 'close'));
		if ($lightboxopt && is_array($lightboxopt)) {
			for ($i = 0 ; $i< count($lightboxopt); $i++) {
				$lightboxopt[$i]  =   '"'.$lightboxopt[$i].'"';
			}
			$lightboxopt=   is_array($lightboxopt) ? implode(',', $lightboxopt) : '';
		} else {
			$lightboxopt=   '';
		}
		$doc->addScriptDeclaration('
			jQuery(function($){
			    $(document).ready(function(){
			        tz_infinite_carousel.lightbox( ['.$lightboxopt.'], \'tz-infinite-carousel-'.$module -> id.'\', $);
			    });
			});
		');
	}
}

require JModuleHelper::getLayoutPath('mod_tz_infinite_carousel', $params->get('layout', 'default'));