<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');


	// site setting
	$menu_name = 'main';
	// $css = [''];
	// $js = [''];
?>
<? include "../block/header.php"; ?>

	<div class="">

			<div class="">
				
				<div class="in_bt1">Все поля обязательны для заполнения</div>
				
				<div class="bl_c">
					<div class="in_bc1">
						<div class="in_bc1l">
							<div class="in_bc1lc">
								<div class="in_bc1ln">Кол-во купюр</div>
								<div class="in_bc1li">
									<div class="fr_price">20000</div>
									<input type="text" placeholder="0" autofocus>
								</div>
								<div class="in_bc1li">
									<div class="fr_price">10000</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">5000</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">2000</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">1000</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">500</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">200</div>
									<input type="text" placeholder="0">
								</div>
							</div>
							<div class="in_bc1lc">
								<div class="in_bc1ln">Кол-во монет</div>
								<div class="in_bc1li">
									<div class="fr_price">100</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">50</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">20</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">10</div>
									<input type="text" placeholder="0">
								</div>
								<div class="in_bc1li">
									<div class="fr_price">5</div>
									<input type="text" placeholder="0">
								</div>
							</div>
						</div>
						<div class="in_bc1r">
							<div class="in_bc1ln">Набор</div>
							<div class="calc">
								<div class="calci">
									<div class="calcn">7</div>
									<div class="calcn">8</div>
									<div class="calcn">9</div>
									<div class="calcn"><i class="fal fa-backspace"></i></div>
								</div>
								<div class="calci">
									<div class="calcn">4</div>
									<div class="calcn">5</div>
									<div class="calcn">6</div>
									<div class="calcn"><i class="fal fa-long-arrow-left"></i></div>
								</div>
								<div class="calci">
									<div class="calcn">1</div>
									<div class="calcn">2</div>
									<div class="calcn">3</div>
									<div class="calcn"><i class="fal fa-long-arrow-right"></i></div>
								</div>
								<div class="calci">
									<div class="calcn calcn2">0</div>
									<div class="calcn">.</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

	</div>

<? include "../block/footer.php"; ?>