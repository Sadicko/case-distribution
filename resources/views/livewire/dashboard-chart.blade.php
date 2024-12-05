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
{{--<script src="{{ asset('js/colors.js') }}"></script>--}}
<script src="{{ asset('plugins/charts/chart.min.js') }}"></script>
@endassets

@script
<script>

    //load chart on page load
    document.addEventListener('livewire:initialized', () => {
        renderChart()
    })

    //load chart when clicked on weekly, monthly or year
    $wire.on('caseDistributionsUpdated', () => {
        renderChart()
    });

    //chart function
    function renderChart(){

        //get data
        const caseDistributions = $wire.caseDistributions;

        // Predefine the colors from the getColors() PHP helper
        const colors = @json(getColors());

        let labels = caseDistributions.map(item => typeof item.period === 'string' ? item.period.toUpperCase() : item.period);
        let caseCounts =  caseDistributions.map(item => item.case_count);
        let mappedColors = caseDistributions.map((item, index) => colors[index]);

        console.log(labels);
        console.log(caseCounts);
        //get chat id
        var ctx = document.getElementById("myBarChart");

        if (window.myChart) {
            window.myChart.destroy(); //destroy canvas if exist
        }

        //start chart
        window.myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: `${$wire.status.toUpperCase()} CASE DISTRIBUTION`,
                    data: caseCounts,
                    backgroundColor: mappedColors,
                    borderColor: mappedColors,
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

    }

    {{--const allColors = @json(getColors());--}}

    {{--function getRandomColor() {--}}
    {{--    console.log(allColors);--}}
    {{--    return allColors;--}}
    {{--}--}}

</script>
@endscript
