<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="w-full">

    <div class="flex justify-center w-full text-center">
        <div>
            <h1 class="text-2xl my-8">TGIDN-TEST DASHBOARD</h1>
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                <div class="flex justify-center w-full">
                    <div class="flex-col items-center">
                        <div class="flex items-center mb-1">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Presentase Tipe
                                Kendaraan</h5>
                        </div>
                    </div>
                </div>

                <!-- Line Chart -->
                <div class="py-6" id="pie-chart"></div>

            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // ApexCharts options and config
    window.addEventListener("load", function() {
        console.log('halo');
        const getChartOptions = () => {
            return {
                // series: [52.8, 26.8, 20.4],
                series: [{{ join(',', $arrayCounts) }}],
                colors: ["#1C64F2", "#16BDCA", "#9061F9", "#0d7483", "#51cbe3", "#9d32dc", "#aa038b"],
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                @php
                    $labels = '';
                    foreach ($arrayTypes as $key => $type) {
                        if ($key != count($arrayTypes)-1) {
                            $labels .= '"' . $type . '",';
                        } else {
                            $labels .= '"' . $type . '"';
                        }
                    }
                @endphp
                labels: [{!! $labels !!}],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return (value / {{ $countTotal }} * 100).toFixed(1) + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value, result) {
                            return (value / {{ $countTotal }} * 100).toFixed(1) + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }

        if (document.getElementById("pie-chart")) {
            console.log('load');
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            console.log(chart);
            chart.render();
        }
    });
</script>

</html>
