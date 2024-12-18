<?php include('include/header.php') ?>
<?php include('include/sidebar.php') ?>

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
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List</h2>
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

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 12.37%">Counter Name</th>
                          <th style="width: 12.37%">Contact No</th>
                          <th style="width: 12.37%">Area</th>
                          <th style="width: 12.37%">District</th>
                          <th style="width: 12.37%">Division</th>
                          <th style="width: 12.37%">Address</th>
                          <th style="width: 12.37%">Contact Person</th>
                          <th style="width: 12.37%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $result=$mysqli->common_select_query("select counter.*, area.name as area, district.district_name as district, division.division_name as division from counter
                        join area on counter.area_id=area.id
                        join district on counter.district_id=district.id
                        join division on counter.division_id=division.id");
                        if($result){
                            if($result['data']){
                                $i=1;
                                foreach($result['data'] as $data){
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $data-> counter_name ?></td>
                                <td><?= $data-> contact_no ?></td>
                                <td><?= $data-> area ?></td>
                                <td><?= $data-> district ?></td>
                                <td><?= $data-> division ?></td>
                                <td><?= $data-> address ?></td>
                                <td><?= $data-> contact_person ?></td>
                                <td>
                                  <a href="<?= $baseurl ?>counter_edit.php?id=<?= $data ->id ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                  <a onclick="return confirm('Are you sure?')" href="<?= $baseurl ?>counter_delete.php?id=<?= $data ->id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                                
                            </tr>
                          <?php } } } ?>
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include('include/footer.php') ; ?>