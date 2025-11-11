<!DOCTYPE html>


<?php 

if($_GET['copy']=='2'){

?>
 
  
  
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fee Receipt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .receipt-card {
      max-width: 1400px;
      margin: 30px auto;
    }
    .card-header {
      background-color: white;
      color: black;
      text-align: center;
      font-size: 18px;
      font-weight: 600;
      padding: 10px 0;
    }
    .student-name {
      font-weight: bold;
      font-size: 18px;
      text-align: center;
      margin: 15px 0;
    }
    .table th, .table td {
      font-size: 14px;
      padding: 6px;
    }
    .card-footer {
      background-color: #fff;
      border-top: none;
    }
    .print-options label {
      margin-right: 15px;
    }
    tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border: navajowhite;
    }
  


@media print {
  @page {
    size: A4 landscape;
    margin: 0;
    margin-left:10px;
    margin-top:10px;
  }

  .f12_new{
    font-size:9px !important;
  }


  body * {
    visibility: hidden;
    font-size: 11pt !important; /* Standard readable size */
  }

  #print-area, #print-area * {
    visibility: visible;
    font-size: 11pt !important;
    /* //padding: 5pt !important; */
    margin: 0 !important;
    line-height: 1.3 !important;
  }


  #print-area {
    position: absolute;
    top: 0;
    left: 0;
    width: 280mm;
    height: 100vh;
    padding: 0 !important;
    box-sizing: border-box;
    overflow: hidden;
    border: none !important;
    margin: 0 !important;
  }
  .card-footer,
  .print-options {
    display: none !important;
  }

  .receipt-card {
    margin: 0 !important;
    padding: 0 !important;
    box-shadow: none !important;
    border: none !important;
  }

  .table th, .table td {
    font-size: 12pt !important;
    padding: 2pt !important;
  }

  h5,span{
    font-size: 12pt !important;
    padding: 0pt !important;
  }
  
  .accountant-sign {
    /* position: absolute; */
    padding-top:4rem;
    text-align: center;
  }

  .abd{
    padding:0px !important;
  }
  .abd>.f12_new{
    font-size:9px !important;
  }

}


table {
  border-collapse: collapse; /* Important for removing spacing */
}

th, td {
  
 
  padding: 3px !important; /* Optional: remove all padding */
  margin: 0px !important; 

  padding-left: 15px !important;
  padding-right: 15px !important;
}


.accountant-sign {
    /* position: absolute; */
   padding-top:4rem;
    text-align: center;
  }
.abd{
  padding:4px;
}

  </style>
</head>
<body>
  <div class="card receipt-card">
   
  

    <div class="card-body">
      <!-- <div class="student-name">Nitya Sharma D/o Durgesh Sharma</div> -->

     <?php //var_dump($student); ?>

    <div id="print-area" >
        
        <div class="row">
          <div class="col-sm-6">



          <div  style="border:2px solid;" >


<div class="text-center p-3 pt-0 pb-0">
    <h5><b><?=$result->name?></b></h5>
    <span><?=$result->address?></span> <br>
    <span><b>Phone No.</b>: <?=$result->phone?></span>, <span><b>Email Id.</b>: <?=$result->email?></span> <br>
    <span><strong>Session: <?=$this->session_model->get($this->setting_model->getCurrentSession())['session']?></strong></span> <br>
</div>


<table class="table mt-3">
    <thead>
        <tr style="border-top:2px solid;border-bottom:2px solid">
            <th><strong>Rec. No.:</strong> <?=$fees[0]->receipt_no?></th>
            <th class="text-end"><strong>Date:</strong> <?=date('d-m-Y',strtotime($fees[0]->date_time))?></th>
        </tr>
    </thead>
</table> 

<div class="d-flex justify-content-between mt-1">
  <div class="p-3 pt-0 pb-0">
      <span><strong style="width:90px; display:inline-block;">Adm. No.</strong> <?=$student['admission_no']?></span> <br>
      <span><strong style="width:90px; display:inline-block;">Student</strong> <?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></span> <br>
      <span><strong style="width:90px; display:inline-block;">Father</strong> <?=$student['father_name']?></span> <br>
      <span><strong style="width:90px; display:inline-block;">Class & Sec</strong> <?=$student['class']?> (<?=$student['section']?>)</span> <br>
       <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
      <span><strong style="width:90px; display:inline-block;">Fee Months</strong> <?=sort_by_custom_month_order($month_names)?></span> <br>
      <?php } ?>
      <!-- <span><strong style="width:90px; display:inline-block;">Note</strong> This is a System Generated Slip Not Required Stamp.</span>  -->
  </div>
</div>

<div style="padding:1px">

        
<table class="table mt-3" >
    <thead>
    <?php if($fees[0]->fee_head_name == 'Ledger Amount'){ ?>
    <tr> 
        <th></th>
        <th class="text-end">Old Balance</th>
        <th class="text-end"><?=$fees[0]->ledger_amt?></th>
    </tr>
    <?php } ?>
    <tr style="border-top:2px solid;border-bottom:2px solid">
        <th>Sr.</th>
        <th>Particulars</th>
        <!-- <th class="text-center">Total</th>
        <th class="text-center">Discount</th> -->
        <th class="text-end">Total Amt.</th>
    </tr>
    </thead>
    <tbody>


    <?php $i=1; $pay=0; foreach($fees as $list){ ?>
    <tr>
        <td><?=$i++?></td>
        <td><?=$list->fee_head_name?></td>
        <!-- <td class="text-center"><?=$list->total?></td>
        <td class="text-center"><?=$list->rec_discount?></td> -->
        <td class="text-end"><?=$list->total?></td>
    </tr>
    <?php $pay+=$list->total; } ?>

       <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
                        <tr> 
                            <td><?=$i?></td>
                            <td >Old Balance</td>
                            <td class="text-end"><?=$fees[0]->ledger_amt?></td>
                        </tr>
                        <?php } ?>
    <tr style="border-top:2px solid">
        <td colspan="2" class="text-end"><strong>Total Amount</strong></td>
        <?php if($fees[0]->fee_head_name!='Ledger Amount'){ ?>
        <td class="text-end"><h6><b><?=$pay+$fees[0]->ledger_amt?></b></h6></td>
        <?php }else{ ?>
        <td class="text-end"><h6><b><?=$pay?></b></h6></td>
        <?php } ?>
    </tr>

    <tr>
        <td colspan="2" class="text-end">+ Late Fee (If Any)</td>
        <td class="text-end"><?=$fees[0]->late_fees??0?></td>
    </tr>

    <tr>
        <td colspan="2" class="text-end">- Discount Amount (If Any)</td>
        <td class="text-end"><?=$fees[0]->discount_amt?></td>
    </tr>
    <tr style="border-top:2px solid">
        <td colspan="2" class="text-end"><strong>Net Fees</strong></td>
        <td class="text-end"><strong><h6><b>
        <?php
        $ledger = $fees[0]->ledger_amt ?? 0;
        $late   = $fees[0]->late_fees ?? 0;
        $disc   = $fees[0]->discount_amt ?? 0;
        if($fees[0]->fee_head_name!='Ledger Amount'){ 
          echo $total  = (int)$pay + (int)$ledger + (int)$late - (int)$disc;
        }else{
          echo $total  = (int)$pay + (int)$late - (int)$disc;
        }
        
        ?>
        </b></h6></strong></td>
    </tr>
    <tr>
        <td colspan="2" class="text-end">Received Amount</td>
        <td class="text-end"><?=$fees[0]->receipt_amt?></td>
    </tr>
    <tr>
        <td colspan="2" class="text-end">Balance Amount</td>
        <td class="text-end"><?=$fees[0]->balance_amt?></td>
    </tr>
    </tbody>
</table>

</div>



<div class="row">
  <div class="col-9">
    <div class="abd">

     
      <h6><b>Received</b> : <?=number_to_words($fees[0]->receipt_amt);?> Only</h6>
      <h5><strong>Payment Mode :  <?=$fees[0]->mode?> </strong></h5>
      <span><strong>Remark:</strong> <?=$fees[0]->remarks?></span> <br>
      <label class="f12_new" for=""><b>Note</b> : <span style="font-size:13px !important">This is a System Generated Slip Not Required Stamp</span> </label>
      </div>
  </div>

  
  <div class="col-3 accountant-sign">
    <h6>Accountant Sign</h6>
</div>

</div>

</div>



          </div>
          <div class="col-sm-6">

          <div  style="border:2px solid;" >


<div class="text-center p-3 pt-0 pb-0">
    <h5><b><?=$result->name?></b></h5>
    <span><?=$result->address?></span> <br>
    <span><b>Phone No.</b>: <?=$result->phone?></span>, <span><b>Email Id.</b>: <?=$result->email?></span> <br>
    <span><strong>Session: <?=$this->session_model->get($this->setting_model->getCurrentSession())['session']?></strong></span> <br>
</div>


<table class="table mt-3">
    <thead>
        <tr style="border-top:2px solid;border-bottom:2px solid">
            <th><strong>Rec. No.:</strong> <?=$fees[0]->receipt_no?></th>
            <th class="text-end"><strong>Date:</strong> <?=date('d-m-Y',strtotime($fees[0]->date_time))?></th>
        </tr>
    </thead>
</table> 

<div class="d-flex justify-content-between mt-1">
  <div class="p-3 pt-0 pb-0">
      <span><strong style="width:90px; display:inline-block;">Adm. No.</strong> <?=$student['admission_no']?></span> <br>
      <span><strong style="width:90px; display:inline-block;">Student</strong> <?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></span> <br>
      <span><strong style="width:90px; display:inline-block;">Father</strong> <?=$student['father_name']?></span> <br>
      <span><strong style="width:90px; display:inline-block;">Class & Sec</strong> <?=$student['class']?> (<?=$student['section']?>)</span> <br>
       <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
      <span><strong style="width:90px; display:inline-block;">Fee Months</strong> <?=$month_names?></span> <br>
      <?php } ?>
      <!-- <span><strong style="width:90px; display:inline-block;">Note</strong> This is a System Generated Slip Not Required Stamp.</span>  -->
  </div>
</div>



<div style="padding:1px">

        
<table class="table mt-3" >
  <thead>
  <?php if($fees[0]->fee_head_name == 'Ledger Amount'){ ?>
  <tr> 
      <th></th>
      <th class="text-end">Old Balance</th>
      <th class="text-end"><?=$fees[0]->ledger_amt?></th>
  </tr>
  <?php } ?>
  <tr style="border-top:2px solid;border-bottom:2px solid">
      <th>Sr.</th>
      <th>Particulars</th>
      <!-- <th class="text-center">Total</th>
      <th class="text-center">Discount</th> -->
      <th class="text-end">Total Amt.</th>
  </tr>
  </thead>
  <tbody>


  <?php $i=1; $pay=0; foreach($fees as $list){ ?>
  <tr>
      <td><?=$i++?></td>
      <td><?=$list->fee_head_name?></td>
      <!-- <td class="text-center"><?=$list->total?></td>
      <td class="text-center"><?=$list->rec_discount?></td> -->
      <td class="text-end"><?=$list->total?></td>
  </tr>
  <?php $pay+=$list->total; } ?>
  
  
     <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
                        <tr> 
                            <td><?=$i?></td>
                            <td >Old Balance</td>
                            <td class="text-end"><?=$fees[0]->ledger_amt?></td>
                        </tr>
                        <?php } ?>

  <tr style="border-top:2px solid">
      <td colspan="2" class="text-end"><strong>Total Amount</strong></td>
      <?php if($fees[0]->fee_head_name!='Ledger Amount'){ ?>
      <td class="text-end"><h6><b><?=$pay+$fees[0]->ledger_amt?></b></h6></td>
      <?php }else{ ?>
      <td class="text-end"><h6><b><?=$pay?></b></h6></td>
      <?php } ?>
  </tr>

  <tr>
      <td colspan="2" class="text-end">+ Late Fee (If Any)</td>
      <td class="text-end"><?=$fees[0]->late_fees??0?></td>
  </tr>

  <tr>
      <td colspan="2" class="text-end">- Discount Amount (If Any)</td>
      <td class="text-end"><?=$fees[0]->discount_amt?></td>
  </tr>
  <tr style="border-top:2px solid">
      <td colspan="2" class="text-end"><strong>Net Fees</strong></td>
      <td class="text-end"><strong><h6><b>
      <?php
      $ledger = $fees[0]->ledger_amt ?? 0;
      $late   = $fees[0]->late_fees ?? 0;
      $disc   = $fees[0]->discount_amt ?? 0;
      if($fees[0]->fee_head_name!='Ledger Amount'){ 
        echo $total  = (int)$pay + (int)$ledger + (int)$late - (int)$disc;
      }else{
        echo $total  = (int)$pay + (int)$late - (int)$disc;
      }
      
      ?>
      </b></h6></strong></td>
  </tr>
  <tr>
      <td colspan="2" class="text-end">Received Amount</td>
      <td class="text-end"><?=$fees[0]->receipt_amt?></td>
  </tr>
  <tr>
      <td colspan="2" class="text-end">Balance Amount</td>
      <td class="text-end"><?=$fees[0]->balance_amt?></td>
  </tr>
  </tbody>
</table>

</div>



<div class="row">
  <div class="col-9">
    <div class="abd">

     
      <h6><b>Received</b> : <?=number_to_words($fees[0]->receipt_amt);?> Only</h6>
      <h5><strong>Payment Mode :  <?=$fees[0]->mode?> </strong></h5>
      <span><strong>Remark:</strong> <?=$fees[0]->remarks?></span> <br>
      <label class="f12_new" for=""><b>Note</b> : <span style="font-size:13px !important">This is a System Generated Slip Not Required Stamp</span> </label>
      </div>
  </div>

  
  <div class="col-3 accountant-sign">
    <h6>Accountant Sign</h6>
</div>

</div>

</div>


          </div>
        </div>
    </div>









      <div class="print-options mt-4">
        <p><strong>Print Copy:</strong></p>
        
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="one" value="1"
            onclick="setCopyValue(1)" <?= ($_GET['copy'] ?? '') == '1' ? 'checked' : 'checked' ?>>
          <label class="form-check-label" for="one">One Copy</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="two" value="2"
            onclick="setCopyValue(2)" <?= ($_GET['copy'] ?? '') == '2' ? 'checked' : '' ?>>
          <label class="form-check-label" for="two">Two Copy</label>
        </div>
        <!-- <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="three" value="3"
            onclick="setCopyValue(3)" <?= ($_GET['copy'] ?? '') == '3' ? 'checked' : '' ?>>
          <label class="form-check-label" for="three">Three Copy</label>
        </div> -->
      </div>
    </div>









    <div class="card-footer d-flex justify-content-end gap-2">
      <!-- <button class="btn btn-secondary">Cancel</button> -->
      <a href="<?=base_url()?>studentfee/addfee/<?=$backid?>"><button class="btn btn-success">Back</button></a>
      <button class="btn btn-primary"  onclick="window.print()" >Rs Collect & Print</button>
    </div>
  </div>
</body>
</html>

<script>
  function setCopyValue(val) {
    const url = new URL(window.location.href);
    url.searchParams.set('copy', val);
    window.location.href = url.toString();
  }
</script>


<?php

}else{
  ?>
  
  
  
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fee Receipt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .receipt-card {
      max-width: 700px;
      margin: 30px auto;
    }
    .card-header {
      background-color: white;
      color: black;
      text-align: center;
      font-size: 18px;
      font-weight: 600;
      padding: 10px 0;
    }
    .student-name {
      font-weight: bold;
      font-size: 18px;
      text-align: center;
      margin: 15px 0;
    }
    .table th, .table td {
      font-size: 14px;
      padding: 6px;
    }
    .card-footer {
      background-color: #fff;
      border-top: none;
    }
    .print-options label {
      margin-right: 15px;
    }
    tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border: navajowhite;
    }
  


@media print {
  @page {
    size: A4 landscape;
    margin: 0;
    margin-left:10px;
    margin-top:10px;
  }

  .f12_new{
    font-size:9px !important;
  }


  body * {
    visibility: hidden;
    font-size: 11pt !important; /* Standard readable size */
  }

  #print-area, #print-area * {
    visibility: visible;
    font-size: 11pt !important;
    /* //padding: 5pt !important; */
    margin: 0 !important;
    line-height: 1.3 !important;
  }


  #print-area {
    position: absolute;
    top: 0;
    left: 0;
    width: 140mm;
    height: 100vh;
    padding: 0 !important;
    box-sizing: border-box;
    overflow: hidden;
    border: none !important;
    margin: 0 !important;
  }
  .card-footer,
  .print-options {
    display: none !important;
  }

  .receipt-card {
    margin: 0 !important;
    padding: 0 !important;
    box-shadow: none !important;
    border: none !important;
  }

  .table th, .table td {
    font-size: 12pt !important;
    padding: 2pt !important;
  }

  h5,span{
    font-size: 12pt !important;
    padding: 0pt !important;
  }
  
  .accountant-sign {
    /* position: absolute; */
    padding-top:4rem;
    text-align: center;
  }

  .abd{
    padding:0px !important;
  }
  .abd>.f12_new{
    font-size:9px !important;
  }

}


table {
  border-collapse: collapse; /* Important for removing spacing */
}

th, td {
  
 
  padding: 3px !important; /* Optional: remove all padding */
  margin: 0px !important; 

  padding-left: 15px !important;
  padding-right: 15px !important;
}


.accountant-sign {
    /* position: absolute; */
   padding-top:4rem;
    text-align: center;
  }
.abd{
  padding:4px;
}

  </style>
</head>
<body>
  <div class="card receipt-card">
   
  

    <div class="card-body">
      <!-- <div class="student-name">Nitya Sharma D/o Durgesh Sharma</div> -->

     <?php //var_dump($fees); ?>

    <div id="print-area" >
        
            <div  style="border:2px solid;" >


                    <div class="text-center p-3 pt-0 pb-0">
                        <h5><b><?=$result->name?></b></h5>
                        <span><?=$result->address?></span> <br>
                        <span><b>Phone No.</b>: <?=$result->phone?></span>, <span><b>Email Id.</b>: <?=$result->email?></span> <br>
                        <span><strong>Session: <?=$this->session_model->get($this->setting_model->getCurrentSession())['session']?></strong></span> <br>
                    </div>


                    <table class="table mt-3">
                        <thead>
                            <tr style="border-top:2px solid;border-bottom:2px solid">
                                <th><strong>Rec. No.:</strong> <?=$fees[0]->receipt_no?></th>
                                <th class="text-end"><strong>Date:</strong> <?=date('d-m-Y',strtotime($fees[0]->date_time))?></th>
                            </tr>
                        </thead>
                    </table> 

                    <div class="d-flex justify-content-between mt-1">
                      <div class="p-3 pt-0 pb-0">
                          <span><strong style="width:90px; display:inline-block;">Adm. No.</strong> <?=$student['admission_no']?></span> <br>
                          <span><strong style="width:90px; display:inline-block;">Student</strong> <?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></span> <br>
                          <span><strong style="width:90px; display:inline-block;">Father</strong> <?=$student['father_name']?></span> <br>
                          <span><strong style="width:90px; display:inline-block;">Class & Sec</strong> <?=$student['class']?> (<?=$student['section']?>)</span> <br>
                           <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
                          <span><strong style="width:90px; display:inline-block;">Fee Months</strong> <?=sort_by_custom_month_order($month_names)?></span> <br>
                          <?php } ?>
                          <!-- <span><strong style="width:90px; display:inline-block;">Note</strong> This is a System Generated Slip Not Required Stamp.</span>  -->
                      </div>
                    </div>

                    <div style="padding:1px">

                            
                    <table class="table mt-3" >
                        <thead>
                        <?php if($fees[0]->fee_head_name == 'Ledger Amount'){ ?>
                        <tr> 
                            <th></th>
                            <th class="text-end">Old Balance</th>
                            <th class="text-end"><?=$fees[0]->ledger_amt?></th>
                        </tr>
                        <?php } ?>
                        <tr style="border-top:2px solid;border-bottom:2px solid">
                            <th>Sr.</th>
                            <th>Particulars</th>
                            <!-- <th class="text-center">Total</th>
                            <th class="text-center">Discount</th> -->
                            <th class="text-end">Total Amt.</th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php $i=1; $pay=0; foreach($fees as $list){ ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$list->fee_head_name?></td>
                            <!-- <td class="text-center"><?=$list->total?></td>
                            <td class="text-center"><?=$list->rec_discount?></td> -->
                            <td class="text-end"><?=$list->total?></td>
                        </tr>
                        <?php $pay+=$list->total; } ?>
                         <?php if($fees[0]->fee_head_name != 'Ledger Amount'){ ?>
                        <tr> 
                            <td><?=$i?></td>
                            <td >Old Balance</td>
                            <td class="text-end"><?=$fees[0]->ledger_amt?></td>
                        </tr>
                        <?php } ?>

                        <tr style="border-top:2px solid">
                            <td colspan="2" class="text-end"><strong>Total Amount</strong></td>
                            <?php if($fees[0]->fee_head_name!='Ledger Amount'){ ?>
                            <td class="text-end"><h6><b><?=$pay+$fees[0]->ledger_amt?></b></h6></td>
                            <?php }else{ ?>
                            <td class="text-end"><h6><b><?=$pay?></b></h6></td>
                            <?php } ?>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-end">+ Late Fee (If Any)</td>
                            <td class="text-end"><?=$fees[0]->late_fees??0?></td>
                        </tr>

                        <tr>
                            <td colspan="2" class="text-end">- Discount Amount (If Any)</td>
                            <td class="text-end"><?=$fees[0]->discount_amt?></td>
                        </tr>
                        <tr style="border-top:2px solid">
                            <td colspan="2" class="text-end"><strong>Net Fees</strong></td>
                            <td class="text-end"><strong><h6><b>
                            <?php
                            $ledger = $fees[0]->ledger_amt ?? 0;
                            $late   = $fees[0]->late_fees ?? 0;
                            $disc   = $fees[0]->discount_amt ?? 0;
                            if($fees[0]->fee_head_name!='Ledger Amount'){ 
                              echo $total  = (int)$pay + (int)$ledger + (int)$late - (int)$disc;
                            }else{
                              echo $total  = (int)$pay + (int)$late - (int)$disc;
                            }
                            
                            ?>
                            </b></h6></strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">Received Amount</td>
                            <td class="text-end"><?=$fees[0]->receipt_amt?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">Balance Amount</td>
                            <td class="text-end"><?=$fees[0]->balance_amt?></td>
                        </tr>
                        </tbody>
                    </table>

                    </div>



                    <div class="row">
                      <div class="col-9">
                        <div class="abd">

                         
                          <h6><b>Received</b> : <?=number_to_words($fees[0]->receipt_amt);?> Only</h6>
                          <h5><strong>Payment Mode :  <?=$fees[0]->mode?> </strong></h5>
                          <span><strong>Remark:</strong> <?=$fees[0]->remarks?></span> <br>
                          <label class="f12_new" for=""><b>Note</b> : <span style="font-size:13px !important">This is a System Generated Slip Not Required Stamp</span> </label>
                          </div>
                      </div>

                      
                      <div class="col-3 accountant-sign">
                        <h6>Accountant Sign</h6>
                    </div>

                    </div>
                
        </div>

    </div>









      <div class="print-options mt-4">
        <p><strong>Print Copy:</strong></p>
        
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="one" value="1"
            onclick="setCopyValue(1)" <?= ($_GET['copy'] ?? '') == '1' ? 'checked' : 'checked' ?>>
          <label class="form-check-label" for="one">One Copy</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="two" value="2"
            onclick="setCopyValue(2)" <?= ($_GET['copy'] ?? '') == '2' ? 'checked' : '' ?>>
          <label class="form-check-label" for="two">Two Copy</label>
        </div>
        <!-- <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="copy" id="three" value="3"
            onclick="setCopyValue(3)" <?= ($_GET['copy'] ?? '') == '3' ? 'checked' : '' ?>>
          <label class="form-check-label" for="three">Three Copy</label>
        </div> -->
      </div>
    </div>









    <div class="card-footer d-flex justify-content-end gap-2">
      <!-- <button class="btn btn-secondary">Cancel</button> -->
      <a href="<?=base_url()?>studentfee/addfee/<?=$backid?>"><button class="btn btn-success">Back</button></a>
      <button class="btn btn-primary"  onclick="window.print()" >Rs Collect & Print</button>
    </div>
  </div>
</body>
</html>

<script>
  function setCopyValue(val) {
    const url = new URL(window.location.href);
    url.searchParams.set('copy', val);
    window.location.href = url.toString();
  }
</script>

  
  
  
  
  <?php
} 

?>
