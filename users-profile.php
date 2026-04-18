<?php include'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Employees</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Employees</li> -->
          <li class="breadcrumb-item active">Employees</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-3">

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

        <div class="col-xl-9">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="myTab">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-education">Education</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-eligibility">Eligibility</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-work">Work Experience</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                 
                  <h5 class="card-title">Profile Details</h5>

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
                </div>

                <div class="tab-pane fade pt-3" id="profile-education">
                  <div class="d-flex justify-content-between align-items-center">
                      <h5 class="card-title"></h5>
                      <button class="btn btn-outline-primary" onclick="openAddModalEducation()">Add Education</button>
                  </div>
                  <!-- Table with stripped rows -->
                  <?php  
                    $query="SELECT * FROM employee_educational_attainments WHERE empid = '$empid'";
                    $select = mysqli_query($conn, $query);
                    if (mysqli_num_rows($select)>0):
                  ?>
                  <table class="table datatable table-sm table-responsive d-none d-lg-block" id="table_education">
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
                      $rownum=0; 
                      while ($row = mysqli_fetch_assoc($select)):
                      $rownum++;
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
                            <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_education(this, <?=$row['fea_id']?>, <?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_education(this, <?=$row['fea_id']?>, <?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    <?php endwhile ?>
                    </tbody>
                  </table>
                  <?php endif ?>

                  <!-- End Table with stripped rows -->
                  <div class="d-lg-none" style="font-size:15px">

                    <?php  
                      $query="SELECT * FROM employee_educational_attainments WHERE empid = '$empid'";
                      $select = mysqli_query($conn, $query);
                      $rownum=0; 
                      while ($row = mysqli_fetch_assoc($select)):
                      $rownum++;
                    ?>
                    <div class="card mb-2 this-card">
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="row">
                          <div class="col-12"><b>Degree:</b></div>
                          <div class="col-12"><?=$row['fea_degree']?>'s Degree</div>
                          <div class="col-12"><b>Course:</b></div>
                          <div class="col-12"><?=$row['fea_program']?></div>
                          <div class="col-12"><b>School:</b></div>
                          <div class="col-12"><?=$row['fea_school']?></div>
                          <div class="col-12"><b>Status:</b></div>
                          <div class="col-12"><?=$row['fea_status']?></div>
                          
                          
                            <?php
                              if ($row['fea_status']=="Graduated") {
                                if ($row['fea_date_graduated']!="0000-00-00 00:00:00") {
                                  echo '<div class="col-12"><b>Graduation Date:</b></div>';
                                  echo '<div class="col-12">';
                                  echo date('F d, Y', strtotime($row['fea_date_graduated']));
                                  echo '</div>';
                                }
                              }
                            ?>
                            
                          
                          <div class="col-12">
                            <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_education(this, <?=$row['fea_id']?>, <?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_education(this, <?=$row['fea_id']?>, <?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
                          </div>
                        </div>
                       
                      </div>
                    </div>

                    <?php endwhile ?>
                  </div>
                </div>

                <div class="tab-pane fade pt-3" id="profile-eligibility">
                  <div class="d-flex justify-content-between align-items-center">
                      <h5 class="card-title"></h5>
                      <button class="btn btn-outline-primary" onclick="openAddModalEligibility()">Add Eligibility</button>
                  </div>
                  <!-- Table with stripped rows -->
                  <?php  
                    $query="SELECT * FROM employee_eligibility WHERE empid = '$empid'";
                    $select = mysqli_query($conn, $query);
                    if (mysqli_num_rows($select)>0):
                  ?>
                  <table class="table datatable table-sm table-responsive d-none d-lg-block" id="table_eligibility">
                    <thead>
                      <tr>
                        <th>Eligibility</th>
                        <th>Rating</th>
                        <th>Date of Conferment</th>
                        <th>Place of Examination</th>
                        <th>License Number</th>
                        <th>Date of Validity</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
                      $rownum=0; 
                      while ($row = mysqli_fetch_assoc($select)):
                      $rownum++;
                    ?>
                      <tr>
                        <td><?=$row['empel_title']?></td>
                        <td><?=$row['empel_rating']?></td>
                        <td id="<?=$row['empel_date_conferment']?>"><?=date('F d, Y', strtotime($row['empel_date_conferment'])) ?></td>
                        <td><?=$row['empel_place']?></td>
                        <td><?=$row['empel_number']?></td>
                        <td id="<?=$row['empel_date_validity']?>"><?=date('F d, Y', strtotime($row['empel_date_validity']))?></td>
                        <td width="1%" style="white-space:nowrap" >
                            <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_eligibility(this, <?=$row['empel_id']?>, <?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_eligibility(this, <?=$row['empel_id']?>, <?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    <?php endwhile ?>
                    </tbody>
                  </table>
                  <?php endif ?>

                  <!-- End Table with stripped rows -->
                  <div class="d-lg-none" style="font-size:15px">
                    <?php  
                      $query="SELECT * FROM employee_eligibility WHERE empid = '$empid'";
                      $select = mysqli_query($conn, $query);
                      $rownum=0; 
                      while ($row = mysqli_fetch_assoc($select)):
                      $rownum++;
                    ?>
                    <div class="card mb-2 this-card">
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="row">
                          <div class="col-12"><b>Eligibility:</b></div>
                          <div class="col-12"><?=$row['empel_title']?></div>
                          <div class="col-12"><b>Rating:</b></div>
                          <div class="col-12"><?=$row['empel_rating']?></div>
                          <div class="col-12"><b>Date of Conferment:</b></div>
                          <div class="col-12"><?=date('F d, Y', strtotime($row['empel_date_conferment'])) ?></div>
                          <div class="col-12"><b>License Number:</b></div>
                          <div class="col-12"><?=$row['empel_number']?></div>
                          <div class="col-12"><b>Date of Validity:</b></div> 
                          <div class="col-12"><?=date('F d, Y', strtotime($row['empel_date_validity'])) ?></div>                           
                          
                          <div class="col-12">
                            <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_eligibility(this, <?=$row['empel_id']?>, <?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_eligibility(this, <?=$row['empel_id']?>, <?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php endwhile ?>
                  </div>
                </div>

                <div class="tab-pane fade pt-3" id="profile-work">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title"></h5>
                    <button class="btn btn-outline-primary" onclick="openAddModalWork()">Add Work Experience</button>
                  </div>
                  <!-- Table with stripped rows -->
                  <?php  
                    $query="SELECT * FROM employee_work WHERE empid = '$empid' ORDER BY empwo_date_start DESC";
                    $select = mysqli_query($conn, $query);
                    if (mysqli_num_rows($select)>0):
                  ?>
                  <table class="table datatable table-sm table-responsive d-none d-lg-block" id="table_work">
                    <thead>
                      <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Position Title</th>
                        <th>Company / Agency</th>
                        <th>Monthly Salary</th>
                        <th>Pay Grade</th>
                        <th>Status</th>
                        <th>Gov't Service</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $rownum=0; 
                    while ($row = mysqli_fetch_assoc($select)):
                    $rownum++;
                    ?>
                      <tr>
                        <td id="<?=$row['empwo_date_start'] ?>"><?= date('F d, Y', strtotime($row['empwo_date_start']))?></td>
                        <td id="<?=$row['empwo_date_end'] ?>">
                        <?php
                          if ($row['empwo_date_end'] == "9999-12-31 23:59:59") {
                              echo "PRESENT"; // Output "PRESENT" if the format is incorrect
                          } else {
                              echo date('F d, Y', strtotime($row['empwo_date_end'])); // Output "PRESENT" if the format is incorrect
                          }
                        ?>
                          
                        </td>
                        <td><?=$row['empwo_position']?></td>
                        <td><?=$row['empwo_company']?></td>
                        <td class="text-end"><?=number_format($row['empwo_salary'], 2, '.', ',')?></td>
                        <td class="text-center"><?=$row['empwo_pay_grade']?></td>
                        <td class="text-center"><?=$row['empwo_status']?></td>
                        <td width="1%" class="text-center"><?=$row['empwo_government']?></td>
                        <td width="1%" style="white-space:nowrap" >
                            <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_work(this, <?=$row['empwo_id']?>,<?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_work(this, <?=$row['empwo_id']?>,<?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    <?php endwhile ?>
                    </tbody>
                  </table>
                  <?php endif ?>

                  <!-- End Table with stripped rows -->
                  <div class="d-lg-none" style="font-size:15px">

                    <?php  
                    $query="SELECT * FROM employee_work WHERE empid = '$empid' ORDER BY empwo_date_start DESC";
                      $select = mysqli_query($conn, $query);
                      $rownum=0;
                      while ($row = mysqli_fetch_assoc($select)):
                      $rownum++;
                    ?>
                    <div class="card mb-2 this-card">
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="row">
                          <div class="col-12"><b>From:</b></div>
                          <div class="col-12"><?=date('F d, Y', strtotime($row['empwo_date_start']))?></div>
                          <div class="col-12"><b>To:</b></div>
                          <div class="col-12">
                            <?php
                              if ($row['empwo_date_end'] == "9999-12-31 23:59:59") {
                                  echo "PRESENT"; // Output "PRESENT" if the format is incorrect
                              } else {
                                  echo date('F d, Y', strtotime($row['empwo_date_end'])); // Output "PRESENT" if the format is incorrect
                              }
                            ?>
                          </div>
                          <div class="col-12"><b>Position Title:</b></div>
                          <div class="col-12"><?=$row['empwo_position']?></div>
                          <div class="col-12"><b>Company / Agency:</b></div>
                          <div class="col-12"><?=$row['empwo_company']?></div>
                          <div class="col-12"><b>Monthly Salary:</b></div>
                          <div class="col-12"><?=number_format($row['empwo_salary'], 2, '.', ',')?></div>
                          <div class="col-12"><b>Pay grade:</b></div>
                          <div class="col-12"><?=$row['empwo_pay_grade']?></div>
                          <div class="col-12"><b>Status:</b></div>
                          <div class="col-12"><?=$row['empwo_status']?></div>
                          <div class="col-12"><b>Gov't Sempwo_ervice:</b></div>
                          <div class="col-12"><?=$row['empwo_government']?></div>
                          
                          <div class="col-12">
                            <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_work(this, <?=$row['empwo_id']?>,<?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_work(this, <?=$row['empwo_id']?>,<?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
                          </div>
                        </div>
                       
                      </div>
                    </div>

                    <?php endwhile ?>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="requests_manager.php">
                    

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

                    <!-- <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Eligibility</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editeligibility" type="text" class="form-control" id="editeligibility" value="<?=$_SESSION['user_data_2']['emp_eligibility']?>">
                      </div>
                    </div> -->

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="request" value="editprofile">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

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
                    <legend class="col-form-label col-sm-2 pt-0">Category</legend>
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
                  <input type="text" class="form-control" name="degreeName" id="degreeName" value="" required="" placeholder="Bachelor of Science in Computer Engineering">
                  <div class="invalid-feedback">
                    Please provide degree name!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">School</label>
                  <input type="text" class="form-control" name="school" id="degreeSchool" value="" required="" placeholder="Sultan Kudarat State University">
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
                  <input type="date" class="form-control datepicker" name="graddate" id="inputgraduation">
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

    <div class="modal fade" id="modalElibility" tabindex="-1">
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
                  <label for="degreeName" class="form-label">Title of Eligility</label>
                  <input type="text" class="form-control" name="el_title" id="el_title" value="" required="" placeholder="Title of Eligility">
                  <div class="invalid-feedback">
                    Please provide title of eligibility!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">Rating</label>
                  <input type="text" class="form-control" name="el_rating" id="el_rating" value="" placeholder="Rating">
                  <div class="invalid-feedback">
                    Please provide rating!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">Date of Conferment</label>
                  <input type="date" class="form-control datepicker" name="el_date_conferment" id="el_date_conferment">
                  <div class="invalid-feedback">
                    Please provide date of conferment!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">Place of Examination</label>
                  <input type="text" class="form-control" name="el_place" id="el_place" value="" required="" placeholder="Place of Examination">
                  <div class="invalid-feedback">
                    Please provide place of examination!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">License Number</label>
                  <input type="text" class="form-control" name="el_number" id="el_number" value="" required="" placeholder="License Number">
                  <div class="invalid-feedback">
                    Please provide license number!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="degreeSchool" class="form-label">Date of Validity</label>
                  <input type="date" class="form-control datepicker" name="el_date_validity" id="el_date_validity">
                  <div class="invalid-feedback">
                    Please provide date of validity!
                  </div>
                </div>
                
                <input class="" type="hidden" name="el_id" id="el_id" >
                <div class="col-12">
                  <button class="btn btn-primary" type="submit" name="request" id="submiteligibility" value="">Submit form</button>
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

    <div class="modal fade" id="modalWork" tabindex="">
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
                  <label for="work_from" class="form-label">From</label>
                  <input type="date" class="form-control datepicker" name="work_from" id="work_from" required>
                  <div class="invalid-feedback">
                    Please provide start date!
                  </div>
                </div>
                <div class="col-md-12">
                  <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-1 pt-0">To</legend>
                      <div class="col-sm-11 d-flex align-items-center gap-3">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="work_to" id="work_to_present" value="PRESENT" checked>
                              <label class="form-check-label" for="work_to_present">Present</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="work_to" id="work_to_other" value="OTHER">
                              <label class="form-check-label" for="work_to_other">Other</label>
                          </div>
                          <input type="date" class="form-control datepicker" name="work_to_date" id="work_to_date" readonly disabled>
                      </div>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <label for="work_position" class="form-label">Position Title</label>
                  <input type="text" class="form-control" name="work_position" id="work_position" required="">
                  <div class="invalid-feedback">
                    Please provide position title!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="work_company" class="form-label">Company / Agency</label>
                  <input type="text" class="form-control" name="work_company" id="work_company" required="">
                  <div class="invalid-feedback">
                    Please provide place of examination!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="work_salary" class="form-label">Monthly Salary</label>
                  <input type="number" class="form-control" name="work_salary" id="work_salary" required step="0.01" min="0">
                  <div class="invalid-feedback">
                    Please provide monthly salary!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="work_pay_grade" class="form-label">Pay Grade</label>
                  <input type="text" class="form-control" name="work_pay_grade" id="work_pay_grade">
                  <div class="invalid-feedback">
                    Please provide pay grade!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="work_status" class="form-label">Status</label>
                  <input type="text" class="form-control" name="work_status" id="work_status" required="">
                  <div class="invalid-feedback">
                    Please provide status!
                  </div>
                </div>
                <div class="col-md-12">
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Gov't Service</legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="work_government" id="work_government_y" value="Y" checked="" required="">
                        <label class="form-check-label" for="work_government_y">
                          Yes
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="work_government" id="work_government_n" value="N" required="">
                        <label class="form-check-label" for="work_government_n">
                          No
                        </label>
                      </div>
                    </div>
                  </fieldset>
                </div>
                
                <input class="" type="hidden" name="work_id" id="work_id" >
                <div class="col-12">
                  <button class="btn btn-primary" type="submit" name="request" id="submitwork" value="">Submit form</button>
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
    function delete_education(obj,id, rownum){

      var row = document.getElementById('table_education').rows[rownum];
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
                  obj.closest('.this-card')?.remove();
                  obj.closest('tr')?.remove();
                  Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                  });

                  // location.reload();
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

    function delete_eligibility(obj, id, rownum){

      // var row = obj.closest('tr');
      // alert(rownum);

      var row = document.getElementById('table_eligibility').rows[rownum];
      var request = 'deleteeligibility'
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
                  obj.closest('.this-card')?.remove();
                  obj.closest('tr')?.remove();
                  Swal.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
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

    function delete_eligibility(obj, id, rownum){

      // var row = obj.closest('tr');
      // alert(rownum);

      var row = document.getElementById('table_eligibility').rows[rownum];
      var request = 'deleteeligibility'
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
                  obj.closest('.card').remove();
                  row.remove();
                  Swal.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
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
    function delete_work(obj,id,rownum){

      // var row = obj.closest('tr');
      var row = document.getElementById('table_work').rows[rownum];
      var request = 'deletework'
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
                  obj.closest('.this-card')?.remove();
                  obj.closest('tr')?.remove();
                  Swal.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
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

    function edit_education(obj, id, rownum){
      $("#modalEducation").modal('show');
      $("#modalEducation #modalmode").text("Edit Education");

      // var row = obj.closest("tr");
      // var rownum = row.Index;
      var row = document.getElementById('table_education').rows[rownum];

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

    function edit_eligibility(obj, id, rownum){
      $("#modalElibility").modal('show');
      $("#modalElibility #modalmode").text("Edit Eligibility");

      // var row = obj.closest("tr");
      // var rownum = row.Index;
      var row = document.getElementById('table_eligibility').rows[rownum];

      $("#modalElibility #el_title").val(row.cells[0].innerHTML);   
      $("#modalElibility #el_rating").val(row.cells[1].innerHTML);
      // $("#modalElibility #el_date_conferment").val(row.cells[2].innerHTML);
      $("#modalElibility #el_place").val(row.cells[3].innerHTML);
      $("#modalElibility #el_number").val(row.cells[4].innerHTML);
      // $("#modalElibility #el_date_validity").val(row.cells[5].innerHTML);


      var date = row.cells[2].id+" EDT";
      var formattedDate = new Date(date).toISOString().slice(0, 10);
      $("#modalElibility #el_date_conferment").val(formattedDate);

      var date = row.cells[5].id+" EDT";
      var formattedDate = new Date(date).toISOString().slice(0, 10);
      $("#modalElibility #el_date_validity").val(formattedDate);

      $("#modalElibility #submiteligibility").val("editeligibility");
      $("#modalElibility #el_id").val(id);
    }

    function edit_work(obj, id, rownum){
      $("#modalWork").modal('show');
      // $('#modalWork').on('hidden.bs.modal', function () {
      //     $(this).removeAttr('aria-hidden'); // Remove aria-hidden when fully closed
      // });
      obj.focus();
      $("#modalWork #modalmode").text("Edit Work Experience");

      // var row = obj.closest("tr");
      var row = document.getElementById('table_work').rows[rownum];

      var date = row.cells[0].id+" EDT";
      var formattedDate = new Date(date).toISOString().slice(0, 10);
      $("#modalWork #work_from").val(formattedDate);

      const workToPresent = document.getElementById("work_to_present");
      const workToOther = document.getElementById("work_to_other");
      const workToDate = document.getElementById("work_to_date");

      if(row.cells[1].id == "9999-12-31 23:59:59"){
        $('input[name="work_to"][id="work_to_present"]').prop('checked', true);
        workToDate.setAttribute("disabled", "true");
        workToDate.setAttribute("readonly", "true");
        workToDate.removeAttribute("required");
        workToDate.value = "";
      }else{
        $('input[name="work_to"][id="work_to_other"]').prop('checked', true);
        var date = row.cells[1].id+" EDT"
        var formattedDate = new Date(date).toISOString().slice(0, 10);
        $("#modalWork #work_to_date").val(formattedDate);
        workToDate.removeAttribute("disabled");
        workToDate.removeAttribute("readonly");
        workToDate.setAttribute("required", "true");
      }

      $("#modalWork #work_position").val(row.cells[2].innerHTML);   
      $("#modalWork #work_company").val(row.cells[3].innerHTML);
      $("#modalWork #work_salary").val(row.cells[4].innerHTML);
      $("#modalWork #work_pay_grade").val(row.cells[5].innerHTML);
      $("#modalWork #work_status").val(row.cells[6].innerHTML);

      var gs = row.cells[7].innerHTML;
      if (gs == "Y") {
        $('input[name="work_government"][id="work_government_y"]').prop('checked', true);
        $('input[name="work_government"][id="work_government_n"]').prop('checked', false);
      }else if (gs == "N") {
        $('input[name="work_government"][id="work_government_y"]').prop('checked', false);
        $('input[name="work_government"][id="work_government_n"]').prop('checked', true);
      }

      $("#modalWork #submitwork").val("editwork");
      $("#modalWork #work_id").val(id);
    }


    function openAddModalEducation(){
      $("#modalEducation").modal('show');
      $("#modalEducation #modalmode").text("Add Education");
      $("#modalEducation #submitdegree").val("addeducation");


      $("#modalEducation #degreeName").val("");   
      $("#modalEducation #degreeSchool").val("");
      $('input[name="degree"][id="Bachelor"]').prop('checked', true);
      $('input[name="status"][id="Graduated"]').prop('checked', true);
    }


    function openAddModalEligibility(){
      $("#modalElibility").modal('show');
      $("#modalElibility #modalmode").text("Add Eligibility");
      $("#modalElibility #submiteligibility").val("addeligibility");


      $("#modalElibility #el_title").val("");   
      $("#modalElibility #el_rating").val("");
      $("#modalElibility #el_number").val("");
      $("#modalElibility #el_place").val("");
      $("#modalElibility #el_date_conferment").val("");
      $("#modalElibility #el_date_validity").val("");
    }


    function openAddModalWork(){
      $("#modalWork").modal('show');
      $("#modalWork #modalmode").text("Add Work Experience");
      $("#modalWork #submitwork").val("addwork");


      // $("#modalWork #work_title").val("");   
      // $("#modalWork #work_rating").val("");
      // $("#modalWork #work_number").val("");
      // $("#modalWork #work_place").val("");
      // $("#modalWork #work_date_conferment").val("");
      // $("#modalWork #work_date_validity").val("");
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
        } else {
          // Select the first tab if no active tab is stored
          var firstTabButton = document.querySelector('button[data-bs-toggle="tab"]');

          if (firstTabButton) {
              var firstTab = new bootstrap.Tab(firstTabButton);
              firstTab.show();
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

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const workToPresent = document.getElementById("work_to_present");
        const workToOther = document.getElementById("work_to_other");
        const workToDate = document.getElementById("work_to_date");

        function toggleDateInput() {
            if (workToOther.checked) {
                workToDate.removeAttribute("disabled");
                workToDate.removeAttribute("readonly");
                workToDate.setAttribute("required", "true");
            } else {
                workToDate.setAttribute("disabled", "true");
                workToDate.setAttribute("readonly", "true");
                workToDate.removeAttribute("required");
                workToDate.value = ""; // Clear the date field when switching back
            }
        }

        workToPresent.addEventListener("change", toggleDateInput);
        workToOther.addEventListener("change", toggleDateInput);
    });
  </script>
  <script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',  // Change format to MM/DD/YYYY
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

</body>

</html>