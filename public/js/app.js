function init_datatable(selector, route, columns) {
    if (!selector || !route || !columns) {
        console.error("Selector, route, and columns are required.");
        return;
    }

    $(selector).DataTable({
        processing: true,
        serverSide: true,
        ajax: route,
        columns: columns,
        responsive: true,
        ordering: false, // Disable client-side ordering
        language: {
            emptyTable: "No data available",
            loadingRecords: "Loading...",
            processing: "Processing..."
        }
    });
}

document.querySelectorAll('a').forEach(el => {
    el.setAttribute('data-bs-toggle', 'tooltip');
    el.setAttribute('title', el.getAttribute('title') || 'Click here'); // Default title if not set
})


function createLineChart({
    containerId = 'container',
    titleText = 'U.S Solar Employment Growth',
    titleAlign = 'left',
    subtitleText = 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
    subtitleAlign = 'left',
    yAxisTitle = 'Number of Employees',
    xAxisRangeDescription = 'Range: 2010 to 2022',
    xAxisCategories = ['2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022'],
    legendLayout = 'vertical',
    legendAlign = 'right',
    legendVerticalAlign = 'middle',
    plotOptionsLabelConnectorAllowed = false,
    plotOptionsPointStart = 2010,
    seriesData = [],
    responsiveMaxWidth = 500,
    responsiveLegendLayout = 'horizontal',
    responsiveLegendAlign = 'center',
    responsiveLegendVerticalAlign = 'bottom',
}) {
    Highcharts.chart(containerId, {
        title: {
            text: titleText,
            align: titleAlign,
        },
        subtitle: {
            text: subtitleText,
            align: subtitleAlign,
        },
        yAxis: {
            title: {
                text: yAxisTitle,
            },
        },
        xAxis: {
            categories: xAxisCategories,
            accessibility: {
                rangeDescription: xAxisRangeDescription,
            },
        },
        legend: {
            layout: legendLayout,
            align: legendAlign,
            verticalAlign: legendVerticalAlign,
        },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: plotOptionsLabelConnectorAllowed,
                },
                pointStart: plotOptionsPointStart,
            },
        },
        series: seriesData,
        responsive: {
            rules: [{
                condition: {
                    maxWidth: responsiveMaxWidth,
                },
                chartOptions: {
                    legend: {
                        layout: responsiveLegendLayout,
                        align: responsiveLegendAlign,
                        verticalAlign: responsiveLegendVerticalAlign,
                    },
                },
            }],
        },
    });
}

function createBarChart({
    containerId = 'container',
    chartType = 'bar',
    titleText = 'Historic World Population by Region',
    subtitleText = 'Source: <a href="https://en.wikipedia.org/wiki/List_of_continents_and_continental_subregions_by_population" target="_blank">Wikipedia.org</a>',
    xAxisCategories = ['Africa', 'America', 'Asia', 'Europe'],
    xAxisTitleText = null,
    xAxisGridLineWidth = 1,
    xAxisLineWidth = 0,
    yAxisMin = 0,
    yAxisTitleText = 'Population (millions)',
    yAxisTitleAlign = 'high',
    yAxisLabelsOverflow = 'justify',
    yAxisGridLineWidth = 0,
    tooltipValueSuffix = ' millions',
    plotOptionsBarBorderRadius = '50%',
    plotOptionsBarDataLabelsEnabled = true,
    plotOptionsBarGroupPadding = 0.1,
    legendLayout = 'vertical',
    legendAlign = 'right',
    legendVerticalAlign = 'top',
    legendX = -40,
    legendY = 80,
    legendFloating = true,
    legendBorderWidth = 1,
    legendBackgroundColor = 'var(--highcharts-background-color, #ffffff)',
    legendShadow = true,
    creditsEnabled = false,
    seriesData = [
        { name: 'Year 1990', data: [632, 727, 3202, 721] },
        { name: 'Year 2000', data: [814, 841, 3714, 726] },
        { name: 'Year 2021', data: [1393, 1031, 4695, 745] }
    ]
} = {}) {
    Highcharts.chart(containerId, {
        chart: {
            type: chartType
        },
        title: {
            text: titleText
        },
        subtitle: {
            text: subtitleText
        },
        xAxis: {
            categories: xAxisCategories,
            title: {
                text: xAxisTitleText
            },
            gridLineWidth: xAxisGridLineWidth,
            lineWidth: xAxisLineWidth
        },
        yAxis: {
            min: yAxisMin,
            title: {
                text: yAxisTitleText,
                align: yAxisTitleAlign
            },
            labels: {
                overflow: yAxisLabelsOverflow
            },
            gridLineWidth: yAxisGridLineWidth
        },
        tooltip: {
            valueSuffix: tooltipValueSuffix
        },
        plotOptions: {
            bar: {
                borderRadius: plotOptionsBarBorderRadius,
                dataLabels: {
                    enabled: plotOptionsBarDataLabelsEnabled
                },
                groupPadding: plotOptionsBarGroupPadding
            }
        },
        legend: {
            layout: legendLayout,
            align: legendAlign,
            verticalAlign: legendVerticalAlign,
            x: legendX,
            y: legendY,
            floating: legendFloating,
            borderWidth: legendBorderWidth,
            backgroundColor: legendBackgroundColor,
            shadow: legendShadow
        },
        credits: {
            enabled: creditsEnabled
        },
        series: seriesData
    });
}

function createColumnChart({
    containerId = 'container',
    chartType = 'column',
    titleText = 'Corn vs wheat estimated production for 2023',
    subtitleText = 'Source: <a target="_blank" href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
    xAxisCategories = ['USA', 'China', 'Brazil', 'EU', 'Argentina', 'India'],
    xAxisAccessibilityDescription = 'Countries',
    yAxisMin = 0,
    yAxisTitleText = '1000 metric tons (MT)',
    tooltipValueSuffix = ' (1000 MT)',
    columnPointPadding = 0.2,
    columnBorderWidth = 0,
    seriesData = [
        {
            name: 'Corn',
            data: [387749, 280000, 129000, 64300, 54000, 34300]
        },
        {
            name: 'Wheat',
            data: [45321, 140000, 10000, 140500, 19500, 113500]
        }
    ]
} = {}) {
    Highcharts.chart(containerId, {
        chart: {
            type: chartType
        },
        title: {
            text: titleText
        },
        subtitle: {
            text: subtitleText
        },
        xAxis: {
            categories: xAxisCategories,
            crosshair: true,
            accessibility: {
                description: xAxisAccessibilityDescription
            }
        },
        yAxis: {
            min: yAxisMin,
            title: {
                text: yAxisTitleText
            }
        },
        tooltip: {
            valueSuffix: tooltipValueSuffix
        },
        plotOptions: {
            column: {
                pointPadding: columnPointPadding,
                borderWidth: columnBorderWidth
            }
        },
        series: seriesData
    });
}

function createPieChart({
    containerId,
    chartTitle,
    subtitleText,
    subtitleLink,
    tooltipSuffix,
    panKey = 'shift',
    chartType = 'pie',
    data,
    seriesName = 'Percentage',
    colorByPoint = true
}) {
    Highcharts.chart(containerId, {
        chart: {
            type: chartType,
            zooming: {
                type: 'xy'
            },
            panning: {
                enabled: true,
                type: 'xy'
            },
            panKey: panKey
        },
        title: {
            text: chartTitle
        },
        tooltip: {
            valueSuffix: tooltipSuffix
        },
        subtitle: {
            text: `Source:<a href="${subtitleLink}" target="_blank">${subtitleText}</a>`
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [
                    {
                        enabled: true,
                        distance: 20
                    },
                    {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }
                ]
            }
        },
        series: [{
            name: seriesName,
            colorByPoint: colorByPoint,
            data: data
        }]
    });
}


