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

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$employee['emp_lname'].', '.$employee['emp_fname'].' '.$employee['emp_mname'][0].'.'?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <li class="breadcrumb-item"><a href="employees.php">Employees</a></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section section-profile">
      <div class="row">
        <div class="col-lg-12">




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


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-eligibility">Eligibility</button>
                </li>


                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-work">Work Experience</button>
                </li>
                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-work-experience">Work Experience</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-training-seminar">Trainings & Seminars</button>
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

                  <!-- <h5 class="card-title">Profile Details</h5> -->
                  <table class="table table-sm">
                    <thead><tr><th></th><td></td></tr></thead>
                    <tbody>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Campus</th>
                        <td> : <?=$employee['campname']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Employment Status</th>
                        <td> : <?=$employee['emp_status']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Rank</th>
                        <td> : <?=$employee['emp_rank']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Designation</th>
                        <td> : <?=$employee['emp_designation']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Gender</th>
                        <td> : <?=$employee['emp_gender']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Date of Birth</th>
                        <td> : <?=date("F d, Y", strtotime($employee['emp_dob']))?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Civil Status</th>
                        <td> : <?=$employee['emp_civil_status']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Length of Service (Years)</th>
                        <td> : <?=$employee['emp_service_length']?></td>
                      </tr>
                      <tr>
                        <th width="1%" style="white-space:nowrap">Elibibility</th>
                        <td> : <?=$employee['emp_eligibility']?></td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Campus</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['campname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employment Status</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_rank']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_designation']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?=date("F d, Y", strtotime($employee['emp_dob']))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Civil Status</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_civil_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Length of Service (Years)</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_service_length']?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Eligibility</div>
                    <div class="col-lg-9 col-md-8"><?=$employee['emp_eligibility']?></div>
                  </div>
                   -->

                </div>

                <div class="tab-pane fade" id="profile-personal-information">
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

                </div>

                <div class="tab-pane fade pt-3" id="profile-education">

                  <div class="row">
                    <div class="col-lg-12">
                          <!-- Table with stripped rows -->
                          <table class="table datatable table-sm">
                            <thead>
                              <tr>
                                <th>Degree</th>
                                <th>Title</th>
                                <th>School</th>
                                <th>Status</th>
                                <th>Graduation Date</th>
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
                              </tr>
                            <?php endwhile ?>
                            </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                    </div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-eligibility">

                  <div class="row">
                    <div class="col-lg-12">
                          <!-- Table with stripped rows -->
                          <table class="table datatable table-sm">
                            <thead>
                              <tr>
                                <th>Eligibility</th>
                                <th>Rating</th>
                                <th>Date of Conferment</th>
                                <th>Place of Examination</th>
                                <th>License Number</th>
                                <th>Date of Validity</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php  
                              $query="SELECT * FROM employee_eligibility WHERE empid = '$employee[empid]'";
                              $educ = mysqli_query($conn, $query);
                              while ($row = mysqli_fetch_assoc($educ)):
                            ?>
                              <tr>
                                <td><?=$row['empel_title']?></td>
                                <td><?=$row['empel_rating']?></td>
                                <td><?= date("F d, Y", strtotime($row['empel_date_conferment'])) ?></td>
                                <td><?=$row['empel_place']?></td>
                                <td><?=$row['empel_number']?></td>
                                <td><?= date("F d, Y", strtotime($row['empel_date_validity'])) ?></td>
                              </tr>
                            <?php endwhile ?>
                            </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                    </div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-work">

                  <div class="row">
                    <div class="col-lg-12">
                          <!-- Table with stripped rows -->
                          

                      <table class="table datatable table-sm table-responsive" id="table_work">
                        <thead>
                          <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Position Title</th>
                            <th>Company / Agency</th>
                            <th class="text-end">Monthly Salary</th>
                            <th>Pay Grade</th>
                            <th>Status</th>
                            <th>Gov't Service</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $query="SELECT * FROM employee_work WHERE empid = '$employee[empid]' ORDER BY empwo_date_start DESC";
                        $select = mysqli_query($conn, $query);
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
                            <td class="text-end"><?= is_numeric($row['empwo_salary']) ? number_format($row['empwo_salary'], 2, '.', ',') : $row['empwo_salary'] ?></td>
                            <td class="text-center"><?=$row['empwo_pay_grade']?></td>
                            <td class="text-center"><?=$row['empwo_status']?></td>
                            <td width="1%" class="text-center"><?=$row['empwo_government']?></td>
                          </tr>
                        <?php endwhile ?>
                        </tbody>
                      </table>
                          <!-- End Table with stripped rows -->

                    </div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-training-seminar">

                  <div class="row">
                    <div class="col-lg-12">
                          <!-- Table with stripped rows -->
                          

                      <table class="table datatable table-sm table-responsive" id="table_work">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Hours</th>
                            <th>Type</th>
                            <th>Sponsor</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $query="SELECT * FROM employee_seminar WHERE empid = '$employee[empid]' ORDER BY empsem_date_start DESC";
                        $select = mysqli_query($conn, $query);
                        $rownum=0; 
                        while ($row = mysqli_fetch_assoc($select)):
                        $rownum++;
                        ?>
                          <tr>
                            <td><?=$row['empsem_title']?></td>
                            <td><?= date('m/d/Y', strtotime($row['empsem_date_start']))?></td>
                            <td><?= date('m/d/Y', strtotime($row['empsem_date_end']))?></td>
                            <td class="text-center"><?=$row['empsem_hours']?></td>
                            <td><?=$row['empsem_category']?></td>
                            <td><?=$row['empsem_sponsor']?></td>
                          </tr>
                        <?php endwhile ?>
                        </tbody>
                      </table>
                          <!-- End Table with stripped rows -->

                    </div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->



              <!-- <h5 class="card-title">Employee Details</h5> -->
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->


            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php'; ?>
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