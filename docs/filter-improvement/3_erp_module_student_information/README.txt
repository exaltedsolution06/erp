Module 1 - Student Information (filter / load speed)
====================================================
1) Copy the files over your project (same paths).
2) Run database/student_information_indexes.sql once.
(Install erp_core_update.zip too - it removes per-row DB calls in the lists.)

Changed files
- application/controllers/Student.php
    * Disabled Students page no longer loads every disabled student on each visit (result was never used).
    * student/getByClassAndSection (class -> student dropdown used by ~20 Fees/Report pages) uses the light query.
- application/models/Student_model.php
    * New searchByClassSectionLite(): same students/order, no custom-field joins, no 50 profile columns.
- application/models/Studentsession_model.php
    * Multi Class Student: one query for all students instead of one per student.
- database/student_information_indexes.sql  (run once; not a project file)

Not changed (by design): Student Details search screens still use the full query because the table
shows custom fields and many columns. Their speed-up comes from the indexes above.
