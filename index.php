<html>

<head>
  <title>Medway</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <?php
  require_once('include/function/spl_autoload_register.php');
  $fetchrecordobj = new fetchrecord;
  ?>
  <style>
    body {
      background-color: ghostwhite;
      font-family: Arial, Helvetica, sans-serif;
    }

    .clr-red {
      color: red;
      margin-left: 5px;
    }

    #img-preview {
      display: block;
      width: 140px;
      height: 140px;
      border: 2px dashed #333;
      margin-bottom: 20px;
    }

    #img-preview img {
      width: 140px;
      height: 140px;
      display: block;
    }

    .loader {
      background: url('newloader.gif') no-repeat;
      align-items: center;
    }
  </style>
</head>

<body class="">
  <div class="modal bd-example-modal-sm" id="loadercss" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display:none;opacity:1;background-color:#f3efefd1;">
    <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
      <div class="modal-content" style="width: 100%;">
        <div class="modal-body">
          <center><img src="newloader.gif" class="img-fluid" /></center>
        </div>
      </div>
    </div>
  </div>


  <div class="container card mt-4 mb-4">
    <div class="row">
      <div class="col-sm-12 text-center">
        <img src="medway-lg.png" class="img-fluid" alt="Medway" width="460" height="345">
        <p>K-130, Ground Floor, Sudarshan Cinema Road, Near Johar Motors, Gautam Nagar, New Delhi - 110049</p>
      </div>
      <div class="col-12">

      </div>
      <div class="col-sm-6 p-2" style="background-color: #1c365f;"></div>
      <div class="col-sm-6 p-2" style="background-color: #40c19c;"></div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4 mt-2 text-center text-white" style="background-color: #1c365f;">
        <h5 style="margin-top: 7px;">CBT REGISTRATION FORM</h5>
      </div>
      <div class="col-sm-4"></div>
    </div>
    <form id="candi_registration" method="post" enctype="multipart/form-data">
      <?php // $userObj->registration() 
      ?>
      <div class="form-group row mt-4">
        <label class="form-label col-sm-3">Course Applied For<label class="clr-red">*</label></label>
        <div class="col-sm-6">
          <select class="form-control" name="course" required>
            <option value="">Choose Course</option>
            <?php $fetchrecordobj->getpaper(); ?>
          </select>
        </div>
        <div class="col-sm-3">
          <div id="img-preview" name="imageprev">
            <img src="" name="examimage" id="examimage" alt="img" style="width:135px;height:135px" />
          </div>
          <label class="text-danger">Max Size allowed 200 KB.</label>
          <input type="file" class="form-control-file border upload-file" accept="image/*" data-max-size="200000" name="logoimage" id="logoimage" required>
          <input type="hidden" class="form-control" id="exlogo" name="exlogo" required>
        </div>
        <label class="form-label col-sm-3 mt-2">First Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter First Name" name="fname" required />
          <input type="hidden" placeholder="Registration Closed" id="registration" value="Close" />
        </div>
        <label class="form-label col-sm-3 mt-2">Last Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Mobile<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="mob_student" required />
          <input type="number" maxlength="10" onKeyPress="if(this.value.length==10) return false;" class="form-control" placeholder="Enter Mobile Number" name="contact_value[]" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Date of Birth (Dob)<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dob" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Gender<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <select class="form-control" name="gender" required>
            <option value="">Choose Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <!-- <label class="form-label col-sm-2 mt-2">Reservation<label class="clr-red">*</label></label>
          <div class="col-sm-2 mt-2">
            <select class="form-control" name="reserve" required>
              <option value="">Choose</option>
              <option value="General">General</option>
              <option value="SC/ST">SC/ST</option>
              <option value="OBC">OBC</option>
            </select>
          </div> -->
        <!-- <label class="form-label col-sm-3 mt-2">Permanent Address<label class="clr-red">*</label></label>
          <div class="col-sm-3 mt-2">
            <input type="hidden" class="form-control" name="add_type[]" value="Permanent" required />
            <textarea class="form-control" placeholder="Enter Permanent Address" name="address[]" id="per_address" required></textarea>
          </div>
          <label class="form-label col-sm-3 mt-2">City<label class="clr-red">*</label></label>
          <div class="col-sm-3 mt-2">
            <input type="text" class="form-control" placeholder="Enter City" name="city" required />
          </div>
          <label class="form-label col-sm-3 mt-2">State<label class="clr-red">*</label></label>
          <div class="col-sm-3 mt-2">
            <input type="text" class="form-control" placeholder="Enter State" name="state" required />
          </div>
          <label class="form-label col-sm-3 mt-2">Pincode<label class="clr-red">*</label></label>
          <div class="col-sm-3 mt-2">
            <input type="number" maxlength="6" onKeyPress="if(this.value.length==6) return false;"
            class="form-control" placeholder="Enter Pincode" name="pincode" required />
          </div> -->
        <label class="form-label col-sm-3 mt-2">Email-ID<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="email" required />
          <input type="text" class="form-control" placeholder="Enter Email Id" name="contact_value[]" id="emailid" required onblur="validateEmail(this);" />
        </div>
        <label class="form-label col-sm-3 mt-2">College/University Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter College/University Name" name="college" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Year of Passing<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="number" maxlength="4" onKeyPress="if(this.value.length==4) return false;" class="form-control" placeholder="Enter Year of Passing" name="y_o_p" required />
        </div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2 mt-4">
          <button class="btn form-control bg-primary text-white" type="submit" name="submit">Register</button>
        </div>
        <div class="col-sm-5"></div>
      </div>
    </form>
  </div>

  <script>
    function addPara(text) {
      var p = document.createElement("p");
      p.textContent = text;
      document.body.appendChild(p);
    }

    function checkcountry(vl) {
      if (vl == "Other") {
        $('#cntry_name').val();
        $('#cntry_name').css('display', 'block');
      } else {
        $('#cntry_name').css('display', 'none');
        $('#cntry_name').val(vl);

      }

    }

    function validateEmail(emailField) {
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

      if (reg.test(emailField.value) == false) {
        alert('Invalid Email Address');
        return false;
      }
      return true;
    }

    $('#candi_registration').on('submit', function(event) {
      event.preventDefault();
      var input = document.getElementById('logoimage');
      var registration = document.getElementById('registration').value;
      if (registration == "Close") {
        swal("Warning", "Registration Closed", "warning", {
          button: "Done",
        })
        return;
      }

      var emailconfirm = $('#emailid').val();
      var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

      if (reg.test(emailconfirm) == false) {
        alert('Invalid Email Address');
        return false;
      }

      var fileInput = $('.upload-file');
      var maxSize = fileInput.data('max-size');
      var imgdt = document.getElementById('exlogo');
      if (fileInput.get(0).files.length) {
        var fileSize = fileInput.get(0).files[0].size; // in bytes
        if (fileSize > maxSize) {
          alert('File size is more then ' + maxSize + ' KB');
          return false;
        }
        if (imgdt.value == "") {
          alert('Image not choosen!! Choose Image');
          return false;
        }
        // else{
        //     alert('File size is correct- '+fileSize+' MB');
        // }
      } else {
        alert('Choose file, please');
        return false;
      }

      $.ajax({
        url: "api/candireg.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          $('#loadercss').css('display', 'none');
          // data = JSON.parse(data)
          //alert(data)
          if (data == 404) {
            swal("Warning", "Mobile Number Already Registered", "warning", {
              button: "Done",
            })
            return;
          }
          console.log(data);
          $('#loadercss').css('display', 'block');
          swal("Congratulation", "Registered Successfully", "success", {
            button: "Done",
          }).then(function(isConfirm) {
            if (isConfirm) {
              window.location.href = "preview.php?reg_id=" + data;
            }
          });


          // swal("Done", data,"success").then(function() {
          //    window.location.href= "preview.php?reg_id="+data;
          // })

          // if(true){
          //       window.location.reload();
          // }

        },
        error: (err) => {
          swal("WARNING! ", "Something Went Wrong! ", "warning")
        }
      });
    });

    function sameadr() {
      document.getElementById('cor_address').value = document.getElementById('per_address').value
    }

    function opencountrybox() {
      document.getElementById('othercountry').style.display = "block";
    }

    const chooseFile = document.getElementById("logoimage");
    const imgPreview = document.getElementById("img-preview");
    chooseFile.addEventListener("change", function() {
      getImgData();
    });

    function getImgData() {
      const files = chooseFile.files[0];

      var fileInput = $('.upload-file');
      var maxSize = fileInput.data('max-size');
      if (fileInput.get(0).files.length) {
        var fileSize = fileInput.get(0).files[0].size; // in bytes
        if (fileSize > maxSize) {
          alert('File size is not more then 200 KB');
          return false;
        }
        if (files) {
          const fileReader = new FileReader();
          fileReader.readAsDataURL(files);
          fileReader.addEventListener("load", function() {
            imgPreview.style.display = "block";
            document.getElementById('examimage').src = this.result;
            document.getElementById('exlogo').value = this.result;

          });
        }
      }
    }
  </script>
</body>

</html>