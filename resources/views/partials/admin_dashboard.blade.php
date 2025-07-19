<div class="col-sm-6 col-xl-3 mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Session</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['section_count'] }}</h4>
                    </div>
                    <small class="mb-0">Total Available Sections</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-primary">
                        <i class="icon-base bx bx-group icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Active Users</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['users_count'] }}</h4>
                        <!-- <p class="text-success mb-0">(+18%)</p> -->
                    </div>
                    <small class="mb-0">Total Acitve Users </small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-danger">
                        <i class="icon-base bx bx-user-plus icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Active Courses</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['courses_count'] }}</h4>
                        <!-- <p class="text-danger mb-0">(-14%)</p> -->
                    </div>
                    <small class="mb-0">Active Courses</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-success">
                        <i class="icon-base bx bx-user-check icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Available Activities</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['activity_count'] }}</h4>
                        <!-- <p class="text-success mb-0">(+42%)</p> -->
                    </div>
                    <small class="mb-0">Active Activities</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-warning">
                        <i class="icon-base bx bx-user-voice icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Today Submission Count</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['submission_count_today'] }}</h4>
                        <p class="text-muted mb-0">{{ now()->format('F j, Y, g:i A') }}</p>

                    </div>
                    <small class="mb-0">Submissions</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-warning">
                        <i class="icon-base bx bx-calendar icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Today Submission All time</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['submission_count_overall'] }}</h4>
                        <!-- <p class="text-success mb-0">(+42%)</p> -->
                    </div>
                    <small class="mb-0">Submissions</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-warning">
                        <i class="icon-base bx bx-calendar icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">System Collected Bandits</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['bandit_count'] }}</h4>
                        <!-- <p class="text-success mb-0">(+42%)</p> -->
                    </div>
                    <small class="mb-0">--</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-success">
                        <i class="icon-base bx bx-info-circle icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">Notifications</span>
                    <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ $data['notification_count'] }}</h4>
                        <!-- <p class="text-success mb-0">(+42%)</p> -->
                    </div>
                    <small class="mb-0">Unseen</small>
                </div>
                <div class="avatar">
                    <span class="avatar-initial rounded bg-label-primary">
                        <i class="icon-base bx bx-bell icon-lg"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-sm-6 col-xl-8  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="line_1"></div>
                <!-- <p class="highcharts-description">
                    Basic line chart showing trends in a dataset. This chart includes the
                    <code>series-label</code> module, which adds a label to each line for
                    enhanced readability.
                </p> -->
            </figure>

            <script>
                // Months order to map indexes
                $.get('/get_line_1', function(sqlResults) {
                    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

                    const dataMap = {};

                    // Initialize map only for non-null names
                    sqlResults.forEach(({
                        name
                    }) => {
                        if (name) { // skip null, undefined, or empty string
                            if (!dataMap[name]) {
                                dataMap[name] = new Array(12).fill(0);
                            }
                        }
                    });

                    sqlResults.forEach(({
                        name,
                        created_date,
                        count
                    }) => {
                        if (name) { // skip null or falsy names here too
                            const monthIndex = months.indexOf(created_date);
                            if (monthIndex !== -1) {
                                dataMap[name][monthIndex] = count;
                            }
                        }
                    });

                    // Convert to Highcharts format
                    const seriesData = Object.entries(dataMap).map(([name, data]) => ({
                        name,
                        data,
                    }));

                    // Then call your chart function as before
                    createLineChart({
                        containerId: 'line_1',
                        titleText: 'Submission per Department Monthly',
                        titleAlign: 'left',
                        subtitleText: '',
                        subtitleAlign: 'left',
                        yAxisTitle: 'Submissions',
                        xAxisRangeDescription: 'Range: Jan to Dec',
                        xAxisCategories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        legendLayout: 'vertical',
                        legendAlign: 'right',
                        legendVerticalAlign: 'middle',
                        plotOptionsLabelConnectorAllowed: false,
                        plotOptionsPointStart: 0,
                        seriesData,
                        responsiveMaxWidth: 500,
                        responsiveLegendLayout: 'horizontal',
                        responsiveLegendAlign: 'center',
                        responsiveLegendVerticalAlign: 'bottom',
                    });

                })
            </script>
        </div>
    </div>
</div>


<div class="col-sm-6 col-xl-4  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="bar_1"></div>
                <!-- <p class="highcharts-description">
                    Basic line chart showing trends in a dataset. This chart includes the
                    <code>series-label</code> module, which adds a label to each line for
                    enhanced readability.
                </p> -->
            </figure>

            <script>
                $.get('/get_bar_1', function(sqlResults) {

                    const xAxisCategories = ['Auditory', 'Reading_and_Writing', 'Kinesthetic', 'Visual'];

                    const resultMap = {};
                    sqlResults.forEach(row => {
                        if (row.modality) {
                            const normalizedKey = row.modality.trim().toLowerCase();
                            resultMap[normalizedKey] = {
                                s: parseInt(row.s, 10) || 0,
                                f: parseInt(row.f, 10) || 0
                            };
                        }
                    });

                    // Extract values per modality in order
                    const successes = xAxisCategories.map(modality => {
                        const key = modality.trim().toLowerCase();
                        return resultMap[key]?.s ?? 0;
                    });

                    const failures = xAxisCategories.map(modality => {
                        const key = modality.trim().toLowerCase();
                        return resultMap[key]?.f ?? 0;
                    });
                    createBarChart({
                        containerId: 'bar_1',
                        chartType: 'bar',
                        titleText: 'Activity Results per Modality',
                        subtitleText: '',
                        xAxisCategories: xAxisCategories,
                        xAxisTitleText: null,
                        xAxisGridLineWidth: 1,
                        xAxisLineWidth: 0,
                        yAxisMin: 0,
                        yAxisTitleText: 'Submissions',
                        yAxisTitleAlign: 'high',
                        yAxisLabelsOverflow: 'justify',
                        yAxisGridLineWidth: 0,
                        tooltipValueSuffix: '',
                        plotOptionsBarBorderRadius: '50%',
                        plotOptionsBarDataLabelsEnabled: true,
                        plotOptionsBarGroupPadding: 0.1,
                        legendLayout: 'vertical',
                        legendAlign: 'right',
                        legendVerticalAlign: 'top',
                        legendX: -40,
                        legendY: 80,
                        legendFloating: true,
                        legendBorderWidth: 1,
                        legendBackgroundColor: 'var(--highcharts-background-color, #ffffff)',
                        legendShadow: true,
                        creditsEnabled: false,
                        seriesData: [{
                                name: 'Successes',
                                data: successes
                            },
                            {
                                name: 'Failures',
                                data: failures
                            }
                        ]
                    });


                })
            </script>
        </div>
    </div>
</div>


<div class="col-sm-6 col-xl-4  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="pie_1"></div>
                <!-- <p class="highcharts-description">
                    Basic line chart showing trends in a dataset. This chart includes the
                    <code>series-label</code> module, which adds a label to each line for
                    enhanced readability.
                </p> -->
            </figure>

            <script>
                $.get('/get_pie_1', function(sqlResults) {
                    console.log(sqlResults);

                    const chartData = sqlResults.map(result => ({
                        ...result,
                        y: parseFloat(result.y)
                    }));

                    createPieChart({
                        containerId: 'pie_1',
                        chartTitle: 'Avg Grade per Organizations',
                        subtitleText: 'LSPU-LMS',
                        subtitleLink: '',
                        tooltipSuffix: '%',
                        data: chartData
                    });
                });
            </script>
        </div>
    </div>
</div>

<div class="col-sm-6 col-xl-4  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="pie_2"></div>
                <!-- <p class="highcharts-description">
                    Basic line chart showing trends in a dataset. This chart includes the
                    <code>series-label</code> module, which adds a label to each line for
                    enhanced readability.
                </p> -->
            </figure>

            <script>
                $.get('/get_pie_2', function(sqlResults) {
                    console.log(sqlResults);

                    var chartData = [{
                            name: 'Auditory',
                            y: parseFloat(sqlResults[0].a)
                        },
                        {
                            name: 'Kinesthetics',
                            y: parseFloat(sqlResults[0].k)
                        },
                        {
                            name: 'Reading and Writing',
                            y: parseFloat(sqlResults[0].r)
                        },
                        {
                            name: 'Visual',
                            y: parseFloat(sqlResults[0].v)
                        }
                    ]



                    createPieChart({
                        containerId: 'pie_2',
                        chartTitle: 'Avg Modality Score (INITIAL ASSESSMENT)',
                        subtitleText: 'LSPU-LMS',
                        subtitleLink: '',
                        tooltipSuffix: '%',
                        data: chartData
                    });
                });
            </script>
        </div>
    </div>
</div>

<div class="col-sm-6 col-xl-4  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">


            <figure class="highcharts-figure">
                <div id="bar_2"></div>
                <!-- <p class="highcharts-description">
                    Basic line chart showing trends in a dataset. This chart includes the
                    <code>series-label</code> module, which adds a label to each line for
                    enhanced readability.
                </p> -->
            </figure>

            <script>
                $.get('/get_bar_2', function(sqlResults) {

                    // Convert to float and log results
                    const parsedResults = sqlResults.map(item => ({
                        type: item.modality,
                        success: parseFloat(item.s),
                        failure: parseFloat(item.f)
                    }));

                    const xAxisCategories = parsedResults.map(item => item.type);
                    const successData = parsedResults.map(item => item.success);
                    const failureData = parsedResults.map(item => item.failure);




                    createColumnChart({
                        containerId: 'bar_2',
                        chartType: 'column',
                        titleText: 'Sum of Bandits in the system per modality',
                        subtitleText: 'Source: system',
                        xAxisCategories: xAxisCategories,
                        xAxisAccessibilityDescription: 'Learning Styles',
                        yAxisMin: 0,
                        yAxisTitleText: 'Score',
                        tooltipValueSuffix: '',
                        columnPointPadding: 0.2,
                        columnBorderWidth: 0,
                        seriesData: [{
                                name: 'Successes',
                                data: successData
                            },
                            {
                                name: 'Failures',
                                data: failureData
                            }
                        ]
                    });

                })
            </script>
        </div>
    </div>
</div>


<div class="col-sm-6 col-xl-12   mb-3">
    <div class="card">
        <div class="card-body">
            <span class="text-heading">Submissions history</span>
            <hr>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Module</th>
                            <th>Score</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($data['submission_history'] as $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->course_name }}</strong></td>
                            <td>{{ $item->module_name }}</td>
                            <td>
                                {{ $item->grade }}
                            </td>
                            <td>
                                {{ $item->created_at }}
                                -
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </td>
                            <td>
                                @if($item->grade >= 75)
                                <span class="badge bg-label-success me-1">Passed</span>

                                @else
                                <span class="badge bg-label-danger me-1">Failed</span>

                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No Data</td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>

                {{ $data['submission_history']->links() }}
            </div>
        </div>
    </div>
</div>