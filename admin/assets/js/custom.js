/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

function myFunction() {
  
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function set(a) {
  document.getElementById('abc' + a).style.display = "block";
}

function closemodal() {
  document.getElementById('exampleModalCenter').style.display = "none";
}

// $(document).ready(function () {
//   $("#Addsection").on("click", function () {
//     var pid = document.getElementById('chooseppr').value;
//     const myArray = pid.split(",");
//     const psid = myArray[0];
//     $("#sectext").append("<input type='text' placeholder='Section Name' name='sectioname[]' class='form-control'/><br/>");
//     $("#ttlquestext").append("<input type='text' placeholder='Total Question' name='ttlques[]' class='form-control'/><br/>");
//     $("#marktext").append("<input type='text' placeholder='Marks' name='marks[]' class='form-control'/>" +
//       "<input type='hidden' class='form-control' placeholder='Pid' name='pid[]' value=" + psid + "><br/>");
//       $("#Removesection").css("display", "block");
//   });
//   $("#Remove").on("click", function() {  
//     $("#sectext").children().last().remove();  
//     $("#ttlquestext").children().last().remove();  
//     $("#marktext").children().last().remove();  
// });  
// });

function shiftlistbypid(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  $.ajax({
    type: "POST",
    url: "ajax_pages/shiftlist.php",
    data: { pid: psid },
    success: function (msg) {
      $('#chshift').empty();
      $('#chshift').append(msg);
      sectionlistbypid(psid);
    }
  });
}

function getquestioncount(psid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getquestioncount.php",
    data: { psid: psid },
    success: function (msg) {
     //console.log(msg);
    // alert("quesCount"+msg);
     //make count zero
      ProgresSections.map((val,ind)=>{
          val.count = 0;
      });
      //fill count in ProgresSections;
     msg.map((val,ind)=>{
        var secind = ProgresSections.findIndex(x => x.id == val.secid);
        ProgresSections[secind].count = val.count;
     });
  
     updateProgressSection();
    //  $("#viewqpack").css("display", "block");
    }
    
  });
}

function shiftlistbypidprogress(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  $('#pid').val(psid);
  $('#papernm').text(myArray[2]);
  $.ajax({
    type: "POST",
    url: "ajax_pages/shiftlist.php",
    data: { pid: psid },
    success: function (msg) {
      $('#chshift').empty();
      $('#chshift').append(msg);
      sectionlistbypid(psid);
      getlanguagebypaper(psid);
     
    }
  });
}
var ProgresSections = [];

function updateProgressSection(){

  $('#progressdiv').empty();
  ProgresSections.map((val,ind)=>{


    $('#progressdiv').append(`<div><span  class="badge badge-info">${val.name}</span> <span>${val.count} / ${val.totalquestion}</span>
    
    <div class="progress mb-3 mt-2">
    <div class="progress-bar bg-success" style="width: ${(val.count/val.totalquestion)*100}%;"> ${val.count}</div>
    </div>
    
    </div>`);
  })
  

}

function sectionlistbypid(pid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/sectionlist.php",
    data: { pid: pid },
    success: function (msg) {
      //console.log(msg)
      ProgresSections = msg;

      $('#chsec').empty();
      $('#chsec').append('<option value="">Choose Section</option>');
      
      msg.map((val,ind)=>{
        $('#chsec').append(`<option value="${val.id}">${val.name}</option>`);
      })

      updateProgressSection();
    }
  });
}

function downloadmappingformat(pid) {
  const sid = document.getElementById('chooseshift').value;
  $.ajax({
    type: "POST",
    url: "ajax_pages/exammappingexcel.php",
    data: { pid: pid, sid: sid },
    success: function (msg) {
      alert(msg);
    }
  });
}

function processresult(pid) {

  swal({
    title: "Are you sure?",
    text: "THe given data is correct Are you sure to process the result!",
    icon: "warning",
    buttons: [
      'No, cancel it!',
      'Yes, I am sure!'
    ],
    dangerMode: true,
  }).then(function(isConfirm) {
    if (isConfirm) {
      const myArray = pid.split(",");
      const psid = myArray[0];
      $('#loadercss').css('display','block');
      $("#downloadbtn").css("display", "none");
      $.ajax({
        type: "POST",
        url: "ajax_pages/processresultV2.php",
        data: { pid: psid },
        success: function (msg) {
          //console.log(msg);
           //resultinexcel(psid);
        
            //downloadresult(psid);
            if(msg.status == false){
              swal("Warning!", msg.msg, "warning");
              document.getElementById('jsondatadiv').innerHTML = msg.data;
            }else{
              //display the result and enable the Download btn
              swal("Successfully!", msg.msg, "success");
              $('#fetchresultbtn').css('display','block');
              $('#loadercss').css('display','none');
            }
          
        }
      });

    } 
  }) 
}

function fetchresult() {
  $('#loadercss').css('display','block');
 const pid = document.getElementById('chooseppr').value;
 document.getElementById('jsondatadiv').innerHTML = "";
      const myArray = pid.split(",");
      const psid = myArray[0];
     // $("#loader").css("display", "block");
      $("#downloadbtn").css("display", "none");
      $.ajax({
        type: "POST",
        url: "ajax_pages/fetchcandidateresultV2.php",
        data: { pid: psid },
        success: function (msg) {
         // console.log(msg);
           //resultinexcel(psid);
        
          //downloadresult(psid);
          
           // swal("Warning!", msg.msg, "warning");
          $('#loadercss').css('display','none');
          $('#btnprocessdiv').css('display','none');
              document.getElementById('jsondatadiv').innerHTML = msg.data;
              $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                  'copy',  'print',
                  {
                    extend: 'csv',
                    title: 'Exam_Result_'+psid+'_'+myArray[1]+'_'+myArray[2]
                  },
                  {
                    extend: 'excel',
                    title: 'Exam_Result_'+psid+'_'+myArray[1]+'_'+myArray[2]
                  }    
                ]
            } );

          
        }
      });
}

function downloadresult(psid) {
  //console.log("down"+psid);
  $.ajax({
    type: "POST",
    url: "ajax_pages/downloadresult.php",
    data: { pid: psid },   
     success: function (msg) {
      //alert("download"+msg);
      resultinexcel(psid)
    }
  });
}

function resultinexcel(psid) {
  //console.log("psid"+psid);
   $.ajax({
     type: "POST",
     url: "ajax_pages/resultlist.php",
     data: { pid: psid },
     success: function (msg) {
       //console.log("result"+msg);
       $('#tablelist').empty();
       $("#tablelist").append(msg);
       $("#loader").css("display", "none");
       $("#downloadbtn").css("display", "block");
       $("#candilist").css("display", "block");
     }
   });
 }

 function resultbycategory(pid) {
  // alert(pid);
  const myArray = pid.split(",");
  const psid = myArray[0];
  var paymode = document.getElementById("downloadmode").value;
  if(paymode == "excelmode"){
    window.open('resultinexcel.php?psid='+psid,'_blank');
  }
  if(paymode == "pdfmode"){
    window.open('resultinpdf.php?psid='+psid,'_blank');
  }  
 }

function getresult(enroll) {
  var eid = document.getElementById('exid').value;
  var pid = document.getElementById('chooseppr').value;
  const myArray = pid.split(",");
  const psid = myArray[0];
  //document.getElementById('exampleModalCenter').style.display="block";
  // window.location = "getresult.php?enroll="+enroll+"&exid="+exid; 
  $.ajax({
    type: "POST",
    url: "ajax_pages/getresult.php",
    data: { enroll: enroll, psid: psid, eid: eid },
    success: function (msg) {
      $('#resultmodal').empty();
      $('#resultmodal').append(msg);
      document.getElementById('exampleModalCenter').style.display = "block";
    }
  });
}

function getexamdata(exdt) {
  var eid = document.getElementById('examdrop').value;
  $.ajax({
    type: "POST",
    url: "ajax_pages/examdashboard.php",
    data: { eid: eid, exdt: exdt },
    success: function (msg) {
      const myArray = msg.split(",");
      document.getElementById("excnt").innerHTML = myArray[0];
      document.getElementById("centercnt").innerHTML = myArray[1];
    }
  });
}

function getpaper(eid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpaper.php",
    data: { eid: eid },
    success: function (msg) {
      $("#chooseppr").empty();
      $("#chooseppr").append(msg);
      
    }
  });
}

function getlanguagebypaper(eid){
  $.ajax({
    type: "POST",
    url: "ajax_pages/getlanguage.php",
    data: { eid: eid },
    success: function (msg) {
      
      $("#chlang").empty();
      $("#chlang").append(msg);
    }
  });
}

function shiftlist(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  document.getElementById("pprid").value = myArray[0];
  
  $.ajax({
    type: "POST",
    url: "ajax_pages/shiftlist.php",
    data: { pid: psid },
    success: function (msg) {
      $('#chshift').empty();
      $('#chshift').append(msg);
      //getpaperset(psid);      
      getlanguagebypaper(psid);
    }
  });
}

function getpaperset() {
  const pid = document.getElementById('chooseppr').value;
  if(!pid){
    alert("Some fields are not choosen");
   }else{
    const myArray = pid.split(",");
    const psid = myArray[0];
   
    $.ajax({
      type: "POST",
      url: "ajax_pages/getpaperset.php",
      data: { psid: psid },
      success: function (msg) {
        $("#setsdiv").empty();
        $("#setsdiv").append(msg);
      }
    });
  }
}

function createset(pid, set) {
  const lid = document.getElementById('chlang').value;
  const sid = document.getElementById('chshift').value;
  var setdrop = document.getElementById('abc' + set).value;
  if (setdrop == "random") {
    $('#loaderdiv').css("display","block");
    $.ajax({
      type: "POST",
      url: "ajax_pages/random_qpack.php",
      data: { pid: pid, set: set, sid: sid },
      success: function (msg) {
        //alert(msg);
        $("#sectionData").empty();
        //$("#sectionData").append(msg);
        $('#loaderdiv').css("display","none");
        swal("Good job!", "You clicked the button!", "success");
      }
    });
  }
  if (setdrop == "preview") {
    $('#loaderdiv').css("display","block");
    
    $.ajax({
      type: "POST",
      url: "ajax_pages/fetch_qpack.php",
      data: { pid: pid, set: set, psid: sid, langid:lid },
      success: function (msg) {
        //console.log(msg);
       // alert(msg);
        displayQuestion(msg);
        // $("#quesppr").empty();
        // $("#quesppr").append(msg);
         $('#loaderdiv').css("display","none");
      }
    });
  }
  //else{
  //  $("#quesppr").empty();
  //  alert("blank");    
  // }
}

function displayQuestion(setv1){
  //alert(secv1);
  // document.getElementById('setname').innerHTML = "SetNo: "+setv1.SetNo;
  var secv1 = setv1.Sections;
 var sectionDataDiv = document.getElementById('sectionData');
 $("#sectionData").empty();
 var setheader = document.createElement('p');
 setheader.style.fontSize = "24px";
 setheader.style.textAlign = "Center";
 setheader.innerHTML = "SetNo: "+setv1.SetNo;
 sectionDataDiv.append(setheader);
 //console.log("section",secv1)
 secv1.map(function (val, ind) {
           var sectionDiv = document.createElement('div');
           var sectionName = document.createElement('h4');
           sectionName.innerText = val.SectionName;
           sectionDiv.appendChild(sectionName);
           //val.SectionName;
           var AllQuestionSec = val.AllSetQuestion;
           AllQuestionSec.map(function (qval, qind) {

               var questionDiv = document.createElement('fieldset');
               var questionNO = document.createElement('legend');
              // questionNO.setAttribute("id","qval.ID" );
               questionNO.innerText = "Q.No. " + (qind+1) + ","+ (qval.ID);
               questionDiv.appendChild(questionNO);
               var qtype = qval.Type;
            //console.log(qval.Question);
              //  if (qtype != 1) {
              //      var qname = document.createElement('span');
              //      qname.innerText = qval.Question;
              //  }
              //  else {
                ////console.log("a"+qval.Question);
                   var qname = document.createElement('img');
                   qname.src =  qval.Question ;
               //}

               questionDiv.appendChild(qname);
               questionDiv.appendChild(
                   document.createElement('hr')
               );

               var AllOptions = qval.optionModels;
               AllOptions.map(function (oval, oind) {
                  //  if (qtype != 1) {
                  //      var optionname = document.createElement('span');
                  //      optionname.innerText = oval.Option;
                  //  }
                  //  else {
                    
                       var optionname = document.createElement('img');
                       optionname.src = oval.Option;
                   //}
                   var optonDiv = document.createElement('fieldset');
                   var optNO = document.createElement('legend');
                   //optNO.setAttribute("id","oval.ID" );
                   //optNO.innerText = oval.ID;
                   optNO.innerText = String.fromCharCode(oind + 65) + " , " +oval.ID;
                   optonDiv.appendChild(optNO);
                   optonDiv.appendChild(optionname);
                   questionDiv.appendChild(optonDiv);
               });

               sectionDiv.appendChild(questionDiv);
               sectionDiv.appendChild(
                   document.createElement('br')
               );
               sectionDiv.appendChild(
                   document.createElement('hr')
               );
           });

           sectionDataDiv.appendChild(sectionDiv);
       });


       $('#loaderdiv').css("display","none");
}

function getpapertime(pid) {
  const myArray = pid.split(",");
  const pprid = myArray[0];
  document.getElementById("pprid").value = myArray[0];
  document.getElementById("pprdate").value = myArray[1];
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpapertime.php",
    data: { pid: pprid },
    success: function (msg) {
      //alert(msg);
      $("#choosetime").empty();
      $("#choosetime").append(msg);
    }
  });
}

function getpapertimess(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  alert()
  document.getElementById("pprdate").value = myArray[1];
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpapertime.php",
    data: { psid: psid },
    success: function (msg) {
      $("#choosetime").empty();
      $("#choosetime").append(msg);
    }
  });
}

function getshifttime(sid) {
  document.getElementById("pshifttime").value = sid;
}

function getdashboardpaper(eid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpaper.php",
    data: { eid: eid },
    success: function (msg) {
      //alert(msg);
      $("#chooseppr").empty();
      $("#chooseppr").append(msg);
      getdashboardcity(eid);
      getcnt(eid);
      getcandicntbyexam(eid);
    }
  });
}

function getcandicntbyexam(eid){
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcandicntbyexam.php",
    data: { eid: eid },
    success: function (msg) {
      document.getElementById("candicnt").innerHTML = msg;
    }
  });
}

function getdashboardcity(eid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcity.php",
    data: { eid: eid },
    success: function (msg) {
     // alert(msg);
      $("#choosecity").empty();
      $("#choosecity").append(msg);
     // getcnt(eid);
    }
  });
}

function getcandidatelist(psid) {
  $('#loaderdiv').css("display","block");
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcandidatelist.php",
    data: {psid:psid},
    success: function (msg) {
      //alert(msg);
      //console.log(msg);
       ////console.log(JSON.parse(msg));
      setCandidateJsonList(msg);
    }
  });
}

function setCandidateJsonList(candidata) {
  //alert(candidata);
  candidata.map((val, ind) => {
    const candirow = `<tr>
    <td>${ind+1}</td>
                <td>${val.cname}</td>
                <td>${val.enrollmentno}</td>
                <td><img alt="photo" id='photo${val.enrollmentno}' src='${val.photo}' style='width:80px;height:80px;'/></td>
                <td ><img alt="signature" id='sig${val.enrollmentno}' src='${val.sig}' style='width:80px;height:80px;'/></td>
            </tr>
            `;
    var trok = document.createElement('tr');
    trok.innerHTML = candirow;
    $("#candilist").append(trok);
  })
  $('#loaderdiv').css("display","none");
  $("#candidiv").show();

}

function getpaperforview(eid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getpaper.php",
    data: { eid: eid },
    success: function (msg) {
      //alert(msg);
      $("#chppr").empty();
      $("#chppr").append(msg);
    }
  });
}

function getcnt(eid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcntbyexamid.php",
    data: { eid: eid },
    success: function (msg) {
      //alert(msg);
      //const myArray = msg.split(",");
      document.getElementById("excnt").innerHTML = "1";
      document.getElementById("pprcnt").innerHTML = msg;
    }
  });
}

function getcenterdts(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  document.getElementById("pprid").value = myArray[0];
  $.ajax({
    type: "POST",
    url: "ajax_pages/getshiftdt.php",
    data: { psid: psid },
    success: function (msg) {
      // alert(msg);
      $("#choosepprtime").empty();
      $("#choosepprtime").append(msg);
      getdashboardshift(psid);
    }
  });
}

function getpapershift(pid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcenterdt.php",
    data: { pid: pid },
    success: function (msg) {
      $("#choosecenter").empty();
      $("#choosecenter").append(msg);
      getdashboardcenter(pid);
    }
  });
}

function getcity(city) {
  //var sid = document.getElementById('choosepprtime').value;
  var pid  = document.getElementById("pprid").value;
  //alert(city)
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcentercity.php",
    data: { city: city, sid: pid },
    success: function (msg) {
     // alert(msg);
      $("#choosecenter").empty();
      $("#choosecenter").append(msg);
      getcandicountbycity(city,pid);
    }
  });
}

function getcandicountbycity(city,pid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getcandicntbycity.php",
    data: { city: city ,pid:pid},
    success: function (msg) {
      //alert(msg);
      //const myArray = msg.split(",");
      document.getElementById("candicnt").innerHTML = msg;
    }
  });
}

function getdashboardshift(shift) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/examdashboardbytime.php",
    data: { shift: shift },
    success: function (msg) {
      document.getElementById("pprcnt").innerHTML = 1;
      document.getElementById("shiftcnt").innerHTML = msg;
    }
  });
}

function getdashboardcenter(pid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/examdashboardbyshift.php",
    data: { pid: pid },
    success: function (msg) {
      document.getElementById("shiftcnt").innerHTML = 1;
      document.getElementById("centercnt").innerHTML = msg;
    }
  });
}

function getcandidate(cid) {
  const sid = document.getElementById('choosepprtime').value
  $.ajax({
    type: "POST",
    url: "ajax_pages/examdashboardcandi.php",
    data: { cid: cid, sid: sid },
    success: function (msg) {
      document.getElementById("centercnt").innerHTML = 1;
      document.getElementById("candicnt").innerHTML = msg;
    }
  });
}

function assignset() {
  const psid = document.getElementById('chshift').value;
  const center = document.getElementById('choosecenter').value;
  if(!psid){
    alert("Some Field are not choosen");
    return;
  }
  $('#loaderdiv').css("display","block");
  $.ajax({
    type: "POST",
    url: "ajax_pages/setassign.php",
    data: { psid: psid,center:center },
    success: function (msg) {
      candisetlist(psid,center);
    }
  });
}

function candisetlist(psid,center) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/candisetassignedlist.php",
    data: { psid: psid,center:center },
    success: function (msg) {
      // $("#candilist").empty();
      // $("#candilist").append(msg);
      $('#loaderdiv').css("display","none");
      document.getElementById('candidiv').innerHTML = msg.data;
      // $('#candidiv').show();
      $('#canditable').DataTable();
    }
  });
}

function choosepprf(pid) {
  //alert(pid);
  if(pid!="choose"){
  const myArray = pid.split(",");
  const psid = myArray[0];
  document.getElementById('pid').value = psid;
  $.ajax({
    type: "POST",
    url: "ajax_pages/languagelists.php",
    data: { psid: psid },
    success: function (msg) {
      $("#languagelist").empty();
      $("#languagelist").append(msg);
      
    }
  });
}else{
  $("#languagelist").empty();
}
}

function setpid(pid) {
  const myArray = pid.split(",");
  const psid = myArray[0];
  document.getElementById('pid').value = psid;
}

function savenote(userid) {
  var note = $('#notetextarea').val();
  $.ajax({
    type: "POST",
    url: "ajax_pages/savenotes.php",
    data: { note: note, userid: userid },
    success: function (msg) {
      $("#notestatus").empty();
      $("#notestatus").append(msg);
    }
  });
}

function getnote(userid) {
  $.ajax({
    type: "POST",
    url: "ajax_pages/getnotes.php",
    data: { userid: userid },
    success: function (msg) {
      $("#notetextarea").empty();
      $("#notetextarea").append(msg);
    }
  });
}