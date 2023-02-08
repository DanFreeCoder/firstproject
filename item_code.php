<?php
include './config/connection.php';
include './objects/clsitemcodes.php';

$database = new intranetconnect();
$db = $database->connect();

$page = new clsitemcodes($db);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/innoland.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .search {
            float: right;
        }

        #search {
            color: whitesmoke;
        }



        .card {
            padding-bottom: 30px;
        }
    </style>
</head>

<body>

    <?php include 'includes/header.php'; ?>
    <!-- header section -->

    <?php include 'includes/sidebar.php'; ?>
    <!-- sidebar section -->
    <!--  -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1><i class="bi bi-list-ol"></i> Item Codes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Item Codes</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- start Left side columns -->
                        <div class="d-flext justify-content-start mb-2">
                            <div class="btn btn-danger" id="delete_code"> <i class="bi bi-trash3"></i> Delete </div>
                        </div>

                        <div class="card post">
                            <table style="width:100%;" id="post-table" class="table table-dark table-striped mt-3" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check_all"></input></th>
                                        <th>ITEM CODE</th>
                                        <th>
                                            <center>ITEM DESCRIPTION</center>
                                        </th>
                                        <th>
                                            <center>UNIT of MEASURE</center>
                                        </th>
                                        <th>
                                            <center>ITEM CLASSIFICATION</center>
                                        </th>
                                        <th>
                                            <center>TRADE CLASSIFICATION</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="post-body">
                                    <?php
                                    //operations
                                    $rows = $page->itemcodes();

                                    while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                    <tr>
                    <td><input type="checkbox" name="form_code" class="checklist" value="' . $row['id'] . '"></td>
                    <td>' . $row['itemcode'] . '</td>
                    <td>' . $row['itemdesc'] . '</td>
                    <td>' . $row['unit'] . '</td>
                    <td>' . $row['class'] . '</td>
                    <td>' . $row['category'] . '</td>
              

                </tr>
                    ';
                                    }

                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div><!-- end Left side columns -->
                </div>

            </div> <!-- end of row class -->
        </section>

    </main><!-- End #main -->

    <?php include 'includes/footer.php'; ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="dist/js/jquery.min.js" type="text/javascript"></script>
    <script src="dist/js/jquery.dataTables.js" type="text/javascript"></script>
    <script src="dist/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="dist/js/bootstrap.js" type="text/javascript"></script>
    <script src="dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        $(document).ready(function() {


            // log out action
            $('.logout').on('click', function(e) {
                e.preventDefault();
                if (confirm('You are about to sign out!')) {
                    location.href = $(this).attr("href");
                }
            });

            <?php include 'includes/hover.php'; ?>
            $('#post-table').DataTable({
                "aLengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
            //change the color of datatable filter
            $('.dataTables_filter input').css("color", "whitesmoke").css("background-color", "#171819")
            $('.card .dataTables_length select').css("color", "whitesmoke").css("background-color", "#171819")

        });
        $('input').blur(function(e) {
            $(this).css("background-color", "#3a3b3c").css("color", "whitesmoke")
        })
    </script>

    <!--select and hide the EDIT button when multiple selection happens-->
    <script>
        $('#check_all').change(function(e) {
            e.preventDefault();
            if ($(this).prop('checked')) {
                var table = $(e.target).closest('table');
                $('tbody tr td input[type="checkbox"]').each(function() {
                    $('td input:checkbox', table).prop('checked', true);
                });
            } else {
                $('tbody tr td input[type="checkbox"]').each(function() {
                    $('td input:checkbox', table).prop('checked', false);
                });
            }

        });
    </script>

    <!-- get all value of checked item -->
    <script>
        $('#delete_code').on('click', function(e) {
            e.preventDefault();

            var form_id = []

            $('input:checkbox[name=form_code]:checked').each(function() {
                form_id.push($(this).val());
            })
            if (form_id < 1) {
                alert('Please select the specific user');
            } else {
                if (confirm('Warning: Are you sure to remove this user?')) {
                    alert(form_id)
                    $.ajax({
                        type: 'POST',
                        url: 'controls/delete_code.php',
                        data: {
                            id: form_id
                        },

                        success: function(response) {
                            if (response > 0) {
                                alert('Users successfully Removed!');
                                location.reload(500);
                            } else {
                                alert('error');
                            }
                        }
                    })

                }

            }


        });
    </script>

    <!-- modal Setting Update -->
    <!-- <script>
    function update() {
      const password = $('#password').val();
      const retype = $('#retype_password').val();
      const id = $('#upd-id').val();
      const mydata = 'id=' + id + '&password=' + password;
      if (password != '') {
        if (password == retype) {
          $.ajax({
            type: 'POST',
            url: 'controls/update-pass.php',
            data: mydata,
            success: function(response) {
              if (response > 0) {
                $('#settingmodal').modal('toggle')
                $('#user_current_pass').modal('show')
              }
            }
          })
        } else {
          alert('password is not match')
        }
      } else {
        alert('Fill the neccessary fields');
      }

    }
  </script> -->

</body>

</html>