<?php
$return_string = "";
if (empty($batch_class)) {
    
} else {
    ?>
    <option value="">Select Class</option>

    <?php
    if (!empty($batch_class)) {
        foreach ($batch_class as $subject_key => $subject_value) {

         // $sub_code=($subject_value['class'] != "") ? " (".$subject_value['class'].")":"";
            ?>
            <option value="<?php echo $subject_value['id'] ?>"><?php 
            echo $subject_value['class']  ?></option>
            <?php
        }
    }
}
?>
