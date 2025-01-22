<? include "../../../../config/core_edu.php";
	
    $cours_id = $_GET['id'];

	// filter user all
	$cours_buy_all = db::query("select * from c_buy where cours_id = '$cours_id'");
	$page_result = mysqli_num_rows($cours_buy_all);

	// page number
	$page = 1; if (isset($_GET['page']) && $_GET['page'] && is_int(intval($_GET['page']))) $page = $_GET['page'];
	$page_age = 50;
	$page_all = ceil($page_result / $page_age);
	if ($page < $page_all) $page = $page_all;
	$page_start = ($page - 1) * $page_age;

	// filter cours
	// $cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' order by ins_dt desc limit $page_start, $page_age");


    
    echo $page_start;