<?php include'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Employees</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <li class="breadcrumb-item active">Employee Trainings & Seminars</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Employee Trainings & Seminars</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->

              <!-- Table with stripped rows -->
              <table class="table table-sm" id="example1">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Inclusive Dates</th>
                  </tr>
                </thead>
                <tbody>
                <?php  
                  $campid =  $_SESSION['user_data_2']['campid'];
                  $query = "SELECT * FROM employees_2 
                  INNER JOIN employee_seminar ON employee_seminar.empid=employees_2.empid
                  WHERE campid = '$campid'
                  AND employees_2.empid > 1
                  ORDER BY emp_lname ASC, empsem_date_start DESC";
                  // $query = "SELECT * FROM employees_2 
                  // INNER JOIN employee_seminar USING (empid)
                  // ";
                  $select = mysqli_query($conn,$query);
                  while($rows = mysqli_fetch_assoc($select)):
                ?>
                  <tr>
                    <td><?=$rows['emp_lname'].', '.$rows['emp_fname'].' '.$rows['emp_mname'][0]?></td>
                    <td><?=$rows['empsem_title']?></td>
                    <td><?=date('m/d/Y',strtotime($rows['empsem_date_start'])).' - '.date('m/d/Y',strtotime($rows['empsem_date_end']))?></td>
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
      "responsive": true, "lengthChange": true, "autoWidth": false,
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
  document.title = "Report - List of Trainings & Seminars";
</script>

</body>

</html>