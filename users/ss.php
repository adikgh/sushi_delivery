<? include "../../../../config/core_edu.php";

    $cours_id = $_GET['id'];    

    $page = 1; 
    $page_age = 50;
    $page_all = ceil(50 / $page_age);
    if ($page > $page_all) $page = $page_all;
    $page_start = ($page - 1) * $page_age;
    $number = $page_start;

    $cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' order by ins_dt desc limit $page_start, $page_age");

    echo mysqli_num_rows($cours_buy);