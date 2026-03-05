<?php if ($page['description'] != ""): ?>
    <?php //echo $page['description']; ?>
<?php endif; ?>
<div class="container homeContent">
	<div class="row">
		<?php
		foreach ($main_menus as $menu_key => $menu_value) {
		$description_length = 12;
		?>
		<div class="col-md-12" id="<?php echo $menu_value['slug']; ?>">
			<section class="bg-gray fullwidth hContentGap">
				<div class="container">
					<div class="row">    
						<div class="col-md-8 col-sm-12 col-md-offset-2 text-center">
							<h2 class="head-title"><?php echo $menu_value['content_heading']; ?></h2>
						</div>

						<?php
							$image = '';
							if($menu_value['media_gallery_id'] != null){
								$description_length = 6;
								$image = '
								<div class="col-md-6 col-sm-6">
									<div class="about_img">
										<img class="img-responsive img-rounded" src="'.$menu_value['media_gallery_url'].'">
									</div>
								</div>';
							}
							
							$content = '
							<div class="col-md-'.$description_length.' col-sm-'.$description_length.'">
								<div class="about-right">
									'.$menu_value['menu_description'].'
								</div>
							</div>';
							
							if ($menu_value['image_position'] == 0) {
								echo $image . $content;
							} else {
								echo $content . $image;
							}
						?>

					</div>
				</div>
			</section>
		</div>
		<?php } ?>
	</div>
</div>