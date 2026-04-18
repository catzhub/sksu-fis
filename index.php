<?php 
  // header('location:503.php');
  ob_start();

  include 'include/dbconnect.php';
  include 'config.php';
  /*
  =============================
  REDIRECT IF ALREADY LOGGED IN
  =============================
  */

  // if (isset($_SESSION['auth']['logged_in'])) {

  //     header('location:employee-profile.php');
  //     exit;

  // }

  /*
  =============================
  LOAD SYSTEM CONFIG
  =============================
  */

  $getsystemconfig = "
      SELECT *
      FROM tblconfig
      LIMIT 1
  ";

  $runsystemconfig =
      mysqli_query($conn, $getsystemconfig);

  $rowconfig =
      mysqli_fetch_assoc($runsystemconfig);

  $_SESSION['system'] = [

      'name' =>
          $rowconfig['systemname'],

      'copyright' =>
          $rowconfig['systemcopyright']

  ];

  $login_button = '';



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>myPROFILE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="images/ccslogo.png" rel="icon">
  <link href="assets2/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets2/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo"><img style="position: relative;top:-2px" src="images/researchub_logo.png" alt="" class="img-fluid">
      </a>
      <!-- Uncomment below if you prefer to use text as a logo -->
      <!-- <h1 class="logo"><a href="index.html">Butterfly</a></h1> -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="p87hgtre4D2.php">myPROFILE</a></li>
<!--           <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="#contact">Login</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>What is myPROFILE </h1>
          <h2>myPROFILE is a system designed to manage employee records, including personal details, educational background, work experience, seminars and training, professional development, eligibility, and civic involvement. </h2>
          <!-- <h2>It provides an organized, efficient, and secure platform for tracking and updating employee profiles, ensuring streamlined HR processes and easy access to essential workforce data..</h2> -->
<br>
  <script src="https://accounts.google.com/gsi/client" async defer></script>

                      <!-- <p>-or-</p><br> -->
                     <!--  <div id="g_id_onload"
                           data-client_id="1067806573057-rmecopun8e761up24tb2ukui86h4600b.apps.googleusercontent.com"
                           data-context="signin"
                           data-ux_mode="popup"
                           data-login_uri="<?php echo BASE_URL; ?>/verify.php"
                           data-itp_support="true"
                           data-auto_prompt="false">
                      </div> -->


                      <div id="g_id_onload"
                           data-client_id="1067806573057-rmecopun8e761up24tb2ukui86h4600b.apps.googleusercontent.com"
                           data-callback="handleCredentialResponse"
                           data-auto_prompt="false">
                      </div>
                      
                      <div class="g_id_signin" width="100%"
                           data-type="standard"
                           data-shape="rectangular"
                           data-theme="outline"
                           data-text="signin_with"
                           data-size="large"
                           data-logo_alignment="left">
                      </div>
<?php 

// ============================

   // if($login_button == '' && 0)
   // {
   //  echo '<a href="logout.php"><button class="btn btn-danger">Sign Out </button></a>';
   // }
   // else
   // {
   //  echo 
   //  '
   //  <br>
   //     '.$login_button.'
   //    <br>

   //  ';
   // }

 ?> 
 <?php 
    // $getq = "SELECT * FROM `tblqoutes` ORDER BY RAND() LIMIT 1";
    // $rungetq = mysqli_query($conn, $getq);
    // $rowgetq = mysqli_fetch_assoc($rungetq);
    echo
    '
<footer class="blockquote-footer"> 
<cite>
</cite>
</footer>
    ';
 ?>
         
        </div>

                    <div class="col-12 d-flex justify-content-center align-items-center">
                    </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets2/img/hero-img.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <!-- <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p> -->
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets2/img/hero-img2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
       <!--  <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p> -->
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets2/img/hero-img3.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <!-- <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p> -->
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets2/img/hero-img5.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <!-- <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p> -->
      </div>
    </div>
  </div>
</div>


        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="text-center title">
          <h3>What we have achieved so far</h3>
          <p>ResearcHub provides a short summary of the information gathered.</p>
        </div>

        <div class="row counters position-relative">
<?php 
  $users = "SELECT * FROM `employees_2` WHERE empid >0";
  $runusers = mysqli_query($conn, $users);
  $usercount =  mysqli_num_rows($runusers);
?>
          <div class="col-lg-6 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $usercount ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>User(s)</p>
          </div>

?>
          <div class="col-lg-6 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="7" data-purecounter-duration="1" class="purecounter"></span>
            <p>Campuses</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->



    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container position-relative">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <?php 

                echo
                '
                  <div class="swiper-slide">
                    <div class="testimonial-item">
                    
                                  '; ?>

                                  <?php echo'
                      
                      
                      <h3>LENMAR T. CATAJAY</h3>
                      <h4>Author</h4>
                      <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                      </p>
                    </div>
                  </div><!-- End testimonial item -->
                ';
              // }

            ?>



          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

 

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>myPROFILE</h3>
            <p>
              Isulan <br>
              Sultan Kudarat<br>
              Philippines<br><br>
              <strong>Email:</strong> lenmarcatajay@sksu.edu.ph<br>
            </p>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        <!-- &copy; Copyright <strong><span>Butterfly</span></strong>. All Rights Reserved -->
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/butterfly-free-bootstrap-theme/ -->
        myPROFILE 
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets2/vendor/purecounter/purecounter.js"></script>
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets2/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets2/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>

  <script type="text/javascript">

            function handleCredentialResponse(response) {

              fetch("verify.php", {

                method: "POST",

                headers: {
                  "Content-Type": "application/json"
                },

                body: JSON.stringify({
                  credential: response.credential
                })

              })

              .then(res => res.json())

              .then(data => {

                console.log("Server response:", data);

                if (data.status === "success") {

                  window.location = data.redirect;

                } else {

                  alert(data.message);

                }

              })

              .catch(error => {

                console.error("Fetch error:", error);

              });

            }
  </script>

</body>

</html>