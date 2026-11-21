# ERP – Filter / Load Speed Notes (module-wise)

Scope: every module's filter/search page, code (CodeIgniter 3) + database (u731855585_demoerp.sql).
Status legend: DONE = delivered in a zip, NEXT = planned, in the order shown.

## Findings that affect EVERY module
| # | Finding | Impact | Fix |
|---|---------|--------|-----|
| C1 | `customlib->getSchoolDateFormat()` runs a 3-table DB query (`setting_model->get()`) on every call. 202 view files call it, most **inside row loops** (2 queries per student row on the Student list). | Very high | Per-request cache in `Setting_model::get()` – **DONE (Core zip)** |
| C2 | `customlib->getUserData()` = 2 queries each call; controllers + views call it several times per page. | High | Per-request cache – **DONE (Core zip)** |
| C3 | `rbac->hasPrivilege()` does `getStaffRole()` + `json_encode/json_decode` on every call (called per row in lists). | Medium | Cache role name – **DONE (Core zip)** |
| C4 | No list uses server-side DataTables (`serverSide` appears in 0 views). Every filter loads all rows into the HTML. | High on big schools | Per module: trim columns, paginate/limit where safe |
| C5 | Almost no composite indexes; many `session_id`, `date`, `*_id` filter columns unindexed (see per-module SQL). | High | Index SQL shipped inside each module zip |
| C6 | `date`, `month()`, `year()`, `DATE()` wrapped around indexed columns (Receipt_model 24x, Income 8x, Expense 7x). Prevents index use. | Medium | Rewrite as date ranges per module |
| C7 | Leftover copies in controllers: `Cron - Copy*.php`, `Studentfee - Copy (1-3).php`, `Modulepermission_07-08-2026.php`, `controllers/user/User-10-08-2026.php`. | Security/cleanup | Delete from server (not a speed fix) |

## Module order (highest user impact first)
| Order | Module | Where the slowness is | Planned fix |
|-------|--------|-----------------------|-------------|
| 0 | Attendance – Student Attendance (+ By Date, class report) | whole `student_attendences` loaded on every search; derived-table SQL; no (student_session_id,date) index | **DONE** (erp_attendance_update.zip) |
| 0b | Core (all modules) | C1–C3 above | **DONE** (erp_core_update.zip) |
| 1 | Student Information (search by class/section, keyword, admission no; student list page) | `Student::index()` loads ALL students with 13 joins; `searchFullText` ORs ~33 columns with `%LIKE%`; `custom_field_values` joined once per custom field with no index on `belong_table_id`; `students.admission_no`, `students.is_active` unindexed | Index SQL + query trimming |
| 2 | Fees Collection (collect fee, search due fees, search payment, fee-by-class report) | N+1: one fee query **per student** in `reportbyclass` and `feesearch`; `student_fees_master` has no index on `student_session_id`; `receipts` has none on `session_id`/`student_id` | Single joined query per filter + indexes |
| 3 | Reports (Report.php, 2,787 lines: fee, finance, attendance, student reports) | 19 loops that call a model per row; Receipt_model uses date functions on columns | Batch queries, date ranges, indexes |
| 4 | Income / Expense (and balance sheet search) | `balance_sheets` has **no index** except PK; search by student name uses `LIKE` on joined students | Indexes (session_id, balance_type, date, head_id) |
| 5 | Examinations (Exam result, Marksheet, Report card) | `getStudentResultByExam` called per student; no index on `exam_group_students.student_session_id` | Batch result load + indexes |
| 6 | Homework / Lesson Plan / Syllabus | `homework` has no index on class_id/section_id/session_id/subject_id; N+1 in Lessonplan | Indexes + batch |
| 7 | Human Resource (Staff, Payroll, Staff attendance, Leave) | `staff` no index on session_id/is_active/user_id; `staff_attendance` none on date/session_id; Staff controller N+1 | Indexes + batch |
| 8 | Library, Inventory, Transport, Hostel | `book_issues`, `item_stock`, `item_issue`, `vehicle_routes`, `hostel_rooms` missing FK/session indexes | Indexes + joins |
| 9 | Communicate (Mailsms), Front Office (visitors/enquiry/complaint/dispatch), Download Center | Mailsms N+1 (19 loops); `date` columns unindexed | Batch + indexes |
| 10 | Alumni, Online Exam, Certificate/ID card, Teacher | class/section filters repeat the same student query per row | Per-module review |

## How each module zip will be delivered
- Only changed files, same folder paths as your project (copy over).
- `database/<module>_indexes.sql` – run once, safe to re-run (`ADD INDEX IF NOT EXISTS`, MariaDB).
- `README.txt` with the file list. I'll mention anything I could not test.

## Notes / cautions
- I can't run PHP/MySQL against your live data here, so test each zip on a copy of the site first.
- Index SQL is additive only (no data changes). If the demo DB is small, the speed gain shows on the real school database.
