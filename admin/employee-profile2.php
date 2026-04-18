<?php include'header.php'; ?>
	<?php  
    $query = "SELECT * FROM employees_2 
    INNER JOIN campuses USING(campid)
    WHERE empid = '$_GET[a]'";
    $select = mysqli_query($conn,$query);
    $query = mysqli_query($conn, $query);
    if ($query && mysqli_num_rows($select)==1) {
    	$employee = mysqli_fetch_assoc($select);
    }
	?>
  <main id="main" class="main col-12">

    <div class="pagetitle">
      <h1><?=$employee['emp_lname'].', '.$employee['emp_fname'].' '.$employee['emp_mname'][0].'.'?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-2" style="display:none">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?=$_SESSION['user_data']['picture']?>" alt="Profile" class="rounded-circle">
              <br>
              <h3><b><?=$_SESSION['user_data']['name']?></b></h3>
              <?=$_SESSION['user_data']['email']?>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>

        <div class="col-xl-10">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="myTab">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-personal-information">Personal Information</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-education">Education</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-work-experience">Work Experience</button>
                </li> -->

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-training-seminar">Trainings & Seminars</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Custom Styled Validation</h5> -->
                    <!-- <p>For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. </p> -->


                  </div>
                  <!-- <h5 class="card-title">About</h5> -->
                  <!-- <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Profile Details</h5>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['name']?></div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Campus</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['campname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Employment Status</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Rank</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_rank']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Designation</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_designation']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Gender</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Date of Birth</div>
                    <div class="col-lg-10 col-md-9"><?=date("F d, Y", strtotime($employee['emp_dob']))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Civil Status</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_civil_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Length of Service (Years)</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_service_length']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2 col-md-3 label">Eligibility</div>
                    <div class="col-lg-10 col-md-9"><?=$employee['emp_eligibility']?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-overview" id="profile-personal-information">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Custom Styled Validation</h5> -->
                    <!-- <p>For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. </p> -->


                  </div>
                  <!-- <h5 class="card-title">About</h5> -->
                  <!-- <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Profile Details</h5>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['name']?></div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Campus</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['campname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employment Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_rank']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_designation']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?=date("F d, Y", strtotime($_SESSION['user_data_2']['emp_dob']))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Civil Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_civil_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Length of Service (Years)</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_service_length']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Eligibility</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_eligibility']?></div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div> -->

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['email']?></div>
                  </div> -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-education">

                  <div class="row">
                    <div class="col-lg-12">

                      <div class="card">
                        <div class="card-body">
                          <!-- <h5 class="card-title">Education</h5> -->
                          <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Education</h5>
                            <button class="btn btn-outline-success rounded-pill" onclick="openAddModal()">
                            <!-- <i class="bi bi-plus-square"></i>  -->
                            Add Education
                            </button>
                          </div>

                          <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->

                          <!-- Table with stripped rows -->
                          <table class="table datatable table-sm">
                            <thead>
                              <tr>
                                <th>Degree</th>
                                <th>Title</th>
                                <th>School</th>
                                <th>Status</th>
                                <th>Graduation Date</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php  
                              $query="SELECT * FROM employee_educational_attainments WHERE empid = '$employee[empid]'";
                              $educ = mysqli_query($conn, $query);
                              while ($row = mysqli_fetch_assoc($educ)):
                            ?>
                              <tr>
                                <td><?=$row['fea_degree']?></td>
                                <td><?=$row['fea_program']?></td>
                                <td><?=$row['fea_school']?></td>
                                <td><?=$row['fea_status']?></td>
                                <td id="<?=$row['fea_date_graduated']?>">
                                  <?php 
                                    if ($row['fea_status']=="Graduated") {
                                      if ($row['fea_date_graduated']!="0000-00-00 00:00:00") {
                                        echo date('F d, Y', strtotime($row['fea_date_graduated']));
                                      }
                                    }
                                      
                                   ?>
                                </td>
                                <td width="1%" style="white-space:nowrap" >
                                  <!-- <div class="btn-group"> -->
                                    <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_education(this, <?=$row['fea_id']?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_education(this, <?=$row['fea_id']?>)" title="Delete"><i class="bi bi-trash"></i></button>
                                  <!-- </div> -->
                                </td>
                              </tr>
                            <?php endwhile ?>
                            </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                        </div>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-overview" id="profile-work-experience">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Custom Styled Validation</h5> -->
                    <!-- <p>For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. </p> -->


                  </div>
                  <!-- <h5 class="card-title">About</h5> -->
                  <!-- <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Profile Details</h5>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['name']?></div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Campus</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['campname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employment Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_rank']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_designation']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?=date("F d, Y", strtotime($_SESSION['user_data_2']['emp_dob']))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Civil Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_civil_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Length of Service (Years)</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_service_length']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Eligibility</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_eligibility']?></div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div> -->

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['email']?></div>
                  </div> -->

                </div>

                <div class="tab-pane fade profile-overview" id="profile-training-seminar">
                  <div class="card-body">
                    <!-- <h5 class="card-title">Custom Styled Validation</h5> -->
                    <!-- <p>For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. </p> -->


                  </div>
                  <!-- <h5 class="card-title">About</h5> -->
                  <!-- <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Profile Details</h5>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['name']?></div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Campus</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['campname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employment Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_rank']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_designation']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?=date("F d, Y", strtotime($_SESSION['user_data_2']['emp_dob']))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Civil Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_civil_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Length of Service (Years)</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_service_length']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Eligibility</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data_2']['emp_eligibility']?></div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div> -->

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['user_data']['email']?></div>
                  </div> -->

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="requests_manager.php">
                    <!-- <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile" id="profileImage">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div> -->

                    <!-- <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="Kevin Anderson">
                      </div>
                    </div> -->

                    <!-- <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                      </div>
                    </div> -->

                    <!-- <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Campus</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editcampus" type="text" class="form-control" id="editcampus" value="<?=$_SESSION['user_data_2']['campname']?>">
                      </div>
                    </div> -->

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Employment Status</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editstatus" type="text" class="form-control" id="editstatus" value="<?=$_SESSION['user_data_2']['emp_status']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Rank</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editrank" type="text" class="form-control" id="editrank" value="<?=$_SESSION['user_data_2']['emp_rank']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editdesignation" type="text" class="form-control" id="editdesignation" value="<?=$_SESSION['user_data_2']['emp_designation']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editgender" type="text" class="form-control" id="editgender" value="<?=$_SESSION['user_data_2']['emp_gender']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <?php  
                        echo'
                          <input name="editdob" type="date" class="form-control" id="editdob" value="'.date("Y-m-d", strtotime($_SESSION['user_data_2']['emp_dob'])).'">

                        ';
                        ?>
                        
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Civil Status</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editcivilstatus" type="text" class="form-control" id="editcivilstatus" value="<?=$_SESSION['user_data_2']['emp_civil_status']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Length of Service (Years)</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editservicelength" type="number" class="form-control" id="editservicelength" value="<?=$_SESSION['user_data_2']['emp_service_length']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Eligibility</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editeligibility" type="text" class="form-control" id="editeligibility" value="<?=$_SESSION['user_data_2']['emp_eligibility']?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="request" value="editprofile">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

    <div class="modal fade" id="modalEducation" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalmode">Extra Large Modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <!-- <h5 class="card-title">Custom Styled Validation</h5> -->
              <!-- <p>For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. </p> -->

              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" action="requests_manager.php" method="POST" novalidate="">
                <div class="col-md-12">
                  <!-- <label for="validationCustom01" class="form-label">First name</label> -->
                  <!-- <input type="text" class="form-control" id="validationCustom01" value="John" required=""> -->
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Degree</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="degree" id="Bachelor" value="Bachelor" checked="">
                        <label class="form-check-label" for="Bachelor">
                          Bachelor
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="degree" id="Master" value="Master">
                        <label class="form-check-label" for="Master">
                          Master
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="degree" id="Doctor" value="Doctor">
                        <label class="form-check-label" for="Doctor">
                          Doctor
                        </label>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <label for="degreeName" class="form-label">Degree Name</label>
                  <input type="text" class="form-control" name="degreeName" id="degreeName" value="" required="" placeholder="Degree name">
                  <div class="invalid-feedback">
                    Please provide degree name!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">School</label>
                  <input type="text" class="form-control" name="school" id="degreeSchool" value="" required="" placeholder="Name of school">
                  <div class="invalid-feedback">
                    Please provide school!
                  </div>
                </div>
                <div class="col-md-6">
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="Graduated" value="Graduated" checked="">
                        <label class="form-check-label" for="Graduated">
                          Graduated
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="On-going" value="On-going">
                        <label class="form-check-label" for="On-going">
                          On-going
                        </label>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-6" id="graddate">
                  <label for="degreeName" class="form-label ">Date of Graduation</label>
                  <input type="date" class="form-control" name="graddate" id="inputgraduation">
                  <div class="invalid-feedback">
                    Please provide degree name!
                  </div>
                </div>
                
                <input class="" type="hidden" name="empedu" id="empedu" >
                <div class="col-12">
                  <button class="btn btn-primary" type="submit" name="request" id="submitdegree" value="">Submit form</button>
                </div>
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>

  </main><!-- End #main -->
  <?php include'footer.php'; ?>
  <script type="text/javascript">
    function delete_education(obj,id){

      var row = obj.closest('tr');
      var request = 'deleteeducation'
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          console.log("confirmed: "+id);
          $.ajax({
            url: 'requests_manager.php', 
            type: 'POST',
            data: { id: id, request:request },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response.status);

                if (response.status=='success') {
                  row.remove();
                  Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                  });
                }
                  
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.log(error);
                $('#response').text('An error occurred: ' + error);
            }
          });
        }
      });
    }

    function edit_education(obj, id){
      $("#modalEducation").modal('show');
      $("#modalEducation #modalmode").text("Edit Education");

      var row = obj.closest("tr");
      var rownum = row.Index;

      $('input[name="degree"][id="'+row.cells[0].innerHTML+'"]').prop('checked', true);
      $('input[name="status"][id="'+row.cells[3].innerHTML+'"]').prop('checked', true);

      $("#modalEducation #degreeName").val(row.cells[1].innerHTML);   
      $("#modalEducation #degreeSchool").val(row.cells[2].innerHTML);


      var date = row.cells[4].id+" EDT";
      var formattedDate = new Date(date).toISOString().slice(0, 10);

      $("#modalEducation #inputgraduation").val(formattedDate);

      $("#modalEducation #submitdegree").val("editeducation");
      $("#modalEducation #empedu").val(id);
    }


    function openAddModal(){
      $("#modalEducation").modal('show');
      $("#modalEducation #modalmode").text("Add Education");
      $("#modalEducation #submitdegree").val("addeducation");


      $("#modalEducation #degreeName").val("");   
      $("#modalEducation #degreeSchool").val("");
      $('input[name="degree"][id="Bachelor"]').prop('checked', true);
      $('input[name="status"][id="Graduated"]').prop('checked', true);
    }

    document.getElementById('Graduated').addEventListener('click', function() {
      $("#graddate").css("display", "block"); 
    });

    document.getElementById('On-going').addEventListener('click', function() {
      $("#graddate").css("display", "none"); 
    });
  </script>
  <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            // Check if there's a saved active tab in localStorage
            var activeTab = localStorage.getItem('activeTab');
            
            // If there's an active tab saved, activate it
            if (activeTab) {
                // Get the button element for the active tab using the saved tab ID
                var activeTabButton = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                
                if (activeTabButton) {
                    // Initialize and show the tab using the Bootstrap 5 Tab API
                    var tab = new bootstrap.Tab(activeTabButton);
                    tab.show();
                }
            }

            // Save the active tab on tab change
            var tabButtons = document.querySelectorAll('.nav-link');
            tabButtons.forEach(function(button) {
                button.addEventListener('click', function () {
                    // Store the ID of the clicked tab's target in localStorage
                    localStorage.setItem('activeTab', this.getAttribute('data-bs-target'));
                });
            });
        });
  </script>

</body>

</html>