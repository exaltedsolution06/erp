-- Module 2: Fees Collection. Run ONCE (phpMyAdmin > SQL). Safe to re-run (MariaDB IF NOT EXISTS). Additive only.

-- Fee List / Fee Register / Receipt Book / Fee Card: filter by session + date, student, back_id, receipt no
ALTER TABLE `receipts`
  ADD INDEX IF NOT EXISTS `idx_receipts_session_date` (`session_id`, `date_time`),
  ADD INDEX IF NOT EXISTS `idx_receipts_student` (`student_id`),
  ADD INDEX IF NOT EXISTS `idx_receipts_back_id` (`back_id`),
  ADD INDEX IF NOT EXISTS `idx_receipts_receipt_no` (`receipt_no`);

-- Deleted receipts list
ALTER TABLE `deleted_receipts`
  ADD INDEX IF NOT EXISTS `idx_delrec_session_date` (`session_id`, `date_time`),
  ADD INDEX IF NOT EXISTS `idx_delrec_student` (`student_id`),
  ADD INDEX IF NOT EXISTS `idx_delrec_receipt_no` (`receipt_no`);

-- Due fees / collect fee: student -> fee master -> deposits
ALTER TABLE `student_fees_master`
  ADD INDEX IF NOT EXISTS `idx_sfm_session_group` (`student_session_id`, `fee_session_group_id`),
  ADD INDEX IF NOT EXISTS `idx_sfm_group` (`fee_session_group_id`);

ALTER TABLE `student_fees_deposite`
  ADD INDEX IF NOT EXISTS `idx_sfd_master_feetype` (`student_fees_master_id`, `fee_groups_feetype_id`);

-- Also needed by these pages (already in the Module 1 script; safe to repeat):
ALTER TABLE `student_session`
  ADD INDEX IF NOT EXISTS `idx_ss_student_session` (`student_id`, `session_id`);
ALTER TABLE `users`
  ADD INDEX IF NOT EXISTS `idx_users_user_role` (`user_id`, `role`);
