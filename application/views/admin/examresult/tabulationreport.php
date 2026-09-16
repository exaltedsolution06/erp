<style>
.filter-box {
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 5px;
  max-height: 125px;
  overflow-y: auto;
}
.box-header-ptbnull{
	padding-top:2rem;
}
.form-check-label{
	padding-left:1rem;
}
.tabulation-table th, .tabulation-table td {
	text-align: center;
	vertical-align: middle !important;
	white-space: nowrap;
}
.tabulation-table td.text-left {
	text-align: left;
	white-space: normal;
}
.table-buttons {
	float: right !important;
}
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>  </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $this->load->view('reports/_examinations'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box removeboxmius">
                    <div class="box-header ptbnull"></div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">

                        <form role="form" action="<?php echo site_url('admin/examresult/tabulationreport') ?>" method="post">

                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="row">
                                <div class="col-sm-6 col-lg-3 col-md-12">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                                        <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if (set_value('class_id') == $class['id']) {
                                                    echo "selected=selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>


                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>

								<div class="col-sm-6 col-lg-3 col-md-12">
									<div class="form-check">
										<input type="checkbox" class="form-check-input master-check" data-target="exam-group-check" id="selectAllExamGroup">
										<label class="form-check-label" for="selectAllExamGroup"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?></label><small class="req text-danger"> *</small>
									</div>
									<div class="filter-box">
										<?php
										$selectedExamGroup = $_POST['exam_group_id'] ?? [];
										foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
										$checked = in_array($ex_group_value->id, $selectedExamGroup) ? 'checked' : '';
										echo "<div class='form-check'>
												<input type='checkbox' class='form-check-input exam-group-check' name='exam_group_id[]' value='{$ex_group_value->id}' id='exam-group{$ex_group_value->id}' $checked>
												<label class='form-check-label' for='exam-group{$ex_group_value->id}'>{$ex_group_value->name}</label>
												</div>";
										}
										?>
									</div>
                                    <span class="text-danger"><?php echo form_error('exam_group_id[]'); ?></span>
								</div>
								<div class="col-sm-6 col-lg-3 col-md-12">
									<div class="form-check">
										<input type="checkbox" class="form-check-input master-exam-check" data-target="exam-check" id="selectAllExam">
										<label class="form-check-label" for="selectAllExam"> <?php echo $this->lang->line('exam'); ?></label><small class="req"> *</small>
									</div>
									<div class="filter-box">
										<div id="exam-list-container">
											<?php
											if(!empty($exam_list)){
												$selectedExam = $_POST['exam_id'] ?? [];
												foreach ($exam_list as $exam_list_exam){
													$checked_exam = in_array($exam_list_exam->id, $selectedExam) ? 'checked' : '';
											?>
												<div class='form-check'>
													<input type='checkbox' class='form-check-input exam-check'
														name='exam_id[]' value='<?php echo $exam_list_exam->id; ?>' id='exam<?php echo $exam_list_exam->id; ?>' <?php echo $checked_exam; ?>>
													<label class='form-check-label' for='exam<?php echo $exam_list_exam->id; ?>'>
														<?php echo $exam_list_exam->exam; ?>
													</label>
												</div>
											<?php
												}
											}
											?>
										</div>
									</div>
                                    <span class="text-danger"><?php echo form_error('exam_id[]'); ?></span>
								</div>
                                <div class="col-md-1 mb-3">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    <?php
                    if (isset($stdResult)) {
                        ?>
                        <div class="box-header ptbnull"></div>
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-users"></i> Tabulation <?php echo $this->lang->line('report'); ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive table-header-sticky">
                                <div class="download_label">Tabulation Report</div>

                                <?php
                                if (empty($stdResult)) {
                                    ?>
                                    <!--<h3 class="text-center text-danger py-2">No record Found!</h3>-->
                                    <?php
                                } else {
                                    $exam_ids_filter = !empty($exam_ids) ? $exam_ids : array();
                                    ?>
                                    <div class="dt-buttons btn-group mb10 table-buttons" style="margin-bottom:10px;">
                                        <button type="button" class="btn btn-default btn-sm" onclick="tabulationCopyTable()"><i class="fa fa-copy"></i> Copy</button>
                                        <button type="button" class="btn btn-default btn-sm" onclick="tabulationExportExcel()"><i class="fa fa-file-excel-o"></i> Excel</button>
                                        <button type="button" class="btn btn-default btn-sm" onclick="tabulationPrintTable()"><i class="fa fa-print"></i> Print / PDF</button>
                                    </div>
                                    <table id="tabulation-report-table" cellspacing="0" class="table table-striped table-bordered table-hover table-fixed-header tabulation-table" style="width:100% !important">
                                        <thead>
                                            <tr>
                                                <th colspan="5">STUDENT PROFILE</th>
                                                <th rowspan="2">Subject</th>
                                                <?php foreach ($exam_group_headers as $group_header) { ?>
                                                <th colspan="<?php echo count($group_header['exams']) + 3; ?>"><?php echo strtoupper($group_header['name']); ?> MARKS</th>
                                                <?php } ?>
                                                <th rowspan="2">Total MO</th>
                                                <th rowspan="2">Max Marks</th>
                                                <th rowspan="2">Overall Grade</th>
                                                <th rowspan="2">Total MO<br>(All)</th>
                                                <th rowspan="2">Max Marks<br>(All)</th>
                                                <th rowspan="2">Overall %</th>
                                                <th rowspan="2">Overall Grade</th>
                                                <th rowspan="2">Division</th>
                                                <th rowspan="2">FINAL OVERALL EVALUATION</th>
                                            </tr>
                                            <tr>
                                                <th>Adm No.</th>
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Mother's Name</th>
                                                <th>Contact</th>
                                                <?php foreach ($exam_group_headers as $group_header) {
                                                    foreach ($group_header['exams'] as $ge) {
                                                        echo '<th>' . $ge->exam . '</th>';
                                                    }
                                                    ?>
                                                <th>MO</th>
                                                <th>MM</th>
                                                <th>Grade</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($stdResult as $stddata) {
                                                $student_id = $stddata->student_id;

                                                // ---- Subjects applicable to this student's class/section ----
                                                $student_result = $this->studentsession_model->getStudentClass($student_id);
                                                $subject_group_by_classsection = $this->subjectgroup_model->getGroupByClassandSection($student_result['class_id'], $student_result['section_id']);
                                                $subject_id_data = array();
                                                foreach ($subject_group_by_classsection as $sgc_val) {
                                                    $subject_list_by_groupid = $this->subjectgroup_model->getByID($sgc_val['subject_group_id']);
                                                    foreach ($subject_list_by_groupid as $slg_val) {
                                                        foreach ($slg_val->group_subject as $subject) {
                                                            $subject_id_data[] = $subject->subject_id;
                                                        }
                                                    }
                                                }

                                                $finalTotal = 0;
                                                $maxMark    = array();
                                                $minMark    = array();
                                                $is_fail    = 0;
                                                $subject_rows = array();

                                                foreach ($subject_id_data as $subject_id) {
                                                    $subject_row = $this->db->get_where('subjects', array('id' => $subject_id))->row();
                                                    if (empty($subject_row) || $subject_row->type_one == 'optional') {
                                                        continue;
                                                    }

                                                    $max_marks1 = 0;
                                                    $total1     = 0;
                                                    $min_marks  = 0;
                                                    $group_cells = array();

                                                    foreach ($post_exam_group_id as $exam_group_id) {
                                                        $exam_type = $this->db->query("SELECT exam_group_class_batch_exams.* FROM exam_group_class_batch_exams
                                                            INNER JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.exam_group_class_batch_exam_id = exam_group_class_batch_exams.id
                                                            WHERE exam_group_id = '" . $exam_group_id . "' AND exam_group_class_batch_exam_students.student_id = '" . $student_id . "'")->result();

                                                        $group_total = 0;
                                                        $group_max   = 0;
                                                        $exam_marks  = array();

                                                        foreach ($exam_type as $type) {
                                                            if (!in_array($type->id, $exam_ids_filter)) {
                                                                continue;
                                                            }

                                                            $maxMarksRow = $this->db->query("SELECT max_marks, min_marks FROM exam_group_class_batch_exam_subjects WHERE exam_group_class_batch_exams_id='" . $type->id . "' and subject_id='" . $subject_row->id . "'")->row();
                                                            if (empty($maxMarksRow)) {
                                                                continue;
                                                            }

                                                            $resultData = $this->db->query("SELECT exam_group_exam_results.* FROM exam_group_exam_results
                                                                LEFT JOIN exam_group_class_batch_exam_subjects ON exam_group_class_batch_exam_subjects.id = exam_group_exam_results.exam_group_class_batch_exam_subject_id
                                                                LEFT JOIN exam_group_class_batch_exam_students ON exam_group_class_batch_exam_students.id = exam_group_exam_results.exam_group_class_batch_exam_student_id
                                                                WHERE exam_group_class_batch_exam_subjects.exam_group_class_batch_exams_id='" . $type->id . "'
                                                                and exam_group_class_batch_exam_students.exam_group_class_batch_exam_id='" . $type->id . "'
                                                                and exam_group_class_batch_exam_subjects.subject_id='" . $subject_row->id . "'
                                                                and exam_group_class_batch_exam_students.student_id='" . $student_id . "'")->row();

                                                            $marks_val = !empty($resultData) ? ($resultData->attendence == 'absent' ? 'AB' : ($resultData->attendence == 'm_leave' ? 'ML' : format_amount($resultData->get_marks))) : '-';
                                                            $obtained  = !empty($resultData) ? (float) $resultData->get_marks : 0;

                                                            array_push($maxMark, $maxMarksRow->max_marks);
                                                            array_push($minMark, $maxMarksRow->min_marks);
                                                            $min_marks += $maxMarksRow->min_marks;

                                                            $group_max   += $maxMarksRow->max_marks;
                                                            $group_total += $obtained;

                                                            $exam_marks[] = $marks_val;
                                                        }

                                                        $max_marks1 += $group_max;
                                                        $total1     += $group_total;

                                                        $group_grade = '';
                                                        if ($group_max > 0) {
                                                            $g_pct = round(($group_total * 100) / $group_max);
                                                            $gd = $this->db->query("SELECT * FROM `grades` WHERE mark_from>='$g_pct' and mark_upto<='$g_pct' order by mark_upto asc")->result();
                                                            $group_grade = !empty($gd) ? $gd[0]->name : '';
                                                        }

                                                        $group_cells[$exam_group_id] = array(
                                                            'exam_marks' => $exam_marks,
                                                            'mo'         => $group_total,
                                                            'mm'         => $group_max,
                                                            'grade'      => $group_grade,
                                                        );
                                                    }

                                                    if ($min_marks > $total1) {
                                                        $is_fail = 1;
                                                    }

                                                    $overall_subject_grade = '';
                                                    if ($max_marks1 > 0) {
                                                        $s_pct = round(($total1 * 100) / $max_marks1);
                                                        $gd = $this->db->query("SELECT * FROM `grades` WHERE mark_from>='$s_pct' and mark_upto<='$s_pct' order by mark_upto asc")->result();
                                                        $overall_subject_grade = !empty($gd) ? $gd[0]->name : '';
                                                    }

                                                    $finalTotal += $total1;

                                                    $subject_rows[] = array(
                                                        'name'   => $subject_row->name,
                                                        'groups' => $group_cells,
                                                        'mo'     => $total1,
                                                        'mm'     => $max_marks1,
                                                        'grade'  => $overall_subject_grade,
                                                    );
                                                }

                                                $totalMaxMarks = array_sum($maxMark);
                                                $totalNumber   = $totalMaxMarks > 0 ? round(($finalTotal * 100) / $totalMaxMarks, 2) : 0;
                                                $exam_pass_status = ($finalTotal < array_sum($minMark)) ? 0 : 1;
                                                $division = get_division_by_percentage($totalNumber);

                                                $overall_grade = '';
                                                if ($totalMaxMarks > 0) {
                                                    $og_pct = round($totalNumber);
                                                    $gd = $this->db->query("SELECT * FROM `grades` WHERE mark_from>='$og_pct' and mark_upto<='$og_pct' order by mark_upto asc")->result();
                                                    $overall_grade = !empty($gd) ? $gd[0]->name : '';
                                                }

                                                $final_eval = '';
                                                if (!$is_fail) {
                                                    $final_eval = $exam_pass_status
                                                        ? ($this->lang->line('pass') . ' ' . $this->lang->line('with') . ' (' . $division . ' ' . $this->lang->line('division') . ')')
                                                        : $this->lang->line('fail');
                                                }

                                                $row_count = count($subject_rows);
                                                if ($row_count == 0) {
                                                    continue;
                                                }

                                                $student_name = $this->customlib->getFullName($stddata->firstname, $stddata->middlename, $stddata->lastname, $sch_setting->middlename, $sch_setting->lastname);

                                                foreach ($subject_rows as $sr_key => $sr) {
                                                    echo '<tr>';
                                                    if ($sr_key == 0) {
                                                        echo '<td rowspan="' . $row_count . '">' . $stddata->admission_no . '</td>';
                                                        echo '<td rowspan="' . $row_count . '" class="text-left">' . $student_name . '</td>';
                                                        echo '<td rowspan="' . $row_count . '" class="text-left">' . $stddata->father_name . '</td>';
                                                        echo '<td rowspan="' . $row_count . '" class="text-left">' . $stddata->mother_name . '</td>';
                                                        echo '<td rowspan="' . $row_count . '">' . $stddata->guardian_phone . '</td>';
                                                    }
                                                    echo '<td class="text-left">' . $sr['name'] . '</td>';
                                                    foreach ($sr['groups'] as $gc) {
                                                        foreach ($gc['exam_marks'] as $em) {
                                                            echo '<td>' . $em . '</td>';
                                                        }
                                                        echo '<td>' . format_amount($gc['mo']) . '</td>';
                                                        echo '<td>' . format_amount($gc['mm']) . '</td>';
                                                        echo '<td>' . $gc['grade'] . '</td>';
                                                    }
                                                    echo '<td>' . format_amount($sr['mo']) . '</td>';
                                                    echo '<td>' . format_amount($sr['mm']) . '</td>';
                                                    echo '<td>' . $sr['grade'] . '</td>';
                                                    if ($sr_key == 0) {
                                                        echo '<td rowspan="' . $row_count . '">' . format_amount($finalTotal) . '</td>';
                                                        echo '<td rowspan="' . $row_count . '">' . format_amount($totalMaxMarks) . '</td>';
                                                        echo '<td rowspan="' . $row_count . '">' . $totalNumber . '%</td>';
                                                        echo '<td rowspan="' . $row_count . '">' . $overall_grade . '</td>';
                                                        echo '<td rowspan="' . $row_count . '">' . $division . '</td>';
                                                        echo '<td rowspan="' . $row_count . '">' . $final_eval . '</td>';
                                                    }
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                             </div>
                        </div>
                </div>
					<?php
					}
				?>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.select2').select2();
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
	});
	var class_id = '<?php echo set_value('class_id') ?>';
	var section_id = '<?php echo set_value('section_id') ?>';
	var session_id = '<?php echo set_value('session_id') ?>';
	getSectionByClass(class_id, section_id);

	$(document).on('change', '#class_id', function (e) {
		$('#section_id').html("");
		var class_id = $(this).val();
		getSectionByClass(class_id, 0);
	});

	function getSectionByClass(class_id, section_id) {

		if (class_id !== "") {
			$('#section_id').html("");
			var base_url = '<?php echo base_url() ?>';
			var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


			$.ajax({
				type: "GET",
				url: base_url + "sections/getByClass",
				data: {'class_id': class_id},
				dataType: "json",
				beforeSend: function () {
					$('#section_id').addClass('dropdownloading');
				},
				success: function (data) {
					$.each(data, function (i, obj)
					{
						var sel = "";
						if (section_id === obj.section_id) {
							sel = "selected";
						}
						div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
					});
					$('#section_id').append(div_data);
				},
				complete: function () {
					$('#section_id').removeClass('dropdownloading');
				}
			});
		}
	}
</script>
<script>
	$(document).on('change', '.master-exam-check', function () {
		const targetClass = $(this).data('target');

		$('.' + targetClass).prop('checked', this.checked);
	});
	$(document).on('change', '.master-check', function () {
		const targetClass = $(this).data('target');

		$('.' + targetClass).prop('checked', this.checked);

		loadExamList();
	});
  $(document).on('change', '.exam-group-check', function () {
		loadExamList();
	});
	function loadExamList() {
		let selected = [];

		$('.exam-group-check:checked').each(function () {
			selected.push($(this).val());
		});

		$.ajax({
			url: base_url + "admin/examgroup/getExamByExamgroupArray",
			type: "POST",
			data: { exam_group_id: selected },
			success: function (res) {
				$('#exam-list-container').html(res);
			}
		});
	}
</script>
<script type="text/javascript">
	// Custom Copy / Excel / Print handlers for the Tabulation Report table.
	// The table uses merged (rowspan/colspan) cells for the student profile
	// and summary columns, which the DataTables plugin used elsewhere in
	// this app cannot index - so these work directly on the raw HTML table
	// instead of going through DataTables.

	function tabulationCopyTable() {
		var table = document.getElementById('tabulation-report-table');
		if (!table) { return; }

		var range = document.createRange();
		range.selectNode(table);
		var selection = window.getSelection();
		selection.removeAllRanges();
		selection.addRange(range);

		try {
			document.execCommand('copy');
		} catch (e) {
			alert('Copy is not supported in this browser. Please select the table manually and copy it.');
		}
		selection.removeAllRanges();
	}

	function tabulationExportExcel() {
		var table = document.getElementById('tabulation-report-table');
		if (!table || typeof XLSX === 'undefined') { return; }

		var wb = XLSX.utils.table_to_book(table, { sheet: 'Tabulation Report' });
		XLSX.writeFile(wb, 'Tabulation_Report.xlsx');
	}

	function tabulationPrintTable() {
		var table = document.getElementById('tabulation-report-table');
		if (!table) { return; }

		var printWindow = window.open('', '', 'height=800,width=1200');
		printWindow.document.write('<html><head><title>Tabulation Report</title>');
		printWindow.document.write('<style>' +
			'body{font-family:Arial,Helvetica,sans-serif;}' +
			'table{border-collapse:collapse;width:100%;}' +
			'th,td{border:1px solid #666;padding:4px 6px;text-align:center;font-size:11px;}' +
			'</style>');
		printWindow.document.write('</head><body>');
		printWindow.document.write('<h3>Tabulation Report</h3>');
		printWindow.document.write(table.outerHTML);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.focus();
		setTimeout(function () {
			printWindow.print();
			printWindow.close();
		}, 250);
	}
</script>
