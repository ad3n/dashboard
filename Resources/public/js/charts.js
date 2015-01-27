var Chart = {};

Chart.scope = '';

Chart.BulanIndonesia = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

Chart.buildScalarChart = function (data, selector, title, subtitle, xAxis, type, handler) {
    var option = {
        chart : {
            type: type
        },
        title: {
            text: title
        },
        subtitle: {
            text: subtitle
        },
        xAxis: {
            categories: xAxis
        },
        plotOptions: {
            series: {
                point: {
                    events: handler
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        series: data
    };

    jQuery(selector).highcharts(option);
};

Chart.buildGaugeChart = function (data, selector, title, subtitle, startIndicator, yellowIndicator, greenIndicator, endIndicator, handler) {
    startIndicator = parseInt(startIndicator);
    yellowIndicator = parseInt(yellowIndicator);
    greenIndicator = parseInt(greenIndicator);
    endIndicator = parseInt(endIndicator);

    var option = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events: handler
        },
        title: {
            text: title
        },
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        yAxis: {
            min: startIndicator,
            max: endIndicator,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: subtitle
            },
            plotBands: [{
                from: startIndicator,
                to: yellowIndicator,
                color: '#DF5353'
            }, {
                from: yellowIndicator,
                to: greenIndicator,
                color: '#DDDF0D'
            }, {
                from: greenIndicator,
                to: endIndicator,
                color: '#55BF3B'
            }]
        },
        series: [data]
    };

    jQuery(selector).highcharts(option);
};

Chart.buildPieChart = function (data, selector, title, handler) {
    var option = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,
            plotShadow: false
        },
        title: {
            text: title
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            },
            series: {
                point: {
                    events: handler
                }
            }
        },
        series: [data]
    };

    jQuery(selector).highcharts(option);
};

Chart.buildCombinationChart = function (selector, title, xAxis, columnData, sparkLineData, pieData, handler) {
    var option = {
        title: {
            text: title
        },
        plotOptions: {
            series: {
                point: {
                    events: handler
                }
            }
        },
        xAxis: {
            categories: xAxis
        },
        series: [columnData, sparkLineData, pieData]
    };

    jQuery(selector).highcharts(option);
};

Chart.createBarChart = function (handler, data, selector, title, subtitle, type, tahun) {
    var output = [];

    if ('pertahun' === type) {
        output = Chart.processDataPerTahun(data);

        Chart.buildScalarChart([output['data']], selector, title, subtitle, output['tahun'], 'bar', handler);
    } else {
        output = Chart.processDataPerBulan(data);

        Chart.buildScalarChart(output, selector, title, subtitle, Chart.BulanIndonesia, 'bar', handler);
    }
};

Chart.createColumnChart = function (handler, data, selector, title, subtitle, type, tahun) {
    var output = [];

    if ('pertahun' === type) {
        output = Chart.processDataPerTahun(data);

        Chart.buildScalarChart([output['data']], selector, title, subtitle, output['tahun'], 'column', handler);
    } else {
        output = Chart.processDataPerBulan(data);

        Chart.buildScalarChart(output, selector, title, subtitle, Chart.BulanIndonesia, 'column', handler);
    }
};

Chart.createLineChart = function (handler, data, selector, title, subtitle, type, tahun) {
    var output = [];

    if ('pertahun' === type) {
        output = Chart.processDataPerTahun(data);

        Chart.buildScalarChart([output['data']], selector, title, subtitle, output['tahun'], 'line', handler);
    } else {
        output = Chart.processDataPerBulan(data);

        Chart.buildScalarChart(output, selector, title, subtitle, Chart.BulanIndonesia, 'line', handler);
    }
};

Chart.createAreaChart = function (handler, data, selector, title, subtitle, type, tahun) {
    var output = [];

    if ('pertahun' === type) {
        output = Chart.processDataPerTahun(data);

        Chart.buildScalarChart([output['data']], selector, title, subtitle, output['tahun'], 'area', handler);
    } else {
        output = Chart.processDataPerBulan(data);

        Chart.buildScalarChart(output, selector, title, subtitle, Chart.BulanIndonesia, 'area', handler);
    }
};

Chart.createGaugeChart = function (data, selector, title, handler) {
    Chart.scope = data['scope'];
    var now = new Date();
    var subtitle = 'TAHUN ' + now.getFullYear();
    var output = 0;
    var i = 0;

    jQuery.each(data['data'], function (key, value) {
        subtitle = 'TAHUN ' + key;
        jQuery.each(value, function (k, v) {
            output = output + parseInt(v['value']);

            i++;
        });
    });

    i = 0 === i ? 1 : i;

    Chart.buildGaugeChart({
        name: 'Nilai rata-rata',
        data: [parseInt(output / i)],
        tooltip: {
            valueSuffix: ' %'
        }
    }, selector, title, subtitle, data['indikator']['indikator_merah'], data['indikator']['indikator_kuning'], data['indikator']['indikator_hijau'], 100, handler);
};

Chart.createPieChart = function (data, seletor, title, handler) {
    var temp = Chart.processDataPerBulan(data);
    var output = [];

    jQuery.each(temp[0]['data'], function (key, value) {
        output.push([Chart.BulanIndonesia[key], value]);
    });

    Chart.buildPieChart({
        type: 'pie',
        name: 'Total',
        data: output
    }, seletor, title, handler);
};

Chart.processDataPerTahun = function (data, type) {
    var output = [];
    output['tahun'] = [];
    output['data'] = [];
    output['data']['name'] = 'Total';
    output['data']['tye'] = type;
    output['data']['data'] = [];

    jQuery.each(data['data'], function (key, value) {
        output['tahun'].push(key);
        var data = 0;

        jQuery.each(value, function (k, v) {
            data = data + parseInt(v['value']);
        });

        output['data']['data'].push(data);
    });

    return output;
};

Chart.processDataPerBulan = function (data, type) {
    Chart.scope = data['scope'];
    var output = [];
    var i = 0;

    jQuery.each(data['data'], function (key, value) {
        var data = [];
        output[i] = [];

        output[i]['name'] = key;
        output[i]['type'] = type;

        jQuery.each(value, function (k, v) {
            data.push(parseInt(v['value']));
        });

        output[i]['data'] = data;

        i++;
    });

    return output;
};

Chart.requestSingleChart = function (callback, indikator, scope, kode, tahun, bulan) {
    if ("undefined" === typeof scope) {
        scope = '0';
    }

    if ("undefined" === typeof kode) {
        kode = '0';
    }

    if ("undefined" === typeof tahun) {
        tahun = '0';
    }

    if ("undefined" === typeof bulan) {
        bulan = '0';
    }

    jQuery.ajax({
        url: '/api/chart/single/get/' + indikator + '/' + scope + '/' + kode + '/' + tahun + '/' + bulan,
        type:'GET',
        dataType: 'json',
        beforeSend: function( xhr ) {
            Chart.modalHelper.pleaseWait();
        }
    }).done (function (response) {
        if ('function' === typeof callback) {
            Chart.modalHelper.done();
            callback(response);
        }
    });
};

Chart.modalHelper = Chart.modalHelper || (function () {
    var pleaseWaitDiv = jQuery('<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="pleaseWaitDialog"><div class="modal-header"><h1 style="color:#eee;">Processing...</h1></div><div class="modal-body"><div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div></div>');
    return {
        pleaseWait: function() {
            pleaseWaitDiv.modal();
        },
        done: function () {
            pleaseWaitDiv.modal('hide');
        },

    };
})();