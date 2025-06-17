function printChart() {
  const chartArea = document.querySelector(".print-chart-area"); // Ganti selector sesuai tempat chart kamu

  html2canvas(chartArea, {
    scale: 4, // Atur ke 2x, 3x, bahkan 4x untuk kualitas lebih tinggi
  }).then(function (canvas) {
    const dataUrl = canvas.toDataURL("image/png", 1.0); // kualitas maksimal
    const windowContent = `
      <!DOCTYPE html>
      <html>
      <head><title>Print Chart</title></head>
      <body>
        <img src="${dataUrl}" style="width:100%;"/>
        <script>
          window.onload = function() {
            window.focus();
            window.print();
            window.onafterprint = function() {
              window.close();
            };
          };
        </script>
      </body>
      </html>
    `;

    const printWindow = window.open("", "", "width=800,height=600");
    printWindow.document.open();
    printWindow.document.write(windowContent);
    printWindow.document.close();
  });
}

function printChartPerbandingan() {
  const chartAreaPerbandingan = document.querySelector(".print-chart-area-perbandingan"); // Ganti selector sesuai tempat chart kamu

  html2canvas(chartAreaPerbandingan, {
    scale: 4, // Atur ke 2x, 3x, bahkan 4x untuk kualitas lebih tinggi
  }).then(function (canvas) {
    const dataUrlPerbandingan = canvas.toDataURL("image/png", 1.0); // kualitas maksimal
    const windowContentPerbandingan = `
        <!DOCTYPE html>
        <html>
        <head><title>Print Chart Perbandingan</title></head>
        <body>
          <img src="${dataUrlPerbandingan}" style="width:100%;"/>
          <script>
            window.onload = function() {
              window.focus();
              window.print();
              window.onafterprint = function() {
                window.close();
              };
            };
          </script>
        </body>
        </html>
      `;

    const printWindow = window.open("", "", "width=800,height=600");
    printWindow.document.open();
    printWindow.document.write(windowContentPerbandingan);
    printWindow.document.close();
  });
}
