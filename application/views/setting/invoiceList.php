<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('class1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Invoices</h3>                   
                    </div>
                    <div class="box-body">
                        <div class="download_label">Invoice List</div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Invoice No.</th>
										<th>School ID</th>
										<th>Item Description</th>
										<th>Price</th>
										<th>Discount</th>
										<th>CGST</th>
										<th>IGST</th>
										<th>Total</th>
										<th>Date</th>
										<th>Status</th>
										<th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									// echo '<pre>'; print_r($invoices); die;
									foreach($invoices as $row){ ?>
										<tr>
											<td><strong><?= $row['invoice_prefix'] . '-' . $row['invoice_number'] ?></strong></td>
											<td><?= $row['school_id'] ?></td>
											<td><?= htmlspecialchars($row['item_description']) ?></td>
											<td><?= format_amount($row['price_amount']) ?></td>
											<td><?= format_amount($row['discount']) ?></td>
											<td>
												<?= format_amount($row['cgst']) ?>
												<?php if(isset($row['cgst_pct']) && $row['cgst_pct'] > 0){ ?>
													<small class="text-muted">(<?= $row['cgst_pct'] ?>%)</small>
												<?php } ?>
											</td>
											<td>
												<?= format_amount($row['igst']) ?>
												<?php if(isset($row['igst_pct']) && $row['igst_pct'] > 0){ ?>
													<small class="text-muted">(<?= $row['igst_pct'] ?>%)</small>
												<?php } ?>
											</td>
											<td><strong><?= format_amount($row['total']) ?></strong></td>
											<td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
											<td class="text-end">
												<?php if($row['status'] == 0){ ?>
													<button type="button" class="btn btn-xs btn-danger"> Unpaid</button>
												<?php }else{ ?>
													<button type="button" class="btn btn-xs btn-success"> Paid</button>
												<?php } ?>
											</td>
											<td  class="mailbox-date pull-right">
												<a data-placement="left" href="javascript:void(0)" class="btn btn-default btn-xs print-invoice-btn" data-toggle="tooltip" title="Print Invoice" data-id="<?= $row['id'] ?>">
													<i class="fa fa-print"></i>
												</a>
                                            </td>
										</tr>
									<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

        </div> 
    </section>
<div id="inv-print-frame"></div>
</div>
<script>
$(document).on("click", ".print-invoice-btn", function() {
    var id = $(this).data("id");

    $.ajax({
        url: "<?= base_url('package/print_invoice') ?>/" + id,
        type: "GET",
		success: function(html) {
			// console.log(html);
			// $("#inv-print-frame").html(html);return;
			$("#inv-print-frame").remove();

			var $frame = $('<div id="inv-print-frame"></div>').html(html);
			$("body").append($frame);
			$("body").addClass("inv-printing");

			var $imgs = $frame.find("img");

			if ($imgs.length === 0) {
				printInvoice();
				return;
			}

			var loaded = 0;

			$imgs.each(function () {
				if (this.complete) {
					loaded++;
					if (loaded === $imgs.length) {
						printInvoice();
					}
				} else {
					$(this).one("load error", function () {
						loaded++;
						if (loaded === $imgs.length) {
							printInvoice();
						}
					});
				}
			});

			function printInvoice() {
				window.print();

				setTimeout(function () {
					$("body").removeClass("inv-printing");
					$("#inv-print-frame").remove();
				}, 1000);
			}
		},
        error: function() {
            toastr.error("Failed to load invoice. Please try again.");
        }
    });
});

</script>
<style>
/* Hidden off-screen by default */
#inv-print-frame {
    display: none;
}

/* When printing: show only the invoice frame, hide everything else */
@media print {
    body.inv-printing > *:not(#inv-print-frame) {
        display: none !important;
    }
    body.inv-printing #inv-print-frame {
        display: block !important;
    }
    /* Force background colours to print */
    body.inv-printing * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    body.inv-printing .items-table thead tr {
        background: #e03c2f !important;
        color: #fff !important;
    }
    body.inv-printing .summary-table tr.total-row td {
        background: #e03c2f !important;
        color: #fff !important;
    }
}
</style>