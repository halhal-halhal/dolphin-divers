<?php
/*
	Template Name: Taiken
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">

<meta name="keywords" content="ダイビング,名古屋,緑区,天白区,ダイビングショップ,ダイビングスクール,体験ダイビング" />
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
<h1>名古屋市緑区のダイビングショップ、ドルフィンダイバーズでライセンス取得、体験ダイビングのご案内。</h1>
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
			<div id="mainBackground">
				<div id="wrapper4">
					<h2><img src="<?php bloginfo('template_url' ); ?>/img/taiken_h2.jpg" alt="体験ダイビング" width="980" height="267"></h2>
					<div id="mainWrapper">
						<div class="innerpageMain2">
							<div class="taikenBox1">
								<h3><img src="<?php bloginfo('template_url' ); ?>/img/taiken_h3.jpg" width="710" height="909" alt="まずは海の世界を覗いてみよう"></h3>
								<p>「ダイビングをしてみたいけど、泳げないから不安」<br>
									「始める前に、本当にできるのか確認したい」<br>
									<br>
									まだちょっとダイビングを始めることに迷いがある人、<br>
									ダイビングにちょっぴり興味がある人、<br>
									そんな人には体験ダイビングがピッタリです。<br>
									<br>
									まずはドルフィンダイバーズと一緒に<br>
									海の世界、ダイビングの世界がどんなものか、<br>
									自分にとって魅力的なものか<br>
									確かめてみませんか？</p>
								<div><img src="<?php bloginfo('template_url' ); ?>/img/taiken_price.jpg" alt="費用15,000円（税別）" width="710" height="123"></div>
							</div>
							<div class="taikenBox2">
								<h4><img src="<?php bloginfo('template_url' ); ?>/img/taiken_h4_1.jpg" alt="ご参加条件" width="640" height="41"></h4>
								<p>10歳以上で健康体の方なら、どなたでも参加していただけます。<br>
									インストラクターが見守る中、じっくり体験ダイビングを楽しんでください。</p>
								<h4><img src="<?php bloginfo('template_url' ); ?>/img/taiken_h4_2.jpg" alt="ご用意いただくもの" width="640" height="41"></h4>
								<p>・水着<br>
									・タオル</p>
								<h4><img src="<?php bloginfo('template_url' ); ?>/img/taiken_h4_3.jpg" alt="体験内容" width="640" height="41"></h4>
								<p>最初は足のつく所で、器材の使い方や簡単なスキルの練習をします。<br>
									その後、実際に5m前後の水深にてダイビングを体験して頂きます。<br>
									基本はインストラクターとマンツーマンで開催し、不安が消えるまでマイペースで開催いたします。</p>
							</div>
							<div class="taikenBox3">
								<h3><img src="<?php bloginfo('template_url' ); ?>/img/taiken_box3.jpg" alt="本格的にダイビングを始めたい人はオープンウォーターダイバーコース" width="640" height="201" border="0" usemap="#Map">
									<map name="Map">
										<area shape="rect" coords="112,135,534,172" href="open.html" alt="オープンウォーターダイバーコース">
									</map>
								</h3>
								<p>※体験ダイビングを事前に参加しなくても、ダイビングライセンスを取得することは可能です<br>
									当店で体験ダイビングご参加後、次のステップに進まれる方には特別割引をしています。</p>
							</div>
						</div>
					<?php get_sidebar();?>
					<?php wp_footer(); ?>
