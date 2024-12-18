<?php include_once('include/header.php') ?>
<?php include_once('include/sidebar.php') ?>

    <?php 
        $olddata=array();
        $con['id']=$_GET['id'];
        $result=$mysqli->common_select_single('vehicle_seat_type','*',$con);
        if($result){
            if($result['data']){
                $olddata=$result['data'];
            }
        }
    ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Vehicle Seat Type</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Settings 1</a>
                                        <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="" action="" method="post" novalidate>
                                
                                
                                
                                <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Vehicle<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" required name="vehicle_id" id="vehicle_id">
                                                    <option value="">Choose One</option>
                                                <?php 
                                                    $result=$mysqli->common_select('vehicle');
                                                    if($result){
                                                        if($result['data']){
                                                            foreach($result['data'] as $data){
                                                ?>
                                                    <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                                <?php } } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Seat<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" required name="seat_id" id="seat_id">
                                                    <option value="">Choose One</option>
                                                <?php 
                                                    $result=$mysqli->common_select('seat');
                                                    if($result){
                                                        if($result['data']){
                                                            foreach($result['data'] as $data){
                                                ?>
                                                    <option value="<?= $data->id ?>"<?= $data->id==$olddata->seat_id ? "selected" :"" ?>><?= $data->name ?></option>
                                                <?php } } } ?>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Seat Type<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" name="seat_type_id" id="seat_type_id" required="required">
                                                    <option value="">Choose One</option>
                                                <?php 
                                                    $result=$mysqli->common_select('seat_type');
                                                    if($result){
                                                        if($result['data']){
                                                            foreach($result['data'] as $data){
                                                ?>
                                                    <option value="<?= $data->id ?>" <?= $data->id==$olddata->seat_type_id ? "selected" :"" ?>><?= $data->name ?></option>
                                                <?php } } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Price<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" value="<?= $olddata->price ?>" name="price" required="required" />
                                            </div>
                                        </div>
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                    <button type='submit' class="btn btn-primary">Submit</button>
                                                   
                                                </div>
                                            </div>
                                        </div>
                            </form>
                            <?php 
                                if($_POST){
                                    $_POST['updated_at']=date('Y-m-d H:i:s');
                                    $_POST['updated_by']=1;
                                    $rs=$mysqli->common_update('vehicle_seat_type',$_POST, $con);
                                    if($rs){
                                        if($rs['data']){
                                            echo "<script>window.location='{$baseurl}vehicle_seat_type_list.php'</script>";
                                        }else{
                                            echo $rs['error'];
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- /page footer -->
    <?php include('include/footer.php') ?>