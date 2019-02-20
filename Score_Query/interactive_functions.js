// function sendMySQLRequest(headers) {
//     return Query.ajax({
//                     type: "POST",
//                     url: 'mysql_interface.php',
//                     dataType: 'json',
//                     data: {functionname: 'add', arguments: [1, 2]},

//                     success: function (obj, textstatus) {
//                             if( !('error' in obj) ) {
//                                 yourVariable = obj.result;
//                             } else {
//                             console.log(obj.error);
//                             }
//                         }
//                 });
//  }

 function toggleClass(el, className) {
    // For highlighting table rows I think  
    el = (el.className.indexOf(className) >= 0) ?
    el.className.replace(className,"") : el.className + className;
}

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