-- Run ONCE on the live database (phpMyAdmin > SQL). Safe to re-run (IF NOT EXISTS, MariaDB).
-- Speeds up Student Attendance filter, Attendance By Date and attendance reports.

-- Lookup of one student's attendance on a date: (student_session_id, date)
ALTER TABLE `student_attendences`
  ADD INDEX IF NOT EXISTS `idx_sa_session_date` (`student_session_id`, `date`),
  ADD INDEX IF NOT EXISTS `idx_sa_date_type` (`date`, `attendence_type_id`);

-- Class/section filter: session + class + section + active in one index
ALTER TABLE `student_session`
  ADD INDEX IF NOT EXISTS `idx_ss_filter` (`session_id`, `class_id`, `section_id`, `is_active`);
