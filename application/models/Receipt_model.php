<?php
class Receipt_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date    = $this->setting_model->getDateYmd();
    }

    // public function insert_receipt($insert_data)
    // {
    //     // Start a transaction to ensure that the insert is successful
    //     $this->db->trans_start();

    //     // Insert data into the 'receipts' table
    //     $this->db->insert('receipts', $insert_data);

    //     $a=$this->db->insert_id();
        
    //     // Check if the insert was successful
    //     if ($this->db->trans_status() === FALSE) {
    //         // Rollback the transaction if something went wrong
    //         $this->db->trans_complete();
    //         // Return false if insertion failed
    //         return $a;
    //     } else {
    //         // Commit the transaction if everything is successful
    //         $this->db->trans_complete();
    //         // Return the inserted ID
    //         return $a;
    //     }
    // }

    public function insert_receipt($insert_data)
    {
        // Define the condition to check if the same data already exists
        $this->db->where($insert_data);
        $query = $this->db->get('receipts');

        // If record exists, skip insertion
        if ($query->num_rows() > 0) {
            return 'duplicate'; // or return false / 0 based on your handling
        }

        // Start a transaction
        $this->db->trans_start();

        // Insert the new data
        $this->db->insert('receipts', $insert_data);
        $insert_id = $this->db->insert_id();

        // Check if the insert was successful
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_complete();
            return false;
        } else {
            $this->db->trans_complete();
            return $insert_id;
        }
    }


    public function check_existing_entry($student_id, $month, $fee_head_type,$fee_head)
    {
        // Query the database to check if the combination exists
        $this->db->select('id');  // Select any field (e.g., `id`), just to check existence
        $this->db->from('receipts');  // Replace with your actual table name
        $this->db->where('student_id', $student_id);
        $this->db->where('months', $month);
        $this->db->where('fee_head', $fee_head);
        $this->db->where('fee_head_type', $fee_head_type);

        // Execute the query
        $query = $this->db->get();

        // If a record is found, return true (meaning record exists)
        if ($query->num_rows() > 0) {
            return true;  // Record exists
        } else {
            return false;  // No such record
        }
    }


    public function update_student($id, $fees_discount)
    {
        // Prepare the data to update
        $data = array(
            'fees_discount' => $fees_discount
        );

        // Perform the update
        $this->db->where('student_id', $id); // Condition to match the student ID
        $this->db->update('student_session', $data); // Update the `students` table

        // Check if update was successful
        if ($this->db->affected_rows() > 0) {
            return true; // Successful update
        } else {
            return false; // No rows affected, meaning update didn't happen
        }
    }

    

    public function get_pay_mounth($id){
        $this->db->select('DISTINCT(months)');
        $this->db->from('receipts');
        $this->db->where('student_id', $id);
        $query = $this->db->get();
        $result = $query->result();

        $months_array = array_map(function($row) {
            return $row->months;
        }, $result);
 
        return $months_array;
    }



    public function get_receipts_by_ids($ids = []) {
        return $this->db
                ->select('student_id,date_time,back_id,receipt_no,mode,fee_head,late_fees,ledger_amt,total_fees,discount_amt,net_fees,receipt_amt,balance_amt,remarks,fee_head_name,SUM(balance_amount) as balance_amount,(total) as total, SUM(rec_discount) as rec_discount, SUM(rec_amount) as rec_amount')
                ->where_in('id', $ids)
                ->group_by('fee_head')
                ->get('receipts')
                ->result();
    }
    

    public function getStudentsPrint($student_id = null)
    {

        
        $this->db->select('
            classes.id AS class_id,
            student_session.id as student_session_id,
            student_session.fees_discount as fees_discount,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        // $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('users.role', 'student');

        // Filter by student ID if provided
        if (!empty($student_id)) {
            $this->db->where('students.id', $student_id);
        }

        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }



    public function get_last_receipt_id()
    {
        $this->db->select_max('sr_no'); 
		$this->db->limit(1);
		$query = $this->db->get('receipts');

        if ($query->num_rows() > 0) {
			$row = $query->row();
			$max_id = $row->sr_no;
			$next_id = $max_id +1;
            return $next_id;
        } else {
            return 1; // Or 0, depending on your logic
        }
    }
	
	public function get_last_receipt_id_bck()
    {
        $this->db->select('sr_no'); // Replace 'id' with your actual primary key column if different
        $this->db->from('receipts');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->sr_no+1;
        } else {
            return 1; // Or 0, depending on your logic
        }
    }


    // reportbyname

    public function get_receipt($limit, $offset,$from_date = null, $to_date = null)
    {
         //    echo $from_date;
        // die;
        $this->db->select('
            receipts.*,
            receipts.receipt_no,
            receipts.id as receipts_id,
            GROUP_CONCAT(DISTINCT receipts.months ORDER BY receipts.months SEPARATOR ", ") AS receipt_months,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(receipts.date_time) >=', $from_date);
            $this->db->where('DATE(receipts.date_time) <=', $to_date);
        }

        $this->db->group_by('receipts.receipt_no');
        $this->db->order_by('receipts.date_time', 'DESC');
		$this->db->order_by('receipts.id', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result();

    }

    public function get_receipt_count($from_date = null, $to_date = null)
    {
        $this->db->select('receipts.receipt_no'); // Select only grouped field
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('users', 'users.user_id = students.id', 'left');
         if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(receipts.date_time) >=', $from_date);
            $this->db->where('DATE(receipts.date_time) <=', $to_date);
        }
        $this->db->group_by('receipts.receipt_no');
        
        $query = $this->db->get();
        return $query->num_rows(); // This returns the count of grouped rows
    }





    public function get_deleted_receipt($limit, $offset,$from_date = null, $to_date = null)
    {
         //    echo $from_date;
        // die;
        $this->db->select('
            deleted_receipts.*,
            deleted_receipts.receipt_no,
            deleted_receipts.id as receipts_id,
            GROUP_CONCAT(DISTINCT deleted_receipts.months ORDER BY deleted_receipts.months SEPARATOR ", ") AS receipt_months,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('deleted_receipts');
        $this->db->join('students', 'students.id = deleted_receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(receipts.date_time) >=', $from_date);
            $this->db->where('DATE(receipts.date_time) <=', $to_date);
        }

        $this->db->group_by('deleted_receipts.receipt_no');
        $this->db->order_by('deleted_receipts.id', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result();

    }


    // deleted_receipts








    public function get_deleted_receipt_count($from_date = null, $to_date = null)
    {
        $this->db->select('deleted_receipts.receipt_no'); // Select only grouped field
        $this->db->from('deleted_receipts');
        $this->db->join('students', 'students.id = deleted_receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('users', 'users.user_id = students.id', 'left');
         if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('DATE(deleted_receipts.date_time) >=', $from_date);
            $this->db->where('DATE(deleted_receipts.date_time) <=', $to_date);
        }
        $this->db->group_by('deleted_receipts.receipt_no');
        
        $query = $this->db->get();
        return $query->num_rows(); // This returns the count of grouped rows
    }










    public function get_receipt_expense($limit, $offset,$filters=[])
    {
    //    echo $from_date;
        // die;
        $this->db->select('
            receipts.*,
            receipts.receipt_no,
            GROUP_CONCAT(DISTINCT receipts.months ORDER BY receipts.months SEPARATOR ", ") AS receipt_months,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        
        if (!empty($filters['feesHead']) and $filters['feesHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['feesHead']);
        }
        if (!empty($filters['routeHead']) and $filters['routeHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['routeHead']);
        }
        if (!empty($filters['categoryHead']) and $filters['categoryHead']!='All') {
            $this->db->where('students.category_id', $filters['categoryHead']);
        }
        if (!empty($filters['class_id']) and $filters['class_id']!='All') {
            $this->db->where('student_session.class_id', $filters['class_id']);
        }
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $this->db->where('DATE(receipts.date_time) >=', $filters['from_date']);
            $this->db->where('DATE(receipts.date_time) <=', $filters['to_date']);
        }
        $this->db->group_by('receipts.receipt_no');
        $this->db->order_by('receipts.id', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result();

    }














    public function get_receipt_expense_count($filters=[])
    {
        $this->db->select('receipts.receipt_no'); // Select only grouped field
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        if (!empty($filters['feesHead']) and $filters['feesHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['feesHead']);
        }
        if (!empty($filters['routeHead']) and $filters['routeHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['routeHead']);
        }
        if (!empty($filters['categoryHead']) and $filters['categoryHead']!='All') {
            $this->db->where('students.category_id', $filters['categoryHead']);
        }
        if (!empty($filters['class_id']) and $filters['class_id']!='All') {
            $this->db->where('student_session.class_id', $filters['class_id']);
        }
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $this->db->where('DATE(receipts.date_time) >=', $filters['from_date']);
            $this->db->where('DATE(receipts.date_time) <=', $filters['to_date']);
        }
        $this->db->group_by('receipts.receipt_no');
        
        $query = $this->db->get();
        return $query->num_rows(); // This returns the count of grouped rows
    }






    public function get_student_receipt($limit, $offset,$id)
    {
        

        $this->db->select('
            receipts.*,
            receipts.receipt_no,
            GROUP_CONCAT(DISTINCT receipts.months ORDER BY receipts.months SEPARATOR ", ") AS receipt_months,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('receipts.student_id', $id);
        $this->db->group_by('receipts.receipt_no');
        $this->db->order_by('receipts.id', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result();


        // $this->db->select('receipts.*,classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.middlename,students.lastname,students.image,    students.mobileno,students.vehroute_id, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.app_key ,students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('receipts');
        // $this->db->join('students', 'students.id = receipts.student_id');
        // $this->db->join('student_session', 'student_session.student_id = students.id');
        // $this->db->join('classes', 'student_session.class_id = classes.id');
        // $this->db->join('sections', 'sections.id = student_session.section_id');
        // $this->db->join('categories', 'students.category_id = categories.id', 'left');
        // $this->db->join('users', 'users.user_id = students.id', 'left');
        // $this->db->group_by('receipts.receipt_no');
        // $this->db->order_by('receipts.id', 'DESC');
        // $this->db->limit($limit, $offset);
        // $query = $this->db->get();
        // return $query->result();
    }

    public function get_receipt_student_count($id)
    {
        
        $this->db->select('receipts.receipt_no'); // Select only grouped field
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('receipts.student_id', $id);
        $this->db->group_by('receipts.receipt_no');
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    

    // income

    public function get_receipt_expense_list($limit, $offset,$filters = [])
    {

//         error_reporting(E_ALL);
// ini_set('display_errors', 1);
     
        $this->db->select('
            receipts.*,
            MAX(receipts.date_time) as receipt_date,
            GROUP_CONCAT(DISTINCT receipts.months ORDER BY receipts.months SEPARATOR ", ") AS receipt_months,
            SUM(receipts.total) as total_amount,
            MAX(students.admission_no) as admission_no,
            MAX(students.roll_no) as roll_no,
            MAX(students.admission_date) as admission_date,
            MAX(students.firstname) as firstname,
            MAX(students.middlename) as middlename,
            MAX(students.lastname) as lastname,
            MAX(students.image) as image,
            MAX(students.mobileno) as mobileno,
            MAX(students.vehroute_id) as vehroute_id,
            MAX(students.email) as email,
            MAX(students.state) as state,
            MAX(students.city) as city,
            MAX(students.pincode) as pincode,
            MAX(students.religion) as religion,
            MAX(students.dob) as dob,
            MAX(students.current_address) as current_address,
            MAX(students.permanent_address) as permanent_address,
            IFNULL(MAX(students.category_id), 0) as category_id,
            IFNULL(MAX(categories.category), "") as category,
            MAX(students.adhar_no) as adhar_no,
            MAX(students.samagra_id) as samagra_id,
            MAX(students.bank_account_no) as bank_account_no,
            MAX(students.bank_name) as bank_name,
            MAX(students.ifsc_code) as ifsc_code,
            MAX(students.guardian_name) as guardian_name,
            MAX(students.app_key) as app_key,
            MAX(students.guardian_relation) as guardian_relation,
            MAX(students.guardian_phone) as guardian_phone,
            MAX(students.guardian_address) as guardian_address,
            MAX(students.is_active) as student_active,
            MAX(students.created_at) as student_created_at,
            MAX(students.updated_at) as student_updated_at,
            MAX(students.father_name) as father_name,
            MAX(students.rte) as rte,
            MAX(students.gender) as gender,
            
            MAX(users.id) as user_tbl_id,
            MAX(users.username) as username,
            MAX(users.password) as user_tbl_password,
            MAX(users.is_active) as user_tbl_active,

            MAX(classes.id) as class_id,
            MAX(classes.class) as class,
            MAX(sections.id) as section_id,
            MAX(sections.section) as section
        ');

        $this->db->from('receipts');
        // $this->db->join('route_head', 'route_head.fees_heading = receipts.fee_head_name', 'inner');
        // $this->db->join('route_head', 'route_head.fees_heading COLLATE utf8mb4_general_ci = receipts.fee_head_name', 'inner');
        // $this->db->join('route_head', "CONVERT(route_head.fees_heading USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT(receipts.fee_head_name USING utf8mb4) COLLATE utf8mb4_unicode_ci", 'inner');
        $this->db->join('route_head', 'CAST(route_head.fees_heading AS CHAR CHARACTER SET utf8mb4) = CAST(receipts.fee_head_name AS CHAR CHARACTER SET utf8mb4)', 'inner');



        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        // $this->db->join('route_head', 'route_head.fees_heading = receipts.fee_head_name', 'left');
        
        $this->db->where('receipts.fee_head_name !=', 'Ledger Amount');


        if (!empty($filters['feesHead']) and $filters['feesHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['feesHead']);
        }
        if (!empty($filters['routeHead']) and $filters['routeHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['routeHead']);
        }
        if (!empty($filters['categoryHead']) and $filters['categoryHead']!='All') {
            $this->db->where('students.category_id', $filters['categoryHead']);
        }
        if (!empty($filters['class_id']) and $filters['class_id']!='All') {
            $this->db->where('student_session.class_id', $filters['class_id']);
        }
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $this->db->where('DATE(receipts.date_time) >=', $filters['from_date']);
            $this->db->where('DATE(receipts.date_time) <=', $filters['to_date']);
        }

        $this->db->group_by(['receipts.receipt_no', 'receipts.fee_head_name']);
        $this->db->order_by('MAX(receipts.id)', 'DESC');

        // $this->db->group_by(['receipts.receipt_no', 'receipts.fee_head_name']);

        // $this->db->order_by('MAX(receipts.id)', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return  $query->result();

        

        /*
        $this->db->distinct();
        $this->db->select('
            receipts.*,
            receipts.receipt_no,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('receipts.fee_head_name !=', 'Ledger Amount');

        // $this->db->group_by('receipts.fee_head_type');
        $this->db->group_by(['receipts.receipt_no','receipts.student_id', 'receipts.months', 'receipts.fee_head_name']);

        
        $this->db->order_by('receipts.id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        return $query->result();

        */

    }

    public function get_receipt_income($limit, $offset,$filters = [])
    {

        // var_dump($filters); die;

//         error_reporting(E_ALL);
// ini_set('display_errors', 1);

        $this->db->select('
            receipts.*,
            MAX(receipts.date_time) as receipt_date,
            GROUP_CONCAT(DISTINCT receipts.months ORDER BY receipts.months SEPARATOR ", ") AS receipt_months,
            SUM(receipts.total) as total_amount,
            MAX(students.admission_no) as admission_no,
            MAX(students.roll_no) as roll_no,
            MAX(students.admission_date) as admission_date,
            MAX(students.firstname) as firstname,
            MAX(students.middlename) as middlename,
            MAX(students.lastname) as lastname,
            MAX(students.image) as image,
            MAX(students.mobileno) as mobileno,
            MAX(students.vehroute_id) as vehroute_id,
            MAX(students.email) as email,
            MAX(students.state) as state,
            MAX(students.city) as city,
            MAX(students.pincode) as pincode,
            MAX(students.religion) as religion,
            MAX(students.dob) as dob,
            MAX(students.current_address) as current_address,
            MAX(students.permanent_address) as permanent_address,
            IFNULL(MAX(students.category_id), 0) as category_id,
            IFNULL(MAX(categories.category), "") as category,
            MAX(students.adhar_no) as adhar_no,
            MAX(students.samagra_id) as samagra_id,
            MAX(students.bank_account_no) as bank_account_no,
            MAX(students.bank_name) as bank_name,
            MAX(students.ifsc_code) as ifsc_code,
            MAX(students.guardian_name) as guardian_name,
            MAX(students.app_key) as app_key,
            MAX(students.guardian_relation) as guardian_relation,
            MAX(students.guardian_phone) as guardian_phone,
            MAX(students.guardian_address) as guardian_address,
            MAX(students.is_active) as student_active,
            MAX(students.created_at) as student_created_at,
            MAX(students.updated_at) as student_updated_at,
            MAX(students.father_name) as father_name,
            MAX(students.rte) as rte,
            MAX(students.gender) as gender,
            
            MAX(users.id) as user_tbl_id,
            MAX(users.username) as username,
            MAX(users.password) as user_tbl_password,
            MAX(users.is_active) as user_tbl_active,

            MAX(classes.id) as class_id,
            MAX(classes.class) as class,
            MAX(sections.id) as section_id,
            MAX(sections.section) as section
        ');

        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        
        $this->db->where('receipts.fee_head_name !=', 'Ledger Amount');


        if (!empty($filters['feesHead']) and $filters['feesHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['feesHead']);
        }
        if (!empty($filters['routeHead']) and $filters['routeHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['routeHead']);
        }
        if (!empty($filters['categoryHead']) and $filters['categoryHead']!='All') {
            $this->db->where('students.category_id', $filters['categoryHead']);
        }
        if (!empty($filters['class_id']) and $filters['class_id']!='All') {
            $this->db->where('student_session.class_id', $filters['class_id']);
        }
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $this->db->where('DATE(receipts.date_time) >=', $filters['from_date']);
            $this->db->where('DATE(receipts.date_time) <=', $filters['to_date']);
        }

        $this->db->group_by(['receipts.receipt_no', 'receipts.fee_head_name']);

        $this->db->order_by('MAX(receipts.id)', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return  $query->result();

        

        /*
        $this->db->distinct();
        $this->db->select('
            receipts.*,
            receipts.receipt_no,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('receipts.fee_head_name !=', 'Ledger Amount');

        // $this->db->group_by('receipts.fee_head_type');
        $this->db->group_by(['receipts.receipt_no','receipts.student_id', 'receipts.months', 'receipts.fee_head_name']);

        
        $this->db->order_by('receipts.id', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        return $query->result();

        */

    }


   
   public function get_fiscal_order_receipt_months($from_date, $to_date)
    {
        $this->db->select('GROUP_CONCAT(DISTINCT months SEPARATOR ",") AS all_months');
        $this->db->from('receipts');

        // Date filter on receipt_date column
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('receipt_date >=', $from_date);
            $this->db->where('receipt_date <=', $to_date);
        }

        $query = $this->db->get();
        $result = $query->row();

        if ($result && $result->all_months) {
            $fetched_months_raw = explode(',', $result->all_months);
            $fetched_months = array_map('trim', $fetched_months_raw);

            // Define fiscal year order
            $fiscal_order = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];

            // Sort according to fiscal year
            $sorted_months = array_values(array_filter($fiscal_order, function($month) use ($fetched_months) {
                return in_array($month, $fetched_months);
            }));

            return $sorted_months;
        }

        return [];
    }

    


    public function get_receipt_count_income($filters = [])
    {
        $this->db->select('receipts.receipt_no'); // Select only grouped field
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('receipts.fee_head_name !=', 'Ledger Amount');


        if (!empty($filters['feesHead']) and $filters['feesHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['feesHead']);
        }
        if (!empty($filters['routeHead']) and $filters['routeHead']!='All') {
            $this->db->where('receipts.fee_head_name', $filters['routeHead']);
        }
        if (!empty($filters['categoryHead']) and $filters['categoryHead']!='All') {
            $this->db->where('students.category_id', $filters['categoryHead']);
        }
        if (!empty($filters['class_id']) and $filters['class_id']!='All') {
            $this->db->where('student_session.class_id', $filters['class_id']);
        }
        if (!empty($filters['from_date']) && !empty($filters['to_date'])) {
            $this->db->where('DATE(receipts.date_time) >=', $filters['from_date']);
            $this->db->where('DATE(receipts.date_time) <=', $filters['to_date']);
        }


        $this->db->group_by(['receipts.receipt_no', 'receipts.fee_head_name']);

        //$this->db->group_by('receipts.receipt_no');
    
        $query = $this->db->get();
        return $query->num_rows(); // This returns the count of grouped rows
    }






    // get_receipt_student



    public function get_receipt_student($limit = null, $offset = null, $class_id = [], $section_id = [], $selectedroutes = [],$id=null)
    {


        $class_ids=[];
        $section_ids=[];
        if(!empty($class_id)){
            foreach($class_id as $key=>$value){
                $dts=explode('-',$value);
                array_push($class_ids,$dts[0]);
                array_push($section_ids,$dts[1]);
            }
        }

        

        $this->db->select('
            student_session.transport_fees,
            students.vehroute_id,
            vehicle_routes.route_id,
            vehicle_routes.vehicle_id,
            transport_route.route_title,
            vehicles.vehicle_no,
            hostel_rooms.room_no,
            vehicles.driver_name,
            vehicles.driver_contact,
            hostel.id as hostel_id,
            hostel.hostel_name,
            room_types.id as room_type_id,
            room_types.room_type,
            students.hostel_room_id,
            student_session.id as student_session_id,
            student_session.fees_discount,
            classes.id AS class_id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.id as student_id,
            students.id,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.note,
            students.religion,
            students.cast,
            school_houses.house_name,
            students.dob,
            students.current_address,
            students.previous_school,
            students.guardian_is,
            students.parent_id,
            students.permanent_address,
            students.category_id,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.father_pic,
            students.height,
            students.weight,
            students.measurement_date,
            students.mother_pic,
            students.guardian_pic,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.father_phone,
            students.blood_group,
            students.school_house_id,
            students.father_occupation,
            students.mother_name,
            students.mother_phone,
            students.mother_occupation,
            students.guardian_occupation,
            students.gender,
            students.guardian_is,
            students.rte,
            students.guardian_email,
            users.username,
            users.password,
            students.dis_reason,
            students.dis_note,
            students.app_key,
            students.parent_app_key
        ');
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id', 'left');
        $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
        $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
        $this->db->join('vehicle_routes', 'vehicle_routes.id = students.vehroute_id', 'left');
        $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
        $this->db->join('school_houses', 'school_houses.id = students.school_house_id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        // Filters
        if (!empty($class_ids)) {
            $this->db->where_in('student_session.class_id', $class_ids);
        }
        if (!empty($section_ids)) {
            $this->db->where_in('student_session.section_id', $section_ids);
        }

        if (!empty($section_id)) {
            $this->db->where_in('students.category_id', $section_id);
        }
        if (!empty($selectedroutes)) {
            $this->db->where_in('students.vehroute_id', $selectedroutes);
        }

        
        // selectedroutes
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('users.role', 'student');

        if (!is_null($id)) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->where('students.is_active', 'yes');
            $this->db->order_by('students.id', 'desc');

            if ($limit !== null && $offset !== null) {
                $this->db->limit($limit, $offset);
            } elseif ($limit !== null) {
                $this->db->limit($limit);
            }
        }

        $query = $this->db->get();

        return (!is_null($id)) ? $query->row_array() : $query->result_array();
    }



    public function get_receipt_count_student($class_id = [], $section_id = [],$selectedroutes=[])
    {
        $this->db->select('students.id'); // Selecting a distinct student ID is enough
        $this->db->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        // Filters
        if (!empty($class_id)) {
            $this->db->where_in('student_session.class_id', $class_id);
        }
        if (!empty($section_id)) {
            $this->db->where_in('student_session.section_id', $section_id);
        }
        if (!empty($selectedroutes)) {
            $this->db->where_in('students.vehroute_id', $selectedroutes);
        }

        $this->db->where('students.is_active', 'yes');
        $this->db->where('users.role', 'student');

        // Optionally group if needed, e.g., by student ID
        $this->db->group_by('students.id');

        $query = $this->db->get();

        return $query->num_rows(); // Return the count of matching students
    }






    // public function delete_receipt($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('receipts');

    //     if ($this->db->affected_rows() > 0) {
    //         return true; // Successfully deleted
    //     } else {
    //         return false; // Not deleted or not found
    //     }
    // }


    public function get_receipts_by_receipt_no($receipt_no) {
        return $this->db->get_where('receipts', ['receipt_no' => $receipt_no])->result_array();
    }

    public function backup_receipt_data($data) {
        return $this->db->insert('deleted_receipts', $data);
    }

    public function delete_receipts_by_receipt_no($receipt_no) {
        return $this->db->delete('receipts', ['receipt_no' => $receipt_no]);
    }

	public function search_fee_slip($receipt_no)
    {
         //    echo $from_date;
        // die;
        $this->db->select('
            receipts.*,
            receipts.receipt_no,
            receipts.id as receipts_id,
            GROUP_CONCAT(DISTINCT receipts.months ORDER BY receipts.months SEPARATOR ", ") AS receipt_months,
            classes.id AS class_id,
            student_session.id as student_session_id,
            students.id,
            classes.class,
            sections.id AS section_id,
            sections.section,
            students.admission_no,
            students.roll_no,
            students.admission_date,
            students.firstname,
            students.middlename,
            students.lastname,
            students.image,
            students.mobileno,
            students.vehroute_id,
            students.email,
            students.state,
            students.city,
            students.pincode,
            students.religion,
            students.dob,
            students.current_address,
            students.permanent_address,
            IFNULL(students.category_id, 0) as category_id,
            IFNULL(categories.category, "") as category,
            students.adhar_no,
            students.samagra_id,
            students.bank_account_no,
            students.bank_name,
            students.ifsc_code,
            students.guardian_name,
            students.app_key,
            students.guardian_relation,
            students.guardian_phone,
            students.guardian_address,
            students.is_active,
            students.created_at,
            students.updated_at,
            students.father_name,
            students.rte,
            students.gender,
            users.id as user_tbl_id,
            users.username,
            users.password as user_tbl_password,
            users.is_active as user_tbl_active
        ');
        $this->db->from('receipts');
        $this->db->join('students', 'students.id = receipts.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');

        if (!empty($receipt_no)) {
            $this->db->where('receipts.receipt_no', $receipt_no);
        }

        $this->db->group_by('receipts.receipt_no');
        $this->db->order_by('receipts.id', 'DESC');
        //$this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result();

    }
}
