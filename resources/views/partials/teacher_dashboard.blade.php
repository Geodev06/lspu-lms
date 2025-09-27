<div class="col-sm-6 col-xl-3  mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                    <span class="text-heading">My Active Courses</span>
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
                    <span class="text-heading">My Available Activities</span>
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
                    <span class="text-heading">My Notifications</span>
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

<div class="col-sm-12 col-xl-12  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">
            <div class="card-header">My Pending Tasks</div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="table_pending_tasks">
                    <thead>
                        <tr>
                            <th>Activity Name</th>
                            <th>Submitted By</th>
                            <th>Section</th>
                            <th>Submmited Date</th>
                            <th>Activity Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">


                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        const route = "{{ route('datatable.table_pending_tasks') }}"

        const columns = [{
                data: 'activity_name',
                name: 'activity_name',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'section_name',
                name: 'section_name',
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
            {
                data: 'activity_type',
                name: 'activity_type',
            },
            {
                data: 'actions',
                name: 'actions',
            }
        ]

        init_datatable('#table_pending_tasks', route, columns)
    </script>
</div>


<div class="col-sm-6 col-xl-4  mb-3" wire:ignore>
    <div class="card">
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="t_bar_1"></div>
                <!-- <p class="highcharts-description">
                    Basic line chart showing trends in a dataset. This chart includes the
                    <code>series-label</code> module, which adds a label to each line for
                    enhanced readability.
                </p> -->
            </figure>

            <script>
                $.get('/get_t_bar_1', function(sqlResults) {


                    const gradesFloat = sqlResults.map(item => parseFloat(item.grade) || 0);

                    createColumnChart({
                        containerId: 't_bar_1',
                        chartType: 'column',
                        titleText: 'Average grade per Activity Type',
                        subtitleText: 'Source: system',
                        xAxisCategories: ['Hands On', 'Identification', 'Essay', 'Multiple Choice'],
                        xAxisAccessibilityDescription: 'Countries',
                        yAxisMin: 0,
                        yAxisTitleText: 'Grade',
                        tooltipValueSuffix: '%',
                        columnPointPadding: 0.2,
                        columnBorderWidth: 0,
                        seriesData: [{
                            name: 'Activity type',
                            data: gradesFloat
                        }]
                    });

                })
            </script>
        </div>
    </div>
</div>

<div class="col-sm-6 col-xl-8  mb-3">
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
                                {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
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