<?php
session_start();
require '../../helper/redirector.php';
include '../../helper/autoloader.php';
$path = '../../../';

$questions = new \Controller\Question;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../config/head.php' ?>
    <title>Home | Ex-Ledge</title>
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/student/home.css">
    <link rel="stylesheet" href="<?php echo $path; ?>public/css/layout/question.css">
</head>

<body>

    <?php include '../layout/header.php'; ?>

    <div class="main-sidebar-wrapper">

        <?php include '../layout/sidebar.php' ?>

        <main class="home--main main-content">
            <div class="home__header">
                <h2 class="home__header-title main-title">Question Asked:
                    <span class="home__quetion-asked">1289</span>
                </h2>
                <div class="home__header-btn-container">
                    <button class="home__header-btn home__header-btn--filter dialog">Filter</button>
                    <button class="home__header-btn home__header-btn--ask-question dialog">
                        <a class="home__header-link" href="askQuestion.php">Ask Question</a>
                    </button>
                </div>
            </div>
            <div class="home__body">
                <?php include '../layout/question.php'; ?>
            </div>
            <nav class="home__main-nav">
                <button class="home__main-nav-btn">
                    <a class="home__main-nav-link dialog" href="<?php echo $_SERVER['PHP_SELF'] . '?page=#'; ?>">Back</a>
                </button>
                <p class="home__main-nav-page">1</p>
                <button class="home__main-nav-btn">
                    <a class="home__main-nav-link dialog" href="<?php echo $_SERVER['PHP_SELF'] . '?page=#'; ?>">Next</a>
                </button>
            </nav>
        </main>

        <aside class="home--sidebar">
            <div class="home--sidebar__content home--sidebar__content--top-user dialog">
                <h3 class="home--sidebar__content-title">Top Users</h3>
                <a class="home--sidebar__top-user" href="profile.php?id=#">
                    <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                    <p class="sidebar-top-user__username">Username</p>
                </a>
                <a class="home--sidebar__top-user" href="profile.php?id=#">
                    <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                    <p class="sidebar-top-user__username">Username</p>
                </a>
                <a class="home--sidebar__top-user" href="profile.php?id=#">
                    <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                    <p class="sidebar-top-user__username">Username</p>
                </a>
                <a class="home--sidebar__top-user" href="profile.php?id=#">
                    <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                    <p class="sidebar-top-user__username">Username</p>
                </a>
                <a class="home--sidebar__top-user" href="profile.php?id=#">
                    <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
                    <p class="sidebar-top-user__username">Username</p>
                </a>
            </div>
            <div class="home--sidebar__content home--sidebar__content--hot-topic dialog">
                <h3 class="home--sidebar__content-title">Hot Topics</h3>
                <a class="home--sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
                <a class="home--sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
                <a class="home--sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
                <a class="home--sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
                <a class="home--sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
            </div>
        </aside>

    </div>

    <?php include '../layout/footer.php'; ?>

    <script src="<?php echo $path; ?>public/js/script.js"></script>
</body>

</html>