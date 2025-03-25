document.addEventListener("DOMContentLoaded", function () {
    const trackers = document.querySelectorAll(".habit-tracker");
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth() + 1;
    const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();


    const backButton = document.querySelector(".back");
    const saveButton = document.querySelector(".save");

    if (backButton) {
        backButton.addEventListener("click", function () {
            window.location.href = "muctieu-thoiquen.html"; 
        });
    }

    if (saveButton) {
        saveButton.addEventListener("click", function () {
            window.location.href = "muctieu-thoiquen.html"; 
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
