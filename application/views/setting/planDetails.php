<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-info-circle"></i> Plan Details</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Plan Title</th>
                        <td><?= $plan['title'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>₹<?= format_amount($plan['price'] ?? 0) ?> / <?= $plan['duration'] ?? '' ?> Month<?= $plan['duration'] > 1 ? 's' : '' ?></td>
                    </tr>
                    <tr>
                        <th>Student Limit</th>
                        <td><?= $plan['max_students'] ?? '' ?></td>
                    </tr>
                    <?php if(isset($plan['add_on_students']) && $plan['add_on_students'] > 0){ ?>
                    <tr>
                        <th>Add-On Students</th>
                        <td><?= $plan['add_on_students'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(isset($domain_api_data['extra_add_on_students']) && $domain_api_data['extra_add_on_students'] > 0){ ?>
                    <tr>
                        <th>Extra Add-On Students</th>
                        <td><?= $domain_api_data['extra_add_on_students'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th>Description</th>
                        <td><?= $plan['description'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th>Subscription Start Date</th>
                        <td><?= isset($domain_api_data['subscription_start_date']) ? date('d-m-Y', strtotime($domain_api_data['subscription_start_date'])) : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Subscription End Date</th>
                        <td><?= isset($domain_api_data['subscription_end_date']) ? date('d-m-Y', strtotime($domain_api_data['subscription_end_date'])) : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Current Services</th>
                        <td>
							<?php 
								foreach($services as $serviceVal){
									$selected_service_ids = !empty($domain_api_data['service_ids']) ? explode(',', $domain_api_data['service_ids']) : [];
									if(in_array($serviceVal['id'], $selected_service_ids)){
							?>
								<button type="button" class="btn btn-xs btn-info"><?= $serviceVal['title'] ?></button>
							<?php 
									} 
								}
							?>
						</td>
                    </tr>
                </table>
                <a href="<?= base_url('package') ?>" class="btn btn-default">Back</a>
            </div>
        </div>
    </section>
</div>