<?php
session_start();
if (isset($_SESSION["user_id"])) {
} else {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        /* Container */

        .container {
            display: flex;
        }

        /* Sidebar */

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #1e293b;
            padding: 25px;
            color: white;
            position: fixed;
        }

        .logo h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #ec4899;
            font-size: 30px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 18px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .sidebar ul li a:hover,
        .sidebar ul .active a {
            background: #16a34a;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: #ec4899;
            border: none;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 40px;
            font-size: 16px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #db2777;
        }

        /* Main Content */

        .main-content {
            margin-left: 260px;
            width: 100%;
            padding: 25px;
        }

        /* Topbar */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-box {
            background: white;
            padding: 12px 18px;
            border-radius: 12px;
            width: 350px;

            display: flex;
            align-items: center;
            gap: 10px;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .notification {
            font-size: 22px;
            cursor: pointer;
            color: #16a34a;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        /* Banner */

        .banner {
            background: linear-gradient(to right, #16a34a, #ec4899);
            border-radius: 20px;
            padding: 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            color: white;
            margin-bottom: 30px;
        }

        .banner img {
            width: 250px;
        }

        .banner h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .banner p {
            margin-bottom: 20px;
        }

        .banner button {
            padding: 12px 20px;
            border: none;
            background: white;
            color: #16a34a;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Cards */

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 18px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);

            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 35px;
            color: #ec4899;
        }

        /* Details */

        .details {
            background: white;
            padding: 25px;
            border-radius: 20px;

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .details-header button {
            padding: 10px 18px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .detail-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 15px;
            border-left: 5px solid #ec4899;
        }

        .detail-box h4 {
            color: #64748b;
            margin-bottom: 10px;
        }

        .detail-box p {
            font-weight: 600;
        }

        /* Responsive */

        @media(max-width:900px) {

            .sidebar {
                width: 80px;
            }

            .sidebar .logo h2,
            .sidebar ul li a {
                font-size: 12px;
            }

            .main-content {
                margin-left: 80px;
            }

            .banner {
                flex-direction: column;
                text-align: center;
            }

            .banner img {
                width: 180px;
                margin-top: 20px;
            }

            .search-box {
                width: 200px;
            }

        }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">

        <!-- Sidebar -->

        <aside class="sidebar">

            <div class="logo">
                <h2>EduTrack</h2>
            </div>

            <ul>

                <li class="active">
                    <a href="#">
                        <i class="fa-solid fa-house"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa-solid fa-user"></i>
                        Profile
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa-solid fa-book"></i>
                        Courses
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa-solid fa-chart-column"></i>
                        Results
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa-solid fa-calendar-check"></i>
                        Attendance
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        Settings
                    </a>
                </li>

            </ul>
            <a href="logout.php">
                <button class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </a>

        </aside>

        <!-- Main Content -->

        <main class="main-content">

            <!-- Navbar -->

            <div class="topbar">

                <div class="search-box">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text" placeholder="Search here...">

                </div>

                <div class="top-right">

                    <i class="fa-regular fa-bell notification"></i>

                    <div class="profile">

                        <img src="https://i.pravatar.cc/50" alt="">

                        <div>
                            <h4>Rahul Sharma</h4>
                            <p>Student</p>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Welcome Banner -->

            <section class="banner">

                <div class="banner-text">

                    <h1>Welcome Back 👋</h1>

                    <p>
                        Track your academic progress and manage your records easily.
                    </p>

                    <button>View Report</button>

                </div>

                <img src="https://cdni.iconscout.com/illustration/premium/thumb/student-studying-online-4268393-3551765.png" alt="">

            </section>

            <!-- Cards -->

            <section class="cards">

                <div class="card">

                    <div>
                        <h2>85%</h2>
                        <p>Attendance</p>
                    </div>

                    <i class="fa-solid fa-calendar-check"></i>

                </div>

                <div class="card">

                    <div>
                        <h2>8.7 CGPA</h2>
                        <p>Performance</p>
                    </div>

                    <i class="fa-solid fa-chart-line"></i>

                </div>

                <div class="card">

                    <div>
                        <h2>6</h2>
                        <p>Courses</p>
                    </div>

                    <i class="fa-solid fa-book-open"></i>

                </div>

                <div class="card">

                    <div>
                        <h2>12</h2>
                        <p>Assignments</p>
                    </div>

                    <i class="fa-solid fa-file"></i>

                </div>

            </section>

            <!-- Student Details -->

            <section class="details">

                <div class="details-header">

                    <h2>Student Information</h2>

                    <button>Edit Profile</button>

                </div>

                <div class="detail-grid">

                    <div class="detail-box">
                        <h4>Full Name</h4>
                        <p>Rahul Sharma</p>
                    </div>

                    <div class="detail-box">
                        <h4>Email</h4>
                        <p>rahul@gmail.com</p>
                    </div>

                    <div class="detail-box">
                        <h4>Course</h4>
                        <p>BCA</p>
                    </div>

                    <div class="detail-box">
                        <h4>Semester</h4>
                        <p>4th Semester</p>
                    </div>

                    <div class="detail-box">
                        <h4>Phone</h4>
                        <p>9876543210</p>
                    </div>

                    <div class="detail-box">
                        <h4>Address</h4>
                        <p>New Delhi, India</p>
                    </div>

                </div>

            </section>

        </main>

    </div>

</body>

</html>