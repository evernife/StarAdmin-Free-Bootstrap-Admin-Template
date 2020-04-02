var accounts_tbody = document.getElementById("accounts-table");

var imageIndex = 1;
function getNextImage() {
    if (imageIndex > 3){
        imageIndex = 1;
    }
    var image = new Image(1,1);
    image.src = "../../../assets/images/faces-clipart/pic-" + imageIndex + ".png";
    image.alt = "image";
    imageIndex++;
    return image;
}

function createPictureTableCell(aJson, key) {
    var table_data = document.createElement("TD");   // Create a <td> element
    table_data.appendChild(getNextImage());
    var text = document.createTextNode(" " + aJson[key]);
    table_data.appendChild(text);
    return table_data;
}

function createTextTableCell(aJson, key) {
    var table_data = document.createElement("TD");   // Create a <td> element
    var text = document.createTextNode(aJson[key]);
    table_data.appendChild(text);
    return table_data;
}

function createBooleanTableCell(aJson, key) {
    var table_data = document.createElement("TD");   // Create a <td> element
    var label = document.createElement("label")
    label.classList.add("badge", "badge-warning")
    label.textContent = (aJson[key] == "true" ? "Sim" : "Não");
    table_data.appendChild(label);6
    return table_data;
}

function createDateTableCell(aJson, key) {
    var table_data = document.createElement("TD");   // Create a <td> element
    var date = new Date(aJson[key]);
    var text = document.createTextNode(date.toLocaleDateString("pt-BR",{hour: '2-digit', minute:'2-digit'}));
    table_data.appendChild(text);
    return table_data;
}

for (i = 0; i < allAccounts.length; i++){
    var accountJson = allAccounts[i];
    var table_row = document.createElement("TR");   // Create a <tr> element
    table_row.appendChild(createPictureTableCell(accountJson,"username"));
    table_row.appendChild(createTextTableCell(accountJson,"fullname"));
    table_row.appendChild(createTextTableCell(accountJson,"email"));
    table_row.appendChild(createDateTableCell(accountJson,"creation"));
    table_row.appendChild(createBooleanTableCell(accountJson,"active"));
    accounts_tbody.appendChild(table_row);
}