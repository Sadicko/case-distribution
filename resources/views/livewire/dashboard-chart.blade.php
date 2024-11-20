<div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header border-bottom pt-3">
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-chart-bar me-1"></i> <span class="show-time-status">Case distributions</span></span>
                        <div>
                            <div class="btn-group" role="group" aria-label="Case distribution buttons">
                                <button wire:click="getCaseDistributions('weekly')" type="button" class="btn btn-outline-primary">Weekly</button>
                                <button wire:click="getCaseDistributions('monthly')" type="button" class="btn btn-outline-primary">Monthly</button>
                                <button wire:click="getCaseDistributions('yearly')" type="button" class="btn btn-outline-primary">Yearly</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" wire:ignore wire:loading.class="opacity-25">
                    <canvas id="myBarChart" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



@assets
<script src="{{ asset('plugins/charts/chart.min.js') }}"></script>
@endassets

@script
<script>

    const caseDistributions = $wire.caseDistributions;
    //
    console.log(caseDistributions);
    // console.log(getRandomColor());

    let labels = [];
    let caseCounts = [];
    let colors = [];

    labels = caseDistributions.map(item => item.period);
    console.log(labels);
    caseCounts =  caseDistributions.map(item => item.case_count);
    console.log(caseCounts);
    colors = caseDistributions.map(item => getRandomColor());
    console.log(colors);

    // caseDistributions.forEach(item => {
    //     labels.push(item.period);
    //     caseCounts.push(item.case_count);
    //     colors.push(getRandomColor());
    // });


    var ctx = document.getElementById("myBarChart");

    window.myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: `${$wire.status.toUpperCase()} CASE DISTRIBUTION`,
                data: caseCounts,
                backgroundColor: colors,
                borderColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: true,
            legend: {
                display: true,
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
                xAxes: [
                    {
                        gridLines: {
                            display: false,
                        },
                    },
                ],
            },
        },
    });


    function getRandomColor() {
        return `#${Math.floor(Math.random() * 16777215).toString(16)}`;
    }

</script>
@endscript
