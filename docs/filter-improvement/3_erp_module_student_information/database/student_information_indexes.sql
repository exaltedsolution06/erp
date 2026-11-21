-- Module 1: Student Information. Run ONCE (phpMyAdmin > SQL). Safe to re-run (MariaDB IF NOT EXISTS).
-- Additive only: no data is changed.

-- Class/section filter (also used by Attendance, Fees, Reports, Certificates, ID cards)
ALTER TABLE `student_session`
  ADD INDEX IF NOT EXISTS `idx_ss_filter` (`session_id`, `class_id`, `section_id`, `is_active`),
  ADD INDEX IF NOT EXISTS `idx_ss_student_session` (`student_id`, `session_id`),
  ADD INDEX IF NOT EXISTS `idx_ss_fee_category` (`fee_category_id`),
  ADD INDEX IF NOT EXISTS `idx_ss_house` (`school_house_id`),
  ADD INDEX IF NOT EXISTS `idx_ss_route` (`route_id`);

-- Student search by admission no / siblings by parent
ALTER TABLE `students`
  ADD INDEX IF NOT EXISTS `idx_students_admission_no` (`admission_no`),
  ADD INDEX IF NOT EXISTS `idx_students_parent_id` (`parent_id`);

-- Student list joins one row of custom_field_values PER custom field: needs this index
ALTER TABLE `custom_field_values`
  ADD INDEX IF NOT EXISTS `idx_cfv_belong_field` (`belong_table_id`, `custom_field_id`);

-- Student::get() joins users on user_id + role
ALTER TABLE `users`
  ADD INDEX IF NOT EXISTS `idx_users_user_role` (`user_id`, `role`);

-- Student documents tab
ALTER TABLE `student_doc`
  ADD INDEX IF NOT EXISTS `idx_student_doc_student` (`student_id`);
