<?php include('include/header.php') ?>
<?php include('include/sidebar.php') ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Schedule</h3>
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
                          <th style="width: 12%">Couch Number</th>
                          <th style="width: 12%">Vehicle id</th>
                          <th style="width: 12%">Route id</th>
                          <th style="width: 12%">Departure Time</th>
                          <th style="width: 12%">Departure Counter</th>
                          <th style="width: 12%">Arrival Time</th>
                          <th style="width: 12%">Arrival Counter</th>
                          <th style="width: 12%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $result=$mysqli->common_select_query("
                          select schedule.*, vehicle.name as vehicle, 
                          route.name as route,
                          (select counter_name from counter where counter.id=schedule.arrival_counter) as arrival_counter,
                          (select counter_name from counter where counter.id=schedule.departure_counter) as departure_counter
                          from schedule
                          join vehicle on schedule.vehicle_id=vehicle.id
                          join route on schedule.route_id=route.id");
                          if($result){
                            if($result['data']){
                              $i=1;
                              foreach($result['data'] as $data){
                        ?>
                          <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data->couch_number ?></td>
                            <td><?= $data->vehicle ?></td>
                            <td><?= $data->route ?></td>
                            <td><?= date('d-m-Y h:iA',strtotime($data->departure_time)) ?></td>
                            <td><?= $data->departure_counter ?></td>
                            <td><?= date('d-m-Y h:iA',strtotime($data->arrival_time)) ?></td>
                            <td><?= $data->arrival_counter ?></td>
                            <td>
                              <a href="<?= $baseurl ?>schedule_edit.php?id=<?= $data ->id ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              <a onclick="return confirm('Are you sure?')" href="<?= $baseurl ?>schedule_delete.php?id=<?= $data ->id ?>" class="btn btn-Warning btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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