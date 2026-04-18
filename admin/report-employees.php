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

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Employees</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->

              <!-- Table with stripped rows -->
              <table class="table table-sm" id="example1">
                <thead>
                  <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Rank</th>
                    <th>Designation</th>
                    <th>Email</th>
                    <th>Campus</th>
                  </tr>
                </thead>
                <tbody>
                <?php  
                  $campid =  $_SESSION['user_data_2']['campid'];
                  $query = "SELECT * FROM employees_2 
                  INNER JOIN campuses USING(campid)
                  WHERE campid = '$campid'
                  AND empid > 1
                  AND employees_2.dateDeleted IS NULL
                  ORDER BY emp_lname ASC";
                  $select = mysqli_query($conn,$query);
                  while($rows = mysqli_fetch_assoc($select)):
                ?>
                  <tr>
                    <td><?=$rows['emp_lname']?></td>
                    <td><?=$rows['emp_fname']?></td>
                    <td><?=$rows['emp_mname']?></td>
                    <td><?=$rows['emp_rank']?></td>
                    <td><?=$rows['emp_designation']?></td>
                    <td><?=$rows['emp_email']?></td>
                    <td><?=$rows['campname']?></td>
                  </tr>
                <?php   endwhile ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php   include 'footer.php'; ?>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
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
<script type="text/javascript">
  document.title = "Report - List of Employees";
</script>

</body>

</html>