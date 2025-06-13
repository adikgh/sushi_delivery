<? include "config/core.php";

	// sign in phone
	if(isset($_GET['sign'])) {
		$phone = strip_tags($_POST['phone']);
		$password = strip_tags($_POST['password']);
		$user = db::query("SELECT * FROM user WHERE `phone` = '$phone' and `password` = '$password' and `right` = 1");
		if (mysqli_num_rows($user)) {
			$user_d = mysqli_fetch_array($user);
			$user_staff = fun::user_staffw($user_d['id']);
			if ($user_staff['positions_id'] == 6) {
				$_SESSION['uph'] = $phone;
				$_SESSION['ups'] = $password;
				setcookie('uph', $phone, time() + 3600*24*30*6, '/');
				setcookie('ups', $password, time() + 3600*24*30*6, '/');
				echo 'yes';
			} else echo 'none';
		} else echo 'none';
		exit();
	}


	// ubd user
	if(isset($_GET['ubd_pass'])) {
		$pass = strip_tags($_POST['pass']);
		$upd = db::query("UPDATE `user` SET `password`='$pass', `upd_dt`='$datetime' WHERE id = '$user_id'");
		echo "yes";
		exit();
	}



	// ubd user
	if(isset($_GET['ubd_acc'])) {
		$n_name = strip_tags($_POST['n_name']);
		$surname = strip_tags($_POST['surname']);
		$sex = strip_tags($_POST['sex']);
		$age = strip_tags($_POST['age']);
		$mail = strip_tags($_POST['mail']);
		$phone = strip_tags($_POST['phone']);
		$password = strip_tags($_POST['password']);
		
		$upd = db::query("UPDATE `user` SET `name`='$n_name', `surname`='$surname', `sex`='$sex', `age`='$age', `mail`='$mail', `phone`='$phone', `password`='$password', `upd_dt`='$datetime' WHERE id = '$user_id'");

		$_SESSION['uph'] = $phone;
		$_SESSION['upm'] = $mail;
		$_SESSION['ups'] = $password;
		setcookie('uph', $phone, time() + 3600*24*30);
		setcookie('upm', $mail, time() + 3600*24*30);
		setcookie('ups', $password, time() + 3600*24*30);

		echo "yes";
		exit();
	}
	
	
