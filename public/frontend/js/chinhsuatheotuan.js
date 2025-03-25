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

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".back").addEventListener("click", function () {
        window.location.href = "congviectheotuan.html"; 
    });

    document.querySelector(".save").addEventListener("click", function () {
        alert("Đã lưu công việc thành công!"); 
        window.location.href = "congviectheotuan.html";
    });
});
