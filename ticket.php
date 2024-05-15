<?php
session_start();
if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Support Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">User</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="backend/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="ticket.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Create Ticket
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    User
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Create Support Ticket</h1>
                    <ol class="breadcrumb mb-4">

                    </ol>

                    <form id="ticketform" class="row g-3 m-4">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Support Type</label>
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">System ID</label>
                            <select id="systemid" class="form-select" name="systemid">
                                <option selected>Select...</option>
                                <?php
                                require_once('backend/dbconnetion.php');
                                $sql = "SELECT SystemID, SystemName FROM systemdata WHERE UserID = $userid";
                                $response = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($response))
                                {
                                    $sysid = $row['SystemID'];
                                    $sysname = $row['SystemName'];
                                     echo "<option value=".$sysid.">".$sysid. " - ".$sysname."</option>";
                                }
                                
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Support Type</label>
                            <select id="supporttype" class="form-select" name="supporttype">
                                <option selected>Select...</option>
                                <option value="technical">Technical</option>
                                <option value="billing">Billing</option>
                                <option>....</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Urgency</label>
                            <select id="urgency" class="form-select" name="urgency">
                                <option selected>Select...</option>
                                <option value="low">Low</option>
                                <option value="moderate">Moderate</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Details</label>
                            <div class="input-group">
                                <textarea name="details" id="details" class="form-control" aria-label="With textarea" placeholder="Write here..."></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <button id="resetticket" type="reset" class="btn btn-success">Delete</button>
                            <button id="ticketbtn" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; CSE482 Website 2022</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>