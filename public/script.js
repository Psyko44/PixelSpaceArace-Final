/**
 * SCALE ALL OF THE ITEM PRODUCT AND PUT A OPACITY ON THE OVER
 */
document.addEventListener("DOMContentLoaded", function () {
  var images = document.querySelectorAll(".productImage");
  images.forEach(function (image) {
    image.addEventListener("mouseover", function () {
      images.forEach(function (otherImage) {
        if (otherImage !== image) {
          otherImage.style.opacity = 0.2;
        }
      });
      image.style.transform = "scale(1.5)";
    });
    image.addEventListener("mouseout", function () {
      images.forEach(function (otherImage) {
        otherImage.style.opacity = 1;
      });
      image.style.transform = "scale(1)";
    });
  });
  let menuItems = document.querySelectorAll(".menue");
  menuItems.forEach(function (menu) {
    menu.addEventListener("mouseover", function () {
      menu.style.backgroundColor = "purple";
    });
    menu.addEventListener("mouseout", function () {
      menu.style.backgroundColor = "";
    });
  });
  let icones = document.querySelectorAll(".fa-brands");
  icones.forEach(function (icone) {
    icone.addEventListener("mouseover", function () {
      icone.style.color = "purple";
    });
    icone.addEventListener("mouseout", function () {
      icone.style.color = "white";
    });
  });
});
let btnclr = document.querySelectorAll(".btn");
btnclr.forEach(function (btn) {
  btn.addEventListener("mouseover", function () {
    btn.style.backgroundColor = "#5710DA";
  });
  btn.addEventListener("mouseout", function () {
    btn.style.backgroundColor = "";
  });
});

/**
 *  STAY ON THE PRODUCT PAGE WHEN AN ITEM PUT IN THE CART
 */
$(document).ready(function () {
  $(".shopNow").on("submit", function (e) {
    e.preventDefault();
    const id = $(this).find(".addToCartButton").data("id");
    $.ajax({
      url: "/product/addToCartById/" + id,
      type: "POST",
      success: function (data) {
        alert("Produit ajouté au panier");
      },
    });
  });
});

$(document).ready(function () {
  $("#registerForm").on("submit", function (e) {
    e.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      url: "/register/index",
      type: "POST",
      data: formData,
      success: function (data) {
        alert("L'utilisateur à été crée avec succès");
      },
    });
  });
});

// SEND A MESSAGE IN CSS WHEN SUCCESS MESSAGE ITS VISIBLE
let successMessage = $("#successMessage");
if (successMessage.length) {
  setTimeout(function () {
    successMessage.fadeOut("slow", function () {
      successMessage.remove();
    });
  }, 3000);
}
let successMessageF = $("#successMessageF");
if (successMessageF.length) {
  setTimeout(function () {
    successMessageF.fadeOut("slow", function () {
      successMessageF.remove();
    });
  }, 3000);
}
function navigateTo(selectElement) {
  var url = selectElement.value;
  if (url) {
    location.href = url;
  }
}

/**
 * CHANGE THEME IN LIGHT THEME AND STOCK IT IN USER LOCALSTORAGE
 */
let themeIcon = document.getElementById("themeIcon");
themeIcon.addEventListener("click", function () {
  let theme = themeIcon.classList.contains("fa-toggle-off") ? "light" : "dark";
  switchTheme(theme);
});
document.addEventListener("DOMContentLoaded", (event) => {
  let theme = localStorage.getItem("theme") || "dark";
  switchTheme(theme);
});
function switchTheme(theme) {
  if (theme === "light") {
    themeIcon.className = "fa-solid fa-toggle-on";
    let themeLink = document.getElementById("theme-link");
    if (themeLink) {
      themeLink.href = "/light-theme.css";
    } else {
      let head = document.head;
      let link = document.createElement("link");
      link.type = "text/css";
      link.rel = "stylesheet";
      link.id = "theme-link";
      link.href = "/light-theme.css";
      head.appendChild(link);
    }
  } else {
    themeIcon.className = "fa-solid fa-toggle-off";
    let themeLink = document.getElementById("theme-link");
    if (themeLink) {
      themeLink.href = "/original-style.css";
    }
  }
  localStorage.setItem("theme", theme);
}
