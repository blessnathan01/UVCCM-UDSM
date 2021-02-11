/**
 *------------------------------------------------------------------------------
 * @package       TZ Infinite Carousel Module
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2012-2019 TemPlaza.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       Sonny
 * @Link:         https://templaza.com
 *------------------------------------------------------------------------------
 */
"use strict";
var tz_infinite_carousel = {
    lightboxopen    :   false,

    init:   function (id, delay, $) {
        var maxheight   =   0,
            $id         =   $('#'+id),
            i           =   0,
            row         =   $id.find('.row').length,
            column      =   $id.find('.row:first > div.tz-infinite-item').length,
            timer       =   delay*column;
        if (!row) return 0;
        $id.find('.row').each(function (i, el) {
            if (maxheight < $(this).height()) {
                maxheight = $(this).height();
                $id.height(maxheight);
            }
        });
        $id.find('.row:first > div.tz-infinite-item').addClass('active');
        i++;
        setInterval(function(){
            $id.find('.row').each(function (r, el) {
                $(this).find('div.tz-infinite-item').each(function (c, el) {
                    $(this).css('transition-delay',(0.25*(c+1))+'s');
                });
            });
            $id.find('div.tz-infinite-item').removeClass('active');
            $($id.find('.row')[i]).find('div.tz-infinite-item').each(function (c, el) {
                $(this).css('transition-delay',(1+(0.25*(c+1)))+'s').addClass('active');
            });
            if (i<row-1) {
                i++
            } else {
                i=0;
            }
        }, timer);

        $(window).on("resize", function () {
            maxheight = 0;
            $id.find('.row').each(function (i, el) {
                if (maxheight < $(this).height()) {
                    maxheight = $(this).height();
                    $id.height(maxheight);
                }
            });
        });
    },

    lightbox  :   function (buttons, id, $) {
        var items = [],
            $pic        = $('#'+id),
            $el = '';
        $el = $pic.find('.tz-item-media').each(function(i, el) {
            var thumb       =   $(el).find('img').attr('src'),
                $href       =   $(el).find('img').attr('src'),
                $dataid     =   $(el).data('id');
            if ($dataid !== 'undefined' && $dataid !== null) {
                var item = {
                    src     : $href,
                    dataid  : $dataid,
                    opts    : {
                        thumb   : thumb
                    }
                };
                items.push(item);
            }
        });
        $('#'+id+' .tz-item-lightbox').on('click', function(event) {
            event.preventDefault();

            var $clickid    = $(this).data('id'),
                $index      = 0;

            for (var $i = 0; $i<items.length; $i++) {
                if ($clickid === items[$i].dataid) {
                    $index  =   $i;
                }
            }
            if (tz_infinite_carousel.lightboxopen === false) {
                if ($(window).width()<768) {
                    var instance    = $.fancybox.open(items, {
                        loop : true,
                        thumbs : {
                            autoStart : false
                        },
                        buttons: buttons,
                        beforeShow: function( instance, slide ) {
                            tz_infinite_carousel.lightboxopen = true;
                        },
                        afterClose: function( instance, slide ) {
                            tz_infinite_carousel.lightboxopen = false;
                        }
                    }, $index);
                } else {
                    var instance    = $.fancybox.open(items, {
                        loop : true,
                        thumbs : {
                            autoStart : true
                        },
                        buttons: buttons,
                        beforeShow: function( instance, slide ) {
                            tz_infinite_carousel.lightboxopen = true;
                        },
                        afterClose: function( instance, slide ) {
                            tz_infinite_carousel.lightboxopen = false;
                        }
                    }, $index);
                }
            }
        });
    }
};
