<aside class="layout-sidebar">
     <?php $url = $_SERVER['REQUEST_URI']; ?>
     <?php if (strpos($url, 'question')) : ?>
          <button class="layout-sidebar-btn layout-sidebar-btn--ask-question dialog">
               <a class="layout-sidebar-link" href="askQuestion.php">Ask Question</a>
          </button>
     <?php endif; ?>
     <div class="layout-sidebar__content layout-sidebar__content--top-user dialog">
          <h3 class="layout-sidebar__content-title">Top Users</h3>
          <a class="layout-sidebar__top-user" href="profile.php?id=#">
               <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
               <p class="sidebar-top-user__username">Username</p>
          </a>
          <a class="layout-sidebar__top-user" href="profile.php?id=#">
               <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
               <p class="sidebar-top-user__username">Username</p>
          </a>
          <a class="layout-sidebar__top-user" href="profile.php?id=#">
               <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
               <p class="sidebar-top-user__username">Username</p>
          </a>
          <a class="layout-sidebar__top-user" href="profile.php?id=#">
               <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
               <p class="sidebar-top-user__username">Username</p>
          </a>
          <a class="layout-sidebar__top-user" href="profile.php?id=#">
               <img class="sidebar-top-user__profile-img profile-icon" src="<?php echo $path ?>public/img/profile1.jpg" alt="Profile Image">
               <p class="sidebar-top-user__username">Username</p>
          </a>
     </div>
     <div class="layout-sidebar__content layout-sidebar__content--hot-topic dialog">
          <h3 class="layout-sidebar__content-title">Hot Topics</h3>
          <a class="layout-sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
          <a class="layout-sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
          <a class="layout-sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
          <a class="layout-sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
          <a class="layout-sidebar__hot-topic" href="question.php?id=#">What is Xyz?</a>
     </div>
</aside>