<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015-2020 tzportfolio.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;

if(isset($item) && $item) :
    if (isset($slider) && $slider) {
        $media  = $item -> media -> image_gallery;
        $image  = '';
        $thumb  = '';
        $caption= '';
        if (isset($slider->featured) && $slider -> featured) {
            $image  = $slider -> featured;
            $key    = array_search($slider->featured, $media -> url);
            if($key !== false){
                $caption    = $slider -> caption[$key];
            }
        }else{
            $image  = $media -> url[0];
            $caption    = $media -> caption[0];
        }
        if($image){
            $oldVersion = preg_match('/media\/tz_portfolio_plus\/article\/cache/i', $image);

            if($oldVersion){
                $thumb  = TZ_Portfolio_PlusFrontHelper::getImageURLBySize($image,
                    $params->get('mt_image_gallery_flex_thumbnail_size', 'o'));
                $image  = TZ_Portfolio_PlusFrontHelper::getImageURLBySize($image,
                    $params->get('mt_image_gallery_flex_thumbnail_size', 'o'));
            }else{
                $prefixPath = 'images/tz_portfolio_plus/image_gallery/'.$item->id;
                if($params -> get('mt_image_gallery_flex_thumbnail_size', 'o') != 'o'){
                    $thumb  = $prefixPath.'/resize/'.$image;
                    $thumb  = TZ_Portfolio_PlusFrontHelper::getImageURLBySize($thumb, $params->get('mt_image_gallery_flex_thumbnail_size', 'o'));
                }else{
                    $thumb      = $prefixPath.'/'.$image;
                }
                if($params -> get('mt_img_gallery_size', 'o') != 'o'){
                    $image  = $prefixPath.'/resize/'.$image;
                    $image  = TZ_Portfolio_PlusFrontHelper::getImageURLBySize($image, $params->get('mt_img_gallery_size', 'o'));
                }else{
                    $image      = $prefixPath.'/'.$image;
                }
            }

            $image  = JUri::root().$image;
            if($thumb){
                $thumb  = JUri::root().$thumb;
            }
        }
        ?>
        <div class="tz_portfolio_plus_image_gallery">
            <a href="<?php echo $item -> link; ?>">
                <img src="<?php echo $image; ?>"
                     alt="<?php echo $caption ? $caption : $item->title; ?>"
                     title="<?php echo $caption ? $caption : $item->title; ?>"
                     data-tpp-flex-thumb="<?php echo $thumb; ?>"
                     data-tpp-flex-thumb-alt="<?php echo $item -> title; ?>"
                     itemprop="thumbnailUrl"/>
            </a>
        </div>
        <?php
    }
endif;