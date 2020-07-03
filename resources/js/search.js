import axios from "axios";
const search = document.getElementById("search");
const loading = document.getElementById("loading");
const tableBody = document.getElementById("table-body");
const previousData = document.querySelectorAll("#table-body tr");
const pagination = document.querySelector(".pagination");

if (search) {
  search.addEventListener("search", async function() {
    loading.classList.remove("d-none");

    try {
      if (search.value.length >= 2) {
        // Remove the prevoius data and the pagination
        removeData();
        removePagination();

        //   Fetch the data
        const { data } = await axios.get(`/patients/search/${search.value}`);
        const { patients } = data;

        // Append the searched data
        addData(patients);
      }

      if (search.value.length == 0) {
        // Remove the searched Data
        removeData();

        //  Append the previous data
        previousData.forEach(el => tableBody.append(el));

        // Append the pagination links
        addPagination();
      }
    } catch (err) {
      alert("Some error occured", err.message);
    }

    loading.classList.add("d-none");
  });
}

function removeData() {
  document.getElementById("table-body").innerHTML = "";
}

function removePagination() {
  document.querySelector("#pagination-container").innerHTML = "";
}

function addPagination() {
  document.querySelector("#pagination-container").innerHTML = `
    <div class="pagination">
        ${pagination.innerHTML}
    </div>
  `;
}

function addData(data) {
  let markup = "";

  data.forEach(el => {
    markup += `<tr>
        <td scope="row">${el.id}</td>
        <td>${el.name + " " + (el.guardian_name || "")}</td>
        <td>${el.age}</td>
        <td>${el.fee}</td>
        <td>${el.created_at}</td>
        <td>
            <button class="btn btn-success btn-sm">Print</button>
        </td>
    </tr>`;
  });
  return tableBody.insertAdjacentHTML("afterbegin", markup);
}
