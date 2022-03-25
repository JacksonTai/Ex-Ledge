/* -- Section view modification -- */
let profileBannerBtns = document.querySelectorAll(
  ".profile__banner-navbar-btn"
);

for (let profileBannerBtn of profileBannerBtns) {
  profileBannerBtn.addEventListener("click", styleBtn);
}

function styleBtn() {
  for (let profileBannerBtn of profileBannerBtns) {
    if (profileBannerBtn.classList.contains("profile-btn-selected")) {
      profileBannerBtn.classList.remove("profile-btn-selected");
    }
  }
  this.classList.add("profile-btn-selected");
  switchSection(this.dataset.section);
}

let profileSections = document.querySelectorAll(".profile-section");

function switchSection(section) {
  let showSection = "profile-section-selected";
  let showFlexSection = "profile-section-selected--flex";
  for (let profileSection of profileSections) {
    if (profileSection.classList.contains(showSection)) {
      profileSection.classList.remove(showSection);
    }
    if (profileSection.classList.contains(showFlexSection)) {
      profileSection.classList.remove(showFlexSection);
    }
  }
  if (section == "overview") {
    showSection = showFlexSection;
  }
  document
    .querySelector(`.profile-section--${section}`)
    .classList.add(showSection);
}

/* -- Overview section -- */
let aboutMeEditBtn = document.querySelector(".overview--about__edit-btn");
let aboutMeContent = document.querySelector(".overview--about__content");
let aboutMeInput = document.querySelector(".overview--about__bio-input");
let aboutMeBtnContainer = document.querySelector(
  ".overview--about__bio-btn-container"
);
let aboutMeCancelBtn = document.querySelector(
  ".overview--about__bio-cancel-btn"
);
let aboutMeConfirmBtn = document.querySelector(
  ".overview--about__bio-confirm-btn"
);

if (aboutMeEditBtn) {
  aboutMeEditBtn.addEventListener("click", () => {
    aboutMeContent.style.display = "none";
    aboutMeEditBtn.style.display = "none";
    aboutMeInput.style.display = "block";
    aboutMeBtnContainer.style.display = "flex";
  });
}

aboutMeCancelBtn.addEventListener("click", hideEditField);
aboutMeConfirmBtn.addEventListener("click", async function () {
  try {
    await fetch(`../../controller/user.php?bio=${aboutMeInput.value.trim()}`);

    let res = await fetch(
      `../../controller/user.php?userId=${aboutMeContent.dataset.userId}`
    );
    let data = await res.json();

    if (data.bio) {
      aboutMeContent.textContent = data.bio;
    } else {
      aboutMeContent.textContent = "Your about me section is currently empty.";
    }
    hideEditField();
  } catch (e) {
    console.log("Error: ", e);
  }
});

function hideEditField() {
  aboutMeContent.style.display = "block";
  aboutMeEditBtn.style.display = "block";
  aboutMeInput.style.display = "none";
  aboutMeBtnContainer.style.display = "none";
}

/* -- Modal opening and closing -- */
let editProfileBtn = document.querySelector(".profile__edit-btn");
let deleteAccountBtn = document.querySelector(".profile__delete-btn");
let verifyLink = document.querySelector(".profile__banner-verify-link");

if (editProfileBtn) {
  editProfileBtn.addEventListener("click", openModal);
}
if (deleteAccountBtn) {
  deleteAccountBtn.addEventListener("click", openModal);
}
if (verifyLink) {
  verifyLink.addEventListener("click", openModal);
}

let modals = document.querySelectorAll(".modal");
let modalsOverlay = document.querySelectorAll(".modal-overlay");
let modalsCloseBtn = document.querySelectorAll(".modal__close-btn");

function openModal() {
  // Check if btn classname contains extracted modifier name in modal classname.
  for (let modal of modals) {
    if (this.className.includes(modal.className.split("-")[2])) {
      modal.style.display = "block";
    }
  }

  // Check if btn classname contains extracted modifier name in modal overlay classname.
  for (let modalOverlay of modalsOverlay) {
    if (this.className.includes(modalOverlay.className.split("-")[4])) {
      modalOverlay.style.display = "flex";
    }
  }

  // Avoid user scrolling the browser if modal is being opened.
  document.body.classList.add("no-scroll");
}

for (let modalCloseBtn of modalsCloseBtn) {
  modalCloseBtn.addEventListener("click", closeModal);
}

function closeModal() {
  // closest() - ref: https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
  this.closest(".modal").style.display = "none";
  this.closest(".modal-overlay").style.display = "none";
  document.body.classList.remove("no-scroll");
  window.location.href = "profile.php";
}

/* -- Verify account modal -- */
let verifyAccountForm = document.querySelector(".verify-form");
if (verifyAccountForm) {
  verifyAccountForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    try {
      let res = await fetch("../../controller/user.php", {
        method: "POST",
        body: formData,
      });
      let errMsg = await res.json();
      // Redirect to profile page again once there is no error messages.
      if (!errMsg) {
        window.location.href = "profile.php";
      } else {
        let usernameErrMsg = document.querySelector(
          ".verify-form__err-msg--full-name"
        );
        let ageErrMsg = document.querySelector(".verify-form__err-msg--nric");
        usernameErrMsg.textContent = decodeEntity(errMsg.fullName);
        ageErrMsg.textContent = decodeEntity(errMsg.nric);
      }
    } catch (e) {
      console.log(e);
    }
  });
}

/* -- Edit profile modal -- */
let editProfileForm = document.querySelector(".edit-profile-form");
editProfileForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  try {
    let res = await fetch("../../controller/user.php", {
      method: "POST",
      body: formData,
    });
    let errMsg = await res.json();

    // Redirect to profile page again once there is no error messages.
    if (!errMsg) {
      window.location.href = "profile.php";
    } else {
      // Destruct the errMsg object.
      let { username, age, gender } = errMsg;
      let usernameErrMsg = document.querySelector(
        ".edit-profile__err-msg--username"
      );
      let ageErrMsg = document.querySelector(".edit-profile__err-msg--age");
      let genderErrMsg = document.querySelector(
        ".edit-profile__err-msg--gender"
      );
      usernameErrMsg.textContent = decodeEntity(username);
      ageErrMsg.textContent = decodeEntity(age);
      genderErrMsg.textContent = decodeEntity(gender);
    }
  } catch (e) {
    console.log(e);
  }
});

// Decode HTML entity code to use in JavaScript.
const decodeEntity = function (entityCode) {
  let textarea = document.createElement("textarea");
  textarea.innerHTML = entityCode;
  return textarea.value;
};

/* -- Delete account modal -- */
let deleteAccountPassword = document.querySelector(
  ".modal__delete-account-password"
);
let deletAccountbtn = document.querySelector(".modal__delete-account-btn");
let validPassword = false;

// Check if password is correct in real time.
deleteAccountPassword.addEventListener("input", async function () {
  deletAccountbtn.classList.add("modal__delete-account-btn--disabled");
  try {
    let res = await fetch(
      `../../controller/signin.php?email=${deleteAccountPassword.dataset.email.trim()}&
      password=${deleteAccountPassword.value}`
    );
    if (await res.json()) {
      deletAccountbtn.classList.remove("modal__delete-account-btn--disabled");
      validPassword = true;
    }
  } catch (e) {
    console.log(e);
  }
});

// Delete account process.
deletAccountbtn.addEventListener("click", async function () {
  if (validPassword) {
    try {
      await fetch(
        `../../controller/user.php?deleteId=${aboutMeContent.dataset.userId}`
      );
      window.location = "../../helper/logout.php";
    } catch (e) {
      window.location = "profile.php";
    }
  }
});
