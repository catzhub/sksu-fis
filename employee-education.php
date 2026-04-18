<?php include'header.php'; ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Education</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Employees</li> -->
          <li class="breadcrumb-item active">Education</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- <div class="d-flex justify-content-between align-items-center"> -->
                  <!-- <h5 class="card-title"></h5> -->
                  <button type="button" class="btn btn-outline-primary" onclick="openAddModalEducation()">Add Education</button>
              <!-- </div> -->
              <div class="d-none1 d-lg-block1">
              <!-- Table with stripped rows -->
              <?php  
                $empid = $_SESSION['auth']['db']['empid'];

                $stmt = $conn->prepare("
                    SELECT *
                    FROM employee_educational_attainments
                    WHERE empid = ?
                ");

                $stmt->bind_param("i", $empid);
                $stmt->execute();

                $select = $stmt->get_result();
                if ($select->num_rows > 0):
              ?>

              <table class="table table-sm table-responsive" id="table_education">
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
                    <td><?=htmlspecialchars($row['fea_degree'])?></td>
                    <td><?=htmlspecialchars($row['fea_program'])?></td>
                    <td><?=htmlspecialchars($row['fea_school'])?></td>
                    <td><?=htmlspecialchars($row['fea_status'])?></td>
                    <td>
                      <?php 
                        if ($row['fea_status']=="Graduated") {
                          if ($row['fea_date_graduated']!="0000-00-00 00:00:00") {
                            echo date('F d, Y', strtotime($row['fea_date_graduated']));
                          }
                        }
                          
                       ?>
                    </td>
                    <td width="1%" style="white-space:nowrap" >
                        <button class="btn btn-outline-info rounded-pill btn-sm" 
                        onclick="edit_education(
                          this,
                          <?= $row['fea_id'] ?>,
                          '<?= htmlspecialchars($row['fea_degree'], ENT_QUOTES) ?>',
                          '<?= htmlspecialchars($row['fea_program'], ENT_QUOTES) ?>',
                          '<?= htmlspecialchars($row['fea_school'], ENT_QUOTES) ?>',
                          '<?= htmlspecialchars($row['fea_status'], ENT_QUOTES) ?>',
                          '<?= htmlspecialchars($row['fea_date_graduated'], ENT_QUOTES) ?>'
                        )" 
                        title="Edit"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_education(this, <?=$row['fea_id']?>)" title="Delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                <?php endwhile ?>
                </tbody>
              </table>
            <?php else: ?>

            <p class="text-muted">
              No education records found.
            </p>

            <?php endif ?>
              </div>


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

  </main><!-- End #main -->
  <?php include'footer.php'; ?>
  <script type="text/javascript">
    const modal =
    new bootstrap.Modal(
    document.getElementById('modalEducation')
    );
    function openAddModalEducation(){
      // alert("1");

      modal.show();
      $("#modalEducation #modalmode").text("Add Education");
      $("#modalEducation #submitdegree").val("addeducation");

      $("#inputgraduation").val("");
      $("#modalEducation #degreeName").val("");   
      $("#modalEducation #degreeSchool").val("");
      $('input[name="degree"][id="Bachelor"]').prop('checked', true);
      $('input[name="status"][id="Graduated"]').prop('checked', true);
    }
    function delete_education(obj,id, rownum){
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
            data: { 
              id: id, 
              request:request
              // csrf: "<?= $_SESSION['csrf'] ?? '' ?>"
            },
            success: function(response) {
              try {

                response = JSON.parse(response);

                if (response.status === 'success') {

                    obj.closest('tr').remove();

                    Swal.fire({
                        title: "Deleted!",
                        text: "Record deleted.",
                        icon: "success"
                    });

                }

              } catch (e) {

                console.error("Invalid JSON:", response);

            }

        }
          });
        }
      });
    }

    function edit_education(
        obj,
        id,
        degree,
        program,
        school,
        status,
        date
    ){

        modal.show();

        $("#modalmode").text("Edit Education");

        /* Set values */

        $('input[name="degree"][id="'+degree+'"]')
            .prop('checked', true);

        $('input[name="status"][id="'+status+'"]')
            .prop('checked', true);

        $("#degreeName").val(program);

        $("#degreeSchool").val(school);

        if(status === "On-going"){
            $("#graddate").hide();
        }else{
            $("#graddate").show();
        }

        /* Handle date */

        if(date &&
           date !== "0000-00-00 00:00:00"){

            $("#inputgraduation")
                .val(date.substring(0,10));

        }

        $("#submitdegree")
            .val("editeducation");

        $("#empedu")
            .val(id);

    }


    const grad = document.getElementById('Graduated');
    const ongoing = document.getElementById('On-going');

    if (grad) {
      grad.addEventListener('click', function() {
          $("#graddate").show();
      });
    }

    if (ongoing) {
      ongoing.addEventListener('click', function() {
          $("#graddate").hide();
      });
    }

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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#table_education').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

</body>

</html>