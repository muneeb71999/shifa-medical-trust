const Chart = require("chart.js");
let ctx = document.getElementById("myChart");
const graphData = [];
const date = new Date();
const passedDays = date.getDate();
const currentMonth =
  String(date.getMonth() + 1).length == 1
    ? "0" + String(date.getMonth() + 1)
    : String(date.getMonth() + 1);
const currentYear = String(date.getFullYear());

if (ctx) {
  getPatientData(ctx);
}

// Gets the data from Api
async function getPatientData(ctx) {
  const { data } = await axios.get("/patients/currentMonth");
  let obj = {};

  data.forEach(el => {
    let date = String(el.created_at.split(" ")[0]);
    obj[date] = (obj[date] || 0) + 1;
  });

  for (let i = 0; i < passedDays; i++) {
    let day = String(i + 1).length == 1 ? `0${i + 1}` : i + 1;
    const currentDate = `${currentYear}-${currentMonth}-${day}`;
    graphData.push({
      title: currentDate,
      count: obj[currentDate] || 0,
    });
  }

  barChart(ctx, graphData);
}

function barChart(ctx, data) {
  ctx = ctx.getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: data.map(el => el.title),
      datasets: [
        {
          label: "Patients Count",
          data: data.map(el => el.count),
          backgroundColor: "rgba(120, 230, 20, 0.5)",
          borderColor: "rgba(120, 230, 20, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
    },
  });
}
