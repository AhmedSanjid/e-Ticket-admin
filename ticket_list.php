
<?php include('include/header.php') ?>
<?php include('include/sidebar.php') ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ticket</h3>
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
                  <th scope="col">#</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Route</th>
                  <th scope="col">Order Date </th>
                  <th scope="col">Journey Date </th>
                  <th scope="col">Total Seat</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">Status</th>
                  <th scope="col">Refund</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $result=$mysqli->common_select_query("SELECT seat_book.*, schedule.couch_number,schedule.departure_time,
                                                          schedule.arrival_time,
                                                          (select route.name from route WHERE route.id=schedule.route_id) as route,
                                                          (select counter.counter_name from counter WHERE counter.id=schedule.departure_counter) as departure_counter,
                                                          (select counter.counter_name from counter WHERE counter.id=schedule.arrival_counter) as arrival_counter,
                                                          vehicle.name as vehicle_name, vehicle.registration_no FROM `seat_book`
                                                          JOIN schedule on schedule.id=seat_book.schedule_id
                                                          JOIN vehicle on vehicle.id=seat_book.vehicle_id order by seat_book.id DESC"); 
                    if($result){
                      if($result['data']){
                        foreach($result['data'] as $i=>$data){
                  ?>
                <tr>
                  <td><?= ++$i ?></td>
                  <td><?= $data->name ?></td>
                  <td><?= $data->route ?></td>
                  <td><?= date('d-m-Y h:iA',strtotime( $data->created_at)) ?></td>
                  <td><?= date('d-m-Y h:iA',strtotime( $data->departure_time)) ?></td>
                  <td><?= $data->total_seat?></td>
                  <td><?= $data->total_amount-$data->other_charge ?></td>
                  <td><?= $data->status==1 ? "canceled and refunded" : "Paid" ?></td>
                  <td><?= $data->request_cancel==1 ? "Refund request sent" : "" ?></td>
                  <td>
                    <a href="<?= $baseurl ?>invoice.php?txnid=<?= $data->transaction_id ?? "" ?>" class="btn btn-success">Invoice</a>
                      <?php if($data->status==1){ ?>
                        <a onclick="return confirm('Are you sure?')" href="<?= $baseurl ?>cencel_request.php?id=<?= $data ->id ?>&status=0" class="btn btn-danger btn-xs"> Cancel refund </a>
                      <?php } else { ?>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="<?= $baseurl ?>cencel_request.php?id=<?= $data ->id ?>&status=1"> Refund </a>
                      <?php } ?>
                  </td>
                </tr>
                <?php }}} ?>
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