<?php
/*
	Template Name: Schedule
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">

<meta name="keywords" content="ダイビング,名古屋,ショップ,スクール,ツアースケジュール" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/system/js/jquery.iframe-auto-height.plugin.js"></script>
<script src="//feed.mobeek.net/static/loader.js"></script>
<script>
feedUID = '6WprZNme';
feedPrepare.toSmp = {};
feedPrepare.toTab = {};
feedPrepare();
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40977751-3', 'dolphin-divers.jp');
  ga('send', 'pageview');

</script>
<?php wp_head();?>
</head>
<body>
<h1>名古屋のダイビングショップ、ドルフィンダイバーズが開催しているダイビングツアーのスケジュールは、こちらでご確認ください。</h1>
<div id="wrapper">
  <div id="wrapper2">
    <div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
      <div id="mainBackground">
        <div id="wrapper4">
          <h2><img src="<?php bloginfo('template_url' ); ?>/img/schedule_h2.jpg" alt="ダイビングツアースケジュール" width="980" height="268"></h2>
          <div id="mainWrapper">
            <div class="innerpageMain">
            <div id="scheduleBox">
            <div><img src="<?php bloginfo('template_url' ); ?>/img/schedule_top.jpg" width="641" height="32"></div>
            <div id="scheduleinnner">
            <iframe src="https://dolphin-divers.jp/system/index.cgi?code=tour" name="disp"　id="disp" frameborder="0" scrolling="auto" width="590" align="left">当サイトはインラインフレームを使用しております。</iframe>
<script type="text/javascript">
jQuery('iframe').iframeAutoHeight();
</script>
            </div>
            <div><img src="<?php bloginfo('template_url' ); ?>/img/schedule_bottom.jpg" width="641" height="34"></div>
            </div>
            </div>
           <?php get_sidebar();?>
					<?php wp_footer(); ?>
