<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;

if(isset($item) && $item):
    if (isset($video) && $video) {
        $thumb      = '';
        $caption    =  $video -> title ? ($video -> title) : ($item->title);
        $media      = $item -> media -> video;

        if($thumbSize = $params -> get('mt_audio_flex_thumbnail_size', 'o')){
            $thumb  = JUri::root().TZ_Portfolio_PlusFrontHelper::getImageURLBySize($media -> thumbnail, $thumbSize);
        }
        ?>
        <div class="tz_portfolio_plus_video">
            <?php if($params -> get('mt_video_switcher','thumbnail') == 'thumbnail'){
                ?>
                <a href="<?php echo $item -> link; ?>">
                    <img src="<?php echo $video -> thumbnail; ?>" title="<?php echo $caption;
                         ?>" alt="<?php echo $caption;
                         ?>" data-tpp-flex-thumb="<?php echo $thumb;
                         ?>" data-tpp-flex-thumb-alt="<?php echo $caption; ?>"
                         itemprop="thumbnailUrl"/>
                </a>
            <?php }else{
                if($video -> type == 'embed'){
                    echo $video -> embed_code;
                }else{
                    ?>
                    <iframe src="<?php echo $video -> url;?>"
                            width="<?php echo $params -> get('mt_video_width');?>"
                            height="<?php echo $params -> get('mt_video_height');
                            ?>" data-tpp-flex-thumb="<?php echo $thumb;
                            ?>" data-tpp-flex-thumb-alt="<?php echo $caption; ?>"
                            frameborder="0" allowFullScreen itemprop="embedUrl">
                    </iframe>
                <?php }
            }
            ?>
        </div>
        <?php
    }
endif;