import axios from "axios";

const detailBtn = document.querySelectorAll(".detailModal-btn");
const detailModal = document.getElementById("detailModal-body");
// const modalTitle = document.querySelector(".modal-title");
// const token = document.querySelector('meta[name="csrf-token"]').content;

if (detailBtn) {
  detailBtn.forEach(el => {
    el.addEventListener("click", async function() {
      if (el.dataset.link.includes("users")) {
        userModal(el);
      } else if (el.dataset.link.includes("employees")) {
        employeeModal(el);
      } else if (el.dataset.link.includes("patients")) {
        patientModal(el);
      }
    });
  });
}

async function employeeModal(el) {
  const { data } = await axios.get(el.dataset.link);
  const {
    id,
    name,
    guardian_name,
    monthly_salary,
    age,
    gender,
    education,
    designation,
    cnic,
    address,
  } = data;

  //   Generate the markup
  let markup = "";
  markup += addRow("EmployeeId", id);
  markup += addRow("Name", name);
  markup += addRow("Guardian Name", guardian_name);
  markup += addRow("Monthly Salary", monthly_salary);
  markup += addRow("Age", age);
  markup += addRow("Gender", gender);
  markup += addRow("Address", address);
  markup += addRow("Education", education);
  markup += addRow("Designation", designation);
  markup += addRow("Cnic", cnic);

  //   Insert the markup in the modal
  detailModal.innerHTML = "";
  detailModal.insertAdjacentHTML("afterbegin", markup);
}

function addRow(label, value) {
  return `<div class="row py-1">
                <div class="col-md-4 font-weight-bold">
                    ${label}  &nbsp; :
                </div>
                <div class="col-md-6">
                    ${value}
                </div>
            </div>`;
}

async function userModal(el) {
  const { data } = await axios.get(el.dataset.link);
  const { id, name, username, is_admin, employee_id: employeeId } = data;

  //   Generate the markup
  let markup = "";
  markup += addRow("User Id", id);
  markup += addRow("Name", name);
  markup += addRow("Username", username);
  markup += addRow("Employee Id", employeeId);
  markup += addRow("This user is Admin?", is_admin ? "Yes" : "No");

  //   Insert the markup in the modal
  detailModal.innerHTML = "";
  detailModal.insertAdjacentHTML("afterbegin", markup);
}

async function patientModal(el) {
  const { data } = await axios.get(el.dataset.link);
  const {
    id,
    name,
    guardian_name,
    phone,
    age,
    fee,
    doctor_id: employeeId,
    gender,
    created_at,
  } = data;

  //   Generate the markup
  let markup = "";
  markup += addRow("Invoice #", id);
  markup += addRow("Name", name);
  markup += addRow("Guardian Name", guardian_name);
  markup += addRow("Doctor Id", employeeId);
  markup += addRow("Phone", phone || "");
  markup += addRow("Gender", gender || "");
  markup += addRow("Fee", fee);
  markup += addRow("Age", age);
  markup += addRow("Visited At", created_at);

  //   Insert the markup in the modal
  detailModal.innerHTML = "";
  detailModal.insertAdjacentHTML("afterbegin", markup);
}
