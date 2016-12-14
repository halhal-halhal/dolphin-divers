<?php
/*
	Template Name: QandA
*/
?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			<?php wp_title('|', true, 'right'); ?>
			<?php bloginfo('name'); ?>
		</title>
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<meta name="keywords" content="ダイビング,名古屋,緑区,天白区,ダイビングショップ,ダイビングスクール,Q&A" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" type="text/css" />
		<script src="//feed.mobeek.net/static/loader.js"></script>
		<script>
			feedUID = '6WprZNme';
			feedPrepare.toSmp = {};
			feedPrepare.toTab = {};
			feedPrepare();
		</script>
		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] || function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-40977751-3', 'dolphin-divers.jp');
			ga('send', 'pageview');
		</script>
		<?php wp_head();?>
	</head>

	<body>
		<h1>名古屋市緑区のダイビングショップ、ドルフィンダイバーズに、よくご相談いただくご質問をまとめています。</h1>
		<div id="wrapper">
			<div id="wrapper2">
				<div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
					<div id="mainBackground">
						<div id="wrapper4">
							<h2><img src="<?php bloginfo('template_url' ); ?>/img/faq_h2.jpg" alt="Q&amp;A" width="980" height="267"></h2>
							<div id="mainWrapper">
								<div class="innerpageMain">

									<?php
            					$wp_query = new WP_Query();
    									$param = array(
    										'posts_per_page' => '-1', //表示件数。-1なら全件表示
												
												'post_type' => 'qaa',
									      'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
                				'orderby' => 'DATE', //ID順に並び替え→DATE順
                				'order' => 'ASC'
                			);
                			$wp_query->query($param);
                			if($wp_query->have_posts()): while($wp_query->have_posts()) : $wp_query->the_post();
            			?>
										<dl class="faq">
											<dt><?php the_title(); ?></dt>
											<dd>
												<?php the_content();?>
											</dd>
										</dl>
										<?php endwhile; endif; ?>
										<?php wp_reset_query(); ?>
										<div class="pagetotop"><a href="#wrapper">▲ページ上部へ戻る</a></div>
								</div>
								<?php get_sidebar();?>
								<!-- / #sub -->
								<?php get_footer(); ?>