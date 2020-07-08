import axios from "axios";

// Data Holding
const sold_items = [];
let totalPrice = 0;
let count = -1;

// Selectors
const medicineSearch = document.getElementById("search-medicine");
const list = document.getElementById("medicine-list");
const salesList = document.getElementById("medicine-sales-list");
const totalAmount = document.getElementById("totalAmount");
const form = document.getElementById("medicine-form");
const submit = document.getElementById("submit-medicine");

// Event Listeners
document.addEventListener("keyup", function(e) {
  if (e.keyCode === 191) {
    medicineSearch.focus();
  }
});

if (submit) {
  submit.addEventListener("click", () => {
    saveData();
  });
}

document.onkeydown = function(e) {
  e = e || window.event; //Get event

  if (!e.ctrlKey) return;

  var code = e.which || e.keyCode; //Get key code

  switch (code) {
    case 83: //Block Ctrl+S
    case 87: //Block Ctrl+W -- Not work in Chrome and new Firefox
      e.preventDefault();
      e.stopPropagation();
      saveData();
      break;
  }
};

async function saveData() {
  const formData = generateFormData();

  const data = await axios({
    url: "http://127.0.0.1:8000/sales/items",
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": "Qk5fQLjxYlMMKdP1yY223V8O8vMBXKksiZ5pHb65",
    },
    data: formData,
  });

  //   console.log(data);
  if (data.status === 201) {
    let url = `/sales/print/${data.data.invoiceId}`;
    window.location.href = url;
  } else {
    showAlert("danger", data.message);
  }
}

const itemDeleteHandler = () => {
  const btns = document.querySelectorAll(".remove-item");
  if (btns) {
    btns.forEach(el => {
      el.addEventListener("click", function(e) {
        const id = e.target.parentElement.parentElement.dataset.id;
        const index = sold_items.findIndex(el => (el.id = id));
        sold_items.splice(index);
        console.log(e.target.parentElement.parentElement.remove());
      });
    });
  }
};

// Get the Data from server
const getData = async url => {
  const { data } = await axios.get(`${url}`);
  return data;
};

function generateFormData() {
  const formData = new FormData(form);

  const inputs = document.querySelectorAll(".form-data");
  if (inputs) {
    inputs.forEach(el => formData.append(el.name, el.value));
    return formData;
  }
}

// Insert data into the search list
const insertDataToSearchList = data => {
  let markup = ``;

  data.forEach(el => {
    markup += `<tr class="sales-item" data-id="${el.id}">
                  <td>${el.id}</td>
                  <td>${el.name}</td>
                  <td>${el.quantity}</td>
                  <td>${el.unit_price}</td>
                </tr>`;
  });

  list.innerHTML = "";
  list.insertAdjacentHTML("beforeend", markup);
};

// Insert data into SoldItems list
const insetDataToSoldItemsList = data => {
  console.log(data);
  const { name, quantity, id, unit_price } = data;

  //Get the quantity purchased
  let soldQuantity = getQuantity(quantity);

  const soldItem = ` <tr class="sold-item" data-id="${id}">

                            <td>
                            <input name="id[]" type="number" value="${id}" class="form-control form-data" disabled  ></td>
                            <td><input name="name[]" type="text" value="${name}" class="form-control form-data" disabled ></td>
                            <td><input name="quantity[]" type="number" value="${soldQuantity}" class="form-control form-data" disabled></td>
                            <td><input name="unit_price[]" type="number" value="${unit_price}" class="form-control form-data" disabled></td>
                            <td><input  type="number" value="${soldQuantity *
                              unit_price}" class="form-control form-data" disabled></td>
                            <td><button class="btn btn-danger btn-small remove-item">Remove</button></td>

                        </tr>`;

  const index = sold_items.findIndex(el => el.id === id);
  if (index) {
    //   salesList.firstChild.insertAdjacentHTML()
    salesList.insertAdjacentHTML("beforeend", soldItem);
    sold_items.push(data);
  } else {
    const items = document.querySelectorAll(".sold-item");
    items[index].children[2].children[0].focus();
    return showAlert("danger", "Item already in the list");
  }

  totalPrice += soldQuantity * unit_price;
  totalAmount.textContent = Math.floor(totalPrice);
  itemDeleteHandler();
};

// Remove the active class from all the items
const removeActive = list_items => {
  list_items.forEach(el => {
    el.classList.remove("bg-primary");
    el.classList.remove("text-white");
  });
};

// Add the active class to the current Element
const addActive = (list, el) => {
  list[el].classList.add("bg-primary");
  list[el].classList.add("text-white");
};

// Implementation
if (medicineSearch) {
  medicineSearch.addEventListener("keyup", async e => {
    if (e.keyCode === 40 || e.keyCode === 38 || e.keyCode === 13) {
      navigateListItems(e);
    } else if (medicineSearch.value != "") {
      count = -1;
      const data = await getData(`/sales/search/${medicineSearch.value}`);
      insertDataToSearchList(data);
    } else {
      list.innerHTML = "";
    }
  });
}

// Keyboard Navigation Implementation
async function navigateListItems(e) {
  const list_items = document.querySelectorAll(".sales-item");
  const total_size = list_items.length - 1;

  //   Remove the active class from all the elements
  removeActive(list_items);

  // Down Arrow key is pressed
  if (e.keyCode === 40) {
    count < total_size ? count++ : (count = 0);
  }

  //   Up Arrow key is pressed
  if (e.keyCode === 38) {
    count > 0 ? count-- : (count = total_size);
  }

  //   Enter key is pressed
  if (e.keyCode === 13) {
    //   Get the data from the server
    const data = await getData(`/sales/${list_items[count].dataset.id}/show`);

    // Reset the data
    list.innerHTML = "";
    medicineSearch.value = "";

    // Insert Data to the DOM
    insetDataToSoldItemsList(data);
  }

  //   Insert the active class to current element
  addActive(list_items, count);
}

// Get the quantity of the product from the client
function getQuantity(totalQuantity) {
  let soldQuantity = prompt("Enter the a  valid quantity");

  if (soldQuantity > totalQuantity) {
    return getQuantity(totalQuantity);
  }

  if (soldQuantity === 0) {
    showAlert("error", "This medicine is out of stock");
  }

  return soldQuantity;
}

// Show alert messages to the client
function showAlert(className, message) {
  let markup = `<div class="alert alert-${className} alert-dismissible fade show" role="alert">
    ${message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>`;

  const body = document.querySelector("body");
  body.insertAdjacentHTML("afterbegin", markup);
}
