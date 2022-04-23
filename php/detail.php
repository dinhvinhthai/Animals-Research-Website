<?php
    include_once "connection.php";
    $tendv=$_GET['tendv'];
    $sql = "SELECT * 
            FROM animals LEFT JOIN animals_img 
            ON animals.TenKhoaHoc = animals_img.TenKhoaHoc
            WHERE animals.TenTiengViet = '$tendv'
            GROUP BY animals.TenKhoaHoc
            ORDER BY animals.TenTiengViet";
    $result=$conn->query($sql);
    if(mysqli_num_rows($result) == 0){
        echo "<p align='center'>Không tìm thấy động vật trong hệ thống!!!</p>";
    }
    else{ 
        while($row = $result->fetch_assoc()){
        echo "
            <section class='product-details'>
                <div class='product-title'>
                        <p>".$row['TenTiengViet']."</p>
                        <p>".$row['TenKhoaHoc']."</p>
                </div>
                <div class='product'>
                            
                    <div class='product-images'>            
                        <img src='".$row['HinhAnh']."'>
                    </div>
                <div class='details'>
                        <p class='product-brand'><span>Tên địa phương: </span>".$row['TenDiaPhuong']." </p>
                        <p class='product-brand'><span>Giới: </span>".$row['Gioi']."</p>
                        <p class='product-brand'><span>Ngành: </span>".$row['Nganh']."</p>
                        <p class='product-brand'><span>Lớp: </span>".$row['Lop']."</p>
                        <p class='product-brand'><span>Bộ: </span>".$row['Bo']."</p>
                        <p class='product-brand'><span>Họ: </span>".$row['Ho']."</p>
                        <p class='product-brand'><span>Phân bố: </span>".$row['PhanBo']."</p>
                        <p class='product-brand'><span>Giá trị sử dụng: </span>".$row['GiaTri']."</p>
                        </div>
                        </div>
                </section>

            <section class='detail-des'>
                <h2 class='heading'>Đặc điểm hình thái</h2>
                <p class='des'>".$row['HinhThai']."</p>
                <h2 class='heading'>Đặc điểm sinh thái</h2>
                <p class='des'>".$row['SinhThai']."</p>
                <h2 class='heading'>Thông tin bảo tồn</h2>
                <p class='baoton'>Tình trạng bảo tồn theo IUCN: ".$row['BaoTonIUCN']."</p>
                <p class='baoton'>Tình trạng bảo tồn theo sách đỏ Việt Nam: ".$row['BaoTonVN']."</p>
                <p class='baoton'>Tình trạng bảo tồn theo Nghị định 32/2006/NĐCP: ".$row['BaoTon32']."</p>
                <p class='baoton'>Tình trạng bảo tồn theo CITES (40/2013/TT-BNNPTNT): ".$row['BaoTonCITES']."</p>
            </section>
            <section class='detail-lienquan'>
            <h2 class='heading'>Một số loài liên quan</h2>";
            $sql2 = "SELECT * 
                FROM animals LEFT JOIN animals_img 
                ON animals.TenKhoaHoc = animals_img.TenKhoaHoc
                WHERE animals.Lop = (SELECT Lop FROM animals WHERE TenTiengViet = '$tendv')
                GROUP BY animals.TenKhoaHoc
                ORDER BY animals.TenTiengViet
                LIMIT 4";
            $result2=$conn->query($sql2);
            if(mysqli_num_rows($result2) == 0){
                echo "<p align='center'>Không tìm thấy động vật trong hệ thống!!!</p>";
            }
            else{
                echo "<div class='lienquan'>";
                while($row = $result2->fetch_assoc()){                            
                    echo "<div class='div-results'>
                        <div class='result-img'>
                        <img width='250px' src='".$row['HinhAnh']."'></img>
                    </div>                            
                    <div class='result-name'>
                            <a href='./detail_page.php?tendv=".$row['TenTiengViet']."'>".$row['TenTiengViet']."</a>                    
                            <br>
                            Tên địa phương: ".$row['TenDiaPhuong']."
                            <br>
                            ".$row['TenKhoaHoc']."
                        </div>			
                    </div>";         
                }
                echo "</div>";
            echo "</section>";
            }
        }
    }
?>