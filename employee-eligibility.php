<?php include'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Eligibility</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Employees</li> -->
          <li class="breadcrumb-item active">Eligibility</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-12">


          <div class="card">
            <div class="card-body pt-3">

              <button class="btn btn-outline-primary" onclick="openAddModalEligibility()">Add Eligibility</button>
             
              <!-- Table with stripped rows -->
              <div class="d-none1 d-lg-block1">
              <?php  
                $empid = $_SESSION['auth']['db']['empid'];
                $query="SELECT * FROM employee_eligibility WHERE empid = '$empid'";
                $select = mysqli_query($conn, $query);
                if (mysqli_num_rows($select)>0):
              ?>
              <table class="table table-sm table-responsive" id="table_eligibility">
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
                    <td><?=strtoupper($row['empel_title'])?></td>
                    <td><?=$row['empel_rating']?></td>
                    <td id="<?=$row['empel_date_conferment']?>"><?=date('m/d/Y', strtotime($row['empel_date_conferment'])) ?></td>
                    <td><?=strtoupper($row['empel_place'])?></td>
                    <td><?=$row['empel_number']?></td>
                    <td id="<?=$row['empel_date_validity']?>"><?php
                      if ($row['empel_date_validity']!='0000-00-00 00:00:00') {
                        echo date('m/d/Y', strtotime($row['empel_date_validity']));
                      }else{
                        echo 'N/A';
                      }
                    ?></td>
                    <td width="1%" style="white-space:nowrap" >
                        <button class="btn btn-outline-info rounded-pill btn-sm" onclick="edit_eligibility(this, <?=$row['empel_id']?>, <?=$rownum?>)"  title="Edit"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_eligibility(this, <?=$row['empel_id']?>, <?=$rownum?>)" title="Delete"><i class="bi bi-trash"></i></button>
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

  </main><!-- End #main -->
  <?php include'footer.php'; ?>
  <script type="text/javascript">

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
    $('#table_eligibility').DataTable({
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