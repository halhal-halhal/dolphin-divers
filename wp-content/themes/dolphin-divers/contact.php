<?php
/*
	Template Name: Contact
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">

<meta name="keywords" content="ダイビング,名古屋,緑区,天白区,ダイビングショップ,ダイビングスクール,お問い合わせ" />
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
<h1>名古屋市緑区のダイビングショップ、ドルフィンダイバーズへのご質問、お問い合わせはこちらから。</h1>
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
			<div id="mainBackground">
				<div id="wrapper4">
					<h2><img src="<?php bloginfo('template_url' ); ?>/img/contact_h2.jpg" alt="お問い合わせ" width="980" height="267"></h2>
					<div id="mainWrapper">
						<div class="innerpageMain">
							<h3 class="headline1"><img src="<?php bloginfo('template_url' ); ?>/img/contact_h3.jpg" alt="お問い合わせフォーム" width="641" height="41"></h3>
							<p class="contact_text">※マークは入力必須項目です。<br>
								※【お急ぎの場合】<br>
								お問い合わせの内容によりご返信までにお時間がかかる場合がございます。<br>
								お急ぎの場合はお電話でお問い合わせください。<br>
								※【連絡がない場合】<br>
								数日しても当社から連絡がない場合は、電話番号・メールアドレスの誤記入等が考えられます。<br>
								再度お問い合わせください。<br>
								※【お客様の個人情報】<br>
								お問い合わせの際にご連絡いただいたお客様の個人情報は、<br>
								お問い合わせにお答えする目的にのみ利用し、それ以外には利用いたしません。</p>
							<div id="contactBox">
								<div><img src="<?php bloginfo('template_url' ); ?>/img/schedule_top.jpg" width="641" height="32"></div>
								<div id="contactinnner">
									<iframe src="http://dolphin-divers.jp/system/?code=toiawase" name="a" frameborder="no" scrolling="no" marginwidth="0" marginheight="0" width="571" height="740" align="left"> <font color="#000000">当サイトはインラインフレームを使用しております。571 </font></iframe>
								</div>
								<div><img src="<?php bloginfo('template_url' ); ?>/img/schedule_bottom.jpg" width="641" height="34"></div>
							</div>
						</div>
										<?php get_sidebar();?>
						<!-- / #sub -->
						<?php get_footer(); ?>