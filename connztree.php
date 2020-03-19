<?php
$mysqli  = new  mysqli ( 'localhost' ,  'root' ,  'root' ,  'tree' );
mysqli_query($mysqli, "set names gbk");
if ( $mysqli -> connect_error ) {
    die(  $mysqli -> connect_errno + $mysqli -> connect_error );
}
$sql='select * from tree_lr';
$res=mysqli_query($mysqli, $sql);
$array=array();
while ($row=mysqli_fetch_row($res)){
    $menu=array(
        "id"=>$row[0],
        "pId"=>$row[1],
        "name"=>urlencode(iconv('gb2312','utf-8',$row[2])),
        "open"=>1,
        "file"=>$row[4],
    );
    array_push($array, $menu);
}
echo json_encode($array);

 $mysqli -> close ();

?>