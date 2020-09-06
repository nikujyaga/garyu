// スクロールの速度
var speed = 1200; // ミリ秒

/* ドロップダウンメニュー */
var nav = $('#MainMenu');
nav.find('.sub-menu').slideUp(0);
$('li', nav).hover(function() {
  $('ul', this).slideDown('fast');
},
function() {
  $('ul', this).slideUp('fast');
});

/* モバイルメニュー */
var accordionTree = $('#AccordionTree');
accordionTree.slideUp(0);
$('#Trigger').click(function() {
  accordionTree.slideToggle();
});

/* lightboxのcss遅延読み込み  */
// var lazycss = function() {
//   var l = document.createElement('link');
//   l.rel = 'stylesheet';
//   l.href = 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css?ver=2.11.3';

//   var s = document.getElementById('normalize-css');
//   s.parentNode.insertBefore(l,s);
// };
// window.addEventListener("DOMContentLoaded", lazycss);

$(function() {
  /* #で始まるアンカーをクリックした場合に処理 */
  $('a[href^="#"]').click(function() {
     // アンカーの値取得
     var href= $(this).attr('href');
     // 移動先を取得
     var target = $(href == '#' || href == '' ? 'html' : href);
     // スムーススクロール
    if (target.length) {
      // 移動先を数値で取得
      var position = target.offset().top;
      $('html,body').animate({scrollTop:position}, speed, 'swing');
    }
    return false;
  });

  /* PageTop */
  var pageTop = jQuery('#Pagetop');
  pageTop.hide();
  $(window).scroll(function() {
    if (400 < jQuery(this).scrollTop()) {
      pageTop.fadeIn();
    } else {
      pageTop.fadeOut();
    }
  });
  pageTop.click(function () {
    jQuery('body,html').animate({
      scrollTop: 0
    }, 800);
    return false
  });

  /* スクロールに追従するサイドバー（Google AdSense自動広告対応） */
  $(window).on('load scroll resize', function() {
    setSideBar();
  });

  function setSideBar() {
    if (!($('#ScrollSidebarBlock').length)) return;

    var setWrap = $('#ContentsBlock');
    var wrapTop = setWrap.offset().top;
    var wrapHeight = setWrap.outerHeight();

    var sideBar2 = $('#ScrollSidebarBlock');
    var sideBar1Height = 0;
    var sideBar2Height = sideBar2.outerHeight(true);
    var sideBar2OffsetTop = 0;
    var adHeight = 0;
    var adCorrectionHeight =0; 

    if ($('#SidebarBlock').length) {
      sideBar1Height = $('#SidebarBlock').outerHeight(true);
      sideBar2OffsetTop = $('#SidebarBlock').offset().top + sideBar1Height;
    } else {
      sideBar2OffsetTop = wrapTop;
    }
    
    var googleAd = $($('#SideBar').children().last());
    if (googleAd.attr('class') == 'google-auto-placed') {
      adHeight = googleAd.outerHeight(true);
      adCorrectionHeight = parseInt(googleAd.children().css('margin-top'));
      adMarginTop = parseInt(googleAd.css('margin-top'));
      adMarginBottom = parseInt(googleAd.css('margin-bottom'));
    }
    else {
      googleAd = null;
    }

    sideBar2.css('width', sideBar2.outerWidth(true));
    if (sideBar1Height + sideBar2Height + adHeight < wrapHeight) {
      if (sideBar2OffsetTop < $(window).scrollTop()) {
        if (sideBar2Height + adHeight < $(window).height()) {
          if ($(window).scrollTop() < (wrapTop + wrapHeight - (sideBar2Height + adHeight))) {
            sideBar2.css({position: 'fixed', top: '0'});
            if (googleAd !== null) googleAd.css({position: 'fixed', top: sideBar2Height - adCorrectionHeight, width: 'initial'});
          } else {
            sideBar2.css({position: 'absolute', top: wrapHeight - (sideBar2Height + adHeight)});
            if (googleAd !== null) googleAd.css({position: 'absolute', top: wrapHeight - (adHeight + adCorrectionHeight)});
          }
        } else {
          if ($(window).scrollTop() + $(window).height() < wrapTop + wrapHeight) {
            if ($(window).scrollTop() < sideBar2OffsetTop) {
              sideBar2.css({position: 'fixed', top: '0'});
              if (googleAd !== null) googleAd.css({position: 'fixed', top: sideBar2Height, width: 'initial'});
            } else {
              if (sideBar2OffsetTop + sideBar2Height + adHeight < $(window).scrollTop() + $(window).height()) {
                sideBar2.css({position: 'absolute', top: $(window).scrollTop() - (sideBar2Height + adHeight - $(window).height()) - wrapTop});
                if (googleAd !== null) googleAd.css({position: 'absolute', top: $(window).scrollTop() - (adHeight + adCorrectionHeight - $(window).height()) - wrapTop});
              } else {
                sideBar2.css({position: 'absolute', top: sideBar2OffsetTop - wrapTop});
                if (googleAd !== null) googleAd.css({position: 'absolute', top: sideBar2OffsetTop - wrapTop + sideBar2Height - adCorrectionHeight});
              }
            }
          } else {
            sideBar2.css({position: 'absolute', top: wrapHeight - (sideBar2Height + adHeight)});
            if (googleAd !== null) googleAd.css({position: 'absolute', top: wrapHeight - (adHeight + adCorrectionHeight)});
          }
        }
      } else {
        sideBar2.css({position: 'static', top: 'auto'});
        if (googleAd !== null) googleAd.css({position: 'static', top: 'auto'});
      }
    }
  }

});
