	<!-- body end -->
	</div>

	<!-- main js -->
	<? foreach ($sjs as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <? endforeach ?>
	<? foreach ($js as $i): ?> <script src="/assets/js/<?=$i?>.js?v=<?=$ver?>"></script> <? endforeach ?>
		
</body>
</html>

	<?php include "modal.php"; ?>