function validate() {
    var x = document.forms["itemForm"]["expense"].value;
    var regex = /^[0-9]+([.]?[0-9]{1,2})?$/
    if(regex.test(x)) {
        return true
    }else {
        alert("Expense have to be an interger or 1-2 decimal places")
        return false
    }
}

function dateValidate() {
    var x = document.forms["rangeForm"]["startDate"].value;
    var x2 = document.forms["rangeForm"]["endDate"].value;
    let date1 = new Date(x).getTime()/1000
    let date2 = new Date(x2).getTime()/1000
    
    if(date2 - date1 < 0) {
        alert("End Date must be greater than start date")
        return false
    }
}

 function test() {
    alert('test')
}

function drawChart(data) {
    let category = []
    let data2 = []
    for(var item of data) {
        if(!category.includes(item.category)) {
            category.push(item.category)
        }

        let index = category.indexOf(item.category)
        if(!data2[index]) {
            data2[index] = 0 + item.expense
        }else {
            data2[index] = data2[index] + item.expense
        }
        
    }

    let chartData = {
        datasets: [{
            data: data2,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)'
              ],
        }],
        labels : category

    }

    var ctx = document.getElementById('myChart');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: chartData,
    });

}

function drawBarChart(data) {
    let label = []
    let data2 = []
    let background = []

    for(var item of data) {
        label.push(item.date)
        data2.push(item.total)
        let r = Math.floor(Math.random()*256)
        let g = Math.floor(Math.random()*256)
        let b = Math.floor(Math.random()*256)
        let color = 'rgb('+r+','+g+','+b+')'
        background.push(color)
        
    }
    let barData = {
        labels: label,
        datasets: [{
            barPercentage: 0.5,
            barThickness: 6,
            maxBarThickness: 8,
            minBarLength: 2,
            data: data2,
            backgroundColor: background,
            label: "Total Expenses"
        }]
    };
    var ctx = document.getElementById('barChart');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: barData,
    });

}

function drawgraph(data) {
    console.log("gg",data)

}