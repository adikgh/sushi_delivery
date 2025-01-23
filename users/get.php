<? include "../config/core.php";

	// add user
	if(isset($_GET['add_user'])) {
		$name = @strip_tags($_POST['name']);
		$phone = @strip_tags($_POST['phone']);
		$phone_sms = substr_replace($phone, 7, 0, 1);

		$user = db::query("SELECT * FROM `user` WHERE phone = '$phone'");
		if (mysqli_num_rows($user) == 0) {
			$user_ins = db::query("INSERT INTO `user`(`name`, `phone`, `password`, `right`) VALUES ('$name', '$phone', '123456', 1)");
			if ($user_ins) {
				$user_d = mysqli_fetch_assoc(db::query("SELECT * FROM `user` WHERE phone = '$phone'"));
				$user_id = $user_d['id'];
				$buy_ins = db::query("INSERT INTO `user_staff`(`user_id`, `positions_id`) VALUES ('$user_id', 6)");
            	echo 'add';
			}
		} else echo 'yes';

		exit();
	}


	// add user
	if(isset($_GET['edit_user'])) {
		$id = @strip_tags($_POST['id']);
		$name = @strip_tags($_POST['name']);
		$phone = @strip_tags($_POST['phone']);
		$phone_sms = substr_replace($phone, 7, 0, 1);

		if ($name) $upd = db::query("UPDATE `user` SET `name` = '$name' WHERE id = '$id'");
		if ($phone) $upd = db::query("UPDATE `user` SET `phone` = '$phone' WHERE id = '$id'");

		echo 'yes';
		exit();
	}

	

   // user delete
	if(isset($_GET['user_del'])) {
		$id = strip_tags($_POST['id']);
		$buy = db::query("delete FROM `user_staff` WHERE id = '$id'");
		echo 'yes';
		exit();
	}


   // user delete
	if(isset($_GET['on_superv'])) {
		// $_SESSION['super'] = $_GET['on_superv'];
		$super = $_GET['on_superv'];
		$id = strip_tags($_POST['id']);
		$buy = db::query("UPDATE `user_staff` SET `positions_id` = '$super' WHERE id = '$id'");

		echo 'yes';
		exit();
	}


	// sms_send
	if(isset($_GET['sms_send'])) {

		$cours_id = strip_tags($_POST['cours_id']);
		$user_id = strip_tags($_POST['user_id']);

		$sub = db::query("SELECT * FROM `c_sub` WHERE cours_id = '$cours_id' and user_id = '$user_id");
		$user = db::query("SELECT * FROM `user` WHERE id = '$user_id'");
		$user_date = mysqli_fetch_assoc($user);
		$phone = $user_date['phone'];
		$code = $user_date['code'];

		$mess = "Иммунити курсы.\nТексеру коды: $code\nСілтеме: https://aruacademy.kz/l/?c=$cours_id";
		list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $mess, 0, 0, 0, 0, false);

		echo 'yes';
		exit();
	}


