<? include "../config/core.php";


   // from_stock
   if(isset($_GET['from_stock'])) {
		$warehouses_id = strip_tags($_POST['warehouses']);
		$id = strip_tags($_POST['id']);
      if ($warehouses_id == 0) $upd = db::query("UPDATE `pr_warehouses_displacement` SET all_stock = 1, from_stock = null WHERE id = '$id'");
      else $upd = db::query("UPDATE `pr_warehouses_displacement` SET all_stock = null, from_stock = '$warehouses_id' WHERE id = '$id'");
      if ($upd) echo 'yes';
      exit();
	}
   // in_stock
   if(isset($_GET['in_stock'])) {
		$warehouses_id = strip_tags($_POST['warehouses']);
		$id = strip_tags($_POST['id']);
      $upd = db::query("UPDATE `pr_warehouses_displacement` SET in_stock = '$warehouses_id' WHERE id = '$id'");
      if ($upd) echo 'yes';
      exit();
	}


   // cashbox_remove
   if(isset($_GET['cashbox_remove'])) {
      $id = strip_tags($_POST['id']);
      $del = db::query("DELETE FROM `pr_warehouses_displacement_product` where id = '$id'");
      if ($del) echo 'yes'; else echo 'none';
      exit();
   }

   // cashbox_upd
   if(isset($_GET['cashbox_upd'])) {
      $id = strip_tags($_POST['id']);
      $quantity = strip_tags($_POST['quantity']);
      $upd = db::query("UPDATE `pr_warehouses_displacement_product` SET quantity = '$quantity' WHERE id = '$id'");
      if ($upd) echo 'yes'; else echo 'none';
      exit();
   }


   // disp_full
   if(isset($_GET['disp_full'])) {
      $id = strip_tags($_POST['id']);
      $quantity = strip_tags($_POST['quantity']);
      $upd = db::query("UPDATE `pr_warehouses_displacement_product` SET quantity = '$quantity' WHERE id = '$id'");
      if ($upd) echo 'yes'; else echo 'none';
      exit();
   }


   // cashbox_search
   if(isset($_GET['cashbox_search'])) {
		$search = strip_tags($_POST['search']);
		$oid = strip_tags($_POST['id']);

      $pitem = db::query("select * from product_item where (barcode = '$search' and barcode is not null) or article = '$search' limit 1");
      if (mysqli_num_rows($pitem)) {
         $pitem_d = mysqli_fetch_assoc($pitem);
         $pitem_id = $pitem_d['id'];
         $product_d = product::product($pitem_d['product_id']);
         $product_id = $pitem_d['product_id'];

         $view = db::query("select * from product_item_quantity where item_id = '$pitem_id'");
         if (mysqli_num_rows($view)) {
            while ($view_d = mysqli_fetch_assoc($view)) {
               $view_id = $view_d['id'];
               $disp = db::query("select * from pr_warehouses_displacement_product where displacement_id = '$oid' and view_id = '$view_id'");
               if (!mysqli_num_rows($disp)) $ins = db::query("INSERT INTO `pr_warehouses_displacement_product`(`displacement_id`, `product_id`, `item_id`, `view_id`, `quantity`) VALUES ('$oid', '$product_id', '$pitem_id', '$view_id', 1)");
               // else $upd = db::query("UPDATE `pr_warehouses_displacement_product` SET quantity = quantity + 1 WHERE displacement_id = '$oid' and view_id = '$view_id'");
            }
            if ($upd || $ins) echo 'yes';
         }
      } else echo 'none';
      exit();
	}

   // 
	if(isset($_GET['cashbox_add'])) {
      $pid = strip_tags($_POST['id']);
		$oid = strip_tags($_POST['oid']);
      
      $pitem_id = strip_tags($_POST['item_id']);
      $pitem_d = product::pr_item($pitem_id);
      $price = $pitem_d['price'];

      if ($pitem_d['quantity'] > 0) {
         $retailop = db::query("select * from retail_orders_products where order_id = '$oid' and product_id = '$pid' and product_item_id = '$pitem_id'");
         if (mysqli_num_rows($retailop)) $upd = db::query("UPDATE `retail_orders_products` SET quantity = quantity + 1 WHERE `order_id`='$oid' and `product_id`='$pid' and product_item_id = '$pitem_id'");
         else $ins = db::query("INSERT INTO `retail_orders_products`(`order_id`, `product_id`, `product_item_id`, `quantity`, `price`) VALUES ('$oid', '$pid', '$pitem_id', 1, $price)");
         $upd2 = db::query("UPDATE `product_item` SET quantity = quantity - 1 WHERE id = '$pitem_id'");
         if ($upd || $ins) echo 'yes';
      } else echo 0;

      exit();
	}


   // displacement_success
	if(isset($_GET['displacement_success'])) {
		$id = strip_tags($_POST['id']);
      $disp_d = product::pr_displacement($id);
      $all_stock = $disp_d['all_stock'];
      $from_stock = $disp_d['from_stock'];
      $in_stock = $disp_d['in_stock'];
      $number = 0;

      $dispi = db::query("select * from pr_warehouses_displacement_product where displacement_id = '$id'");
      if (mysqli_num_rows($dispi)) {
         while ($dispi_d = mysqli_fetch_assoc($dispi)) {
            $quantity = $dispi_d['quantity'];
            $product_id = $dispi_d['product_id'];
            $item_id = $dispi_d['item_id'];
            $view_id = $dispi_d['view_id'];
            $view_d = product::pr_item_view($view_id);
            $view_warehouses_id = $view_d['warehouses_id'];
            $in_stock_view_d = product::in_stock($item_id, $in_stock);

            if (($all_stock && $in_stock!=$view_warehouses_id) || (!$all_stock && ($from_stock==$view_warehouses_id) && ($from_stock!=$in_stock))) {
               $number++;
               if ($view_d['quantity'] == $quantity) {
                  if ($in_stock_view_d == 0) $upd = db::query("UPDATE `product_item_quantity` SET `warehouses_id` = '$in_stock', `upd_dt` = '$datetime' WHERE id = '$view_id'");
                  else {
                     $upd = db::query("UPDATE `product_item_quantity` SET quantity = quantity + '$quantity', `upd_dt` = '$datetime' WHERE item_id = $item_id and warehouses_id = '$in_stock'");
                     $del = db::query("DELETE FROM `product_item_quantity` where id = '$view_id'");
                  }
               } else {
                  $upd = db::query("UPDATE `product_item_quantity` SET quantity = quantity - '$quantity', `upd_dt` = '$datetime' WHERE id = '$view_id'");
                  if ($in_stock_view_d == 0) $ins = db::query("INSERT INTO `product_item_quantity`(`product_id`, `item_id`, `warehouses_id`, `quantity`) VALUES ('$product_id', '$item_id', '$in_stock', '$quantity')");
                  else $upd = db::query("UPDATE `product_item_quantity` SET quantity = quantity + '$quantity', `upd_dt` = '$datetime' WHERE item_id = $item_id and warehouses_id = '$in_stock'");
               }
            }
         }
         
         $upd = db::query("UPDATE `pr_warehouses_displacement` SET `success` = 1, `upd_dt` = '$datetime' WHERE id = '$id'");
         $ins = db::query("INSERT INTO `pr_warehouses_displacement`(`user_id`) VALUES ('$user_id')");
         if ($upd && $ins && $number != 0) echo 'yes'; else echo 'none';

      } else echo 'none';
      exit();
	}











      // cashbox_minus
      if(isset($_GET['cashbox_minus'])) {
         $id = strip_tags($_POST['id']);
         $sql = db::query("UPDATE `pr_warehouses_displacement_product` SET quantity = quantity - 1 WHERE id = '$id'");
         if ($sql) echo 'yes'; else echo 'none';
         exit();
      }
      // cashbox_plus
      if(isset($_GET['cashbox_plus'])) {
         $id = strip_tags($_POST['id']);
         $upd = db::query("UPDATE `pr_warehouses_displacement_product` SET quantity = quantity + 1 WHERE id = '$id'");
         if ($upd) echo 'yes'; else echo 'none';
         exit();
      }