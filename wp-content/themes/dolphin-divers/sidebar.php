<div id="sub">
	<div id="navWrap">
		<h2><img src="<?php bloginfo('template_url' ); ?>/img/sub_top.jpg" width="209" height="30" alt="contents"></h2>
		<ul id="g_nav">
			<li><a href="<?php echo home_url(); ?>/ダイビングを始めよう" id="nav1">Enjoyダイビング!!</a></li>
			<?php if(get_post_type() == 'enjoy'):?>
			<ul class="nav2">
				<?php 
            		$wp_query = new WP_Query();
    				$param = array(
    					'posts_per_page' => '-1', //表示件数。-1なら全件表示
						'post_type' => 'enjoy',
						'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
                		'orderby' => 'DATE', //ID順に並び替え→DATE順
                		'order' => 'ASC'
                	);
                	$wp_query->query($param);
                	if($wp_query->have_posts()): while($wp_query->have_posts()) : $wp_query->the_post();
            	?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</li>

				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>

			</ul>
			<?php endif;?>
			<li>
				<div id="school">
					<div><a href="<?php echo home_url(); ?>/体験ダイビング"><img src="<?php bloginfo('template_url' ); ?>/img/school.jpg" alt="ダイビングスクール" width="193" height="46"></a></div>
					<?php if(get_post_type() =='school'): ?>
					<ul class="nav2">
						<?php 
            				$wp_query = new WP_Query();
    						$param = array(
    						    'posts_per_page' => '-1', //表示件数。-1なら全件表示
								'post_type' => 'school',
								'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
                				'orderby' => 'DATE', //ID順に並び替え→DATE順
                				'order' => 'ASC'
                			);
                			$wp_query->query($param);
            				if($wp_query->have_posts()): while($wp_query->have_posts()) : $wp_query->the_post();
            			?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</li>

						<?php endwhile; endif; ?>
						<?php wp_reset_query(); ?>

					</ul>
					<?php endif;?>
				</div>
			</li>
			<li><a href="<?php echo home_url(); ?>/イルカに会いに行こう！" id="nav3">イルカに会いにいこう！</a></li>
			<li><a href="<?php echo home_url(); ?>/ダイビングツアースケジュール" id="nav4">ダイビングツアースケジュール</a></li>
			<li><a href="<?php echo home_url(); ?>/店舗紹介＆アクセス" id="nav5">店舗紹介＆アクセス</a></li>
			<li><a href="http://dolphin-divers.jp/blog/" id="nav6">ブログ</a></li>
			<li><a href="<?php echo home_url(); ?>/qa" id="nav7">Q＆A</a></li>
			<li><a href="<?php echo home_url(); ?>/お問い合わせ" id="nav8">お問い合わせ</a></li>
		</ul>
	</div>
	<div class="banner"><a href="https://www.facebook.com/dolphin.divers" target="_blank"><img src="<?php bloginfo('template_url' ); ?>/img/fb_banner.jpg" width="209" height="63" alt="ドルフィンダイバーズ Facebookページ"/></a></div>
	<div id="infoWrap">
		<h2><img src="<?php bloginfo('template_url' ); ?>/img/shop_top.jpg" width="209" height="30" alt="shop"></h2>
		<div class="shopInfo">
			<p><span class="shopName">ドルフィンダイバーズ</span><br> 〒458-0007
				<br> 愛知県名古屋市緑区篭山2-1216 <br>
				<span class="bold">Tel. <span class="shopTell">052-876-2105</span></span>
			</p>
			<div><img src="<?php bloginfo('template_url' ); ?>/img/shop_photo.jpg" alt="ドルフィンダイバーズ 店舗 外観" width="193" height="145"></div>
		</div>
	</div>
</div>