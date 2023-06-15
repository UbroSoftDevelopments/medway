<!DOCTYPE html>
<html lang="en">

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
      width: 100%;
      height: auto;
      display: block;
    }
  </style>
</head>

<body>

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
      <div class="form-group row mt-4">
        <label class="form-label col-sm-3">Country of Education<label class="clr-red">*</label></label>
        <div class="col-sm-6">
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input rdo" name="optradio" value="India" onclick="checkcountry()">India
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input rdo" name="optradio" value="Uzberkistan" onclick="checkcountry()">Uzberkistan
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Ukraine" onclick="checkcountry()" onclick="checkcountry()">Ukraine
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Kazakhstan" onclick="checkcountry()">Kazakhstan
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Kyrgystan" onclick="checkcountry()">Kyrgystan
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Rusia" onclick="checkcountry()">Russia
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="China" onclick="checkcountry()">China
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Bangladesh" onclick="checkcountry()">Bangladesh
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Armenia" onclick="checkcountry()">Armenia
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Phillipines" onclick="checkcountry()">Phillipines
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optradio" value="Nepal" onclick="checkcountry()">Nepal
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label" onclick="opencountrybox()">
              <input type="radio" class="form-check-input" name="optradio">Others
            </label>
          </div>
          <input type="hidden" class="form-control mt-3" placeholder="Enter Country Name" name="country_nm" id="othercountry" style="display: block;" />
        </div>
        <div class="col-sm-3">
          <div id="img-preview" name="imageprev">
            <img src="" name="examimage" id="examimage" alt="img" />
          </div>
          <input type="file" class="form-control-file border" name="logoimage" id="logoimage">
        </div>
        <label class="form-label col-sm-3 mt-2">Course Applied For<label class="clr-red">*</label></label>
        <div class="col-sm-6 mt-2">
          <select class="form-control" name="course">
            <option value="">Choose Course</option>
            <option value="1">NEET - PG</option>
            <option value="2">NEXT</option>
            <option value="3">FMGE</option>
          </select>
        </div>
        <div class="col-sm-3 mt-2"></div>
        <label class="form-label col-sm-3 mt-2">First Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter First Name" name="fname" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Last Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Father's/Guardian's Name<label class="clr-red">*</label></label>
        <div class="col-sm-9 mt-2">
          <input type="text" class="form-control" placeholder="Enter Father's/Guardian's Name" name="f_name" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Mother's Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter Mother's Name" name="m_name" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Mobile<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="mob_student" required />
          <input type="text" class="form-control" placeholder="Enter Mobile Number" name="contact_value[]" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Date of Birth (Dob)<label class="clr-red">*</label></label>
        <div class="col-sm-2 mt-2">
          <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dob" required />
        </div>
        <label class="form-label col-sm-1 mt-2">Gender<label class="clr-red">*</label></label>
        <div class="col-sm-2 mt-2">
          <select class="form-control" name="gender">
            <option value="">Choose Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Feamle</option>
          </select>
        </div>
        <label class="form-label col-sm-2 mt-2">Reservation<label class="clr-red">*</label></label>
        <div class="col-sm-2 mt-2">
          <select class="form-control" name="reserve">
            <option value="">Choose</option>
            <option value="General">General</option>
            <option value="SC/ST">SC/ST</option>
            <option value="OBC">OBC</option>
          </select>
        </div>
        <label class="form-label col-sm-3 mt-2">Permanent Address<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="add_type[]" value="Permanent" required />
          <textarea class="form-control" placeholder="Enter Permanent Address" name="address[]" id="per_address"></textarea>
        </div>
        <div class="col-sm-3 mt-2">
          <label class="form-label ">Correspondance Address<label class="clr-red">*</label></label>
          <br>
          <input type="checkbox" name="check" id="check" onclick="sameadr()" required />
          <label for=""><i>Same as Permanent Address</i></label>
        </div>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="add_type[]" value="Correspondance" required />
          <textarea class="form-control" placeholder="Enter Correspondance Address" name="address[]" id="cor_address"></textarea>
        </div>
        <label class="form-label col-sm-3 mt-2">City<label class="clr-red">*</label></label>
        <div class="col-sm-2 mt-2">
          <input type="text" class="form-control" placeholder="Enter City" name="city" required />
        </div>
        <label class="form-label col-sm-1 mt-2">State<label class="clr-red">*</label></label>
        <div class="col-sm-2 mt-2">
          <input type="text" class="form-control" placeholder="Enter State" name="state" required />
        </div>
        <label class="form-label col-sm-2 mt-2">Pincode<label class="clr-red">*</label></label>
        <div class="col-sm-2 mt-2">
          <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode" required />
        </div>
        <label class="form-label col-sm-3  mt-2">Mobile (Parent's)<label class="clr-red">*</label></label>
        <div class="col-sm-3  mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="father" required />
          <input type="text" class="form-control" placeholder="Enter Mobile (Parent's)" name="contact_value[]" required />
        </div>
        <label class="form-label col-sm-3  mt-2">Mobile (Mother's)<label class="clr-red">*</label></label>
        <div class="col-sm-3  mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="mob_mother" required />
          <input type="text" class="form-control" placeholder="Enter Mobile (Mother's)" name="contact_value[]" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Mobile (WhatsApp)<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="mob_whatsapp" required />
          <input type="text" class="form-control" placeholder="Enter Mobile (WhatsApp)" name="contact_value[]" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Email-ID<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="hidden" class="form-control" name="contact_type[]" value="email" required />
          <input type="text" class="form-control" placeholder="Enter Email Id" name="contact_value[]" required />
        </div>
        <label class="form-label col-sm-3 mt-2">College/University Name<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter College/University Name" name="college" required />
        </div>
        <label class="form-label col-sm-3 mt-2">Year of Passing<label class="clr-red">*</label></label>
        <div class="col-sm-3 mt-2">
          <input type="text" class="form-control" placeholder="Enter Year of Passing" name="y_o_p" required />
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
    function checkcountry() {
      var radios = document.getElementsByName('optradio');

      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          // do whatever you want with the checked radio
          // alert(radios[i].value);

          $('#othercountry').val(radios[i].value);

          // only one radio can be logically checked, don't check the rest
          break;
        }
      }

    }

    $('#candi_registration').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: "api/registration.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          // alert(data);

          data = JSON.parse(data)
          console.log(data);
          swal(data.msg, "", data.type).then(function() {
            window.location.reload();
          })

          // if(data.status){
          //       window.location.reload();
          // }

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
      if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function() {
          imgPreview.style.display = "block";
          document.getElementById('examimage').src = this.result;
          //document.getElementById('exlogo').value= this.result;

        });
      }
    }
  </script>
</body>

</html>