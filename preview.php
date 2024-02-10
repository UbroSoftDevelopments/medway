<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="medway-lg.png" />

  <title>Admit Card</title>

  <style>
    .txt-center {
      text-align: center;
    }

    .border- {
      border: 1px solid #000 !important;
    }

    .padding {
      padding: 15px;
    }

    .mar-bot {
      margin-bottom: 15px;
    }

    .admit-card {
      border: 2px solid #000;
      padding: 15px;
      margin: 20px 0;
    }

    .BoxA h5,
    .BoxA p {
      margin: 0;
    }

    h5 {
      text-transform: uppercase;
    }

    table img {
      width: 100%;
      margin: 0 auto;
    }

    .table-bordered td,
    .table-bordered th,
    .table thead th {
      border: 1px solid #000000 !important;
    }

    @media print {
      .printPageButton {
        display: none;
      }
    }
  </style>

</head>

<body>
  <?php
  require_once('include/function/spl_autoload_register.php');
  $fetchrecordobj = new fetchrecord;
  $c_detail = $fetchrecordobj->candi_detail();
  ?>
  <br />
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 ">
      <section>
        <div class="container">
          <div class="admit-card">
            <div style='text-align:center;' class='list-group-item list-group-item-success printPageButton'><b>Registered Successfull</b></div>
            <div class=" border-padding mar-bot">
              <div class="row">
                <div class="col-sm-10">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td><b>ENROLLMENT NO : <?php echo $c_detail['reg_no'] ?></b></td>
                        <td><b>Course: </b> <?php echo $c_detail['papername']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Student Name: </b><?php echo $c_detail['name'] ?></td>
                        <td><b>Gender: </b><?php echo $c_detail['gender']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Date of Birth (Dob): </b><?php echo date("d-m-Y", strtotime($c_detail['dob'])); ?></td>
                        <td></td>
                      </tr>

                      <!-- <tr>
                           <td colspan="2" style="    height: 125px;"><b>Address:<br> </b><?php

                                                                                          //$fetchrecordobj->candi_address();

                                                                                          //echo $gcandiaddress['address']. " , ". $gcandiaddress['district']. " , ".$gcandiaddress['pincode']." , ". $gcandiaddress['city']." , ".$gcandiaddress['state'] ;
                                                                                          ?> </td>
                         </tr> -->
                    </tbody>
                  </table>
                </div>
                <div class="col-sm-2 txt-center">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th scope="row txt-center"><img src="<?php echo $c_detail['photo'] ?>" width="123px" height="165px" /></th>
                      </tr>
                      <!-- <tr>
                           <th scope="row txt-center"><img src="sign/sig.png" /></th>
                         </tr> -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <button class="printPageButton" onClick="window.print();">Print</button>

          </div>
        </div>

      </section>
    </div>
    <div class="col-lg-1"></div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>