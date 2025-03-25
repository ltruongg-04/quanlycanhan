function selectMonth(element) {
    document.querySelectorAll('.month').forEach(month => month.classList.remove('selected'));
    element.classList.add('selected');

    let selectedMonth = parseInt(element.textContent.replace(/\D/g, ''), 10);

    loadMonthData(selectedMonth);
}

function autoSelectCurrentMonthYear() {
    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth() + 1; 

    document.getElementById("yearDisplay").textContent = currentYear;

    let months = document.querySelectorAll('.month');
    months[currentMonth - 1].classList.add('selected');

    loadMonthData(currentMonth);
}

function loadMonthData(month) {
    fetch(`/cong-viec/month/${month}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            let monthlyGoalsList = document.getElementById("monthlyGoals");
            let weeklyGoalsContainer = document.getElementById("weeklyGoals");

            if (!monthlyGoalsList || !weeklyGoalsContainer) {
                console.error("DOM elements không tìm thấy!");
                return;
            }

            monthlyGoalsList.innerHTML = "";
            if (Array.isArray(data.monthlyGoals)) {
                data.monthlyGoals.forEach(goal => {
                    let li = document.createElement("li");
                    li.textContent = goal.task_name;
                    monthlyGoalsList.appendChild(li);
                });
            }

            
        })
        .catch(error => console.error("Lỗi khi tải dữ liệu:", error));
}

window.onload = autoSelectCurrentMonthYear;
