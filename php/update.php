<?php
    session_start();
    include_once "connection.php";
    if(isset($_SESSION['user_id'])){
        $userID = $_SESSION['user_id'];
    }
    $tenkhoahoc = mysqli_real_escape_string($conn, $_POST['tenkhoahoc']);
    $tengtiengviet = mysqli_real_escape_string($conn, $_POST['tengtiengviet']);
    $tendiaphuong = mysqli_real_escape_string($conn, $_POST['tendiaphuong']);
    $gioi = mysqli_real_escape_string($conn, $_POST['gioi']);
    $nganh = mysqli_real_escape_string($conn, $_POST['nganh']);
    $lop = mysqli_real_escape_string($conn, $_POST['tenkhoahoc']);
    $bo = mysqli_real_escape_string($conn, $_POST['bo']);
    $ho = mysqli_real_escape_string($conn, $_POST['ho']);
    $hinhthai = mysqli_real_escape_string($conn, $_POST['hinhthai']);
    $sinhthai = mysqli_real_escape_string($conn, $_POST['sinhthai']);
    $giatri = mysqli_real_escape_string($conn, $_POST['giatri']);
    $baotonIUCN = mysqli_real_escape_string($conn, $_POST['baotonIUCN']);
    $baotonVN = mysqli_real_escape_string($conn, $_POST['baotonVN']);
    $baoton32 = mysqli_real_escape_string($conn, $_POST['baoton32']);
    $baotonCITES = mysqli_real_escape_string($conn, $_POST['baotonCITES']);
    $phanbo = mysqli_real_escape_string($conn, $_POST['phanbo']);
    $tinhtrang = mysqli_real_escape_string($conn, $_POST['tinhtrang']);
    $sinhcanh = mysqli_real_escape_string($conn, $_POST['sinhcanh']);
    $diadiem = mysqli_real_escape_string($conn, $_POST['diadiem']);
    $ngaythumau = mysqli_real_escape_string($conn, $_POST['ngaythumau']);
    $nguoithumau = mysqli_real_escape_string($conn, $_POST['nguoithumau']);
    $sql = mysqli_query($conn, "SELECT * FROM animals WHERE TenKhoaHoc = '{$tenkhoahoc}'");
        if(mysqli_num_rows($sql) > 0){
            echo "Động vật đã tồn tại!";
        }
         else{
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];
                
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if(in_array($img_ext, $extensions) === true){
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if(in_array($img_type, $types) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        if(move_uploaded_file($tmp_name,"../img/".$new_img_name)){                            
                            $insert_query = mysqli_query($conn, "INSERT INTO animals_update (NgayCapNhat, TenKhoaHoc, TenTiengViet, 
                            TenDiaPhuong, Gioi, Nganh, Lop, Bo, Ho, HinhThai, SinhThai, GiaTri, 
                            BaoTonIUCN, BaoTonVN, BaoTon32, BaoTonCITES, PhanBo, TinhTrang, 
                            SinhCanh, DiaDiem, NgayThuMau, NguoiThuMau, NguoiYeuCau, TrangThai)
                            VALUES (now(),'{$tenkhoahoc}', '{$tengtiengviet}', '{$tendiaphuong}', '{$gioi}',
                            '{$nganh}','{$lop}','{$bo}','{$ho}','{$hinhthai}',
                            '{$sinhthai}','{$giatri}','{$baotonIUCN}','{$baotonVN}','{$baoton32}',
                            '{$baotonCITES}','{$phanbo}','{$tinhtrang}','{$sinhcanh}','{$diadiem}',
                            '{$ngaythumau}','{$nguoithumau}','{$userID}','Chờ duyệt')");


                            $insert_query_img = mysqli_query($conn, "INSERT INTO animals_update_img (TenKhoaHoc, HinhAnh, NguoiYeuCau, TrangThai) 
                            VALUES ('{$tenkhoahoc}','{$new_img_name}','{$userID}','Chờ duyệt')");                           
                            echo "success";
                        }
                    }
                    else
                    {
                        echo "Chỉ nhận ảnh - jpeg, png, jpg";
                    }   
                }   
            }
        }                 
        

?>