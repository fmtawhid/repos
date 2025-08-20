// Apex.grid = {
//     padding: {
//         right: 0,
//         left: 0
//     }
// };

// Apex.dataLabels = {
//     enabled: false
// };

// var randomizeArray = function (arg) {
//     var array = arg.slice();
//     var currentIndex = array.length, temporaryValue, randomIndex;

//     while (0 !== currentIndex) {

//         randomIndex = Math.floor(Math.random() * currentIndex);
//         currentIndex -= 1;

//         temporaryValue = array[currentIndex];
//         array[currentIndex] = array[randomIndex];
//         array[randomIndex] = temporaryValue;
//     }

//     return array;
// };

// // data for the sparklines that appear below header area
// var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

// // the default colorPalette for this dashboard
// var colorPalette = ['#00D8B6','#008FFB',  '#FEB019', '#FF4560', '#775DD0']

// var sparkOne = {
//     chart: {
//         type: 'area',
//         height: 80,
//         sparkline: {
//             enabled: true
//         },
//     },
//     stroke: {
//         curve: 'smooth',
//         width: 2
//     },
//     fill: {
//         opacity: 1,
//     },
//     series: [{
//         name: 'Profits',
//         data: randomizeArray(sparklineData)
//     }],
//     labels: [...Array(24).keys()].map(n => `2022-09-0${n+1}`),
//     xaxis: {
//         type: 'datetime',
//     },
//     yaxis: {
//         min: 0
//     },
//     colors: ['#FF7C08'],
// };

// new ApexCharts(document.querySelector("#sparkOne"), sparkOne).render();


// //pie chart
// var optionDonut = {
//     chart: {
//         type: 'donut',
//         height: 220,
//         offsetY: 15,
//     },
//     offsetX: 0,
//     dataLabels: {
//         enabled: false,
//     },
//     plotOptions: {
//         pie: {
//             donut: {
//                 size: '75%',
//             },
//         },
//         stroke: {
//             colors: undefined
//         }
//     },
//     colors: colorPalette,
//     series: [4523, 1313, 1212, 1331],
//     labels: ['Word', 'AI Image', 'Speech to Text', 'AI Chat'],
//     legend: {
//         position: 'left',
//     }
// };

// var donut = new ApexCharts(document.querySelector("#donut"),optionDonut);
// donut.render();



// //total monthly sale
// var options = {
//     chart: {
//         height: 210,
//         type: 'area',
//         width: '100%',
//         offsetX: -10,
//         zoom:{
//             enabled: false,
//         },
//         toolbar:{
//             show: false,
//         },
//     },
//     dataLabels: {
//         enabled: false
//     },
//     stroke: {
//         curve: 'smooth',
//         width: 2
//     },
//     colors: ['#4EB529'],
//     series: [{
//         name: 'Sales',
//         data: [100, 200, 105, 320, 250, 300, 555],
//         align: 'right'
//     }],
//     zoom: {
//         enabled: false
//     },
//     legend: {
//         show: false,
//     },
//     xaxis: {
//         type: 'datetime',
//         categories: [
//             "01 Jan",
//             "05 Jan",
//             "10 Jan",
//             "15 Jan",
//             "20 Jan",
//             "25 Jan",
//             "30 Jan",
//         ]
//     }
// };

// var chart = new ApexCharts(document.querySelector("#chart"), options);
// chart.render();