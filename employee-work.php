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

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">

              <button class="btn btn-outline-primary" onclick="openAddModalWork()">Add Work Experience</button>

              <div class="d-none1 d-lg-block1">
                <!-- Table with stripped rows -->
                <?php  
                $empid = $_SESSION['auth']['db']['empid'];
                  $query="SELECT * FROM employee_work WHERE empid = '$empid' ORDER BY empwo_date_start DESC";
                  $select = mysqli_query($conn, $query);
                  if (mysqli_num_rows($select)>0):
                ?>

                <table class="table table-sm table-responsive " id="table_work">
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
                      <td id="<?=$row['empwo_date_start'] ?>"><?= date('m/d/Y', strtotime($row['empwo_date_start']))?></td>
                      <td id="<?=$row['empwo_date_end'] ?>">
                      <?php
                        if ($row['empwo_date_end'] == "9999-12-31 23:59:59") {
                            echo "PRESENT"; // Output "PRESENT" if the format is incorrect
                        } else {
                            echo date('m/d/Y', strtotime($row['empwo_date_end'])); // Output "PRESENT" if the format is incorrect
                        }
                      ?>
                        
                      </td>
                      <td><?=strtoupper($row['empwo_position'])?></td>
                      <td><?=strtoupper($row['empwo_company'])?></td>
                      <td class="text-end">
                        <?php
                        if (is_numeric($row['empwo_salary'])) {
                          echo number_format($row['empwo_salary'], 2, '.', ',');
                        }else{
                          echo $row['empwo_salary'];
                        }
                        ?>
                      </td>
                      <td class="text-center"><?=$row['empwo_pay_grade']?></td>
                      <td class="text-center"><?=strtoupper($row['empwo_status'])?></td>
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
              </div>


            </div>
          </div>

        </div>
      </div>
    </section>

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
                  <input type="text" class="form-control" name="work_salary" id="work_salary" required step="0.01" min="0">
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
      var salary = row.cells[4].innerHTML;
      $("#modalWork #work_position").val(row.cells[2].innerHTML);   
      $("#modalWork #work_company").val(row.cells[3].innerHTML);
      $("#modalWork #work_salary").val(salary.trim());
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#table_work').DataTable({
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