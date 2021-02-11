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

if($list){
    $tmpl   = JFactory::getApplication() -> input -> getString('tmpl');

    $doc -> addScriptDeclaration('(function($){
        "use strict";
        $(document).ready(function(){
            $("#module__'.$module -> id.' [data-tpp-flexslider]").find("li").each(function(){
                var html    = "<li>";
                html += "<img src=\\""+$(this).find("[data-tpp-flex-thumb]").data("tpp-flex-thumb")+"\\" alt=\\"\\"/>";
                html += "</li>";
                $("#module__'.$module -> id.' [data-tpp-flexslider__carousel] > .slides").append(html);
            });
            $("#module__'.$module -> id.' [data-tpp-flexslider]").flexslider(modTPFlexOptions);
            if($("#module__'.$module -> id.' [data-tpp-flexslider__carousel]").length && (typeof modTPFlexCarouselOptions != undefined)){
                $("#module__'.$module -> id.' [data-tpp-flexslider__carousel]").flexslider(modTPFlexCarouselOptions);
            }
        });
    })(jQuery);');
?>
<div id="module__<?php echo $module -> id;?>" class="tpp-module__flexslider<?php echo $moduleclass_sfx;?>">
    <div class="flexslider" data-tpp-flexslider>
        <ul class="slides">
        <?php foreach($list as $i => $item){
            // Get article's extrafields
            $extraFields    = TZ_Portfolio_PlusFrontHelperExtraFields::getExtraFields($item, null,
                false, array('filter.list_view' => true, 'filter.group' => $item -> params -> get('order_fieldgroup', 'rdate')));
            $item -> extrafields    = $extraFields;

            ob_start();
            require TZ_Portfolio_PlusModuleHelper::getTZLayoutPath($module, '_item_info');
            $info   = ob_get_contents();
            ob_end_clean();
            $info   = trim($info);
            ?>
            <?php if($info || (isset($item->event->onContentDisplayMediaType) && $item -> event -> onContentDisplayMediaType)){ ?>
            <li class="item">
                <?php
                if(isset($item->event->onContentDisplayMediaType) && ($media = $item -> event -> onContentDisplayMediaType)){
                ?>
                <div class="tpp-module-media"><?php echo $media;?></div>
                <?php } ?>

                <?php
                if($info){
                ?>
                <div class="flex-caption"><?php echo $info;?></div>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </div>
    <?php if($params -> get('flex_controlNav', 'none') == 'thumbnail_slider'){ ?>
    <div class="flexslider" data-tpp-flexslider__carousel>
        <ul class="slides"></ul>
    </div>
    <?php } ?>
    <?php if($params -> get('show_view_all', 0)){?>
        <div class="tpp-portfolio__action text-center">
            <a href="<?php echo $params -> get('view_all_link');?>"<?php echo ($target = $params -> get('view_all_target'))?' target="'
                .$target.'"':'';?> class="btn btn-primary btn-view-all"><?php
                echo $params -> get('view_all_text', 'View All Portfolios');?></a>
        </div>
    <?php } ?>
</div>
<?php
}