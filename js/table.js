var search_input = document.querySelector("#search_input");

search_input.addEventListener("keyup", function(e){
    var span_items = document.querySelectorAll(".table_body .name span");
    var table_body = document.querySelector(".table_body ul");
    var search_item = e.target.value.toLowerCase();

    span_items.forEach(function(item){
        if(item.textContent.toLowerCase().indexOf(search_item) != -1){
            item.closest("li").style.display = "block";
        }
        else{
            item.closest("li").style.display = "none";
        }
    })

});

let sortDirection = false;
let fetData ;

window.onload = () => {
    loadTableData();
};

function loadTableData(data){
    const tableBody = document.getElementById('tableData');
    let dataHtml = '';

    for(let elem of data){
        dataHtml += `<tr><td>${elem.name}</td><td>${elem.age}</td></tr>`;
    }
    tableBody.innerHTML = dataHtml;
}

function sortColumn(columnName) {
    const dataType = typeof  fetData[0][columnName];
    sortDirection = !sortDirection;

    switch (dataType) {
        case 'number':
            sortNumberColumn(sortDirection, columnName);
            break;
        case 'string':
            sortTextcolumn(sortDirection, columnName);
            break;
    }

}

function sortNumberColumn(sort, columnName){
    fetData = fetData.sort((p1,p2) =>{
        return sort ? p1[columnName]-p2[columnName]:p2[columnName] - p1[columnName]
    });
}

function sortTextcolumn(sort, columnName){
    fetData = fetData.sort(function (a, b) {
        return ('' + a.attr).localeCompare(b.attr);
    })
}