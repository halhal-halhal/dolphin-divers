<?php
/*
	Template Name: Master
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">

<meta name="keywords" content="ダイビング,名古屋,緑区,天白区,ダイビングショップ,ダイビングスクール,プロ,ダイブマスター" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" type="text/css" />
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
<h1>名古屋市緑区のダイビングショップ、ドルフィンダイバーズでライセンス取得、ダイブマスターコースのご案内。</h1>
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
			<div id="mainBackground">
				<div id="wrapper4">
					<h2><img src="<?php bloginfo('template_url' ); ?>/img/master_h2.jpg" alt="ダイブマスターコース" width="980" height="267"></h2>
					<div id="mainWrapper">
						<div class="innerpageMain" style="padding-bottom:80px;">
							<h3><img src="<?php bloginfo('template_url' ); ?>/img/master_h3.jpg" width="414" height="61" alt="ダイビングのプロになろう"></h3>
							<div class="clear2">
								<p class="textstyle1"><img style="float:right;margin:0 0 5px 10px;" src="<?php bloginfo('template_url' ); ?>/img/master_img.jpg" width="321" height="218">ダイブマスターは、ダイビングのプロフェッショナルへの最初のステップ。<br>
									<br>
									インストラクターと共に働いて、あなたのダイビング知識を広げ、スキルをプロフェッショナルとして磨いてください。<br>
									<br>
									そしてインストラクターや生徒ダイバーのアシスタントをしながら、インストラクターレベルに近い、高いスキルを身に付けることができます。<br>
									<br>
									職業としてプロを目指したい方も、もっとダイビングを<br>
									奥深くまで知りたい方もダイブマスターを取得して、<br>
									ダイビングのプロフェッショナルになってください。</p>
							</div>
							<div><img src="<?php bloginfo('template_url' ); ?>/img/master_price.jpg" alt="100,000円" width="640" height="169"></div>
							<h4 class="headline1"><img src="<?php bloginfo('template_url' ); ?>/img/master_h4_1.jpg" alt="受講概要" width="640" height="41"></h4>
							<dl class="liststyle1">
								<dt><span>■</span>各コースの詳細はスタッフまでお問い合わせください。</dt>
								<dd>&nbsp;</dd>
							</dl>
							<h4 class="headline1"><img src="<?php bloginfo('template_url' ); ?>/img/master_h4_2.jpg" alt="受講資格" width="640" height="41"></h4>
							<p>PADIレスキューダイバーライセンス、もしくは同等ランクのCカード</p>
						</div>
											<?php get_sidebar();?>
						<!-- / #sub -->
						<?php get_footer(); ?>