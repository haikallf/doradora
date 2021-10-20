const goToLogin = () => {
  location.href = "./pages/login.php";
};

const goToHome = () => {
  location.href = "./index.php";
};

const goToHomeFromHome = () => {
  location.href = "index.php";
};

const goToCart = () => {
  location.href = "./pages/cart.php";
};

const goToOrderHistory = () => {
  location.href = "./pages/order-history.php";
};

const goToAddVariant = () => {
  location.href = "./pages/addvariant.php";
};

const submitData = (idx) => {
  document.forms[`itemForm-${idx}`].submit();
  return true;
};

const submitSearch = () => {
  document.forms["search-form"].submit();
  return true;
};

const getQuantity = () => {
  return document.getElementById("quantity").value;
};

// const getQuantity = () => {
//   document.body.addEventListener("input", () => {
//     document.getElementById("quantity-hidden").value =
//       document.getElementById("quantity").value;
//   });
// };

const renderHeader = (isAdmin) => {
  var headerIcon = "";

  if (isAdmin == 0) {
    headerIcon = `
      <div class="header-option">
          <div class="header-cart" title="Keranjang" onclick="goToCart()">
              <i class="fas fa-shopping-cart"></i>
          </div>
  
          <div class="header-wishlist" title="Wishlist">
              <i class="fas fa-heart"></i>
          </div>
  
          <div class="header-chat" title="Obrolan">
              <i class="fas fa-comment-dots"></i>
          </div>
      </div>
  
      <div class="vr"></div>
  
      <div class="header-history" onclick="goToOrderHistory()">
          <i class="fas fa-history"></i>
          <p>Order History</p>
      </div>

      <div class="vr"></div>
      `;
  } else if (isAdmin == 1) {
    headerIcon = `
      <div class="header-add-variant" onclick="goToAddVariant()">
          <i class="fas fa-plus"></i>
          <p>add variant</p>
      </div>
      <div class="vr"></div>
    `;
  }

  document.getElementById("header-user-admin").innerHTML = headerIcon;
};

// const goToProductDetails = (idx) => {
//   document.getElementsByName("itemForm")[idx].submit();
//   location.href = "product-details.php";
// };

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
