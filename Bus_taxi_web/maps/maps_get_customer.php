<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start(); 
require '../ptittaxi_api/database.php';
session_start();

if(isset($_GET['action'])){
    $action = $_GET['action'];
    
    if($action == 'status_rep' && isset($_SESSION['hangtaxi_id'], $_SESSION['username'])){
        $db = new DBQuery;
        $stt_rep = "UPDATE tbl_gd1_khachhangLog SET status_rep = " . $_GET['stt'] . " WHERE id =" . $_GET['id_kh'];
        $db ->query($stt_rep);
    }
    if($action == 'comment' && isset($_SESSION['hangtaxi_id'], $_SESSION['username'])){
        $db = new DBQuery;
        $comment = "UPDATE tbl_gd1_khachhangLog SET comment = '" . $_GET['comment'] . "' WHERE id =" . $_GET['id_kh'];
        $db ->query($comment);
    }
}

if(isset($_SESSION['hangtaxi_id']) && $_SESSION['hangtaxi_id'] != -1){
    $hangtaxi_id = $_SESSION['hangtaxi_id'];
    $lat = $_SESSION['fix_lat'];
    $db = new DBQuery;
    $sql_get_df_pingtaxi = "SELECT value FROM tbl_config WHERE name = 'default_hangtaxi_id'";
    $rs_df_pingtaxi = $db ->loadResult($sql_get_df_pingtaxi);
    $str_sql_get_list = '';
    if($rs_df_pingtaxi == $hangtaxi_id){
        $str_sql_get_list = " OR kh.hangtaxi_id = 0";
    }
    $sql_get_customer = "SELECT kh.phonenumber AS sodt, kh.status_rep AS trangthai, kh.id, kh.comment AS ghichu, h.name AS hangxe, ltx.description AS loaixe
                            FROM tbl_gd1_khachhangLog kh INNER JOIN tbl_hangtaxi h ON kh.hangtaxi_id = h.id
                                INNER JOIN tbl_loaitaxi ltx ON kh.loaitaxi_id = ltx.id
                            WHERE kh.hangtaxi_id = " . $hangtaxi_id . $str_sql_get_list . " 
                                AND abs(kh.lat - " . $lat . ") < 300000
                            ORDER BY kh.hangtaxi_id DESC";
    //echo $sql_get_customer;
    $rs_info_customer = $db ->loadArray($sql_get_customer);
    //echo "<br><pre>";
    //var_dump($rs_info_customer);
    //echo "</pre>";
    $html_output = '';
    $i = 1;   
    foreach ($rs_info_customer as $rs){
        if($i > 10) break;
        $html_output.= '<tr>
            <td>' . $i . '</td>
            <td>' . $rs['sodt'] . '</td>
            <td>' . $rs['loaixe'] . '</td>
            <td>' . $rs['hangxe'] . '</td>
            <td><!--<form action="?action=status_rep" method = "GET" >-->
                    <input id="id_kh' . $i . '" type="hidden" value="' . $rs['id'] . '" name="id_kh" />
                    <input id="comment' . $i . '" type="text" value="' . $rs['ghichu'] . '" size="35" />
                    <input id="ghichu' . $i . '" name="ghichu" size="1" type="submit" value="Lưu" />
                <!--</form>-->
            </td>
            <td>';
                $html_output.= '<!--<form action="?action=comment" method = "GET" >-->
                                    <input id="id_kh' . $i . '" type="hidden" value="' . $rs['id'] . '" name="id_kh" />';
                if($rs['trangthai'] == 1){
                     $html_output.= '<input id="stt' . $i . '" type="hidden" value="0" name="stt" />
                                     <input id="trangthai' . $i . '" name="trangthai" size="1" type="submit" value="Bình thường" /> 
                                     ';
                }else{
                    $html_output.= '<input id="stt' . $i . '" type="hidden" value="1" name="stt" />
                                    <input id="trangthai' . $i . '" name="trangthai" size="1" type="submit" value="Lỗi" /> 
                                <!--</form>-->';
                }    
            $html_output.='</td>
        <tr>';
        $i++;
    }
    echo $html_output;
    for($i = 1; $i <= 10; $i++){
        echo '<script type="text/javascript">
                $("#trangthai' . $i . '").live("click", function(){
                    var id_stt = $("#id_kh' . $i . '").val();
                    var stt = $("#stt' . $i . '").val();
                    function statusrep(){
                        $.ajax({
                            url: "maps_get_customer.php?action=status_rep",
                            type: "GET",
                            data: {
                                id_kh: id_stt,
                                stt: stt
                            },
                            timeout: 2000
                        });
                    }
                    statusrep();
                    if(stt == 1)
                        alert("Bạn đã cập nhật trạng thái cuộc gọi từ lỗi về bình thường");
                    if(stt == 0)
                        alert("Bạn đã cập nhật trạng thái cuộc gọi từ bình thường thành lỗi");
                    window.location.reload();
                });
                $("#ghichu' . $i . '").live("click", function(){
                    var id_stt = $("#id_kh' . $i . '").val();
                    var comment = $("#comment' . $i . '").val();
                    function comment_customer(){
                        $.ajax({
                            url: "maps_get_customer.php?action=comment",
                            type: "GET",
                            data: {
                                id_kh: id_stt,
                                comment: comment
                            },
                            timeout: 2000
                        });
                    }
                    comment_customer();
                    alert("Bạn đã cập nhận ghi chú trạng thái cuộc gọi khách hàng thành công!");
                    window.location.reload();
                });
            </script>';
    }
}
?>
<?php ob_end_flush() ?>    