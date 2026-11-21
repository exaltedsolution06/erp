Module 3 - Reports (filter / load speed)
========================================
1) Copy the files over your project (same paths). This zip includes the latest Receipt_model.php
   (contains the Module 2 changes) and Stuattendence_model.php (contains the Attendance changes),
   so it is safe to apply after them.
2) Run database/reports_indexes.sql once.

New file
- application/helpers/report_cache.php   per-request cache used by the fee report views

Changed files
- application/views/reports/defaulter_list.php, overall_collection_report.php, income.php,
  incomegroup.php, expensegroup.php, expense.php, discountedstudent.php
    These pages calculated dues inside the view with several queries PER STUDENT (fee plan with
    JSON_CONTAINS, discounts, receipts per month, route plan, names). Each distinct lookup now runs
    once per page; receipts for all listed students are loaded in one query. Calculation logic unchanged.
    The class-filter checkbox counts use one grouped query instead of one per class/section.
- application/models/Receipt_model.php   Date filters of the income/expense/overall/discount reports use
    index-friendly ranges (same _apply_date_range helper as Module 2).
- application/controllers/Report.php + application/models/Stuattendence_model.php
    Student attendance report: one query for the holidays of the whole range (was one per day) and an
    index-friendly date filter.

Not changed here (later modules): marks report / online exam rank (Examinations), lesson plan and
syllabus reports (Homework/Lesson), staff report (Human Resource).
