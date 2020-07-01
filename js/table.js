//var search_input = document.querySelector("#search_input");


var search_input = document.getElementById('search_input');
document.get
console.log(search_input,"--------------");

if(search_input!= null) {
    search_input.addEventListener("keyup", function (e) {
        var span_items = document.querySelectorAll(".table_body .name span");
        var table_body = document.querySelector(".table_body ul");
        var search_item = e.target.value.toLowerCase();

        span_items.forEach(function (item) {
            if (item.textContent.toLowerCase().indexOf(search_item) != -1) {
                item.closest("li").style.display = "block";
            } else {
                item.closest("li").style.display = "none";
            }
        })

    });
}

function lister(data,len){
    console.log(data,len);
    var mega_list = [];
    const times = Math.floor(data.length/len);
    for(i=0;i<times;i++){
        mega_list.push(data.slice(i*len,(i+1)*len));
    }
    //mega_list.push(data.slice(len*times,data.length));
    return mega_list;
}

let sortDirection = false;
//let fetData = document.getElementById('data')

function reqListener () {
    console.log(this.responseText);
}

var cookies = document.cookie.split(";").
map(function(el){ return el.split("="); }).
reduce(function(prev,cur){ prev[cur[0]] = cur[1];return prev },{});

var headers = cookies['headers'].split('+');
console.log(cookies[" data"]);
var fetData = lister(cookies[" data"].split('+'),headers.length);
console.log(fetData);
window.onload = () => {
    loadTableData(fetData);
};

function loadTableData(data){
    const tableBody = document.getElementById('tableData');
    let dataHtml = '';

    for(let elem of data){
        dataHtml += `<tr><td>${elem[1]}</td><td>${elem[2]}</td><td>${elem[3]}</td><td>${elem[4]}</td><td>${elem[5]}</td></tr>`;
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