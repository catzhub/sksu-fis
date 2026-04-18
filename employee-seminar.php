<?php include'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Trainings & Seminars</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Employees</li> -->
          <li class="breadcrumb-item active">Trainings & Seminars</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <button class="btn btn-outline-primary" onclick="openAddModalSeminar()">Add Training/Seminar</button>
              <!-- Table with stripped rows -->
              <div class=" d-none1 d-lg-block1">
              <?php  
                $empid = $_SESSION['auth']['db']['empid'];
                $query="SELECT * FROM employee_seminar WHERE empid = '$empid' ORDER BY empsem_date_start DESC";
                $select = mysqli_query($conn, $query);
                if (mysqli_num_rows($select)>0):
              ?>
              <table class="table table-sm table-responsive" id="table_seminar">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Hours</th>
                    <th>Type</th>
                    <th>Sponsor</th>
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
                    <td><?=strtoupper($row['empsem_title'])?></td>
                    <td><?=strtoupper($row['empsem_category'])?></td>
                    <td id="<?=$row['empsem_date_start']?>">
                      <?php 
                        if ($row['empsem_date_start']!="0000-00-00 00:00:00") {
                          echo date('m/d/Y', strtotime($row['empsem_date_start']));
                        }  
                       ?>
                    </td>
                    <td id="<?=$row['empsem_date_end']?>">
                      <?php 
                        if ($row['empsem_date_end']!="0000-00-00 00:00:00") {
                          echo date('m/d/Y', strtotime($row['empsem_date_end']));
                        }  
                       ?>
                    </td>
                    <td><?=$row['empsem_hours']?></td>
                    <td><?=strtoupper($row['empsem_type'])?></td>
                    <td><?=strtoupper($row['empsem_sponsor'])?></td>
                    <td width="1%" style="white-space:nowrap" >
                        <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_seminar(this, <?=$row['empsem_id']?>, <?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_seminar(this, <?=$row['empsem_id']?>, <?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
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

    <div class="modal fade" id="modalSeminar" tabindex="-1">
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
                        <input class="form-check-input" type="radio" name="category" id="Training" value="Training" checked="">
                        <label class="form-check-label" for="Training">
                          Training
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="Seminar" value="Seminar">
                        <label class="form-check-label" for="Seminar">
                          Seminar
                        </label>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <label for="degreeName" class="form-label">Title</label>
                  <textarea type="text" class="form-control" name="title" id="title" value="" required="" placeholder="Title of Training / Seminar" rows="3"></textarea>
                  <div class="invalid-feedback">
                    Please provide title for training / seminar!
                  </div>
                </div>
                <div class="col-md-6" id="divstartdate">
                  <label for="startdate" class="form-label ">From</label>
                  <input type="date" class="form-control datepicker" name="startdate" id="startdate">
                  <div class="invalid-feedback">
                    Please provide starting date!
                  </div>
                </div>
                <div class="col-md-6" id="divenddate">
                  <label for="enddate" class="form-label ">To</label>
                  <input type="date" class="form-control datepicker" name="enddate" id="enddate">
                  <div class="invalid-feedback">
                    Please provide ending date!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="hours" class="form-label">No. of Hours</label>
                  <input type="number" class="form-control" name="hours" id="hours" value="" required="">
                  <div class="invalid-feedback">
                    Please provide number of hours!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="hours" class="form-label">Type (Managerial/Supervisory/Technical/etc)</label>
                  <input type="text" class="form-control" name="semtype" id="semtype" value="" required="">
                  <div class="invalid-feedback">
                    Please provide type of training/seminar!
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="sponsor" class="form-label">Sponsor</label>
                  <textarea type="text" class="form-control" name="sponsor" id="sponsor" value="" required="" placeholder="Sultan Kudarat State University" rows="2"></textarea>
                  <div class="invalid-feedback">
                    Please provide name of sponsor!
                  </div>
                </div>
                
                <input class="" type="hidden" name="empsem" id="empsem" >
                <div class="col-12">
                  <button class="btn btn-primary" type="submit" name="request" id="submitseminar" value="">Submit form</button>
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
    function delete_seminar(obj,id, rownum){

      var row = document.getElementById('table_seminar').rows[rownum];
      var request = 'deleteseminar'
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

    function edit_seminar(obj, id, rownum){
      $("#modalSeminar").modal('show');
      $("#modalSeminar #modalmode").text("Edit Seminar");

      var row = document.getElementById('table_seminar').rows[rownum];

      $('input[name="category"][id="'+row.cells[1].innerHTML+'"]').prop('checked', true);

      $("#modalSeminar #title").val(row.cells[0].innerHTML);   
      $("#modalSeminar #hours").val(row.cells[4].innerHTML);
      $("#modalSeminar #semtype").val(row.cells[5].innerHTML);
      $("#modalSeminar #sponsor").val(row.cells[6].innerHTML);


      var date = row.cells[2].id+" EDT";
      var formattedDate = new Date(date).toISOString().slice(0, 10);

      $("#modalSeminar #startdate").val(formattedDate);

      var date = row.cells[3].id+" EDT";
      var formattedDate = new Date(date).toISOString().slice(0, 10);

      $("#modalSeminar #enddate").val(formattedDate);

      $("#modalSeminar #submitseminar").val("editseminar");
      $("#modalSeminar #empsem").val(id);
      // alert(id);
    }

    function openAddModalSeminar(){
      $("#modalSeminar").modal('show');
      $("#modalSeminar #modalmode").text("Add Training/Seminar");
      $("#modalSeminar #submitseminar").val("addseminar");


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
    $('#table_seminar').DataTable({
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