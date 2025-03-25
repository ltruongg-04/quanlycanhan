document.addEventListener("DOMContentLoaded", function () {
    const trackers = document.querySelectorAll(".habit-tracker");
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth() + 1; 
    const daysInMonth = new Date(currentYear, currentMonth, 0).getDate(); 


    const addButton = document.querySelector(".new");
    const editButton = document.querySelector(".edit");

    if (addButton) {
        addButton.addEventListener("click", function () {
            window.location.href = ""; 
        });
    }

    


});


function selectMonth(element) {
    document.querySelectorAll('.month').forEach(month => month.classList.remove('selected'));
    element.classList.add('selected');
}


function autoSelectCurrentMonthYear() {
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth(); 

    document.getElementById("yearDisplay").textContent = currentYear;
    let months = document.querySelectorAll('.month');
    months[currentMonth].classList.add('selected');
}

window.onload = autoSelectCurrentMonthYear;
