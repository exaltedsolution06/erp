Core speed-up (benefits every module)
=====================================
Copy over your project (same paths). No database changes needed.

Changed files
- application/models/Setting_model.php   (get() cached per request; cache cleared when settings are saved)
- application/libraries/Customlib.php    (getUserData() cached per request)
- application/libraries/Rbac.php         (hasPrivilege() no longer re-encodes JSON on every call)

Why: getSchoolDateFormat(), getUserData() and hasPrivilege() are called inside table rows in 200+ views,
and each call ran database queries / JSON work.
