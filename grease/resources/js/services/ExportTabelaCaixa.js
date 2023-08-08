// Função para exportar para PDF
function exportToPDF() {
  window.jsPDF = window.jspdf.jsPDF

  const doc = new jsPDF();
  const table = document.getElementById('myTable');

  doc.autoTable({ html: table });
  doc.save('Caixa.pdf');

  toggleDropdown(); // Oculta o menu dropdown após o download do PDF
}


// Função para exportar para Excel
function exportToExcel() {
  const table = document.getElementById('myTable');
  const workbook = XLSX.utils.book_new();
  const worksheet = XLSX.utils.table_to_sheet(table);

  // Adiciona o worksheet ao workbook
  XLSX.utils.book_append_sheet(workbook, worksheet, 'Caixa');

  // Salva o arquivo Excel
  XLSX.writeFile(workbook, 'Livro - Caixa.xlsx');
  toggleDropdown(); // Oculta o menu dropdown após o download do Excel
}