<div class="py-2 md:p-4">
    <div class="bg-white rounded-none md:rounded shadow">
        <div class="bg-gray-50 rounded-t p-4 shadow">
            <p class="uppercase text-yellow-900 text-sm font-semibold">Orders</p>
        </div>
            <div class="p-4">
                <div id="calendar" class="bg-gray-100 shadow rounded">
                    <div class="flex items-center justify-between bg-yellow-900 bg-opacity-50 rounded-t p-4">
                        <button id="previousBtn" class="text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <div class="flex flex-col items-center justify-center">
                            <h1 id="month" class="uppercase font-bold text-3xl text-white"></h1>
                            <p id="completeDate" class="uppercase font-semibold text-white"></p>
                        </div>
                        <button id="nextBtn" class="text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <div id="days" class="grid grid-cols-7"></div>

                    <div id="dates" class="grid grid-cols-7"></div>
                </div>
            </div>
    </div>
</div>
<script>
$(document).ready(function(){

    $('#orderTable').DataTable({
        responsive: true
    });

/* CALENDAR START ------------------------------------ */
const date = new Date();

const renderCalendar = () => {
    const monthsArray = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

const daysId = $("#days");
const daysArray = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
let days = "";
const currentYear = date.getFullYear();
const currentMonth = date.getMonth();
const currentDate = date.getDate();
const currentDay = date.getDay();
const getDaysInMonth = (year, month) => {
    return new Date(year, month + 1, 0).getDate();
};
const currentMonthLastDate = getDaysInMonth(currentYear, currentMonth);
let dates = "";
const datesId = $("#dates");
const previousDates = new Date(currentYear, currentMonth, 0).getDate();
const currentMonthLastDay = new Date(currentYear, currentMonth + 1, 0).getDay();
const nextDates = 7 - currentMonthLastDay - 1;

for(let m = 0; m < monthsArray.length; m++)
{
    $("#month").html(monthsArray[currentMonth]);
}

$('#completeDate').html(date.toDateString());

//days
daysArray.forEach(day => {
    days += `<div class="flex items-center justify-center uppercase font-semibold text-yellow-900 p-4 shadow">${day}</div>`;
    daysId.html(days);
});

//previous dates
for(let p = currentDay; p > 0; p--)
{
    dates += `<div class="flex items-center justify-center text-gray-400 p-4 border">${previousDates - p + 1}</div>`;
}

//current dates
for(let i = 1; i <= currentMonthLastDate; i++)
{

    if(i === currentDate && currentMonth === new Date().getMonth() && currentYear === new Date().getFullYear())
    {
        dates += `<div class="flex items-center justify-center p-4 border bg-yellow-900 bg-opacity-50 text-white shadow">${i}
                ${orderDateCount(i, currentMonth, currentYear)}</div>`;
    }else{
        dates += `<div class="flex items-center justify-center text-yellow-900 p-4 border">${i}
                    ${orderDateCount(i, currentMonth, currentYear)}</div>`;
    }
}

//next dates
for(let n = 1; n <= nextDates; n++)
{
    dates += `<div class="flex items-center justify-center text-gray-400 p-4 border">${n}</div>`;
    datesId.html(dates);
}
};

$("#previousBtn").on('click', function(){
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
});

$("#nextBtn").on('click', function(){
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
});

renderCalendar();
/* CALENDAR END ------------------------------------ */
});

function orderDateCount(date, month, year)
{
    let d = new Date();
    var orders = @json($orders);
    let orderDatesArray = [];

    for(let o = 0; o < orders.length; o++)
    {
        let orderGetDates = new Date(orders[o].updated_at).getDate();
        orderDatesArray.push(orderGetDates);
    }

    var count = [];
        for(let d = 0; d < orderDatesArray.sort().length; ++d)
        {
            if(orderDatesArray[d] == date)
            {
                count.push(orderDatesArray[d]);
            }
        }

        if(count.length != 0 && month === new Date(orders[0].updated_at).getMonth() && year === new Date(orders[0].updated_at).getFullYear())
        {
            return `<a href="view-order-list/${month + 1}/${date}/${year}" class="text-xs bg-green-600 text-green-100 px-2 py-1 rounded-full absolute mb-5 ml-16">${count.length}</a>`;
        }else{
            /* return `<span class="text-xs bg-yellow-600 text-yellow-100 p-1 rounded-full absolute mb-5 ml-16">${count.length}</span>`; */
            return "";
        }

}
</script>
