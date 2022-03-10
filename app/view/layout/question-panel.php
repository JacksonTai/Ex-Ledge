<div class="panel dialog">
    <div class="vote-container">
        <i class="fa-solid fa-arrow-up fa-lg"></i>
        <p>95</p>
        <i class="fa-solid fa-arrow-down fa-lg"></i>
    </div>
    <div class="question">
        <div class="question-headers">
            <div class="question-caption">
                <p class="question-title">Is Ex-Ledge the best?</p>
                <p class="question-age">19 mins ago</p>
            </div>

            <?php if ($_SESSION['userId'][0] == "A") : ?>
                <div class="button">
                    <button class="button-answer">
                        <p>12 Answers</p>
                    </button>

                    <button class="button-remove">
                        <p>Remove</p>
                    </button>
                </div>
            <?php elseif ($_SESSION['userId'][0] == "U") : ?>
                <div class="button">
                    <button class="button-answer">
                        <p>12 Answers</p>
                    </button>
                </div>
            <?php endif; ?>

        </div>

        <div class="question-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo. 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
        </div>

        <div class="post-tags">
            <span>#Maths</span>
        </div>

        <div class="question-footer">
            <div class="question-owner">
                <img class="profile-picture" src="<?php echo $path; ?>public/img/profile.jpg" alt="Profile Image">
                <p class="posted-by">Posted by&nbsp</p>
                <p class="owner">Mike Wazowski</p>
            </div>

            <?php if ($_SESSION['userId'][0] == "A") : ?>
                <div class="button-mobile">
                    <i class="fa-solid fa-trash-can"></i>
                    <p class="remove-text">Remove</p>
                </div>
            <?php elseif ($_SESSION['userId'][0] == "U") : ?>
                <div class="button-mobile">
                    <i class="fa-solid fa-bookmark"></i>
                    <p class="bookmark-text">Bookmark</p>
                </div>
            <?php endif; ?>


        </div>
    </div>
</div>