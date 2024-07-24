<?php
    session_start();

    include "../includes/db.php";

    if(!isset($_SESSION['adminId'])){
        header("Location: ./login.php");
        exit();
    }

    /*DAILY DATA*/
    $dailyRegistrationSql = "SELECT * FROM students WHERE added_on LIKE '".date("Y-m-d")."%'";
    $dailyRegistrationRes = mysqli_query($connection, $dailyRegistrationSql);
    $dailyRegistrationData = mysqli_num_rows($dailyRegistrationRes);

    $dailyUnresolvedSql = "SELECT * FROM complaints WHERE added_on LIKE '".date("Y-m-d")."%' AND status = '0'";
    $dailyUnresolvedRes = mysqli_query($connection, $dailyUnresolvedSql);
    $dailyUnresolvedData = mysqli_num_rows($dailyUnresolvedRes);

    $dailyResolvedSql = "SELECT * FROM complaints WHERE added_on LIKE '".date("Y-m-d")."%' AND status = '0'";
    $dailyResolvedRes = mysqli_query($connection, $dailyResolvedSql);
    $dailyResolvedData = mysqli_num_rows($dailyResolvedRes);

    /*MONTHLY DATA*/
    $monthlyRegistrationSql = "SELECT * FROM students WHERE added_on LIKE '".date("Y-m-d")."%'";
    $monthlyRegistrationRes = mysqli_query($connection, $monthlyRegistrationSql);
    $monthlyRegistrationData = mysqli_num_rows($monthlyRegistrationRes);

    $monthlyUnresolvedSql = "SELECT * FROM complaints WHERE added_on LIKE '".date("Y-m-d")."%' AND status = '0'";
    $monthlyUnresolvedRes = mysqli_query($connection, $monthlyUnresolvedSql);
    $monthlyUnresolvedData = mysqli_num_rows($monthlyUnresolvedRes);

    $monthlyResolvedSql = "SELECT * FROM complaints WHERE added_on LIKE '".date("Y-m-d")."%' AND status = '0'";
    $monthlyResolvedRes = mysqli_query($connection, $monthlyResolvedSql);
    $monthlyResolvedData = mysqli_num_rows($dailyResolvedRes);

    /*ANNUAL OR YEARLY DATA*/
    $annualRegistrationSql = "SELECT * FROM students WHERE added_on LIKE '".date("Y-m-d")."%'";
    $annualRegistrationRes = mysqli_query($connection, $annualRegistrationSql);
    $annualRegistrationData = mysqli_num_rows($annualRegistrationRes);

    $annualUnresolvedSql = "SELECT * FROM complaints WHERE added_on LIKE '".date("Y-m-d")."%' AND status = '0'";
    $annualUnresolvedRes = mysqli_query($connection, $annualUnresolvedSql);
    $annualUnresolvedData = mysqli_num_rows($annualUnresolvedRes);

    $annualResolvedSql = "SELECT * FROM complaints WHERE added_on LIKE '".date("Y-m-d")."%' AND status = '0'";
    $annualResolvedRes = mysqli_query($connection, $annualResolvedSql);
    $annualResolvedData = mysqli_num_rows($dailyResolvedRes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../index.css">    
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard | CMS -Technical University of Mombasa</title>
    <style>
        body{
            display: flex;
            flex-direction: row;
            height: 100vh;
            overflow: hidden;
            width: 100vw;
        }

        .dashboard{
            padding: 10vh 5vw;
            background: rgba(0, 0, 0, 0.015);
            width: 100%;
            overflow-y: scroll;
        }

        .dash-header{
            display: flex;
            flex-direction: column;
            font-weight: 500;
            font-size: 1.25vw;
            color: var(--primary);
            padding-bottom: 4px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
        }

        .dash-header p:last-child{
            font-size: 0.8vw;
            color: rgba(0, 0, 0, 0.25);
        }

        .dash-body{
            display: flex;
            flex-direction: column;
        }

        .daily{
            padding: 2vh 2vw;
            margin-top: 2vh;
            display: flex;
            flex-direction: column;
            background: white;
            border-radius: 8px;
        }

        .daily .daily-header{
            font-weight: 600;
            font-size: 1.15vw;
        }

        .dash-items{
            display: flex;
            flex-direction: row;
            gap: 2vw;
        }

        .dash-item{
            margin-top: 1vh;
            padding: 2vh 2vw;
            display: flex;
            flex-direction: column;
            border-radius: 6px;
            width: 30vw;
        }

        .dash-item h2{
            font-weight: 600;
            font-size: 1.3vw;
            color: var(--primary);
        }

        .dash-item p{
            font-size: 1.35vw;
            font-weight: 500;
        }

        .dash-item p span{
            color: rgba(0, 0, 0, 0.5);
            font-size: 0.9vw;
        }

        .dash-item:first-child{
            background: #fcecec;
        }

        .dash-item:first-child h2{
            color: #fe2900;
        }

        .dash-item:nth-child(2){
            background: #eafcec;
        }

        .dash-item:nth-child(2) h2{
            color: #007700;
        }

        .dash-item:last-child{
            background: #ffe9fe;
        }

        .dash-item:last-child h2{
            color: #93248b;
        }
    </style>
</head>
<body>
    <?php include "./side.php"; ?>

    <section class="dashboard">
        <div class="dash-header">
            <p>Hello <?=$_SESSION['adminName']; ?>,</p>
            <p>This is what we have for you today</p>
        </div>

        <div class="dash-body">
            <div class="daily">
                <div class="daily-header">
                    <p>Today's Data</p>
                </div>

                <div class="dash-items">
                    <div class="dash-item">
                        <h2>Unresolved Complaints</h2>
                        <p>
                            <?=$dailyUnresolvedData; ?> <br>
                            <span>Pending Complaints</span>
                        </p>
                    </div>

                    <div class="dash-item">
                        <h2>Resolved Complaints</h2>
                        <p>
                            <?=$dailyResolvedData; ?> <br>
                            <span>Processed Complaints</span>
                        </p>
                    </div>

                    <div class="dash-item">
                        <h2>Registered Students</h2>
                        <p>
                            <?=$dailyRegistrationData; ?> <br>
                            <span>New students</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="daily">
                <div class="daily-header">
                    <p>This Month's Data</p>
                </div>

                <div class="dash-items">
                    <div class="dash-item">
                        <h2>Unresolved Complaints</h2>
                        <p>
                            <?=$monthlyUnresolvedData; ?><br>
                            <span>Pending Complaints</span>
                        </p>
                    </div>

                    <div class="dash-item">
                        <h2>Resolved Complaints</h2>
                        <p>
                            <?=$monthlyResolvedData; ?> <br>
                            <span>Processed Complaints</span>
                        </p>
                    </div>

                    <div class="dash-item">
                        <h2>Registered Students</h2>
                        <p>
                            <?=$monthlyRegistrationData ?> <br>
                            <span>New students</span>
                        </p>
                    </div>
                </div>
            </div>


            <div class="daily">
                <div class="daily-header">
                    <p>This Year's Data</p>
                </div>

                <div class="dash-items">
                    <div class="dash-item">
                        <h2>Unresolved Complaints</h2>
                        <p>
                            <?=$annualUnresolvedData; ?> <br>
                            <span>Pending Complaints</span>
                        </p>
                    </div>

                    <div class="dash-item">
                        <h2>Resolved Complaints</h2>
                        <p>
                            <?=$annualResolvedData; ?> <br>
                            <span>Processed Complaints</span>
                        </p>
                    </div>

                    <div class="dash-item">
                        <h2>Registered Students</h2>
                        <p>
                            <?=$annualRegistrationData; ?> <br>
                            <span>New students</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>