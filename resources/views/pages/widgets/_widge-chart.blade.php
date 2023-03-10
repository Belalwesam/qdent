
<div class="card card-custom gutter-b card-stretch">
    <!--begin::Header-->

    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body d-flex flex-column">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <!--end::Body-->
</div>
<script>
    var pieOptions = {
        events: false,
        animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function () {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset) {

                    for (var i = 0; i < dataset.data.length; i++) {
                        var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                            total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                            mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                            start_angle = model.startAngle,
                            end_angle = model.endAngle,
                            mid_angle = start_angle + (end_angle - start_angle)/2;

                        var x = mid_radius * Math.cos(mid_angle);
                        var y = mid_radius * Math.sin(mid_angle);

                        ctx.fillStyle = '#fff';
                        if (i == 3){ // Darker text color for lighter background
                            ctx.fillStyle = '#444';
                        }
                        var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
                        //Don't Display If Legend is hide or value is 0
                        if(dataset.data[i] != 0 && dataset._meta[0].data[i].hidden != true) {
                            ctx.fillText(dataset.data[i], model.x + x, model.y + y);
                            // Display percent in another line, line break doesn't work for fillText
                            ctx.fillText(percent, model.x + x, model.y + y + 15);
                        }
                    }
                });
            }
        },
        title: {
            display: true,
            text: 'Orders'
        }

    };
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(document.getElementById("myChart"), {
        type: 'pie',
        data: {
            labels: ["processing", "Pending", "delivered", "Cancelled"],
            datasets: [{
                backgroundColor: ["#f78832", "#e5e5e5","#76c28d","#b12021"],
                data: [2478,5267,734,784]
            }]
        },
        options: pieOptions
    });

</script>
