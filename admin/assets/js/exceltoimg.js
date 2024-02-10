document.getElementById("upload").addEventListener("change", handleFileSelect, false);

var imgContainer = document.getElementById("imgContainer");

let excelDataToUpload = [];

var ExcelToJSON = function () {
  this.parseExcel = function (file) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var data = e.target.result;
      var workbook = XLSX.read(data, {
        type: "binary",
      });
      workbook.SheetNames.forEach(function (sheetName) {
        // Here is your object
        var XL_row_object = XLSX.utils.sheet_to_row_object_array(
          workbook.Sheets[sheetName]
        );
        readJsonArray(XL_row_object);
      });
    };

    reader.onerror = function (ex) {
      // //console.log(ex);
    };

    reader.readAsBinaryString(file);
  };
};

function handleFileSelect(evt) {
  document.getElementById("loadercss").style.display = "block";
  var files = evt.target.files; // FileList object
  var xl2json = new ExcelToJSON();
  xl2json.parseExcel(files[0]);
}

function cleardiv() {
  imgContainer.innerHTML = "";
}

//read JSON and create img
readJsonArray = (jsonInput) => {
  cleardiv();
  excelDataToUpload = [];
  jsonInput.map((data, ind) => {
    let h6 = document.createElement("h4");
    h6.innerText = ind + 1;
    imgContainer.appendChild(h6);
    let questionBaseImg = textToImg(data.Question);
    let opt1BaseImg = textToImg(data.Option_A);
    let opt2BaseImg = textToImg(data.Option_B);
    let opt3BaseImg = textToImg(data.Option_C);
    let opt4BaseImg = textToImg(data.Option_D);
    let explanation = textToImg(data.Explanation);
    // console.log(
    //   questionBaseImg,
    //   opt1BaseImg,
    //   opt2BaseImg,
    //   opt3BaseImg,
    //   opt4BaseImg,
    //   explanation
    // );
    excelDataToUpload.push({
      qid: data.QID,
      types: data.TYPE,
      mms: data.MM,
      nms: data.NM,
      ol1: data.Op_Id_1,
      ol2: data.Op_Id_2,
      ol3: data.Op_Id_3,
      ol4: data.Op_Id_4,
      question: questionBaseImg,
      opt1: opt1BaseImg,
      opt2: opt2BaseImg,
      opt3: opt3BaseImg,
      opt4: opt4BaseImg,
      explain: explanation,
    });
    let hr = document.createElement("hr");
    imgContainer.appendChild(hr);
  });
  endLoading();
};

//fnution to save to server
const endLoading = () => {
  //console.log("sm"+excelDataToUpload);
  document.getElementById("loadercss").style.display = "none";
};

function uploadqpackexcel() {
 // document.getElementById("uploadloadercss").style.display = "block";
  var files = document.getElementById("upload").files;
  if (files.length == 0) {
    alert("Please choose any file...");
    return;
  }
  const exid = document.getElementById("exid").value;
  const pid = document.getElementById("pid").value;
  const langid = document.getElementById("chlang").value;
  const secid = document.getElementById("chsec").value;
  const psid = document.getElementById("chshift").value;
  var dt = excelDataToUpload;
  // alert(langid);
  // alert(secid);
  if (!langid || !secid) {
    alert("Some Field are not Choosen");
  } else {
   // console.log(dt)
    $.ajax({
      type: "POST",
      data: { langid: langid, secid: secid, dt: dt, psid: psid,pid:pid,exid:exid },
      url: "ajax_pages/uploadexcel.php",
      success: function (msg) {
        console.log("msg" + msg);
		if (msg == "201") {
			swal("Warning", "Clear", "warning", {
			  button: "Done",
			});
		  }
        if (msg == "404") {
          swal("Warning", "All Questions Added", "warning", {
            button: "Done",
          });
        }
        if (msg == "404") {
          document.getElementById("uploadloadercss").style.display = "none";
          swal("Congratulation", "Question Added Successfully", "success", {
            button: "Done",
          });
          getquestioncount(psid);
          //alert("msg"+msg);
          //$('#images_list').html(data);
          //document.getElementById('exampleModalCenter').style.display="block";
        }
      },
    });
  }
}

//text to img

var canvas = document.getElementById("canv"),
  ctx = canvas.getContext("2d"),
  img = document.getElementById("image");

var textToImg = (text) => {
  text = wordWrap(text);
  ////console.log(text)
  var x = 7;
  var y = 18;
  var lineheight = 38;

  var lines = text.replaceAll("\\n", "\n").split("\n");
  var lineLengthOrder = lines.slice(0).sort(function (a, b) {
    return b.length - a.length;
  });

  ctx.canvas.width = ctx.measureText(lineLengthOrder[0]).width + 25;
  ctx.canvas.height = lines.length * lineheight;

  ctx.fillStyle = "#ffffff";
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.textBaseline = "middle";
  ctx.font = "24px Arial Pro";
  ctx.fillStyle = "#000000";
  for (var i = 0; i < lines.length; i++) {
    ctx.fillText(lines[i], x, y + i * lineheight);
  }
  ////console.log(ctx.canvas.toDataURL())
  let _img = document.createElement("img");
  _img.src = ctx.canvas.toDataURL();
  imgContainer.appendChild(_img);
  let br = document.createElement("br");
  imgContainer.appendChild(br);
  return ctx.canvas.toDataURL();
};

//to set canva active
textToImg("");
imgContainer.innerHTML = "";

function wordWrap(str, maxWidth) {
  var newLineStr = "\n";
  done = false;
  res = "";
  while (str.length > maxWidth) {
    found = false;
    // Inserts new line at first whitespace of the line
    for (i = maxWidth - 1; i >= 0; i--) {
      if (testWhite(str.charAt(i))) {
        res = res + [str.slice(0, i), newLineStr].join("");
        str = str.slice(i + 1);
        found = true;
        break;
      }
    }
    // Inserts new line at maxWidth position, the word is too long to wrap
    if (!found) {
      res += [str.slice(0, maxWidth), newLineStr].join("");
      str = str.slice(maxWidth);
    }
  }

  return res + str;
}

function testWhite(x) {
  var white = new RegExp(/^\s$/);
  return white.test(x.charAt(0));
}
