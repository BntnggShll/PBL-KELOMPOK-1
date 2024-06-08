<?php
$sql = "SELECT COUNT(*) as total FROM mahasiswa";
$result = $db->query($sql);

$row = $result->fetch_assoc();
$totalData = $row['total'];

$sql1 = "SELECT COUNT(*) as total1 FROM dosen";
$result1 = $db->query($sql1);

$row1 = $result1->fetch_assoc();
$totalData1 = $row1['total1'];

$sql2 = "SELECT COUNT(*) as total2 FROM ruangan";
$result2 = $db->query($sql2);

$row2 = $result2->fetch_assoc();
$totalData2 = $row2['total2'];

$sql3 = "SELECT COUNT(*) as total3 FROM matakuliah";
$result3 = $db->query($sql3);

$row3 = $result3->fetch_assoc();
$totalData3 = $row3['total3'];
?>



<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Mahasiswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalData ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dosen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalData1 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Ruangan
                            </div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?= $totalData2 ?>
                            </div>


                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Mata Kuliah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalData3 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>