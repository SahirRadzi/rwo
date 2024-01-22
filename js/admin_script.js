const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");
const profile = document.querySelector(".profile");

let darkmode = localStorage.getItem("dark-mode");

const enableDarkMode = () => {
  darkLight.classList.replace("bx-sun", "bx-moon");
  body.classList.add("dark");
  localStorage.setItem("dark-mode", "enabled");
};

const disableDarkMode = () => {
  darkLight.classList.replace("bx-moon", "bx-sun");
  body.classList.remove("dark");
  localStorage.setItem("dark-mode", "disabled");
};

sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

sidebarClose.addEventListener("click", () => {
  sidebar.classList.add("close", "hoverable");
});
sidebarExpand.addEventListener("click", () => {
  sidebar.classList.remove("close", "hoverable");
});

sidebar.addEventListener("mouseenter", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
});
sidebar.addEventListener("mouseleave", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
});

document.querySelector("#user-btn").onclick = () => {
  profile.classList.toggle("active");
};

if (darkmode === "enabled") {
  enableDarkMode();
}
darkLight.onclick = (e) => {
  darkmode = localStorage.getItem("dark-mode");
  if (darkmode === "disabled") {
    enableDarkMode();
  } else {
    disableDarkMode();
  }
};

// darkLight.addEventListener("click", () => {
//   body.classList.toggle("dark");
//   if (body.classList.contains("dark")) {
//     document.setI;
//     darkLight.classList.replace("bx-sun", "bx-moon");
//   } else {
//     darkLight.classList.replace("bx-moon", "bx-sun");
//   }
// });

submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});

if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}

// $(".has-child").each(function (e) {
//   $(this).append(`<i class="fas fa-chevron-down"></i>`);
//   $(this).click(function (e) {
//     e.preventDefault();
//     $(this).children(".sub-menu").slideToggle();
//     $(this).toggleClass("active");
//     $(this).siblings().find(".sub-menu").slideUp();
//     $(this).find(".has-child").removeClass("active");
//     e.stopPropagation();
//   });
// });

// $(document).click(function (e) {
//   $(".sub-menu").slideUp();
//   $(".nav-links li").removeClass("active");
//   //check if .nav-links is not clicked
//   if (!$(e.target).closest(".hamburger").length) {
//     $(".nav-links").removeClass("active");
//     $(".hamburger").removeClass("active");
//   }
// });

// $(".hamburger").click(function () {
//   $(".nav-links").toggleClass("active");
//   $(this).toggleClass("active");
// });

// let profile = document.querySelector(".profile");

// document.querySelector("#user-btn").onclick = () => {
//   profile.classList.toggle("active");
//   // sidebar.classList.remove("active");
// };

// let navbar = document.querySelector(".header .navbar");

// document.querySelector("#hamburger").onclick = () => {
//   navbar.classList.toggle("active");
//   profile.classList.remove("active");
// };

// klik diluar sidebar untuk menghilangkan menu nav

// const sidebarOpen2 = document.querySelector("#sidebarOpen");
// document.addEventListener("click", function (e) {
//   if (!sidebarOpen.contains(e.target) && !sidebar.contains(e.target)) {
//     sidebar.classList.toggle("close");
//   }
// });

// const hamburger = document.querySelector("#hamburger");
// document.addEventListener("click", function (e) {
//   if (!hamburger.contains(e.target) && !navbar.contains(e.target)) {
//     navbar.classList.remove("active");
//   }
// });

// window.onscroll = () => {
//   profile.classList.remove("active");
//   navbar.classList.remove("active");
// };

subImages = document.querySelectorAll(".update-product .image-container .sub-images img");
mainImage = document.querySelector(".update-product .image-container .main-image img");

subImages.forEach((images) => {
  images.onclick = () => {
    let src = images.getAttribute("src");
    mainImage.src = src;
  };
});
