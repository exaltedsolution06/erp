<style type="text/css">
    .wrapper {overflow: visible;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1><i class="fa fa-gears"></i> School Registration</h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<?php
		$total_plans = count($plans_api_data);

		$offset_class = '';

		if($total_plans == 1){
			$offset_class = 'col-md-offset-4'; // center 1 box
		}elseif($total_plans == 2){
			$offset_class = 'col-md-offset-3'; // center 2 boxes
		}elseif($total_plans == 3){
			$offset_class = 'col-md-offset-1'; // center 3 boxes
		}
		?>
        <div class="row row-flex3">
			<?php foreach($plans_api_data as $key=>$plan_val){ ?>
			<div class="col-md-3 <?= $key == 0 ? $offset_class : '' ?>">
				<div class="plan-box <?= $plan_val['id'] == $domain_api_data['plan_id'] ? 'active' : '' ?>">
					<div class="plan-title">
						<?= $plan_val['title'] ?? '' ?>
					</div>
					<div class="plan-price">
						₹<?= format_amount($plan_val['price'] ?? 0) ?> <sub>/ <?= $plan_val['duration'] ?? '' ?> Month<?= $plan_val['duration'] > 1 ? 's' : '' ?></sub>
					</div>
					<ul class="plan-details">
						<li>
							<strong>Student Limit:</strong> <?= $plan_val['max_students'] ?? '' ?> <?php if(isset($plan_val['add_on_students']) && $plan_val['add_on_students'] > 0){ ?>| <strong>Add-On:</strong> <?= $plan_val['add_on_students'] ?? ''; } ?>
						</li>
					</ul>
					<?php if($plan_val['id'] == $domain_api_data['plan_id']){ ?>
					<a href="<?= base_url('package/plan_details/'.$plan_val['id']) ?>" class="btn btn-success btn-plan">
						Current Plan Details
					</a>
					<?php }else{ ?>
					<button class="btn btn-info btn-plan choose-plan">
						Choose Plan
					</button>
					<?php } ?>
					<div class="plan-desc">
						<?= $plan_val['description'] ?? '' ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="choosePlan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Choose Plan</h4>
            </div>
            <div class="modal-body subject-body">
				<p class="">Please Contact to your Partner or Call <?= $company['contact_no'] ?? '' ?></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('.choose-plan').click(function () {
	$('#choosePlan').modal().show();
});
</script>
