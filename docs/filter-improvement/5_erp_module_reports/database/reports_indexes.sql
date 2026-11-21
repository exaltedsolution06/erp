-- Module 3: Reports. Run ONCE (phpMyAdmin > SQL). Safe to re-run (MariaDB IF NOT EXISTS). Additive only.

-- Defaulter / Overall collection / Income / Expense reports: receipt lookups per student + head + month,
-- and "last receipt date" per student
ALTER TABLE `receipts`
  ADD INDEX IF NOT EXISTS `idx_receipts_student_head_month` (`student_id`, `fee_head_name`(60), `months`(20)),
  ADD INDEX IF NOT EXISTS `idx_receipts_student_session_created` (`student_id`, `session_id`, `created_at`),
  ADD INDEX IF NOT EXISTS `idx_receipts_session_date` (`session_id`, `date_time`);

-- Fee / route plan lookups and discounts
ALTER TABLE `fees_plan`  ADD INDEX IF NOT EXISTS `idx_fees_plan_group`  (`fee_group_id`);
ALTER TABLE `route_plan` ADD INDEX IF NOT EXISTS `idx_route_plan_group` (`fee_group_id`);
ALTER TABLE `fee_discounts`
  ADD INDEX IF NOT EXISTS `idx_fee_discounts_ss` (`student_session_id`),
  ADD INDEX IF NOT EXISTS `idx_fee_discounts_updated` (`updated_date`);
ALTER TABLE `route_head` ADD INDEX IF NOT EXISTS `idx_route_head_session` (`session_id`);
ALTER TABLE `fee_head`   ADD INDEX IF NOT EXISTS `idx_fee_head_session`   (`session_id`);

-- Attendance report (date range + holiday check)
ALTER TABLE `student_attendences`
  ADD INDEX IF NOT EXISTS `idx_sa_session_date` (`student_session_id`, `date`),
  ADD INDEX IF NOT EXISTS `idx_sa_date_type` (`date`, `attendence_type_id`);
