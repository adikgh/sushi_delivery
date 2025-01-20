<? 

	class product {
		
		function __construct() {}

		// product function
		public static function product($id) {
			$sql = db::query("select * from product where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function product_img($id) {
			$sql = db::query("select * from product_item where product_id = '$id' and img is not null order by price asc limit 1");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['img']; else return 0;
		}
		public static function product_article($id) {
			$sql = db::query("select * from product_item where product_id = '$id'");
			$sql2 = db::query("select * from product_item where product_id = '$id' order by price asc limit 1");
			if (mysqli_num_rows($sql)) {
				if (mysqli_num_rows($sql) == 1) return (mysqli_fetch_array($sql))['article'];
				else return (mysqli_fetch_array($sql2))['article'].' + '.(mysqli_num_rows($sql) - 1);
			} else return 0;
		}
		public static function product_price($id) {
			$sql = db::query("select * from product_item where product_id = '$id' and price is not null");
			$sql2 = db::query("select * from product_item where product_id = '$id' and price is not null order by price asc limit 1");
			if (mysqli_num_rows($sql)) {
				if (mysqli_num_rows($sql) == 1) return (mysqli_fetch_array($sql))['price'];
				else return (mysqli_fetch_array($sql2))['price'];
				// else return 'от '.(mysqli_fetch_array($sql2))['price'];
			} else return 0;
		}
		public static function product_quantity($id) {
			$sql = db::query("select quantity from product_item_quantity where product_id = '$id'"); $n = 0;
			if (mysqli_num_rows($sql)) { while ($res = mysqli_fetch_array($sql)) $n = $n + $res['quantity']; }
			return $n;
		}

		public static function product_item($id) {
			$sql = db::query("select * from `product_item` where product_id = '$id' limit 1");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function pr_item_sum($id) {
			$sql = db::query("select * from `product_item` where product_id = '$id'");
			return mysqli_num_rows($sql);
		}


		// catalog
		public static function pr_catalog($id) {
			$sql = db::query("select * from product_catalog where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_catalog_name($id, $l) {
			$sql = db::query("select * from product_catalog where id = '$id'");
			return (mysqli_fetch_array($sql)['name_'.$l]);
		}

		// brand
		public static function pr_brand($id) {
			$sql = db::query("select * from product_ch_brand where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_brand_name($n) {
			$sql = db::query("select * from product_ch_brand where name = '$n'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['id']; else return 0;
		}

		// country
		public static function pr_country($id) {
			$sql = db::query("select * from product_ch_country where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_country_name($n) {
			$sql = db::query("select * from product_ch_country where name_kz = '$n' or name_ru = '$n'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['id']; else return 0;
		}

		// collection
		public static function pr_collection($id) {
			$sql = db::query("select * from product_ch_collection where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_collection_name($n) {
			$sql = db::query("select * from product_ch_collection where name_kz = '$n' or name_ru = '$n'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['id']; else return 0;
		}

		// style
		public static function pr_style($id) {
			$sql = db::query("select * from product_ch_style where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_style_name($n) {
			$sql = db::query("select * from product_ch_style where name_kz = '$n' or name_ru = '$n'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['id']; else return 0;
		}
		


		// product item
		public static function pr_item($id) {
			$sql = db::query("select * from product_item where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_item_article($n) {
			$sql = db::query("select * from product_item where article = '$n' limit 1");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function pr_item_one($id) {
			$sql = db::query("select * from product_item where product_id = '$id' limit 1");
			return mysqli_fetch_array($sql);
		}
		public static function pr_item_quantity($id) {
			$sql = db::query("select quantity from product_item_quantity where item_id = '$id'"); $n = 0;
			if (mysqli_num_rows($sql)) { while ($res = mysqli_fetch_array($sql)) $n = $n + $res['quantity']; }
			return $n;
		}

		// color
		public static function pr_color($id) {
			$sql = db::query("select * from product_item_color where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_color_name($n) {
			$sql = db::query("select * from product_item_color where name_kz = '$n' or name_ru = '$n'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['id']; else return 0;
		}

		// product_size
		public static function pr_size($id) {
			$sql = db::query("select * from product_item_size where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_size_name($n) {
			$sql = db::query("select * from product_item_size where name = '$n'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['id']; else return 0;
		}



		// product item
		public static function pr_item_view($id) {
			$sql = db::query("select * from product_item_quantity where id = '$id'");
			return mysqli_fetch_array($sql);
		}
		public static function pr_item_view_one($id) {
			$sql = db::query("select * from product_item_quantity where product_id = '$id' limit 1");
			return mysqli_fetch_array($sql);
		}
		public static function in_stock($id, $wid) {
			$sql = db::query("select * from product_item_quantity where item_id = '$id' and warehouses_id = '$wid'");
			if (mysqli_num_rows($sql)) return mysqli_fetch_array($sql); else return 0;
		}
		public static function in_stockq($id, $wid) {
			$sql = db::query("select * from product_item_quantity where item_id = '$id' and warehouses_id = '$wid'");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_array($sql))['quantity']; else return 0;
		}
		

		//  
		public static function pr_displacement($id) {
			$sql = db::query("select * from pr_warehouses_displacement where id = '$id'");
			return mysqli_fetch_array($sql);
		}







		public static function next_number_order($s, $e, $b) {
			$sql = db::query("SELECT * FROM `retail_orders` where `ins_dt` BETWEEN '$s' and '$e' and `branch_id` = '$b' order by `number` desc");
			if (mysqli_num_rows($sql)) return (mysqli_fetch_assoc($sql))['number'] + 1; else return 1;
		}
		







		// favorites
		public static function favorites($id, $user_id) {
			$sql = db::query("select * from on_favorites where user_id = '$user_id' and item_id = '$id'");
			if (mysqli_num_rows($sql)) return true; else return false;
		}


	}