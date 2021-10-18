const goToLogin = () => {
  location.href = "login.php";
};

const goToHome = () => {
  location.href = "index.php";
};

const goToCart = () => {
  location.href = "cart.php";
};

const goToOrderHistory = () => {
  location.href = "order-history.php";
};

const goToProductDetails = () => {
  document.forms[0].submit();
  location.href = "product-details.php";
};

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
// const renderAllItem = () => {
//   var xhr = new XMLHttpRequest();

//   xhr.onreadystatechange = () => {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       console.log(">>> Item ready");
//     }
//   };

//   xhr.open("GET", "ajax/database.php", true);
//   xhr.send();
// };

// const renderAllItem = () => {
//   var xhr = new XMLHttpRequest();
//   xhr.open("GET", "ajax/database.php", true);

//   var itemDat = new Array();
//   var item = {};

//   xhr.onreadystatechange = () => {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       console.log(">>> Item ready");
//     }
//   };

//   xhr.send();
// };
