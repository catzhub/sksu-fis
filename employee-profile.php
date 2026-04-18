<?php include'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Employees</li> -->
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-3">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?=$_SESSION['auth']['google']['picture']?>" alt="Profile" class="rounded-circle">
              <br>
              <h3><b><?=$_SESSION['auth']['google']['name']?></b></h3>
              <?=$_SESSION['auth']['google']['email']?>
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
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                 
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Campus</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['campname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employment Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['emp_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['emp_rank']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['emp_designation']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['emp_gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?=date("F d, Y", strtotime($_SESSION['auth']['db']['emp_dob']))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Civil Status</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['emp_civil_status']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Length of Service (Years)</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['auth']['db']['emp_service_length']?></div>
                  </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="requests_manager.php">
                    

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Employment Status</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editstatus" type="text" class="form-control" id="editstatus" value="<?=$_SESSION['auth']['db']['emp_status']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Rank</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editrank" type="text" class="form-control" id="editrank" value="<?=$_SESSION['auth']['db']['emp_rank']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editdesignation" type="text" class="form-control" id="editdesignation" value="<?=$_SESSION['auth']['db']['emp_designation']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editgender" type="text" class="form-control" id="editgender" value="<?=$_SESSION['auth']['db']['emp_gender']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <?php  
                        echo'
                          <input name="editdob" type="date" class="form-control" id="editdob" value="'.date("Y-m-d", strtotime($_SESSION['auth']['db']['emp_dob'])).'">

                        ';
                        ?>
                        
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Civil Status</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editcivilstatus" type="text" class="form-control" id="editcivilstatus" value="<?=$_SESSION['auth']['db']['emp_civil_status']?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Length of Service (Years)</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editservicelength" type="number" class="form-control" id="editservicelength" value="<?=$_SESSION['auth']['db']['emp_service_length']?>">
                      </div>
                    </div>

                    <!-- <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Eligibility</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="editeligibility" type="text" class="form-control" id="editeligibility" value="<?=$_SESSION['auth']['db']['emp_eligibility']?>">
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

  </main><!-- End #main -->
  <?php include'footer.php'; ?>
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