<?php
/*
	Template Name: Speciality
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">

<meta name="keywords" content="ダイビング,名古屋,緑区,天白区,ダイビングショップ,ダイビングスクール,スペシャルティコース" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url' ); ?>/js/ui.core.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url' ); ?>/js/ui.tabs.js"></script>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/ui.tabs.css" rel="stylesheet" type="text/css" />
<script src="//feed.mobeek.net/static/loader.js"></script>
<script>
feedUID = '6WprZNme';
feedPrepare.toSmp = {};
feedPrepare.toTab = {};
feedPrepare();
</script>
<script type="text/javascript">
$(function() {
$('#ui-tab > ul').tabs({ fx: { opacity: 'toggle', duration: 'normal'  } });
});
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
<h1>名古屋市緑区のダイビングショップ、ドルフィンダイバーズでライセンス取得、スペシャルティコースのご案内。</h1>
<div id="wrapper">
	<div id="wrapper2">
		<div id="wrapper3"> <a class="logo" href="index.html">SCUBA DIVING ドルフィンダイバーズ</a>
			<div id="mainBackground">
				<div id="wrapper4">
					<h2><img src="<?php bloginfo('template_url' ); ?>/img/speciality_h2.jpg" alt="スペシャルティコース" width="980" height="267"></h2>
					<div id="mainWrapper">
						<div class="innerpageMain2">
							<div class="speciality_topbox">
								<h3><img src="<?php bloginfo('template_url' ); ?>/img/speciality_h3.jpg" alt="新しい世界の楽しみ方は1つじゃありません！" width="710" height="468"></h3>
								<p>ダイビングをもっともっと楽しく・・ <br>
									遊びのコツをマスターしながら、 <br>
									知識・テクニックを身につけましょう。 <br>
									<br>
									興味のあるスタイルについて楽しみながら<br>
									経験の幅を広げることができ、<br>
									ダイビングの基本的なスキルを向上させるのが<br>
									スペシャルティコース。 <br>
									<br>
									基本スキルを向上させることによって、 <br>
									自分らしいダイビングの楽しみ方を見つけて<br>
									ください。</p>
							</div>
							<div id="ui-tab_wrapper">
								<div id="ui-tab">
									<ul id="tab_menu">
										<li id="tab1"><a href="#fragment-1"><span><img src="<?php bloginfo('template_url' ); ?>/img/tab1.png" alt="基本スキルを磨くSPコース" width="145" height="52" /></span></a></li>
										<li id="tab2"><a href="#fragment-2"><span><img src="<?php bloginfo('template_url' ); ?>/img/tab2.png" alt="遊びのコツをマスターするSPコース" width="188" height="52" /></span></a></li>
										<li id="tab3"><a href="#fragment-3"><span><img src="<?php bloginfo('template_url' ); ?>/img/tab3.png" alt="活動範囲を広げるSPコース" width="150" height="52" /></span></a></li>
									</ul>
									<!-- 基本スキルを磨くSPコース -->
									<div class="tabbox_wrapper">
										<div id="fragment-1">
											<h4><img src="<?php bloginfo('template_url' ); ?>/img/speciality_h4_1.jpg" width="643" height="41"></h4>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_1_1.jpg" width="206" height="162" alt="水中ナチュラリストSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>水中ナチュラリストSPコース</dt>
														<dd>水中ナチュラリストSPコースでは、魚やいろいろな水中生物を観察し海の自然環境に詳しくなります。危険な生物の判断や、水中生物の行動を妨げない<br>
															テクニックを身につけて自然に優しいダイバーになりましょう。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_1_2.jpg" width="206" height="162" alt="水中ナビゲーションSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>水中ナビゲーションSPコース</dt>
														<dd>コンパスやセクスタントを使い、目的地に正確にたどりつくナビゲーションのテクニックをマスターすれば最短距離のコースで楽に移動できるばかりでなく、万一水中で位置をロストしてしまった場合でも、落ち着いた行動がとれます。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price2.jpg" width="223" height="36" alt="費用 ¥20,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>エクイップメント（器材）SPコース</dt>
														<dd>ダイビングは器材への依存度がかなり高いスポーツです。このコースでは器材のメンテナンス法、使い方、長持ちさせるコツなどを学びます。知識があれば万一のトラブル時にフレキシブルに対処することもできるようになります。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="ボート・ダイバーSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>ボート・ダイバーSPコース</dt>
														<dd>ボートからのエントリー&amp;エキジットの方法などボートダイビングのテクニックをマスターします。 世界のベストポイントはボートダイビングの技術が必須です。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_1_5.jpg" width="206" height="162" alt="ピーク・パフォーマンス・ボイヤンシーSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>ピーク・パフォーマンス・ボイヤンシーSPコース</dt>
														<dd>ダイバーならぜひ取っておきたいビギナーさん必須のこのコース。浮きすぎない、沈みすぎない中性浮力をマスターして水中でピタッと止まれて行動したいことが思いのまま。水中での余裕につなげましょう。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>ドライスーツSPコース</dt>
														<dd>体が濡れないドライスーツの使い方をマスターして、オールシーズン通した快適なダイビングを楽しめます。ドライスーツの初歩的な使い方からメンテナンスまでオールシーズンダイバーを目指すダイバーには必須のコースです。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
										</div>
									</div>
									<!-- /基本スキルを磨くSPコース --> 
									<!-- 遊びのコツをマスターするSPコース -->
									<div class="tabbox_wrapper">
										<div id="fragment-2">
											<h4><img src="<?php bloginfo('template_url' ); ?>/img/speciality_h4_2.jpg" alt="遊びのコツをマスターするSPコース" width="643" height="41"></h4>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>プロジェクトAWARE（レクチャー）コース</dt>
														<dd>海洋環境を守るには、どうすべきかを知ってもらうことをテーマにしている コースです。まずは水中生態系を崩さないために、 ダイバーとして守るべき10のマナーを知ることから始めましょう。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price3.jpg" width="223" height="36" alt="費用 ¥10,500(税込)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_2_2.jpg" width="206" height="162" alt="AWAREサンゴ礁の保護（レクチャー）コースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>AWAREサンゴ礁の保護（レクチャー）コース</dt>
														<dd>海洋環境、特にサンゴ礁を守ることをテーマにしているこのコースを受講し、 海を愛するスノーケラーやダイバーとして必要な知識、守るべきマナーを 身につけましょう。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price3.jpg" width="223" height="36" alt="費用 ¥10,500(税込)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_2_3.jpg" width="206" height="162" alt="AWARE魚の見分け方コースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>AWARE魚の見分け方コース</dt>
														<dd>このコースでは、サカナをカタチから種別するコツをマスターします。 サカナのカタチや特徴から系統立てて区別することで、生態系的も理解でき 新しい海の魅力を再発見することができるコースです。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_2_4.jpg" width="206" height="162" alt="水中デジタルカメラコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>水中デジタルカメラコース</dt>
														<dd>カメラの基本的な使い方から撮影のテクニック、また海洋実習では、自然光と ストロボ光の撮影、露出設定の方法や、被写体との距離感などまでレクチャー。 海中でのチャレンジ精神、陸上での感動と、海通いがますます楽しくなります。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_2_5.jpg" width="206" height="162" alt="水中ビデオグラファーコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>水中ビデオグラファーコース</dt>
														<dd>このコースでは、陸上でのビデオの使い方から専用のハウジングにセットしての 撮影法までのノウハウが習得できます。水中バランスなどダイビングスキルの 向上や、水中環境をよく知る技術も身につきます。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>ダイバー・プロバルジョンビーグルSPコース</dt>
														<dd>広範囲の移動を可能にする水中スクーターの基本的な操作の方法、 注意点などを習得。さらに使用後や故障した場合のメンテナンス法も マスターし、水中スクーターのテクニックを身につけましょう。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
										</div>
									</div>
									<!-- 遊びのコツをマスターするSPコース --> 
									<!-- 活動範囲を広げるSPコース -->
									<div class="tabbox_wrapper">
										<div id="fragment-3">
											<h4><img src="<?php bloginfo('template_url' ); ?>/img/speciality_h4_3.jpg" alt="活動範囲を広げるSPコース" width="643" height="41"></h4>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>ナイト・ダイバーSPコース</dt>
														<dd>夜の海に安全に潜る知識から、目的地までたどりつくコンパスナビゲーション、 合図や水中ライトをより効果的に使う方法などナイトダイビングに必要な技術を 習得します。ナイトダイビングの神秘的な世界を楽しんでください。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price2.jpg" width="223" height="36" alt="費用 ¥20,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_3_2.jpg" width="206" height="162" alt="ディープ・ダイバーSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>ディープ・ダイバーSPコース</dt>
														<dd>水深18mを超える海中でしか見ることのできない幻想的な世界を体験するため、 より安全にディープ・ダイビングが楽しめるような知識を習得することを目的した コース。水深1 8m以深も安全に潜るテクニックをマスターしましょう。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price4.jpg" width="223" height="36" alt="費用 ¥30,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>マルチレベルSPコース</dt>
														<dd>このコースでは、ダイブコンピュータやPADIが開発した「ザ・ホイール」を 使って、マルチレベル・ダイビングの計画の立て方から、実践までを学びます。 マルチレベルをマスターすれば、さらに貴重なダイブタイムが手に入ります。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price2.jpg" width="223" height="36" alt="費用 ¥20,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_3_4.jpg" width="206" height="162" alt="ドリフト・ダイバーSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>ドリフト・ダイバーSPコース</dt>
														<dd>ドリフト・ダイビングとは、潮の流れにのって水中を移動するダイビング方法。 このコースではドリフト・ダイビングの注意点や、テクニックをマスターし、 潮流の速いポイントでも安全に楽しめる潜り方が身につけられます。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price2.jpg" width="223" height="36" alt="費用 ¥20,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_3_5.jpg" width="206" height="162" alt="アルティチュードSPコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>アルティチュードSPコース</dt>
														<dd>酸素が薄い高所での行動、淡水に潜るためのウエイト重量、ダイブテーブルの 引き方、浮上の方法など、海洋ダイビングとは異なる注意点が多くあるアルティ チュード・ダイビングの知識と手順、テクニック、安全な浮上方法などを習得します。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price1.jpg" width="223" height="36" alt="費用 ¥15,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>エンリッチド・エアSPコース</dt>
														<dd>じっくりと水中生物の観察や、水中写真を撮りたいダイバーにはうってつけの コースです。またエンリッチド・エア用のダイブテーブルの使用方法なども身に 付きますので、減圧理論に興味のあるダイバーにもオススメです。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price5.jpg" width="223" height="36" alt="費用 ¥25,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/sp_3_7.jpg" width="206" height="162" alt="サーチ＆リカバリーコースの写真"></div>
												<div class="course_text">
													<dl>
														<dt>サーチ＆リカバリーコース</dt>
														<dd>このコースでは各種ナビゲーションテクニックなどを学びます。正確なナビで、 最短距離のコースで楽に移動、万一自分のいる位置をロストした場合でも、 落ち着いた行動がとれ、探検ダイビングも思いのままにできるようになります。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price4.jpg" width="223" height="36" alt="費用 ¥30,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>レック（沈船）SPコース</dt>
														<dd>船内に潜るには、堆積物を巻き上げないようなフィンワークとテクニック、マナー も必要になります。このコースは、沈船に潜る際の注意点や、実際に船内に ロープを張って、それを伝いながら移動して潜る方法などを習得します。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price4.jpg" width="223" height="36" alt="費用 ¥30,000(税別)"></div>
												</div>
											</div>
											<div class="coursebox">
												<div class="course_img"><img src="<?php bloginfo('template_url' ); ?>/img/noimage.jpg" width="206" height="162" alt="No IMAGE"></div>
												<div class="course_text">
													<dl>
														<dt>アイスダイビングSPコース</dt>
														<dd>このコースではダイバーの体温の確保ばかりではなく、器材についても万全の対策 が取れるよう、事前のレクチャーに重点が置かれます。エントリーしたときと同じ ポイントからエキジットするための準備とノウハウがしっかり身に付く内容です。</dd>
													</dl>
													<div class="course_price"><img src="<?php bloginfo('template_url' ); ?>/img/price4.jpg" width="223" height="36" alt="費用 ¥30,000(税別)"></div>
												</div>
											</div>
										</div>
									</div>
									<!-- 活動範囲を広げるSPコース --> 
								</div>
								<!-- / #ui-tab --> 
							</div>
							<!-- / #ui-tab_wrapper -->
							<div class="speciality_bottombox">
								<dl class="liststyle1">
									<dt><span>■</span>各SPコース料金に含まれるもの</dt>
									<dd>講習費　Cカード申請料　保険代　事務手数料　マニュアル代</dd>
									<dt><span>■</span>SPコース料金に含まれないもの</dt>
									<dd>ツアー代(開催地によって料金が異なります) <br>
										各SPコースに必要な必須器材代(必須器材はお問合せ下さい) <br>
										器材レンタル代</dd>
								</dl>
								<p>各コースの参加前条件や、講習内容など、詳しくはスタッフにお問い合わせください。</p>
							</div>
						</div>
					<?php get_sidebar();?>
					<?php wp_footer(); ?>
