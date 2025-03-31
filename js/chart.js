fetch("getDashboardData.php")
  .then(response => response.json())
  .then(data => {
    // Update chart data with dynamic values
    const xValues = ["Water Usage", "Electric Usage"];
    const yValues = [data.waterUsage, data.electricUsage];
    const barColors = ["blue", "orange"];

    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: { display: false },
        title: {
          display: true,
          text: "Utility Usage 2025"
        }
      }
    });
  })
  .catch(error => console.error("Error fetching data:", error));