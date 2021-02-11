<?php
/*------------------------------------------------------------------------

# Flipbook Gallery Addon

# ------------------------------------------------------------------------

# author    Sonny

# copyright Copyright (C) 2019 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.tzportfolio.com

# Technical Support:  Forum - https://www.tzportfolio.com/help/forum.html

-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;

if(isset($item) && $item) :
    if (isset($flipbook_gallery) && $flipbook_gallery) {
	    if (isset($flipbook_gallery->data) && count($flipbook_gallery->data)) {
		    if ($flipbook_gallery->featured) {
			    $image  =   $flipbook_gallery->featured;
		    } else {
			    $image  =   $flipbook_gallery->data[0];
		    }
//		    jimport('joomla.filesystem.file');
//		    $image_size =   $params->get('mt_cat_flipbook_gallery_size','o');
//		    if ($image_size != 'o') {
//			    $image  =   'images/tz_portfolio_plus/flipbook_gallery/'.$item->id.'/resize/'
//				    . JFile::stripExt($image)
//				    . '_' . $image_size . '.' . JFile::getExt($image);
//		    } else {
//			    $image  =   'images/tz_portfolio_plus/flipbook_gallery/'.$item -> id.'/'.$image;
//		    }

            if($image){
                $image_size = $params->get('mt_cat_flipbook_gallery_size','o');
                $prefixPath = 'images/tz_portfolio_plus/flipbook_gallery/'.$item->id;

                if($params -> get('mt_flipbook_gallery_flex_thumbnail_size', 'o') != 'o'){
                    $thumb      = $prefixPath.'/resize/'.$image;
                    $thumb  = TZ_Portfolio_PlusFrontHelper::getImageURLBySize($thumb,
                        $params -> get('mt_flipbook_gallery_flex_thumbnail_size', 'o'));
                }else{
                    $thumb      = $prefixPath.'/'.$image;
                }
                if ($image_size != 'o') {
                    $image      = $prefixPath.'/resize/'.$image;
                    $image  = TZ_Portfolio_PlusFrontHelper::getImageURLBySize($image, $image_size);
                }else{
                    $image      = $prefixPath.'/'.$image;
                }
                $image  = JUri::root().$image;
                if($thumb){
                    $thumb  = JUri::root().$thumb;
                }
            }

		    ?>
            <div class="tz_portfolio_plus_flipbook_gallery">
                <a href="<?php echo $item -> link;?>">
                    <img src="<?php echo $image;?>"
                         alt="<?php echo $item -> title; ?>"
                         title="<?php echo $item -> title; ?>"
                         itemprop="thumbnailUrl"/>
                </a>
            </div>
		    <?php
	    }
    }
endif;