
function createTable(headers, elements, ID) {
    // Creates a table based on the headers and elements provided

    var div1 = document.getElementById(ID);

    // creates a <table> element
    var tbl = document.createElement("table");

    var no_Col = headers.length();
    var no_Row = elements.length();

    var table_Row = tbl.insertRow(0);
    for (headEL = 0; headEl < no_Col; headEl++) { // Writes the header
        table_Row.insertCell(headEl).innerHTML = headers[headEl];
    }

    // Actually fills out the table
    for (rowEL = 0; rowEl < no_Row; rowEL++) {
        var elementsRow = elements[rowEl];

        table_Row = tbl.insertRow(rowEl); // Create a Row
        table_Row.setAttribute('onclick', "highlight(this, 'select')"); // Enables highlighting
        
        for (cellEL = 0; cellEl < no_Col; cellEl++) { // Fills out all the cells
            table_Row.insertCell(cellEl).innerHTML = elementsRow[cellEl];
        }
    }
    div1.appendChild(tbl); // commits <table> into <div1>
}

