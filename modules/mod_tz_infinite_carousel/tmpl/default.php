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

if($list){
	$bootstrap4 = ($params -> get('bootstrapversion', 4) == 4);
?>
<div id="tz-infinite-carousel-<?php echo $module -> id;?>" class="tz-infinite-carousel<?php echo $bootstrap4?' tpp-bootstrap':' tzpp_bootstrap3'; echo ' '.$moduleclass_sfx;?>">
	<?php foreach($list as $i => $item){
		if ($i % $column == 0) {
			echo '<div class="row">';
		}
		// Get article's extrafields
		$extraFields    = TZ_Portfolio_PlusFrontHelperExtraFields::getExtraFields($item, null,
			false, array('filter.list_view' => true, 'filter.group' => $item -> params -> get('order_fieldgroup', 'rdate')));
		$item -> extrafields    = $extraFields;
		?>
        <div class="tz-infinite-item <?php echo 'col-12 col-sm-6 col-lg-'.(12/$column); ?>">
            <div class="tz-item-container">
                <?php if(!isset($item -> mediatypes) || (isset($item -> mediatypes) && !in_array($item -> type,$item -> mediatypes))){ ?>
                    <div class="tz-item-content">
                        <?php if($item -> params -> get('show_lightbox', 1)){ ?>
                            <a class="tz-item-lightbox" href="#" data-id="<?php echo $item-> id; ?>">
                                <i class="tps tp-search"></i>
                            </a>
                        <?php } ?>
                        <?php if($item -> params -> get('show_title', 1)){ ?>
                            <h3 class="tz-item-heading">
                                <a href="<?php echo $item -> link; ?>"><?php echo $item -> title; ?></a>
                            </h3>
                        <?php } ?>

                        <?php
                        //Call event onContentBeforeDisplay on plugin
                        if(isset($item -> event -> beforeDisplayContent)) {
                            echo $item->event->beforeDisplayContent;
                        }
                        ?>

                        <div class="tz-item-meta">
                            <?php
                            if (isset($item->event->beforeDisplayAdditionInfo)) {
                                echo $item->event->beforeDisplayAdditionInfo;
                            }
                            ?>
                            <?php if ($item -> params->get('show_category', 1)) {
                                if (isset($categories[$item->content_id]) && $categories[$item->content_id]) {
                                    if (count($categories[$item->content_id]))
                                        echo '<div class="tz_flex_categories"><i class="tps tp-folder-open"></i> ';
                                    foreach ($categories[$item->content_id] as $c => $category) {
                                        echo '<a href="' . $category->link . '">' . $category->title . '</a>';
                                        if ($c != count($categories[$item->content_id]) - 1) {
                                            echo ', ';
                                        }
                                    }
                                    echo '</div>';
                                }
                            } ?>
                            <?php if($item -> params -> get('show_created_date', 1)){ ?>
                                <div class="tz-item-created">
                                    <span class="tpr tp-clock"></span>
                                    <?php echo JHtml::_('date', $item -> created, JText::_('DATE_FORMAT_LC'));?>
                                </div>
                            <?php } ?>
                            <?php if($item -> params -> get('show_modified_date', 1)){ ?>
                                <div class="tz-item-modified">
                                    <span class="tpr tp-clock"></span>
                                    <?php echo JHtml::_('date', $item -> modified, JText::_('DATE_FORMAT_LC'));?>
                                </div>
                            <?php } ?>
                            <?php if($item -> params -> get('show_publish_date', 1)){ ?>
                                <div class="tz-item-publish">
                                    <span class="tpr tp-clock"></span>
                                    <?php echo JHtml::_('date', $item -> publish_up, JText::_('DATE_FORMAT_LC'));?>
                                </div>
                            <?php } ?>
                            <?php if($item -> params -> get('show_author', 1)){ ?>
                                <div class="tz-item-author">
                                    <span class="tps tp-user-circle"></span>
                                    <a href="<?php echo $item -> authorLink;?>"><?php echo $item -> author;?></a>
                                </div>
                            <?php } ?>
                            <?php
                            if ($item -> params->get('show_tag', 1)) {
                                if (isset($tags[$item->content_id])) {
                                    echo '<div class="tz_tag"><i class="tps tp-tag"></i> ';
                                    foreach ($tags[$item->content_id] as $t => $tag) {
                                        echo '<a href="' . $tag->link . '">' . $tag->title . '</a>';
                                        if ($t != count($tags[$item->content_id]) - 1) {
                                            echo ', ';
                                        }
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>

                            <?php
                            if(isset($item -> event -> afterDisplayAdditionInfo)){
                                echo $item -> event -> afterDisplayAdditionInfo;
                            }
                            ?>
                        </div>

                        <?php if($item -> params -> get('show_introtext', 1)){ ?>
                            <div class="tz-item-description"><?php echo $item -> introtext; ?></div>
                        <?php } ?>
                        <?php
                        if(isset($item -> extrafields) && !empty($item -> extrafields)):
                            ?>
                            <ul class="tz-extrafields">
                                <?php foreach($item -> extrafields as $field):?>
                                    <li class="tz_extrafield-item">
                                        <?php if($field -> hasTitle()):?>
                                            <div class="tz_extrafield-label"><?php echo $field -> getTitle();?></div>
                                        <?php endif;?>
                                        <div class="tz_extrafield-value pull-left">
                                            <?php echo $field -> getListing();?>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        <?php
                        endif;
                        ?>
                        <?php
                        if(isset($item -> event -> contentDisplayListView)) {
                            echo $item->event->contentDisplayListView;
                        }
                        ?>
                        <?php if($item -> params -> get('show_readmore', 1)){ ?>
                            <div class="tz-item-readmore">
                                <a class="btn" href="<?php echo $item -> link;?>"><?php echo JText::_('MOD_TZ_INFINITE_CAROUSEL_READ_MORE'); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if(isset($item->event->onContentDisplayMediaType) && $media = $item -> event -> onContentDisplayMediaType){ ?>
                    <div class="tz-item-media" data-id="<?php echo $item-> id; ?>"><?php echo $media;?></div>
                <?php } ?>
            </div>
        </div>

		<?php
		if ((($i % $column) == $column - 1) || ($i == count($list) - 1)) {
			echo '</div>';
		}
	} ?>
    <?php if($params -> get('show_view_all', 0)){?>
        <div class="tz-item-view-all text-center">
            <a href="<?php echo $params -> get('view_all_link');?>"<?php echo ($target = $params -> get('view_all_target'))?' target="'
                .$target.'"':'';?> class="btn btn-primary btn-view-all"><?php
                echo $params -> get('view_all_text', 'View All Portfolios');?></a>
        </div>
    <?php } ?>
</div>
<?php
}