<?php include('db_conn.php');

$output= array();
$sql = "SELECT * FROM users ";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'ID',
	1 => 'first_name',
	2 => 'last_name',
	3 => 'atesia',
	4 => 'birthday',
    5 => 'roli',
    6 => 'username',
    7 => 'email',
    8 => 'phone'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE first_name like '%".$search_value."%'";
	$sql .= " OR last_name like '%".$search_value."%'";
	$sql .= " OR atesia like '%".$search_value."%'";
	$sql .= " OR username like '%".$search_value."%'";
    $sql .= " OR email like '%".$search_value."%'";
    $sql .= " OR phone like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY ID asc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($conn,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['ID'];
	$sub_array[] = $row['first_name'];
	$sub_array[] = $row['last_name'];
	$sub_array[] = $row['atesia'];
	$sub_array[] = $row['birthday'];
    $sub_array[] = $row['roli'];
	$sub_array[] = $row['username'];
	$sub_array[] = $row['email'];
	$sub_array[] = $row['phone'];
	$sub_array[] = '<a href="javascript:void();" data-ID="'.$row['ID'].'"  class="btn btn-info" >Edit</a>  <a href="javascript:void();" data-ID="'.$row['ID'].'"  class="btn btn-logout" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
