<?php include'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Eligibilities</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="employees.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Employees</li> -->
          <li class="breadcrumb-item active">Eligibilities</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Eligibilities</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->

              <!-- Table with stripped rows -->
              <table class="table table-sm" id="example1">
                <thead>
                  <tr>
                    <th>Name</th>
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
                  $campid =  $_SESSION['user_data_2']['campid'];
                  $query="SELECT * FROM employees_2
                  INNER JOIN employee_work ON employee_work.empid=employees_2.empid
                  WHERE campid = '$campid'
                  AND employees_2.empid > 1
                  ORDER BY emp_lname ASC, emp_fname ASC, empwo_date_start DESC
                  ";
                  $educ = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($educ)):
                ?>
                  <tr>
                    <td><?=strtoupper($row['emp_lname'].', '.$row['emp_fname'])?></td>                    
                    <td><?= date('m/d/Y', strtotime($row['empwo_date_start']))?></td>
                    <td>
                    <?php
                      if ($row['empwo_date_end'] == "9999-12-31 23:59:59") {
                          echo "PRESENT"; // Output "PRESENT" if the format is incorrect
                      } else {
                          echo date('m/d/Y', strtotime($row['empwo_date_end'])); // Output "PRESENT" if the format is incorrect
                      }
                    ?>
                    </td>
                    <td><?=strtoupper($row['empwo_position']) ?></td>
                    <td><?=$row['empwo_company']?></td>
                    <td class="text-end">
                    <?= is_numeric($row['empwo_salary']) ? number_format($row['empwo_salary'], 2, '.', ',') : $row['empwo_salary'] ?>
                    </td>
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
  document.title = "Report - List of Employee Educational Attainments";
</script>

</body>

</html>