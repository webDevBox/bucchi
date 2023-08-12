function reporter() {
    const sheetName = "Petty Cash";
    const table = document.getElementById('hidden_table');
    const workbook = XLSX.utils.book_new();

    // Clone the table and remove the last column
    const tableClone = table.cloneNode(true);
    const rows = tableClone.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        const lastCellIndex = cells.length - 1;
        rows[i].deleteCell(lastCellIndex);
    }
    const worksheet = XLSX.utils.table_to_sheet(tableClone);

    // Set the column width based on content
    setColumnWidth(worksheet);


    XLSX.utils.book_append_sheet(workbook, worksheet, sheetName);
    XLSX.writeFile(workbook, `${'Petty Cash'}.xlsx`);
}

function setColumnWidth(worksheet) {
    const columns = [];
    for (const cellAddress in worksheet) {
        if (cellAddress[0] === '!') continue; // Skip special cells
        const column = cellAddress.replace(/[^A-Z]/g, '');
        const cellText = worksheet[cellAddress].v.toString();
        if (!columns[column]) {
            columns[column] = cellText.length;
        } else {
            columns[column] = Math.max(columns[column], cellText.length);
        }
    }

    for (const column in columns) {
        const width = columns[column] * 10; // Adjust the multiplier
        worksheet['!cols'] = worksheet['!cols'] || [];
        worksheet['!cols'].push({ wpx: width });
    }
}
