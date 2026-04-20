<?php
session_start();
include 'include/dbconnect.php';

        // print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['csrf'])) {
        if ($_POST['csrf'] !== $_SESSION['csrf']) {
            die(json_encode([
                'status'=>'error',
                'message'=>'Invalid CSRF'
            ]));
        }
    }
    if (!isset($_POST['request'])) {
        die("Invalid request");
        header('employee-profile.php');
    }

    if ($_POST['request']=='addseminar') {

        $title = $_POST['title'];  
        $category = $_POST['category'];
        $sponsor = $_POST['sponsor']; 
        $hours = $_POST['hours']; 
        $semtype = $_POST['semtype']; 
        if ($_POST['startdate']!='') {
            $startdate = $_POST['startdate']; 
        }else{
            $startdate ="1970-01-01 00:00:00";
        }

        if ($_POST['enddate']!='') {
            $enddate = $_POST['enddate']; 
        }else{
            $enddate ="1970-01-01 00:00:00";
        }


        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("INSERT INTO employee_seminar 
                        (empid, empsem_category, empsem_title, empsem_date_start, empsem_date_end, empsem_hours, empsem_type, empsem_sponsor) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters to the placeholders (in order)
        $empid = $_SESSION['user_data_2']['empid'];  // You can replace this with a dynamic value (e.g., from session or another source)
        
        $stmt->bind_param(
            "isssssss", 
            $empid, 
            $category, 
            $title, 
            $startdate, 
            $enddate, 
            $hours, 
            $semtype, 
            $sponsor);
        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            header('location:employee-seminar.php');
        }
    }elseif ($_POST['request']=='editseminar') {

        $empsem = $_POST['empsem'];  
        $title = $_POST['title'];  
        $category = $_POST['category'];
        $sponsor = $_POST['sponsor']; 
        $hours = $_POST['hours']; 
        $semtype = $_POST['semtype']; 
        if ($_POST['startdate']!='') {
            $startdate = $_POST['startdate']; 
        }else{
            $startdate ="1970-01-01 00:00:00";
        }

        if ($_POST['enddate']!='') {
            $enddate = $_POST['enddate']; 
        }else{
            $enddate ="1970-01-01 00:00:00";
        }



        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("UPDATE employee_seminar 
                        SET empsem_category = ?, 
                            empsem_title = ?, 
                            empsem_date_start = ?, 
                            empsem_date_end = ?, 
                            empsem_hours = ?, 
                            empsem_type = ?, 
                            empsem_sponsor = ? 
                        WHERE empsem_id = ?");

        // Bind parameters to the placeholders (in order)
        $stmt->bind_param(
            "sssssssi", 
            $category, 
            $title, 
            $startdate, 
            $enddate, 
            $hours, 
            $semtype, 
            $sponsor,
            $empsem
            );
        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            header('location:employee-seminar.php');
        }
    }elseif($_POST['request']=='deleteseminar'){
        $empsem = $_POST['id']; 
        // $empedu = 0; 

        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("DELETE FROM employee_seminar WHERE empsem_id = ?");

        // Bind parameters to the placeholders (in order)
        // $empid = $_SESSION['user_data_2']['empid'];  // You can replace this with a dynamic value (e.g., from session or another source)
        
        $stmt->bind_param("i", 
            $empsem
        );
        // Execute the prepared statement
        $stmt->execute();
        // // $stmt=1;

        if ($stmt) {
            if ($stmt->affected_rows == 1) {  // Check if exactly one row was deleted
                $response = array(
                    'status' => 'success',
                    'message' => 'Data deleted successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No record was deleted. It may not exist.'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid data. '
            );
        }

        echo json_encode($response);
    }elseif ($_POST['request']=='addeducation') {

        $degree = $_POST['degree'];  
        $degreeName = $_POST['degreeName'];
        $school = $_POST['school']; 
        $status = $_POST['status']; 
        if ($_POST['graddate']!='') {
            $graddate = $_POST['graddate']; 
        }else{
            $graddate ="1970-01-01 00:00:00";
        }


        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("INSERT INTO employee_educational_attainments (fea_id, empid, fea_degree, fea_program, fea_school, fea_status, fea_date_graduated) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?)");

        // Bind parameters to the placeholders (in order)
        $empid = $_SESSION['user_data_2']['empid'];  // You can replace this with a dynamic value (e.g., from session or another source)
        
        $stmt->bind_param("isssss", 
            $empid, 
            $degree, 
            $degreeName, 
            $school, 
            $status, 
            $graddate
        );
        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            header('location:employee-education.php');
        }
    }elseif ($_POST['request']=='editeducation') {
        $degree = $_POST['degree'];  
        $degreeName = $_POST['degreeName'];
        $school = $_POST['school']; 
        $status = $_POST['status']; 
        $empedu = $_POST['empedu']; 

        if ($_POST['graddate']!='') {
            $graddate = $_POST['graddate']; 
        }else{
            $graddate ="1970-01-01 00:00:00";
        }


        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("UPDATE employee_educational_attainments 
                                SET 
                                    fea_degree = ?, 
                                    fea_program = ?, 
                                    fea_school = ?, 
                                    fea_status = ?, 
                                    fea_date_graduated = ?
                                WHERE fea_id = ?
                                AND empid = ?");

        // Bind parameters to the placeholders (in order)
        $empid = $_SESSION['auth']['db']['empid'];
        $stmt->bind_param("sssssii", 
            $degree, 
            $degreeName, 
            $school, 
            $status, 
            $graddate,
            $empedu,
            $empid
        );
        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            header('location:employee-education.php');
        }
    }elseif($_POST['request']=='deleteeducation'){
        $empedu = $_POST['id']; 
        // $empedu = 0; 

        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("DELETE FROM employee_educational_attainments 
                WHERE fea_id = ?
                AND empid = ?");

        // Bind parameters to the placeholders (in order)
        // $empid = $_SESSION['user_data_2']['empid'];  // You can replace this with a dynamic value (e.g., from session or another source)
        
        $empid = $_SESSION['auth']['db']['empid'];

        $stmt->bind_param(
            "ii",
            $empedu,
            $empid
        );
        // Execute the prepared statement
        $stmt->execute();
        // // $stmt=1;

        if ($stmt) {

            $_SESSION['csrf'] = bin2hex(random_bytes(32));
            if ($stmt->affected_rows == 1) {  // Check if exactly one row was deleted
                $response = array(
                    'status' => 'success',
                    'message' => 'Data deleted successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No record was deleted. It may not exist.'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid data. '
            );
        }

        echo json_encode($response);
    }elseif ($_POST['request']=='addeligibility') {
        $el_title = $_POST['el_title'];  
        $el_rating = $_POST['el_rating'];
        $el_date_conferment = $_POST['el_date_conferment']; 
        $el_place = $_POST['el_place']; 
        $el_number = $_POST['el_number']; 
        $el_date_validity = $_POST['el_date_validity']; 
        $el_id = $_POST['el_id']; 

        if ($_POST['el_date_conferment']!='') {
            $el_date_conferment = $_POST['el_date_conferment']; 
        }else{
            $el_date_conferment ="1970-01-01 00:00:00";
        }
        if ($_POST['el_date_validity']!='') {
            $el_date_validity = $_POST['el_date_validity']; 
        }else{
            $el_date_validity ="1970-01-01 00:00:00";
        }

        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("INSERT INTO employee_eligibility 
                        (empid, empel_title, empel_rating, empel_date_conferment, empel_place, empel_number, empel_date_validity) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("issssss", $empid, $el_title, $el_rating, $el_date_conferment, $el_place, $el_number, $el_date_validity);

        $empid = $_SESSION['user_data_2']['empid'];
        $el_title = $_POST['el_title'] ?? '';
        $el_rating = $_POST['el_rating'] ?? '';
        $el_date_conferment = $_POST['el_date_conferment'] ?? '';
        $el_place = $_POST['el_place'] ?? '';
        $el_number = $_POST['el_number'] ?? '';
        $el_date_validity = $_POST['el_date_validity'] ?? '';

        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            header('location:employee-eligibility.php');
        }
    }elseif ($_POST['request']=='editeligibility') {
        $el_title = $_POST['el_title'];  
        $el_rating = $_POST['el_rating'];
        $el_date_conferment = $_POST['el_date_conferment']; 
        $el_place = $_POST['el_place']; 
        $el_number = $_POST['el_number']; 
        $el_date_validity = $_POST['el_date_validity']; 
        $el_id = $_POST['el_id']; 

        if ($_POST['el_date_conferment']!='') {
            $el_date_conferment = $_POST['el_date_conferment']; 
        }else{
            $el_date_conferment ="1970-01-01 00:00:00";
        }
        if ($_POST['el_date_validity']!='') {
            $el_date_validity = $_POST['el_date_validity']; 
        }else{
            $el_date_validity ="1970-01-01 00:00:00";
        }


        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("UPDATE employee_eligibility 
                        SET 
                            empel_title = ?, 
                            empel_rating = ?, 
                            empel_date_conferment = ?, 
                            empel_place = ?, 
                            empel_number = ?, 
                            empel_date_validity = ? 
                        WHERE empel_id = ?");

        $stmt->bind_param("ssssssi", $el_title, $el_rating, $el_date_conferment, $el_place, $el_number, $el_date_validity, $el_id);

        $el_title = $_POST['el_title'] ?? '';
        $el_rating = $_POST['el_rating'] ?? '';
        $el_date_conferment = $_POST['el_date_conferment'] ?? '';
        $el_place = $_POST['el_place'] ?? '';
        $el_number = $_POST['el_number'] ?? '';
        $el_date_validity = $_POST['el_date_validity'] ?? '';
        $el_id = $_POST['el_id'] ?? 0;

        $stmt->execute();

        if ($stmt) {
            header('location:employee-eligibility.php');
        }
    }elseif($_POST['request']=='deleteeligibility'){
        $empel_id = $_POST['id'];

        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("DELETE FROM employee_eligibility WHERE empel_id = ?");

        // Bind parameters to the placeholders (in order)
        $stmt->bind_param("i", 
            $empel_id
        );

        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            if ($stmt->affected_rows == 1) {  // Check if exactly one row was deleted
                $response = array(
                    'status' => 'success',
                    'message' => 'Data deleted successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No record was deleted. It may not exist.'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid data.'
            );
        }

        echo json_encode($response);
    }elseif ($_POST['request']=='addwork') {

        $stmt = $conn->prepare("INSERT INTO employee_work 
                        (empid, empwo_date_start, empwo_date_end, empwo_position, empwo_company, empwo_salary, empwo_pay_grade, empwo_status, empwo_government) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("issssssss", $empid, $empwo_date_start, $empwo_date_end, $empwo_position, $empwo_company, $empwo_salary, $empwo_pay_grade, $empwo_status, $empwo_government);

        $empid = $_SESSION['user_data_2']['empid'];
        $empwo_date_start = $_POST['work_from'] ?? '';

        if ($_POST['work_to'] == 'OTHER' && !empty($_POST['work_to_date'])) {
            $empwo_date_end = (new DateTime($_POST['work_to_date']))->format('Y-m-d H:i:s');
        } elseif ($_POST['work_to'] == 'OTHER' && empty($_POST['work_to_date'])) {
            $empwo_date_end = "9999-12-31 23:59:59";
        }else {
            $empwo_date_end = ($_POST['work_to'] == 'PRESENT') ? "9999-12-31 23:59:59" : $_POST['work_to'];
        }

        $empwo_position = $_POST['work_position'] ?? '';
        $empwo_company = $_POST['work_company'] ?? '';
        $empwo_salary = $_POST['work_salary'] ?? '';
        $empwo_pay_grade = $_POST['work_pay_grade'] ?? 'N/A';
        $empwo_status = $_POST['work_status'] ?? '';
        $empwo_government = $_POST['work_government'] ?? 'N';

        // Execute the prepared statement
        $stmt->execute();
        // print_r($stmt);

        if ($stmt) {
            header('location:employee-work.php');
        }
    }elseif ($_POST['request']=='editwork') {
        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("UPDATE employee_work 
                        SET empwo_date_start = ?, 
                            empwo_date_end = ?, 
                            empwo_position = ?, 
                            empwo_company = ?, 
                            empwo_salary = ?, 
                            empwo_pay_grade = ?, 
                            empwo_status = ?, 
                            empwo_government = ? 
                        WHERE empwo_id = ?");

        $stmt->bind_param("ssssssssi", 
            $empwo_date_start, 
            $empwo_date_end, 
            $empwo_position, 
            $empwo_company, 
            $empwo_salary, 
            $empwo_pay_grade, 
            $empwo_status, 
            $empwo_government, 
            $empwo_id
        );

        $empwo_date_start = $_POST['work_from'] ?? '';

        if ($_POST['work_to'] == 'OTHER' && !empty($_POST['work_to_date'])) {
            $empwo_date_end = (new DateTime($_POST['work_to_date']))->format('Y-m-d H:i:s');
        } elseif ($_POST['work_to'] == 'OTHER' && empty($_POST['work_to_date'])) {
            $empwo_date_end = "9999-12-31 23:59:59";
        }else {
            $empwo_date_end = ($_POST['work_to'] == 'PRESENT') ? "9999-12-31 23:59:59" : $_POST['work_to'];
        }

        $empwo_position = $_POST['work_position'] ?? '';
        $empwo_company = $_POST['work_company'] ?? '';
        $empwo_salary = trim($_POST['work_salary']);
        $empwo_pay_grade = $_POST['work_pay_grade'] ?? '';
        $empwo_status = $_POST['work_status'] ?? '';
        $empwo_government = $_POST['work_government'] ?? '';
        $empwo_id =$_POST['work_id'];


        $stmt->execute();

        if ($stmt) {
            header('location:employee-work.php');
        }
    }elseif($_POST['request']=='deletework'){
        $empwo_id = $_POST['id'];

        // Prepare the SQL query with positional placeholders (?)
        $stmt = $conn->prepare("DELETE FROM employee_work WHERE empwo_id = ?");

        // Bind parameters to the placeholders (in order)
        $stmt->bind_param("i", 
            $empwo_id
        );

        // Execute the prepared statement
        $stmt->execute();

        if ($stmt) {
            if ($stmt->affected_rows == 1) {  // Check if exactly one row was deleted
                $response = array(
                    'status' => 'success',
                    'message' => 'Data deleted successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'No record was deleted. It may not exist.'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid data.'
            );
        }

        echo json_encode($response);

    }elseif($_POST['request']=='editprofile'){
        // print_r($_POST);

        // $campus = $_POST['editcampus'] ?? '';
        $status = $_POST['editstatus'] ?? '';
        $rank = $_POST['editrank'] ?? '';
        $designation = $_POST['editdesignation'] ?? '';
        $gender = $_POST['editgender'] ?? '';
        $dob = $_POST['editdob'] ?? '';
        $civil_status = $_POST['editcivilstatus'] ?? '';
        $service_length = $_POST['editservicelength'] ?? '';
        // $eligibility = $_POST['editeligibility'] ?? '';
        $empid = $_SESSION['user_data_2']['empid'] ?? ''; // Get empid from session
        // Prepare the SQL query with positional placeholders (?)
         $stmt = $conn->prepare("UPDATE employees_2 
                                SET emp_status = ?, emp_rank = ?, emp_designation = ?, 
                                    emp_gender = ?, emp_dob = ?, emp_civil_status = ?, emp_service_length = ?, emp_eligibility = ?, dateUpdated = NOW() 
                                WHERE empid = ?");


        // Bind parameters to the placeholders (in order)
        // $empid = $_SESSION['user_data_2']['empid'];  // You can replace this with a dynamic value (e.g., from session or another source)
        
        // Execute the prepared statement
         // Bind parameters
        $stmt->bind_param("ssssssssi", 
            $status, 
            $rank, 
            $designation, 
            $gender, 
            $dob, 
            $civil_status, 
            $service_length, 
            $eligibility, 
            $empid
        );
        $stmt->execute();
        // // $stmt=1;

        if ($stmt) {
            $query = "
                SELECT * FROM employees_2 
                INNER JOIN campuses USING (campid)
                WHERE empid = '$empid'
            ";
            $select = mysqli_query($conn, $query);
            if (mysqli_num_rows($select)==1) {
                $_SESSION['user_data_2'] = mysqli_fetch_assoc($select);
                // header('location: users-profile.php');

            }
        }

        // print_r($stmt);
        header('location:employee-profile.php');
    }elseif ($_POST['request']=='uploadfile') {

        if ($_POST['csrf'] !== $_SESSION['csrf']) {

            echo json_encode([
                'status'=>'error',
                'message'=>'Invalid CSRF'
            ]);

            exit;

        }
        $title = $_POST['file_title'];

        $empid =
        $_SESSION['auth']['db']['empid'];

        $file_description =
        $_POST['file_description'];

        $category =
        $_POST['file_category'];

        $source =
        $_POST['file_source'];



        /* ===============================
           OPTION 1 — LINK
        =============================== */

        if ($source == "link") {

            $original = $_POST['file_link']; 
            $stmt = $conn->prepare(" 
            INSERT INTO employee_files
            (
                empid,
                file_name,
                file_original_name,
                file_title,
                file_type,
                file_category,
                file_source,
                file_link,
                file_size,
                uploaded_by,
                file_description
            )

            VALUES (?,?,?,?,?,?,?,?,?,?,?)

            ");

            $dummy_name = "LINK";
            $type = "link";
            $size = 0;

            $stmt->bind_param(

            "isssssssiis",

            $empid,
            $dummy_name,
            $original,
            $title,
            $type,
            $category,
            $source,
            $file_link,
            $size,
            $empid,
            $file_description

            );

            $stmt->execute();

            header("location:admin/forms.php");

            exit;

        }



        /* ===============================
           OPTION 2 — FILE UPLOAD
        =============================== */

        if(isset($_FILES['upload_file'])){
            $mode = $_POST['mode'] ?? 'add';

            $file = $_FILES['upload_file'];

            $original = $file['name'];

            $tmp = $file['tmp_name'];

            $size = $file['size'];

            $ext =
            strtolower(
            pathinfo(
            $original,
            PATHINFO_EXTENSION
            ));

            $allowed = [

              'pdf',
              'doc',
              'docx',
              'xls',
              'xlsx',
              'jpg',
              'jpeg',
              'png'

            ];

            if(!in_array($ext,$allowed)){

                die("Invalid file type");

            }

            if($size > 5*1024*1024){

                die("File too large");

            }

            $type =
            mime_content_type($tmp);

            $newname =
            uniqid().".".$ext;

            $folder =
            "files/forms/";

            if(!is_dir($folder)){

                mkdir(
                  $folder,
                  0777,
                  true
                );

            }


            // if($mode == "edit"){

            //     $file_id =
            //     intval($_POST['file_id']);

            //     $title =
            //     $_POST['file_title'];

            //     $category =
            //     $_POST['file_category'];

            //     $source =
            //     $_POST['file_source'];

            //     $description =
            //     $_POST['file_description'];

            //     $empid =
            //     $_SESSION['auth']['db']['empid'];



                /* ===============================
                   EDIT LINK
                =============================== */

                // if($source=="link"){

                //     $link =
                //     $_POST['file_link'];

                //     $stmt =
                //     $conn->prepare("

                //     UPDATE employee_files
                //     SET

                //     file_title=?,
                //     file_category=?,
                //     file_source=?,
                //     file_link=?,
                //     file_description=?

                //     WHERE file_id=?
                //     AND empid=?

                //     ");

                //     $stmt->bind_param(

                //     "sssssii",

                //     $title,
                //     $category,
                //     $source,
                //     $link,
                //     $description,
                //     $file_id,
                //     $empid

                //     );

                //     $stmt->execute();

                //     header("location:forms.php");

                //     exit;

                // }



                /* ===============================
                   EDIT FILE UPLOAD
                =============================== */

                // if(isset($_FILES['upload_file'])
                //    &&
                //    $_FILES['upload_file']['name']!=""){

                //     /* Delete old file */

                //     $stmt =
                //     $conn->prepare("

                //     SELECT file_name
                //     FROM employee_files
                //     WHERE file_id=?
                //     AND empid=?

                //     ");

                //     $stmt->bind_param(
                //     "ii",
                //     $file_id,
                //     $empid
                //     );

                //     $stmt->execute();

                //     $result =
                //     $stmt->get_result();

                //     if($row=$result->fetch_assoc()){

                //         $old =
                //         "files/forms/" .
                //         $row['file_name'];

                //         if(file_exists($old)){

                //             unlink($old);

                //         }

                //     }



                //     /* Upload new */

                //     $file =
                //     $_FILES['upload_file'];

                //     $original =
                //     $file['name'];

                //     $tmp =
                //     $file['tmp_name'];

                //     $size =
                //     $file['size'];

                //     $ext =
                //     strtolower(
                //     pathinfo(
                //     $original,
                //     PATHINFO_EXTENSION
                //     ));

                //     $newname =
                //     uniqid().".".$ext;

                //     move_uploaded_file(
                //         $tmp,
                //         "files/forms/".$newname
                //     );



                    // $stmt =
                    // $conn->prepare("

                    // UPDATE employee_files
                    // SET

                    // file_name=?,
                    // file_original_name=?,
                    // file_title=?,
                    // file_category=?,
                    // file_source='upload',
                    // file_link=NULL,
                    // file_size=?,
                    // file_description=?

                    // WHERE file_id=?
                    // AND empid=?

                    // ");

                    // $stmt->bind_param(

                    // "ssssissi",

                    // $newname,
                    // $original,
                    // $title,
                    // $category,
                    // $size,
                    // $description,
                    // $file_id,
                    // $empid

                    // );

                    // $stmt->execute();

                    // header("location:forms.php");

                    // exit;

            //     }

            // }

            move_uploaded_file(
                $tmp,
                $folder.$newname
            );






            $stmt =
            $conn->prepare("

            INSERT INTO employee_files
            (
                empid,
                file_name,
                file_original_name,
                file_title,
                file_type,
                file_category,
                file_source,
                file_link,
                file_size,
                uploaded_by,
                file_description
            )

            VALUES (?,?,?,?,?,?,?,?,?,?,?)

            ");

            $file_link = NULL;

            $stmt->bind_param(

            "isssssssiis",

            $empid,
            $newname,
            $original,
            $title,
            $type,
            $category,
            $source,
            $file_link,
            $size,
            $empid,
            $file_description

            );

            $stmt->execute();

            header("location:admin/forms.php");

        }
    }elseif ($_POST['request']=='updatefile') {

        if ($_POST['csrf'] !== $_SESSION['csrf']) {

            echo json_encode([
                'status'=>'error',
                'message'=>'Invalid CSRF'
            ]);

            exit;

        }

        $file_id =
        intval($_POST['file_id']);

        $empid =
        $_SESSION['auth']['db']['empid'];

        $title =
        $_POST['file_title'];

        $category =
        $_POST['file_category'];

        $source =
        $_POST['file_source'];

        $description =
        $_POST['file_description'];


        /* ============================
           UPDATE LINK
        ============================ */

        if($source=="link"){

            $link =
            $_POST['file_link'];

            $stmt =
            $conn->prepare("

            UPDATE employee_files
            SET

            file_title=?,
            file_category=?,
            file_source=?,
            file_link=?,
            file_description=?

            WHERE file_id=?
            AND empid=?

            ");

            $stmt->bind_param(

            "sssssii",

            $title,
            $category,
            $source,
            $link,
            $description,
            $file_id,
            $empid

            );

            $stmt->execute();

            header("location:forms.php");

            exit;

        }


    /* ============================
       UPDATE FILE
    ============================ */

    if(isset($_FILES['upload_file'])
       &&
       $_FILES['upload_file']['name']!=""){

        $file =
        $_FILES['upload_file'];

        $original =
        $file['name'];

        $tmp =
        $file['tmp_name'];

        $size =
        $file['size'];

        $ext =
        strtolower(
        pathinfo(
        $original,
        PATHINFO_EXTENSION
        ));

        $newname =
        uniqid().".".$ext;

        move_uploaded_file(
            $tmp,
            "files/forms/".$newname
        );

        $stmt =
        $conn->prepare("

        UPDATE employee_files
        SET

        file_name=?,
        file_original_name=?,
        file_title=?,
        file_category=?,
        file_source='upload',
        file_link=NULL,
        file_size=?,
        file_description=?

        WHERE file_id=?
        AND empid=?

        ");

        $stmt->bind_param(

        "ssssissi",

        $newname,
        $original,
        $title,
        $category,
        $size,
        $description,
        $file_id,
        $empid

        );

        $stmt->execute();

        header("location:forms.php");

        exit;

        }

    }elseif ($_POST['request'] == 'deletefile') {

        if ($_POST['csrf'] !== $_SESSION['csrf']) {

            echo json_encode([
                'status'=>'error',
                'message'=>'Invalid CSRF'
            ]);

            exit;

        }

        $file_id =
        intval($_POST['id']);

        $empid =
        $_SESSION['auth']['db']['empid'];

        /* Get file first */

        $stmt =
        $conn->prepare("
        SELECT file_name
        FROM employee_files
        WHERE file_id = ?
        AND empid = ?
        ");

        $stmt->bind_param(
            "ii",
            $file_id,
            $empid
        );

        $stmt->execute();

        $result =
        $stmt->get_result();

        if ($result->num_rows !== 1) {

            echo json_encode([
                'status'=>'error',
                'message'=>'File not found'
            ]);

            exit;

        }

        $row =
        $result->fetch_assoc();

        $filepath =
        "files/forms/" .
        $row['file_name'];

        /* Delete file from disk */

        if (file_exists($filepath)) {

            unlink($filepath);

        }

        /* Delete from database */

        $stmt =
        $conn->prepare("
        DELETE FROM employee_files
        WHERE file_id = ?
        AND empid = ?
        ");

        $stmt->bind_param(
            "ii",
            $file_id,
            $empid
        );

        $stmt->execute();

        echo json_encode([
            'status'=>'success'
        ]);

        exit;

    }
}

    // Retrieve the form data
//     $name = isset($_POST['name']) ? $_POST['name'] : '';
//     $age = isset($_POST['age']) ? (int) $_POST['age'] : 0;

//     // Process the data (for example, you could add more validation here)
//     if ($name && $age > 0) {
//         // Construct the response array
//         $response = array(
//             'status' => 'success',
//             'message' => 'Data received successfully',
//             'data' => array(
//                 'name' => $name,
//                 'age' => $age
//             )
//         );
//     } else {
//         // Handle errors if the data is missing or invalid
//     }

//     // Return the response as JSON
//     header('Content-Type: application/json');
//     echo json_encode($response);
// } else {
//     // If the request is not POST, return an error message
//     echo json_encode(array(
//         'status' => 'error',
//         'message' => 'Invalid request method.'
//     ));
// }
