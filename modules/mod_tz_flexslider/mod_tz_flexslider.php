<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus FlexSlider Module

# ------------------------------------------------------------------------

# Author:    DuongTVTemPlaza

# Copyright: Copyright (C) 2011-2020 tzportfolio.com. All Rights Reserved.

# @License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website: http://www.tzportfolio.com

# Technical Support:  Forum - http://tzportfolio.com/forum

# Family website: http://www.templaza.com

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

// Include the latest functions only once
JLoader::register('modTZ_Portfolio_PlusFlexSliderHelper', __DIR__ . '/helper.php');

JLoader::import('com_tz_portfolio_plus.libraries.helper.modulehelper', JPATH_ADMINISTRATOR.'/components');
JLoader::import('extrafields', COM_TZ_PORTFOLIO_PLUS_SITE_HELPERS_PATH);

JHtml::_('jquery.framework');

$list            = modTZ_Portfolio_PlusFlexSliderHelper::getList($params, $module);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

if($list) {

    $doc = JFactory::getDocument();
    $doc->addStyleSheet(JUri::base(true) . '/modules/' . $module->module . '/css/flexslider.css');

    // RTL css
    if(JFactory::getLanguage() -> isRtl()){
        $doc->addStyleSheet(JUri::base(true) . '/modules/' . $module->module . '/css/flexslider-rtl-min.css');
    }
    $doc->addStyleSheet(JUri::base(true) . '/modules/' . $module->module . '/css/style.css');

    $doc->addScript(JUri::base(true) . '/modules/' . $module->module . '/js/jquery.flexslider-min.js');

//    $flexOptions    = array();
//    $flexOptions['animation']   = $params -> get('flex_animation', 'fade');
//    $flexOptions['easing']   = $params -> get('flex_easing', 'swing');
    $flexOptions    = new stdClass();
    $flexOptions -> animation   = $params -> get('flex_animation', 'fade');
    $flexOptions -> easing      = $params -> get('flex_easing', 'swing');
    $flexOptions -> direction   = $params -> get('flex_direction', 'horizontal');
    $flexOptions -> reverse     = $params -> get('flex_reverse', 0)?'true':'false';
    $flexOptions -> animationLoop     = $params -> get('flex_animationLoop', 1)?1:0;

//    var_dump(json); die();

    $flexControlNav = $params -> get('flex_controlNav', 'none');
    $flexAddOptions = '';

    if($flexControlNav == 'thumbnail_slider'){
        $flexAddOptions = 'window.modTPFlexOptions["sync"]      = "#module__'.$module -> id.' [data-tpp-flexslider__carousel]";';
        $flexAddOptions = 'window.modTPFlexOptions["slideshow"] = false;';
        $flexAddOptions = '
            window.modTPFlexCarouselOptions = {
                animation: "slide",
                controlNav: false,
                animationLoop: '.($params -> get('flex_animationLoop', 1)?'true':'false').',
                slideshow: false,
                startAt: '.($params -> get('flex_startAt', 0)).',
                itemWidth: '.$params -> get('flex_itemWidth', 0).',
                itemMargin: '.$params -> get('flex_itemMargin', 0).',
                move: '.$params -> get('flex_move', 0).',
                minItems: '.$params -> get('flex_minItems', 0).',
                maxItems: '.$params -> get('flex_maxItems', 0).',
                asNavFor: "#module__'.$module -> id.' [data-tpp-flexslider]"
            };';
    }

    $doc -> addScriptDeclaration('
    (function($, window){
        "use strict";
            window.modTPFlexOptions = {
//                "namespace": "tp-",

                animation: "'.($params -> get('flex_animation', 'fade')).'",
                easing: "'.($params -> get('flex_easing', 'swing')).'",
                direction: "'.($params -> get('flex_direction', 'horizontal')).'",
                reverse: '.($params -> get('flex_reverse', 0)?'true':'false').',
                animationLoop: '.($params -> get('flex_animationLoop', 1)?'true':'false').',
                smoothHeight: '.($params -> get('flex_smoothHeight', 0)?'true':'false').',
                startAt: '.($params -> get('flex_startAt', 0)).',
                slideshow: '.($params -> get('flex_slideshow', 1)?'true':'false').',
                slideshowSpeed: '.($params -> get('flex_slideshowSpeed', 7000)).',
                animationSpeed: '.($params -> get('flex_animationSpeed', 600)).',
//                randomize: false,
                fadeFirstSlide: '.($params -> get('flex_fadeFirstSlide', 0)?'true':'false').',
                thumbCaptions: false,
                
                pauseOnAction: '.($params -> get('flex_pauseOnAction', 1)?'true':'false').',
                pauseOnHover: '.($params -> get('flex_pauseOnHover', 0)?'true':'false').',
                pauseInvisible: '.($params -> get('flex_pauseInvisible', 1)?'true':'false').',
                useCSS: true,
                touch: '.($params -> get('flex_touch', 1)?'true':'false').',
                video: false,
                
                controlNav: '.($flexControlNav == 'thumbnails'?'"thumbnails"':($flexControlNav == 'thumbnail_slider'?'false':'true')).',
                directionNav: '.($params -> get('flex_directionNav', 1)?'true':'false').',
                prevText: "'.($params -> get('flex_prevText' )).'",
                nextText: "'.($params -> get('flex_nextText' )).'",
                
                keyboard: '.($params -> get('flex_keyboard', 1)?'true':'false').',
                multipleKeyboard: '.($params -> get('flex_multipleKeyboard', 0)?'true':'false').',
                mousewheel: '.($params -> get('flex_mousewheel', 0)?'true':'false').',
                pausePlay: '.($params -> get('flex_pausePlay', 0)?'true':'false').',
                pauseText: "'.($params -> get('flex_pauseText' )).'",
                playText: "'.($params -> get('flex_playText' )).'",
                init: function(slider){
                    slider.slides.each(function(){
                        var tpSlide = $(this),
                            tpFlexThumb = tpSlide.find("[data-tpp-flex-thumb]");
                        if(tpFlexThumb.length){
                            if(tpFlexThumb.data("tpp-flex-thumb") != undefined){                                
                                tpSlide.attr("data-thumb",tpFlexThumb.data("tpp-flex-thumb"));
                                tpFlexThumb.removeAttr("data-tpp-flex-thumb");
                                
                                var tpFlexThumbAlt  = tpSlide.find("[data-tpp-flex-thumb-alt]");
                                if(tpFlexThumbAlt.data("tpp-flex-thumb-alt") != undefined){
                                    tpSlide.attr("data-thumb-alt",tpFlexThumbAlt.data("tpp-flex-thumb-alt"));
                                    tpFlexThumbAlt.removeAttr("data-tpp-flex-thumb-alt");
                                }
                            }
                        }
                    });
                }
                
            };
            '.$flexAddOptions.'
    })(jQuery, window);');
}

require TZ_Portfolio_PlusModuleHelper::getTZLayoutPath($module, $params->get('layout', 'default'));