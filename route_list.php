<?php include('include/header.php') ?>
<?php include('include/sidebar.php') ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Route</h3>
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
                          <th>#</th>
                          <th>Name</th>
                          <th>Area From</th>
                          <th>Break Area</th>
                          <th>Area To</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $result=$mysqli->common_select_query("
                          select route.*,
                        (select name from area where area.id=route.area_from) as area_from,
                        (select name from area where area.id=route.break_area) as break_area,
                        (select name from area where area.id=route.area_to) as area_to
                        from route
                          ");
                          if($result){
                            if($result['data']){
                              $i=1;
                              foreach($result['data'] as $data){
                        ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data->name ?></td>
                            <td><?= $data->area_from ?></td>
                            <td><?= $data->break_area ?></td>
                            <td><?= $data->area_to ?></td>
                            <td>
                              <a href="<?= $baseurl ?>route_edit.php?id=<?= $data ->id ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              <a onclick="return confirm('Are you sure?')" href="<?= $baseurl ?>route_delete.php?id=<?= $data ->id ?>" class="btn btn-Warning btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                          </tr>
                        <?php } } } ?>
                      </tbody>
                    </table><!-- end project list -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include('include/footer.php') ; ?>