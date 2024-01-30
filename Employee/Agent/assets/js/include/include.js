fetch("loader.html").then(response =>{
    return response.text();
})
.then(
function (data) { document.getElementById("loader").innerHTML = data; }
);

fetch("topheader.html").then(response =>{
    return response.text();
})
.then(
function (tdata) { document.getElementById("topheader").innerHTML = tdata; }
);

fetch("sidebar.html").then(response =>{
    return response.text();
})
.then(
function (sdata) { document.getElementById("sidebar").innerHTML = sdata; }
);