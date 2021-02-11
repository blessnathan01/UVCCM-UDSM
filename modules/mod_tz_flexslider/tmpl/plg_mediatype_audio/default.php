<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015-2018 tzportfolio.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access
defined('_JEXEC') or die;

if($params -> get('mt_show_audio',1)):
    if(isset($item) && $item){
        if (isset($audio) && $audio) {
            $thumb      = '';
            $caption    =  $audio -> caption ? ($audio -> caption) : ($item->title);
            $media      = $item -> media -> audio;

            if($thumbSize = $params -> get('mt_audio_flex_thumbnail_size', 'o')){
                $thumb  = JUri::root().TZ_Portfolio_PlusFrontHelper::getImageURLBySize($media -> thumbnail, $thumbSize);
            }
?>
<div class="tz_audio">
    <?php if($params -> get('mt_audio_switcher','thumbnail') == 'thumbnail'){

    ?>
    <a href="<?php echo $item -> link; ?>">
        <img src="<?php echo $audio -> thumbnail; ?>"
             title="<?php echo $caption; ?>"
             alt="<?php echo $caption;
             ?>" data-tpp-flex-thumb="<?php echo $thumb;
             ?>" data-tpp-flex-thumb-alt="<?php echo $caption; ?>"/>
    </a>
    <?php }else{
        if($audio -> type == 'embed'){
            echo $audio -> embed_code;
        }else{
            ?>
    <iframe width="<?php echo $params -> get('mt_audio_soundcloud_width','100%');?>"
            height="<?php echo $params -> get('mt_audio_soundcloud_height');?>"
            src="<?php echo $audio -> url;?>" data-tpp-flex-thumb="<?php echo $thumb;
            ?>" data-tpp-flex-thumb-alt="<?php echo $caption; ?>"
            frameborder="0" allowfullscreen>
    </iframe>
        <?php }
    }
    ?>
</div>
        <?php }
    }
endif;