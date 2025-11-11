
   <div class="row pb10">
        <div class="col-lg-2 col-md-3 col-sm-12">   
            <p class="examinfo"><span><?php echo $this->lang->line('exam'); ?></span><?php echo $examgroupDetail->exam; ?></p>
        </div>
        <div class="col-lg-10 col-md-9 col-sm-12">   
            <p class="examinfo"><span><?php echo $this->lang->line('exam')." ".$this->lang->line('group');?></span><?php echo $examgroupDetail->exam_group_name; ?></p>
        </div> 
    </div>    
  <div class="divider2"></div>
   
<div class="row">
    <div class="col-md-12 pt5">
            <button type="button" name="add" class="btn btn-primary btn-sm add pull-right" autocomplete="off"><span class="fa fa-plus"></span> <?php echo $this->lang->line('add')." Terms ".$this->lang->line('subject');?></button>
    </div>
</div>
<form action="<?php echo site_url('admin/coscholasticareas/addexamsubject') ?>" method="POST" class="ssaddSubject ptt10 autoscroll">
    <input type="hidden" name="exam_group_class_batch_exam_id" value="<?php echo $exam_id; ?>">
    <div class="">
      <table class="table table-bordered" id="item_table">
        <thead>
            <tr>
                <th class="">Select Terms</th>
               <!--  <th class=""><?php echo $this->lang->line('date'); ?></th>
                <th class=""><?php echo $this->lang->line('time');?></th>
                <th class=""><?php echo $this->lang->line('duration')?></th>
                <th class=""><?php echo $this->lang->line('credit')." ".$this->lang->line('hours') ?></th>
                <th class=""><?php echo $this->lang->line('room')." ".$this->lang->line('no')?></th> -->
                <!-- <th class="tddm150"><?php echo $this->lang->line('marks')." (".$this->lang->line('max').".)";?></th> -->


                <th class="tddm150">Select Class</th>
                <th class="tddm150">Select Section</th>
                <th class="tddm150">Select Student</th>

                <th class="tddm150">Grade</th>  
                <?php
        if ($examgroupDetail->exam_group_type == "coll_grade_system") {
            ?>
             <th class="text-center"><?php echo $this->lang->line('action'); ?></th>
            <?php
        }
        ?>
               
            </tr>
        </thead>
        <?php


        if (!empty($exam_subjects)) {
   
            $count = 1;
            foreach ($exam_subjects as $exam_subject_key => $exam_subject_value) {
                ?>
                <tr>

                    <td width="160">
                        <select class="form-control item_unit tddm200" name="subject_<?php echo $count; ?>">
                            <option value=""><?php echo $this->lang->line('select')?></option>

                            <?php
                            if (!empty($batch_subjects)) {
                                foreach ($batch_subjects as $subject_key => $subject_value) {
                                    ?>
                                    <option value="<?php echo $subject_value['id'] ?>" <?php echo set_select('subject_' . $count, $subject_value['id'], ($exam_subject_value->subject_id == $subject_value['id']) ? true : false); ?>>
                                        <?php 
                                 $sub_code=($subject_value['code'] != "") ? " (".$subject_value['code'].")":"";
                                        echo $subject_value['name'].$sub_code; ?>
                                            
                                        </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    
                   
                    <td width="160">
                        <select class="form-control item_unit tddm200" onchange="GetFilterData(<?php echo $count; ?>)"  id="ClassData<?php echo $count; ?>" name="class_<?php echo $count; ?>">
                            <option value=""><?php echo $this->lang->line('select')?></option>

                            <?php
                            if (!empty($batch_class)) {
                                foreach ($batch_class as $subject_key => $subject_value) {
                                    ?>
                                    <option value="<?php echo $subject_value['id'] ?>" <?php echo set_select('class_' . $count, $subject_value['id'], ($exam_subject_value->class_id == $subject_value['id']) ? true : false); ?>>
                                        <?php 
                              
                                        echo $subject_value['class']; ?>
                                            
                                        </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>

                     <?php  $section_data=$this->section_model->get($exam_subject_value->section_id);   ?>

                    <td width="160">
                        <select class="form-control item_unit tddm200" onchange="GetFilterDataStudent(<?php echo $count; ?>)" id="ClassSubject<?php echo $count; ?>" name="section_<?php echo $count; ?>">

                            <option value="<?php echo $section_data['id'];?>"><?php echo $section_data['section'];?></option>
                            
                        </select>
                    </td>
                    <?php  $student_data=$this->student_model->getStudentByClassSectionID($exam_subject_value->class_id,$exam_subject_value->section_id); ?>

                    <td width="160">
                        <select class="form-control item_unit tddm200" id="StudentData<?php echo $count; ?>"   name="session_<?php echo $count; ?>">

                            <option value="<?php echo $student_data[0]['id'];?>"><?php echo $student_data[0]['firstname'];?></option>

                           
                        </select>
                    </td>





                    <td>
                        <input name="rows[]" type="hidden" value="<?php echo $count; ?>">
                        <input name="prev_row[<?php echo $count; ?>]" type="hidden" value="<?php echo $exam_subject_value->id; ?>">
                        <input class="form-control min_marks tddm150" name="min_marks_<?php echo $count; ?>" type="text" value="<?php echo $exam_subject_value->grade; ?>"/>

                    </td>
                    
                    <td class="text-center" style="vertical-align: middle; cursor: pointer;">
                        <span class="text text-danger remove fa fa-times"></span>
                    </td>
        
                   
                </tr>

                <?php
                $count++;
            }
        }
        ?>
    </table>
  </div>  
  <div class="modal-footer"> 
   <div class="row"> 
    <?php 
    if($this->rbac->hasPrivilege('exam_subject','can_edit')){
        ?>
        <button type="submit" class="btn btn-primary pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save')?></button>
        <?php
    }
    ?>
    
  </div>  
</div>

</form>
