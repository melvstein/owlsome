<section id="boxes" class="p-4">
    <div class="grid grid-cols-1 md:grid-cols-4 md:gap-4">
        <div class="bg-blue-300 rounded shadow mb-2 md:mb-0">
            <div class="flex items-center justify-between p-4">
                <i class="fa fa-users text-3xl md:text-5xl transition transform hover:-translate-y-1"></i>

                <div class="flex flex-col items-end">
                    <p class="text-3xl md:text-5xl">{{ $users->count() }}</p>
                    <p>Users</p>
                </div>
            </div>
            <div class="bg-blue-400 flex items-center justify-center rounded-b">
                <a href="{{ (auth()->user()->role == "Admin") ? route('admin.user.list') : '#' }}" class="flex items-center justify-center text-sm text-white hover:bg-blue-500 w-full text-center p-2">
                    More Info
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 ml-2">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="bg-red-300 rounded shadow mb-2 md:mb-0">
            <div class="flex items-center justify-between p-4">
                <i class="fa fa-product-hunt text-3xl md:text-5xl transition transform hover:-translate-y-1"></i>

                <div class="flex flex-col items-end">
                    <p class="text-3xl md:text-5xl">{{ $products->count() }}</p>
                    <p>Products</p>
                </div>
            </div>
            <div class="bg-red-400 flex items-center justify-center rounded-b">
                <a href="{{ route(Str::lower(auth()->user()->role).'.product.list') }}" class="flex items-center justify-center text-sm text-white hover:bg-red-500 w-full text-center p-2">
                    More Info
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 ml-2">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="bg-green-300 rounded shadow mb-2 md:mb-0">
            <div class="flex items-center justify-between p-4">
                <i class="fa fa-list text-3xl md:text-5xl transition transform hover:-translate-y-1" aria-hidden="true"></i>

                <div class="flex flex-col items-end">
                    <p class="text-3xl md:text-5xl">{{ $orders->count() }}</p>
                    <p>Orders</p>
                </div>
            </div>
            <div class="bg-green-400 flex items-center justify-center rounded-b">
                <a href="{{ route(Str::lower(auth()->user()->role).'.order.list') }}" class="flex items-center justify-center text-sm text-white hover:bg-green-500 w-full text-center p-2">
                    More Info
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 ml-2">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="bg-yellow-300 rounded shadow md:mb-0">
            <div class="flex items-center justify-between p-4">
                <i class="fa fa-ruble text-3xl md:text-5xl transition transform hover:-translate-y-1"></i>

                <div class="flex flex-col items-end">
                    <p class="text-3xl md:text-5xl">{{ number_format($totalEarned, 2) }}</p>
                    <p>Total Earnings</p>
                </div>
            </div>
            <div class="bg-yellow-400 flex items-center justify-center rounded-b">
                <a href="{{ route(Str::lower(auth()->user()->role).'.order.totalEarningsView') }}" class="flex items-center justify-center text-sm text-white hover:bg-yellow-500 w-full text-center p-2">
                    More Info
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 ml-2">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="p-0 md:px-4" id="chartsList">
    <div class="bg-white border rounded shadow">
        <div class="p-4">
            <select name="selectYear" id="selectYear" class="rounded"></select>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 p-4">
            <div class="shadow border rounded">
                <div class="bg-gray-50 rounded-t border-b p-4">
                    <p class="text-xs uppercase font-semibold text-gray-600">Line Chart</p>
                </div>
                <div class="w-auto h-auto p-4">
                    <canvas id="salesLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let selectYear = $("#selectYear");

$(document).ready(function(){

    selectYear.on("change", function(){
        year = new Date($(this).val()).getFullYear();
        salesLineChart(year);
    });
});


selectedYear(currentYear);
salesLineChart(currentYear);


function selectedYear(year)
{
    let option = "";

    for(let i = 0; i < 10; i++)
    {

        option += `<option value="${year - i}">${year - i}</option>`;
    }
    return selectYear.html(option);
}

function totalEarned(year, month)
{
    const salesDatum = @json($totalEarnings);

    let totalEarned = 0;

    for(let d = 0; d < salesDatum.length; d++)
        {
            if(year === new Date(salesDatum[d].created_at).getFullYear() && month === new Date(salesDatum[d].created_at).getMonth())
            {
                totalEarned += salesDatum[d].earned;
            }else{
                totalEarned;
            }
        }

    return totalEarned;
}

function getData(year){
    let earnedPerMonth = [];

    for(let i = 0; i < 12; i++)
    {
        earnedPerMonth.push(parseFloat(totalEarned(year, i)));
    }

    return { earnedPerMonth, year };
}

async function salesLineChart(year)
{
    const data = await getData(year);
    const ctx = document.getElementById('salesLineChart');
    const salesLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Total amount of Sales',
                data: data.earnedPerMonth,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return '₱ ' + value.toLocaleString();
                        }
                    }
                }]
            },
            title: {
                display: true,
                text: `Earned Per Month ${data.year}`,
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        let label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ₱ ';
                        }
                        label += (Math.round(tooltipItem.yLabel * 100) / 100).toLocaleString();
                        return label;
                    }
                }
            }
        }
    });
}

</script>

