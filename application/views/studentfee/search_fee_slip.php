<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i>                          
                            <?php echo $this->lang->line('search'); ?>
                            Fee Receipt
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url('studentfee/search_fee_slip') ?>" method="post" class="form-inline">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Enter Receipt No
                                            </label><small class="req"> *</small>
                                            <input autofocus="" id="receipt_no" name="receipt_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('receipt_no'); ?>"/>
                                            <span class="text-danger"><?php echo form_error('receipt_no'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group align-text-top">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle mmius15"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
					<?php if ($this->session->flashdata('msgdelete')): ?>
					<div class="card-body" style="padding: 10px;">
                        <div class="row no-print">
                            <div class="col-md-12 mDMb10">	
								<?php echo $this->session->flashdata('msgdelete'); ?>
							</div>
                        </div>
                    </div>  
					<?php $this->session->unset_userdata('msgdelete'); // force remove ?>
				<?php endif; ?>					
                    <div class="table-responsive-" style="overflow: auto;">
                                    <div class="download_label"> </div>

                                    <table  cellpadding="8" cellspacing="0" class="table example table-striped table-bordered table-hover example table-fixed-header" style="width:2300px !important">
                                        <thead>
                                            <tr>
                                                <th style="width:50px !imortant">S.No</th>
                                                <th style="width:70px !imortant">Date</th>
                                                <th style="width:70px !imortant">Slip No</th>
                                                <th style="width:70px !imortant">Adm. No</th>
                                                <th >Student</th>
                                                <th >Father</th>
                                                <th >Class</th>
                                                <th >Sec.</th>
                                                <th >Fee Cat.</th>
                                                <th >Route</th>
                                                <th >Months</th>
                                                <th style="text-align: right;">Fee</th>
                                                <th style="text-align: right;">Ledger Amt</th>
                                                <th style="text-align: right;">Late/Other</th>
                                                <th style="text-align: right;">Total Fees</th>
                                                <th style="text-align: right;">Discount Amt</th>
                                                <th style="text-align: right;">Net Fees</th>
                                                <th style="text-align: right;">Receipt. Amt.</th>
                                                <th style="text-align: right;">Balance Amt</th>
                                                <th >Mode</th>
                                                <th >User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
										<tbody>
                                            <?php if (!empty($receipt_data)): ?>
                                                <?php $sno = 1; foreach ($receipt_data as $record): ?>
                                             <?php  
                                                $record=(array)$record; 
                                                if(!empty($record['fee_head'])){
                                                $fees_received_sum       += (float)$record["fees_received"];
                                                }else{
                                                    $fees_received_sum       +=00.00;
                                                }
                                                $late_fees_sum    += (float)$record["late_fees"];
                                                $ledger_amt_sum   += (float)$record["ledger_amt"];
                                                $total_fees_sum     += (float)$record["total_fees"];
                                                $discount_amt_sum     += (float)$record["discount_amt"];
                                                $net_fees_sum  += (float)$record["net_fees"];
                                                $receipt_amt_sum  += (float)$record["receipt_amt"];
                                                $balance_amt_sum  += (float)$record["balance_amt"];
                                            ?>
                                            <tr>
                                                <td style="width:50px !important"><?= $sno++ ?></td>
                                                <td style="width:100px !imortant"><?= date('d-m-Y',strtotime($record["date_time"])) ?></td>
                                                <td style="width:100px !imortant"><?= $record["receipt_no"] ?></td>
                                                <td ><?= $record["admission_no"] ?></td>
                                                <td ><?= $record["firstname"].' '.$record["middlename"].' '.$record["lastname"] ?></td>
                                                <td ><?= $record["father_name"] ?></td>
                                                <td ><?= $record["class"] ?></td>
                                                <td ><?= $record["section"] ?></td>
                                                <td ><?=  ($this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()) ? $this->db->get_where('fee_groups', ['id' => $record['category_id']])->row()->name : 'N.A'; ?>  </td>
                                                <td ><?=  ($this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row()) ? $this->db->get_where('route_head', ['id' => $record['vehroute_id']])->row()->fees_heading : 'N.A'; ?>  </td>
                                                <td>
                                                    <?php
                                                        if(!empty($record['fee_head'])){
                                                            // echo $record["receipt_months"];
                                                            $financial_year_order = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];

                                                            $months = explode(',', $record["receipt_months"]);
                                                            $months = array_map('trim', $months); // TRIM SPACES

                                                            usort($months, function($a, $b) use ($financial_year_order) {
                                                                return array_search($a, $financial_year_order) - array_search($b, $financial_year_order);
                                                            });

                                                            echo implode(', ', $months);
                                                        }else{
                                                            echo "Old Bal.";
                                                        }
                                                    ?>
                                                </td>
                                                <?php
                                                     if(!empty($record['fee_head'])){
                                                        ?>
                                                        <td style="text-align: right;"><?= sprintf('%.2f', $record["fees_received"]) ?></td>
                                                        <?php
                                                     }else{
                                                        ?>
                                                        <td style="text-align: right;">00.00</td>
                                                        <?php
                                                     }
                                                ?>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["ledger_amt"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', !empty($record["late_fees"]) ? $record["late_fees"] : 0) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["total_fees"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["discount_amt"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["net_fees"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["receipt_amt"]) ?></td>
                                                <td style="text-align: right;"><?= sprintf('%.2f', $record["balance_amt"]) ?></td>
                                                <td ><?= $record["mode"] ?></td>
                                                <td ><?= $record["create_by"] ?></td>
                                                <td>
													<a href="<?php echo base_url(); ?>studentfee/feeview/<?= base64_encode($record["receipt_no"]); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>studentfee/edit/<?= base64_encode($record["receipt_no"]); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>studentfee/search_fee_slip?receipt_no=<?=$record["receipt_no"]?>&type=delete" class="btn btn-default btn-xs"  data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                         <tr>
                                           
                                            <th>Total - </th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>

                                            <th>-</th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $fees_received_sum) ?></th>

                                            <th style="text-align: right;"><?= sprintf('%.2f', $ledger_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $late_fees_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $total_fees_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $discount_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $net_fees_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $receipt_amt_sum) ?></th>
                                            <th style="text-align: right;"><?= sprintf('%.2f', $balance_amt_sum) ?></th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
                                        <?php else: ?>
                                            <tr><td colspan="21" class="text-center">No records found</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                    
                                    </table>
                                    

                                </div> 

                </div>   
            </div>
        </div> 
    </section>
</div>