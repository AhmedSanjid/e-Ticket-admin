<?php include_once('include/header.php') ?>
<?php include_once('include/sidebar.php') ?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Counter</h3>
                        </div>


                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add New</h2>
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
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Counter Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" class='optional' name="counter_name" data-validate-length-range="5,15" type="text" /></div>
                                        </div>
                                       <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Contact No<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="contact_no" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Area<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" name="area_id" id="" required="required">
                                                    <option value="">Choose One</option>
                                                    <?php 
                                                        $result=$mysqli->common_select('area');
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
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">District<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" name="district_id" id="district_id" required="required">
                                                    <option value="">Choose One</option>
                                                    <?php 
                                                        $result=$mysqli->common_select('district');
                                                        if($result){
                                                            if($result['data']){
                                                                foreach($result['data'] as $data){
                                                    ?>
                                                        <option value="<?= $data->id ?>"><?= $data->district_name ?></option>
                                                    <?php } } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Division<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control" name="division_id" id="" required="required">
                                                    <option value="">Choose One</option>
                                                    <?php 
                                                        $result=$mysqli->common_select('division');
                                                        if($result){
                                                            if($result['data']){
                                                                foreach($result['data'] as $data){
                                                    ?>
                                                        <option value="<?= $data->id ?>"><?= $data->division_name ?></option>
                                                    <?php } } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="address" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Contact Person<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="contact_person" required="required" />
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
                                            $_POST['created_at']=date('Y-m-d H:i:s');
                                            $_POST['created_by']=1;
                                            $rs=$mysqli->common_create('counter',$_POST);
                                            if($rs){
                                                if($rs['data']){
                                                    echo "<script>window.location='{$baseurl}counter_list.php'</script>";
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