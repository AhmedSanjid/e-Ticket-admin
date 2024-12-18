<?php require_once('include/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php 
  $seatdata=[];
  $transaction_id=$_GET['txnid'];
  $result=$mysqli->common_select_query("SELECT seat_book.*, schedule.couch_number,schedule.departure_time,
                                        schedule.arrival_time,
                                        (select route.name from route WHERE route.id=schedule.route_id) as route,
                                        (select counter.counter_name from counter WHERE counter.id=schedule.departure_counter) as departure_counter,
                                        (select counter.counter_name from counter WHERE counter.id=schedule.arrival_counter) as arrival_counter,
                                        vehicle.name as vehicle_name, vehicle.registration_no FROM `seat_book`
                                        JOIN schedule on schedule.id=seat_book.schedule_id
                                        JOIN vehicle on vehicle.id=seat_book.vehicle_id WHERE seat_book.transaction_id='$transaction_id'"); 
                                          if($result){
                                            if($result['data']){
                                              $seatdata=$result['data'][0];
                                            }
                                          }
  
?>    
<div class="container">
  <div class="row bg-warning">
    <div class="col-md-4">
      <p> Ticket No: <?= str_pad($seatdata->id, 8, '0', STR_PAD_LEFT) ?></p>
    </div>
    <div class="col-md-4 text-center ">
      <h2 class="text-align-center">TICKET-f0!</h2>
      <p>Coach no-#<?=$seatdata->couch_number?> <?=$seatdata->route?></p>
    </div>
    <div class="col-md-4">
      <p>Passenser Copy</p>
    </div>
  </div>
  <div class="container">
    <div class="row my-3">
      <div class="col-md-4 bg-light">
        <div class=" mt-1">
          <ul class="list-unstyled">
            <li>Name:<span><?=$seatdata->name ?></span></li>
            <li>Contact No:<span><?=$seatdata->phone ?></span></li>
            <li>Route:<span><?=$seatdata->route ?></span></li>
            <li>Issue Counter:<span><?=$seatdata->departure_counter ?></span></li>
            <li>Issue Date:<span><?= date('d-m-Y h:iA',strtotime($seatdata->created_at)) ?></span></li>
            <li>Seat QTY:<span><?=$seatdata->total_seat?></span></li>
            <li>Total price:<span><?= $seatdata->total_amount ?></span></li>
          </ul>
        </div>
      </div>
      <div class="col-md-5 bg-light">
        <div class="mt-1">
          <ul class="list-unstyled">
            <li>start counter:<span><?=$seatdata->departure_counter ?></span></li>
            <li>End counter:<span><?=$seatdata->arrival_counter ?></span></li>
            <li>Route:<span><?=$seatdata->route ?></span></li>
            <li>Journey Date:<span><?= date('d-m-Y h:iA',strtotime($seatdata->departure_time)) ?></span></li>
            <li>Arrival Date:<span><?= date('d-m-Y h:iA',strtotime($seatdata->arrival_time)) ?></span></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 bg-light">
        <?php 
          $booked=$mysqli->common_select_single('seat_book','*',array('transaction_id'=>$_GET['txnid']))['data'];
          
          $cols=array(1,2,3,4);
          $seat=$rows=array();
          $result=$mysqli->common_select_query("SELECT vehicle_seat_type.*,seat.name,seat_type.name as stype FROM `vehicle_seat_type` 
                                        JOIN seat on seat.id=vehicle_seat_type.seat_id
                                        JOIN seat_type on seat_type.id=vehicle_seat_type.seat_type_id
                                        WHERE vehicle_seat_type.vehicle_id={$booked->vehicle_id} and vehicle_seat_type.deleted_at is null order by seat.name");
          if($result){
            if($result['data']){
              foreach($result['data'] as $rs){
                $rows[substr($rs->name,0,1)]=substr($rs->name,0,1);
                $seat[$rs->name]=$rs;
              }


              $booked_seat=array();
              $conbook['seat_book_id']=$booked->id;
              $booked=$mysqli->common_select('seat_book_details','*',$conbook);
              if($booked){
                  if($booked['data']){
                    foreach($booked['data'] as $bd){
                      $booked_seat[$bd->seat_id]=$bd->seat_id;
                    }
                  }
              }
            }
          }
          if(count($seat) > 0){
        ?>
          
            <table style="border:2px solid #ffa900; width:150px;">
              <tbody>
                <?php 
                  if(count($rows)){
                    foreach($rows as $r){
                ?>
                      <tr>
                        <?php
                          if(count($cols)){
                            foreach($cols as $c){
                        ?>
                            <td style="padding:0; border:1px solid #aaa">
                              <?php if(isset($seat["{$r}{$c}"])){ 
                                    if(isset($booked_seat[$seat["{$r}{$c}"]->seat_id])){ ?>
                                      <button title="<?= $seat["{$r}{$c}"]->name ?? '' ?>" type="button" class="btn btn-dark p-0 " value="">
                                        <?= $seat["{$r}{$c}"]->name ?? '' ?>
                                      </button>
                              <?php }else{ ?>
                                        <button title="<?= $seat["{$r}{$c}"]->name ?? '' ?>" type="button"  class="btn  p-0 vseat" value="">
                                          <?= $seat["{$r}{$c}"]->name ?? '' ?>
                                        </button>
                              <?php }} ?>
                            </td>
                        <?php } } ?>
                      </tr>
                <?php } } ?>
              </tbody>
              
            </table>
              
          <?php }  ?>

                </div>
            </div> 
        </div>
        <div class="row bg-warning">
        <p><i class="fa-fa-phone"></i></p>
                    



        </div>
</div>      
</body>
</html>