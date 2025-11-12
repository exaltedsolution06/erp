<style type="text/css">
    .checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-left: 8px;}
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <section class="content-header">
                <h1>
                    <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?><small><?php echo $this->lang->line('student_fee'); ?></small></h1>
            </section>
            
        </div> 
        <div>
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">
                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
                                ?>
                                <li <?php
                                if ($student["section_id"] == $svalue["section_id"]) {
                                    echo "class='active'";
                                }
                                ?> ><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]); ?></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php foreach ($class_section as $skey => $snvalue) {
                            ?>
                            <div class="tab-pane <?php
                            if ($student["section_id"] == $snvalue["section_id"]) {
                                echo "active";
                            }
                            ?>" id="section<?php echo $snvalue["section_id"]; ?>">
                                 <?php
                                 foreach ($studentlistbysection as $stkey => $stvalue) {
                                     if ($stvalue['section_id'] == $snvalue["section_id"]) {
                                         ?>
                                        <div class="studentname">
                                            <a class="" href="<?php echo base_url() . "studentfee/addfee/" . $stvalue["id"] ?>">
                                                <div class="icon"><img src="<?php echo base_url() . $stvalue["image"]; ?>" alt="User Image"></div>
                                                <div class="student-tittle"><?php echo $stvalue["firstname"] . " " . $stvalue["lastname"]; ?></div></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="tab-pane" id="sectionB">
                            <h3 class="control-sidebar-heading">Recent Activity 2</h3>
                        </div>

                        <div class="tab-pane" id="sectionC">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <div class="tab-pane" id="sectionD">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </aside>
        </div></div>
    <!-- /.control-sidebar -->
    <section class="content">
           <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="box-title"><?php echo $this->lang->line('student_fees'); ?></h3>
                                </div>
                                <div class="col-md-8">
                                    <div class="btn-group pull-right">
                                        <a href="<?php echo base_url() ?>search_fee_slip" type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-arrow-left"></i> <?php echo $this->lang->line('back'); ?></a>
                                    </div>
                                </div>

                            </div>
                        </div><!--./box-header-->
                        <div class="box-body" style="padding-top:0;">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="sfborder">
                                        <div class="col-md-2 text-center">
                                            <img width="115" height="115" class="round5" src="<?php
                                            if (!empty($student['image'])) {
                                                echo base_url() . $student['image'];
                                            } else {
                                                echo base_url() . "uploads/student_images/no_image.png";
                                            }
                                            ?>" alt="No Image">

                                            <h4>LEDGER AMT</h4>
                                            <h5>Rs. <?=number_format($student['fees_discount'],2)?></h5>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="row">
                                                <table class="table table-striped mb0 font13">
                                                    <tbody>

                                                        <tr>
                                                            <td onclick="changeDate(this)"> <b>Date : </b> <input type="date" id="dateInput"></td>
                                                            <td>Receipt No. <b><?=$receipt_no?></b> </td>
                                                            <td>Admission No.  <b><?=$student['admission_no']?></b> </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Father Name</th>
                                                            <th>Mother Name</th>
                                                        </tr>
                                                        <tr>
                                                            <td><?=$student['firstname']?> <?=$student['middlename']?> <?=$student['lastname']?></td>
                                                            <td><?=$student['father_name']?></td>
                                                            <td><?=$student['mother_name']?></td>
                                                        </tr>

                                                        <!-- 2 -->

                                                    
                                                    

                                                        <!-- 3 -->
                                                        <tr>
                                                            <th>Class - <?=$student['class']?> </th>
                                                            <th>Section. - <?=$student['section']?></th>
                                                            <th>Contact No. - <?=$student['mobileno']?></th>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th>Route - <?php
                                                                        $this->db->where('id', $student['vehroute_id']);
                                                                        $query = $this->db->get('route_head')->row_array();
                                                                        echo (($query['fees_heading']));
                                                                    ?></th>
                                                            <th>Category - <?php
                                                                foreach ($categorylist as $value) {
                                                                    if ($student['category_id'] == $value['id']) {
                                                                        echo $value['name'];
                                                                    }
                                                                }
                                                                ?></th>
                                                            <th>City - <?=$student_data['city']?></th>
                                                        </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sfborder p-5">
                                    

                                        <form action="" method="post">
                                            <div class="col-md-12 p-5" style="padding:1rem !important">
                                                <div class="row ">
                                                    <div class="col-sm-12" style="text-align: -webkit-right;;">
                                                        <a href="<?=base_url('student/view/'.$student['id'])?>">Edit</a>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <input class="form-check-input month-check" type="checkbox" id="select_all"  disabled>
                                                        <label for="select_all">Select All</label>
                                                    </div>
                                                    <hr>
                                                    <?php
														$months = ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"];

														// Find earliest (first) paid month index; -1 if none paid
														$firstPaidIndex = -1;
														foreach ($months as $index => $month) {
															if (in_array($month, $pay_mounth)) {
																$firstPaidIndex = $index;
																break; // stop at first occurrence (earliest in the array order)
															}
														}

														foreach ($months as $index => $month):
															$isPaid = in_array($month, $pay_mounth);                // already paid
															$isSelected = $isPaid || in_array($month, $months_data);// selected if paid or previously selected
															// disable only months that are strictly before the earliest paid month
															$isDisabled = ($firstPaidIndex >= 0 && $index < $firstPaidIndex);
														?>
															<div class="col-sm-3 col-md-3 p-0 m-0 month-checkbox">
																<input
																	class="form-check-input month-check input-mounth"
																	type="checkbox"
																	name="months[]"
																	value="<?= $month ?>"
																	id="<?= strtolower($month) ?>"
																	<?= $isSelected ? 'checked' : '' ?>
																	disabled
																>
																<label for="<?= strtolower($month) ?>" style="<?= $isDisabled ? 'color:#aaa;' : '' ?>">
																	<?= $month ?>
																</label>
															</div>
														<?php endforeach; ?>
                                                </div>
                                                </div>
                                            </div>
                                        </form>


                                </div>
                                <div class="col-md-12">
                                    <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                                </div>
                            </div>
                        </div>  

                        <form action="" id="ledger_form" method="post">
                         <div class="card-body" style="padding: 10px;">
                            <div class="table-responsive">
                                <div class="download_label "><?php echo $this->lang->line('student_fees') . ": " . $student['firstname'] . " " . $student['lastname'] ?> </div>
                                <table class="table table-bordered">
                                    <thead class="header">
                                        
                                        <tr>
											<th></th>
                                            <th>Fees Head</th>
                                            <?php foreach($months_data as $key=>$value){
                                            ?>
                                            <th><?=$value?> <input type="hidden" name="months[]" value="<?=$value?>" > </th>
                                            <?php
                                            } 
                                            ?>
                                            <th>Total</th>
                                            <th>Discount</th>
                                            <th>Received</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $statusNew=0;
                                            $final_total = 0;
                                            $aa=1;
                                            foreach($data_list as $row){
                                                $db_months = json_decode($row->months);
                                                $total = 0;
                                                $statusNew++;
                                        ?>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" checked onchange="DeleteRowData(this,<?=$aa?>)" disabled />
                                                </th>
                                                <th><?= $row->fees_heading ?></th>
                                                <?php foreach($months_data as $key => $value): ?>
                                                    <th>
                                                        <?php 
                                                            if(in_array($value, $db_months)){
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
                                                        ?>   
                                                    </th>
                                                <?php endforeach; ?>

                                                <th><?= $total ?></th>
                                                <th><?=$rec_discount[$row->id];?></th>
                                                <th><?=$received_amount[$row->id];?></th>
                                                <th>0</th>
                                            </tr>
                                            <?php
                                                $final_total += $total;
                                                $aa++;
                                            }

                                            // $aa++;
                                            foreach($route_data_list as $row){

                                                $db_months = json_decode($row->months);
                                                $total = 0;
                                                $aa++;
                                                $statusNew++;
                                            ?>
                                            <tr>
                                                <th><input type="checkbox"  onchange="DeleteRowData(this,<?=$aa?>)" checked disabled />
                                                </th>
                                                <th><?= $row->fees_heading ?></th>
                                                <?php foreach($months_data as $key => $value): ?>
                                                    <th>
                                                        <?php 
                                                            if(in_array($value, $db_months)){
                                                                echo $row->amount;
                                                                $total += $row->amount;
                                                            } else {
                                                                echo 0;
                                                            }
                                                        ?> 
                                                    </th>
                                                <?php endforeach; ?>
                                                <th><?= $total ?></th>
                                                <th><?=$rec_discount[$row->id];?></th>
                                                <th><?=$received_amount[$row->id];?></th>
                                                <th>0</th>
                                            </tr>
                                            <?php
                                                $final_total += $total;
                                            }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="card-footer"  style="padding: 10px;">
                            <div class="container" style="overflow-x: auto; max-width: 100%;">
                                <div class="row">
                                    
                                    
                                    <?php 
                                    
                                    if($statusNew==0) {
                                    
                                    ?>
                                    
                                    <div class="col-sm-2">
                                        <label for="fees_received">Ledger Total</label>
                                       <p><?=$student['fees_discount']?></p>
                                    </div>
                                    <?php }else{
                                    
                                    ?>
                                    
                                    <div class="col-sm-2">
                                        <label for="fees_received">Estimated Total</label>
                                        <p><?=$final_total?></p>
                                    </div>
                                    
                                    <?php
                                    
                                    } ?>
                                    
                                    
                                    <div class="col-sm-2">
                                        <label for="late_fees">Late Fees</label>
                                        <p><?php echo $late_fees;?></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="ledger_amt">Ledger Amt</label>
                                        <p><?=$ledger_amt; ?></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="total_fees">Total Fees</label>
                                        <p><?=$total_fees; ?></p>
                                    </div>
                                     <div class="col-sm-2">
                                        <label for="discount_amt">Discount Amt</label>
                                        <p><?php echo $discount_amt; ?></p>
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <label for="net_fees">Net Fees</label>
                                        <p><?=$net_fees; ?></p>
                                    </div>
                                </div>
                                <div class="row " style="margin-top: 10px !important;">

                                        <div class="col-sm-2">
                                            <label for="receipt_amt">Receipt Amt</label>
                                           <p><?=$receipt_amt; ?></p>
                                        </div>
                                    
                                    <div class="col-sm-2">
                                        <label for="balance_amt">Balance Amt</label>
										<p><?php echo $balance_amt; ?></p>
                                    </div>
                                
                                    <div class="col-sm-2">
                                        <label for="mode">Mode</label>
                                        <p><?php echo $mode; ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="remarks">Remarks</label>
                                        <p><?php echo $remarks; ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                               </form>
                    </div> 


                </div>
                <!--/.col (left) -->

            </div>

    </section>

</div>





<div class="norecord modal fade" id="confirm-norecord" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">


                <p><?php echo $this->lang->line('no_record_found'); ?></p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>

            </div>
        </div>
    </div>
</div>







<script>
function changeDate(td) {
    const dateSpan = td.querySelector('#admissionDate');

    // Create a date input
    const input = document.createElement('input');
    input.type = 'date';
    input.style.width = '150px';

    // Convert DD::MM::YYYY --> YYYY-MM-DD
    input.value = formatToInputDate(dateSpan.innerText);

    // Replace span with input
    td.innerHTML = 'Date ';
    td.appendChild(input);

    // When input loses focus, convert back
    input.addEventListener('blur', function() {
        const selectedDate = formatToDisplayDate(input.value);
        td.innerHTML = ' <b> Date : </b> <span id="admissionDate">' + selectedDate + '</span>';
    });
}

// Convert "26::04::2025" -> "2025-04-26" (for input type="date")
function formatToInputDate(dateStr) {
    const parts = dateStr.split('-');
    if (parts.length === 3) {
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }
    return ''; // fallback if bad format
}

// Convert "2025-04-26" -> "26::04::2025" (for showing again)
function formatToDisplayDate(inputDateStr) {
    const parts = inputDateStr.split('-');
    if (parts.length === 3) {
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }
    return '';
}
</script>

