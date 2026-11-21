Module 2 - Fees Collection (filter / load speed)
================================================
1) Copy the files over your project (same paths).
2) Run database/fees_collection_indexes.sql once.

Changed files
- application/models/Receipt_model.php
    * get_receipt_count / get_deleted_receipt_count: counted in SQL (COUNT DISTINCT) instead of
      loading every receipt group into PHP just to count rows. They now use the same session filters
      as the list queries, so page counts match the rows shown.
    * Date filters use index-friendly ranges instead of DATE(date_time). Falls back to the old form
      if a non Y-m-d date is passed.
    (Receipt reports under Reports > Finance use the same pattern; they come in Module 3.)
- application/views/studentfee/reportFees_List.php    (Fee List)
- application/views/studentfee/fee_register.php       (Fee Register)
- application/views/studentfee/studentfee_deletedlist.php (Deleted receipts)
    * Fee group / route names (and the student's session in the deleted list) are loaded once,
      not with 4-6 database queries per row.
- database/fees_collection_indexes.sql  (run once; not a project file)

Receipt Book, Collect Fees search and Search Fee Slip need no code change: they use the model
functions above and the Student search from Module 1.
