


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>DOB Certificate</title>
    <style>
p {
  text-indent: 50px;
}
span {
display: inline-block;
width: 25%;
border-bottom: dotted;
}
.span {
display: inline-block;
width: 70%;
border-bottom: dotted;
}
@media print {
  thead, tfoot {  
    display: none !important
  }
}
@media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
@print { 
   @page :footer { 
      display: none
   } 
   @page :header { 
      display: none
   } 
} 
</style>
  </head>
  <body>







    <div class="container-fluid ">
        <div class="row  p-3" style="border-left:5px solid red;border-right:5px solid red;border-top:1px solid ;border-bottom:1px solid">
            <div class="col-1">
                <img src="<?=base_url()?>/uploads/school_content/admin_logo/<?=$sch_setting->app_logo?>"  height="80"  alt="">
            </div>
            <div class="col-11 text-center">
                <h2><?=$sch_setting->name?></h2>
                <p>ARAINPERA ROAD, CHAURA DISTT. KARNAL</p>
            </div>
            <div class="col-12 mb-5 mt-3 text-center">
                <h4>DOB CERTIFICATE</h4>
            </div>



            <div class="col-12 text-left">

                <p>This is to Cortify that <span><?=$student['firstname']?></span>Father's Name<span><?=$student['father_name']?></span>
				Mother's Name<span><?=$student['mother_name']?></span> Date Of Birth <b><span><?=$student['dob']?></span></b>  is/was bonafied student of this school in class  <span><?=$student['class']?></span>during the year ,<span>2022-23</span> He/She passed the <span>..</span>Examination of H.B.S.E. held in March<span>..</span>He/She secured'<span>..</span>Marks  and was placed in <span>..</span>Division. His/Her charecter and conduct are<span>..</span>His /Her Date of Birth acording to the school record is<span class="span">..</span></p>      


            </div>

            <div class="col-sm-12 mb-5 mt-5">
              <div class="row">
                <div class="col-6">
                  Teacher-in-charge
                </div>

                <div class="col-6 " style="text-align: right;">
                  Principal/HeadMaster
                </div>
              </div>
            </div>

        </div>
    </div>














   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>





<script>

window.onload = function () {
   window.print();
        window.onafterprint = back;
}
 function back() {
    // window.history.back();
	window.close();
 }
</script>