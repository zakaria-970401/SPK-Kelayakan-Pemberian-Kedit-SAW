@extends('layouts.base')
@section('title', 'Report')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="container">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="years">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: "Grafik Nasabah Kredit Tahun {{ date('Y') }}"
            },
            subtitle: {
                text: 'PT. BPR Antar Guna'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            credits: {
                enabled: false
            },
            yAxis: {
                title: {
                    text: 'Nominal Peminjaman'
                },
                labels: {
                    formatter: function() {
                        console.log(this.value);
                        return 'Rp. ' + this.value;
                    }
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'GRAFIK KREDIT',
                data: {!! json_encode($data_series) !!},
            }]
        });

        Highcharts.chart('years', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pendapatan Pertahun '
            },
            subtitle: {
                text: 'PT. BPR Antar Guna'
            },
            xAxis: {
                categories: [
                    {{ $categories }}
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nominal'
                },
                labels: {
                    formatter: function() {
                        console.log(this.value);
                        return 'Rp. ' + this.value;
                    }
                }
            },
            credits: {
                enabled: false
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: {!! json_encode($charts_years) !!}
        });
    </script>
@endsection
