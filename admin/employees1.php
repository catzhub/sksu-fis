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
              <table class="table table-sm datatable">
                <thead>
                  <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Email</th>
                    <th>Email</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php  
                  $campid =  $_SESSION['user_data_2']['campid'];
                  $query = "SELECT * FROM employees_2 
                  INNER JOIN campuses USING(campid)
                  WHERE campid = '$campid'
                  AND empid > 1
                  ORDER BY emp_lname ASC";
                  $select = mysqli_query($conn,$query);
                  while($rows = mysqli_fetch_assoc($select)):
                ?>
                  <tr>
                    <td><?=$rows['emp_lname']?></td>
                    <td><?=$rows['emp_fname']?></td>
                    <td><?=$rows['emp_mname']?></td>
                    <td><?=$rows['emp_email']?></td>
                    <td><?=$rows['campname']?></td>
                    <td width="1%" style="white-space:nowrap">
                      <a class="btn btn-outline-info rounded-pill btn-sm" href="employee-profile.php?a=<?=$rows['empid']?>"  title="Edit"><i class="bi bi-pencil-square"></i> Details</a>
                    </td>
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

</body>

</html>