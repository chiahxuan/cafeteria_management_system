
//Column chart for Vendor Report (Analysis Page)
google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(analysisVendor);
function analysisVendor() {
    var data = google.visualization.arrayToDataTable([
            ["Element", "Density", { role: "style" }],
            ["Copper", 8.94, "#b87333"],
            ["Silver", 10.49, "silver"],
            ["Gold", 19.30, "gold"],
            ["Platinum", 21.45, "color: #e5e4e2"]
            
        // ["Diamond", 30.45, "red"]
        ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                    { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                    2]);

    var options = {
        title: "Density of Precious Metals, in g/cm^3",
        fontSize: 20,
        bar: {groupWidth: "95%"},
        //legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}



//Auto resize charts
$(window).resize(function(){
    
    analysisCafeteria();
    analysisVendor();
    
});

//!!!For HOME PAGE

// Add active class to the current button (highlight it)
var header = document.getElementById("bottom_left");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", function() {
var current = document.getElementsByClassName("activeTab");
current[0].className = current[0].className.replace(" activeTab", "");
this.className += " activeTab";
});
}


//Switch website if it is mobile           
if (screen.width <= 699) {
document.location = "../join.html";
}

// Load google charts
//Pie Chart
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(homePieChart);



// Draw the chart and set the chart values
function homePieChart() {
var data = google.visualization.arrayToDataTable([
['Task', 'Hours per Day'],
['Work', 61],
['Eat', 2],
['TV', 4],
['Gym', 2],
['Sleep', 8]
]);

// Optional; add a title and set the width and height of the chart
var options = {'title':'Sales',  'fontSize':22 };

    
// Display the chart inside the <div> element with id="piechart"
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(data, options);
}

//Side Bar charts
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(homeBarChart);
function homeBarChart() {
var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],
    ["Copper", 8.94, "#b87333"],
    ["Silver", 10.49, "silver"],
    ["Gold", 19.30, "gold"],
    ["Platinum", 21.45, "color: #e5e4e2"]
]);

var view = new google.visualization.DataView(data);
view.setColumns([0, 1,
                { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" },
                2]);

var options = {
    title: "Density of Precious Metals, in g/cm^3",
    fontSize:20,
    bar: {groupWidth: "95%"},
    legend: { position: "none" },
};
var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
chart.draw(view, options);
}