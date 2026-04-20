<?php include'header.php'; ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Forms & Documents</h1>
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
                  <button type="button" class="btn btn-outline-primary" onclick="openUploadModal()">Upload</button>
              <!-- </div> -->
              <div class="d-none1 d-lg-block1">
              <!-- Table with stripped rows -->
              <?php  
                $empid = $_SESSION['auth']['db']['empid'];

                $stmt = $conn->prepare("
                    SELECT *
                    FROM employee_files
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
                    <th>File Name</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Uploaded</th>
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
                    <td> <?=htmlspecialchars( $row['file_title'] )?> </td>
                    <td><?=htmlspecialchars($row['file_category'])?></td>
                    <td><?=htmlspecialchars($row['file_type'])?></td>
                    <td><?=number_format($row['file_size']/1024,2)?> KB</td>
                    <td><?=date('F d, Y', strtotime($row['uploaded_at']))?></td>
                    <td width="1%" style="white-space:nowrap" >
                        <button
                          class="btn btn-outline-success rounded-pill btn-sm"
                          onclick="download_file(
                            <?=$row['file_id']?>,
                            '<?=htmlspecialchars($row['file_source'])?>',
                            '<?=htmlspecialchars($row['file_link'])?>'
                            )"
                          title="Download">

                          <i class="bi bi-download"></i>

                        </button>

                        <button
                          class="btn btn-outline-primary rounded-pill btn-sm"

                          onclick="edit_file(
                            <?=$row['file_id']?>,
                            '<?=htmlspecialchars($row['file_title'],ENT_QUOTES)?>',
                            '<?=htmlspecialchars($row['file_category'],ENT_QUOTES)?>',
                            '<?=htmlspecialchars($row['file_source'],ENT_QUOTES)?>',
                            '<?=htmlspecialchars($row['file_link'],ENT_QUOTES)?>',
                            '<?=htmlspecialchars($row['file_description'],ENT_QUOTES)?>'
                          )"

                          title="Edit">

                        <i class="bi bi-pencil"></i>

                        </button>
                        <button class="btn btn-outline-danger rounded-pill btn-sm" onclick="delete_file(this, <?=$row['file_id']?>)" title="Delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                <?php endwhile ?>
                </tbody>
              </table>
            <?php else: ?>

            <p class="text-muted">
              No files found.
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
              <form method="POST" action="../requests_manager.php" enctype="multipart/form-data">
                <input type="hidden" name="request" id="requestMode" value="uploadfile">
                <input type="hidden" name="file_id" id="file_id">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?? '' ?>">
                <input type="hidden" name="mode" id="mode" value="add">
                <div class="row mb-3">



                  <label class="form-label">
                  Document Category
                  </label>

                   <div class="col-md-8 col-lg-12">
                    <select name="file_category"
                            class="form-control"
                            required>

                    <option value="">
                    Select Category
                    </option>

                    <option value="Form">
                    Form
                    </option>

                    <option value="Transcript">
                    Transcript
                    </option>

                    <option value="Certificate">
                    Certificate
                    </option>

                    <option value="ID">
                    ID
                    </option>

                    <option value="Others">
                    Others
                    </option>

                    </select>
                  </div>

                </div>

                <div class="row mb-3">
                  <label class="form-label">Document Title</label>
                  <div class="col-md-8 col-lg-12">
                    <input type="text" name="file_title" class="form-control" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="form-label">Source Type</label>
                  <div class="col-md-8 col-lg-12">
                    <select name="file_source" id="file_source" class="form-control" required> 
                      <option value="upload">Upload File</option>
                      <option value="link">Provide Link</option>
                    </select>
                  </div>
                </div>


                <div class="row mb-3">

                  <label class="form-label">
                  Upload File
                  </label>

                  <div class="col-md-8 col-lg-12">

                    <div id="uploadField">

                      <input type="file"
                             name="upload_file"
                             class="form-control">

                    </div>

                    <div id="linkField"
                         style="display:none;">

                      <input type="url"
                             name="file_link"
                             class="form-control"
                             placeholder="https://...">

                    </div>
                    
                  </div>

                </div>


                <div class="row mb-3">

                </div>

                <div class="row mb-3">

                  <label class="form-label">
                  File Description
                  </label>
                   <div class="col-md-8 col-lg-12">

                    <textarea name="file_description" rows="2" class="form-control"></textarea>
                  </div>
                </div>

                <div class="col-md-8 col-lg-12">

                  <button class="btn btn-primary"
                          type="submit">

                    Upload File

                  </button>
                  
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







<iframe id="downloadFrame"
        style="display:none;">
</iframe>










  <?php include'footer.php'; ?>
  <script type="text/javascript">

    const modal =
    new bootstrap.Modal(
    document.getElementById('modalEducation')
    );

    $("#file_source").change(function(){

        if($(this).val()=="upload"){

            $("#uploadField").show();
            $("#linkField").hide();

        }
        else{

            $("#uploadField").hide();
            $("#linkField").show();

        }

    });


    function download_file(
        file_id,
        source,
        link
    ){

        /* ============================
           IF LINK → OPEN NEW TAB
        ============================ */

        if(source === "link"){

            if(link){

                window.open(
                    link,
                    "_blank"
                );

            }
            else{

                alert(
                "Invalid link"
                );

            }

            return;

        }


        /* ============================
           IF FILE → DOWNLOAD
        ============================ */

        const frame =
        document.getElementById(
        'downloadFrame'
        );

        frame.src =
        "../download_file.php?id="
        + file_id;

    }

    function openUploadModal(){

        modal.show();

        $("#modalmode")
        .text("Upload File");

        $("#requestMode")
        .val("uploadfile");

        $("#file_id").val("");

        $("input[name='file_title']").val("");

        $("textarea[name='file_description']").val("");

    }


    function delete_file(obj,id){

      var request = 'deletefile';

      Swal.fire({
        title: "Are you sure?",
        text: "This file will be permanently deleted.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"

      }).then((result) => {

        if (result.isConfirmed) {

          $.ajax({

            url: 'requests_manager.php',

            type: 'POST',

            data: {

              id: id,
              request: request

            },

            success: function(response) {

              try {

                response = JSON.parse(response);

                if (response.status === 'success') {

                  obj.closest('tr').remove();

                  Swal.fire({
                    title: "Deleted!",
                    text: "File deleted successfully.",
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

    function edit_file(
        id,
        title,
        category,
        source,
        link,
        description
    ){

        modal.show();

        $("#modalmode")
        .text("Edit File");

        /* change request */

        $("#requestMode")
        .val("updatefile");

        $("#file_id")
        .val(id);

        $("input[name='file_title']")
        .val(title);

        $("select[name='file_category']")
        .val(category);

        $("#file_source")
        .val(source)
        .trigger("change");

        $("input[name='file_link']")
        .val(link);

        $("textarea[name='file_description']")
        .val(description);

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