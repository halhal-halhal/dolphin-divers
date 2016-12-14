<?php
/*
Template Name: Enjoy_Diving
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">

	<meta name="keywords" content="ダイビング,名古屋,緑区,天白区,ダイビングショップ,ダイビングスクール,案内" />
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
<h1>名古屋市緑区のダイビングショップ、ドルフィンダイバーズがダイビングの魅力をご提案いたします。</h1>
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
			<div id="mainBackground">
				<div id="wrapper4">
					<h2><img src="<?php bloginfo('template_url' ); ?>/img/hajimete_h2.jpg" alt="ダイビングを始めよう enjoyダイビング!!" width="980" height="268"></h2>
					<div id="mainWrapper">
						<div class="innerpageMain2">
							<div class="hajimeteBox1">
								<div><img src="<?php bloginfo('template_url' ); ?>/img/hajimete_h3.jpg" alt="新しい世界を見に行こう" width="710" height="590"></div>
								<div class="hajimete_text1">
									<p>地球上の約7割を占め、そのほとんどが未知の世界である海。<br>
										地上では見ることのできないような、神秘的な生物たちが生きる水中の世界。<br>
										重力から解き放たれ、まるで空を飛んでいるような気分を味わえる不思議な世界。<br>
										<br>
										体験した人だけがその世界を共有できる。それがダイビングなんです。<br>
										見たことのない新しい世界を私たちと共有しませんか？<br>
										<br>
										ドルフィンダイバーズが、皆さまそれぞれの好奇心に合わせて「新しい世界」をご案内させていただきます。</p>
								</div>
							</div>
							<div class="hajimeteBox2">
								<div class="content1">
									<h3><img src="<?php bloginfo('template_url' ); ?>/img/hajimete_h3_2.jpg" alt="ダイビングを始めるためには" width="675" height="331" border="0" usemap="#Map">
										<map name="Map">
											<area shape="rect" coords="34,266,191,295" href="license.html" alt="Cカードとは？">
										</map>
									</h3>
									<p>ダイビングを安全に楽しむにはまず、「Cカード」というライセンスが必要になります。「Cカード」とは、一般的に「ダイビングライセンス」といわれる技能認定証のことです。<br>
										ダイビングは、「呼吸のできない」特別な環境下でのスポーツです。<br>
										知識や技術を持たない方がスキューバダイビングを行った場合、重大な事故に繋がる可能性が非常に高いことから、ほとんどの国で「Cカード」を所持し、一定の知識と技術を身につけていることがダイビングを楽しむための大前提となっています。</p>
								</div>
								<div>
									<h3><img src="<?php bloginfo('template_url' ); ?>/img/hajimete_h3_3.jpg" alt="まずは気軽にダイビングがどんなものか、海の中がどんな世界なのか感じてみたい方には体験ダイビング 費用¥15,750（税込）　交通費、ダイビング代、昼食代、器材レンタル等すべてを含みます" width="675" height="253" border="0" usemap="#Map2">
										<map name="Map2">
											<area shape="rect" coords="34,160,246,201" href="taiken.html" alt="体験ダイビング">
										</map>
									</h3>
								</div>
								<div class="content3">
									<h3><img src="<?php bloginfo('template_url' ); ?>/img/hajimete_h3_4.jpg" alt="新しい世界への第一歩です。費用¥63,000（税込）昼食代以外の必要な費用をすべて含んでいます。" width="675" height="352" border="0" usemap="#Map3">
										<map name="Map3">
											<area shape="rect" coords="35,258,421,297" href="open.html" alt="オープンウォーターダイバーコース">
										</map>
									</h3>
									<p>オープンウォーター・ダイバーのレッスンでは、<br>
										水の中という未知の世界へ入るために<br>
										最低限必要な知識を修得し、それを実際に経験していきます。<br>
										ダイバーになるための最初のコースで、<br>
										「学科講習」、「プール講習」、「海洋実習」の<br>
										3つのカリキュラムから成り立っています。<br>
										このコースを終了させるとはれてCカードを<br>
										手に入れることができます。<br>
										新しい世界の第一歩はここから始まるのです。</p>
								</div>
							</div>
						</div>
											<?php get_sidebar();?>
						<!-- / #sub -->
						<?php get_footer(); ?>