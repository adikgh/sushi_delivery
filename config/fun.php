<? 

	class fun {
		
		function __construct() {}


		

		// retail_order
		public static function retailo($id) {
			$sql = db::query("select * from retail_orders where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function retailo_quantity($id) {
			$sql = db::query("select * from retail_orders_products where order_id = '$id'"); $q = 0;
			if (mysqli_num_rows($sql)) { while ($res = mysqli_fetch_array($sql)) $q = $q + $res['quantity']; }
			return $q;
		}

		// retail_orders_products
		public static function retailop($id) {
			$sql = db::query("select * from retail_orders_products where id = '$id'");
			return mysqli_fetch_array($sql);
		}


		

		
		// retail_order
		public static function retail_returns($id) {
			$sql = db::query("select * from retail_returns where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function retail_returns_total($id) {
			$sql = db::query("select * from retail_returns_products where return_id = '$id'"); $q = 0;
			if (mysqli_num_rows($sql)) { while ($res = mysqli_fetch_array($sql)) $q = $q + ($res['quantity'] * $res['price']); }
			return $q;
		}
		public static function retail_returns_quantity($id) {
			$sql = db::query("select * from retail_returns_products where return_id = '$id'"); $q = 0;
			if (mysqli_num_rows($sql)) { while ($res = mysqli_fetch_array($sql)) $q = $q + $res['quantity']; }
			return $q;
		}

		// retail_orders_products
		public static function retail_returnsp($id) {
			$sql = db::query("select * from retail_returns_products where id = '$id'");
			return mysqli_fetch_array($sql);
		}
















		// user management
		public static function branch($id) {
			$sql = db::query("select * from company_branch where id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}


		// user
		public static function user($id) {
			$sql = db::query("select * from user where id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function user_phone($phone) {
			$sql = db::query("select * from user where phone = '$phone'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}

		// user management
		public static function user_staffw($id) {
			$sql = db::query("select * from user_staff where user_id = '$id' limit 1");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}


		// user staff
		public static function user_staff($id) {
			$sql = db::query("select * from user_staff where id = '$id' limit 1");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function user_staff_name($id) {
			$sql = db::query("select * from user_staff where id = '$id'");
			return (mysqli_fetch_array($sql))['name_ru'];
		}
		public static function user_staff_positions($id) {
			$sql = db::query("select * from user_staff_positions where id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}

		// autor
		// public static function autor($id) {
		// 	$sql = db::query("select * from u_autor where id = '$id'");
		// 	return mysqli_fetch_array($sql);
		// }











		//  chat
		public static function chat($id) {
			$sql = db::query("select * from h_chat where user_id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function chat2($id) {
			$sql = db::query("select * from h_chat where id = '$id'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function chat_txt_end($id) {
			$sql = db::query("select * from h_chat_item where chat_id = '$id' order by ins_dt desc limit 1");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function chat_view_sum() {
			$sql = db::query("select * from h_chat where view is null");
			return mysqli_num_rows($sql);
		}
		public static function chat_item_view_sum($id) {
			$sql = db::query("select * from h_chat_item where chat_id = '$id' and user_id is null and view is null");
			return mysqli_num_rows($sql);
		}
		public static function chat_view_sum2($id) {
			$sql = db::query("select * from h_chat where user_id = '$id'");
			if (mysqli_num_rows($sql)) {
				$chat_d = mysqli_fetch_array($sql); 
				$chat_id = $chat_d['id'];
				$chad_i = db::query("select * from h_chat_item where chat_id = '$chat_id' and user_id is not null and view is null");
				return mysqli_num_rows($chad_i);
			} else return 0;
		}




		






		







		// mall send
		public static function send_mail($mail, $txt) {
			$from = "info@aruacademy.kz";
			$subject = "Aru Academy";
			$headers = "From:" . $from. "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8";
		$mess = "<html>
							<head><title>$subject</title></head>
							<body>
								<div><b>$txt<b></div>
							</body>
						</html>";
			return mail($mail, $subject, $mess, $headers);
		}

















	}