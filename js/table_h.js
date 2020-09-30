//var search_input = document.querySelector("#search_input");


function lister(data,len){
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

function listToStd(data,heads){
    var ind = 0 , lis = [];
    while(ind<data.length){
        var obj = new Object();
        for(let head of heads){
            obj[head] = data[ind];
            ind++;
        }
        lis.push(obj);
    }
    return lis;
}
console.log(document.cookie);
var cookies = document.cookie.replace(' ','').split(";").
map(function(el){ return el.replace(' ','').split("="); }).
reduce(function(prev,cur){ prev[cur[0]] = cur[1];return prev },{});
var headers = cookies['headers'].split('+');
var caller = cookies['action'].replace('-','/');
var fetData = listToStd(cookies["data"].split('+'),headers);
window.onload = () => {
    loadTableData(fetData);
};

function loadTableData(data){
    const tableBody = document.getElementById('tableData');
    let dataHtml = ``;
    var pos = 1;
    for(let elem of data){
        dataHtml +=`<tr class="item">` +
            `<td class="index index-i">` +
            `<form action="${caller}" method="post">`+
            `<button type="submit" name="bus_num" class="round-button" className="btn btn-indigo btn-sm m-0" value="${elem.BusNumber}" >`+
            `<span>${pos}</span>`+
            `</button>`+
            `</form>`+
            `</td>`;
        for(let head of Object.keys(elem)){
            dataHtml += `<td class=`+`"${head.substring(head.length-2)==='Id'? 'id':'comman'}"`+`>` +
                `<span>${elem[head].replace('-',' ')}</span>`+
                `</td>`;
        }
        dataHtml += `</tr>`;
        pos++;
    }
    tableBody.innerHTML = dataHtml;
}

function loadTableData0(data){
    const tableBody = document.getElementById('tableData');
    let dataHtml = ``;
    var pos = 1;
    for(let elem of data){
        dataHtml +=`<tr class="item">` +
            `<td class="index">` +
            `<span>${pos}</span>`+
            `</td>`;
        for(let head of Object.keys(elem)){
            dataHtml += `<td class=`+`"${head.substring(head.length-2)==='Id'? 'id':'comman'}"`+`>` +
                `<span>${elem[head]}</span>`+
                `</td>`;
        }
        dataHtml += `</tr>`;
        pos++;
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