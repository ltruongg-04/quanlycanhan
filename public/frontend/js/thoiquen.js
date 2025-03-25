document.addEventListener("DOMContentLoaded", function () {
    const trackers = document.querySelectorAll(".habit-tracker");
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth() + 1;
    const daysInMonth = new Date(currentYear, currentMonth, 0).getDate(); 

    function loadCheckboxes() {
        trackers.forEach(tracker => {
            const grid = tracker.querySelector(".habit-grid");
            const habitId = tracker.getAttribute("data-habit");

            grid.innerHTML = ""; 

            for (let day = 1; day <= daysInMonth; day++) {
                const container = document.createElement("div");
                container.classList.add("habit-checkbox-container");

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.classList.add("habit-checkbox");
                checkbox.dataset.day = day;
                
                let date = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

                fetch(`/habit-tracking/status?habit_id=${habitId}&tracking_date=${date}`)
    .then(response => response.json())
    .then(data => {
        checkbox.checked = data.completed;
    })
    .catch(error => console.error('Lỗi khi tải trạng thái:', error));

    checkbox.addEventListener("change", function () {
        checkbox.disabled = true;
    
        fetch('/habit-tracking/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                habit_id: habitId,
                tracking_date: date
            })
        })
        .then(response => response.json())
        .then(data => {
            checkbox.checked = data.action === 'added'; 
            drawChart();
        })
        .catch(error => console.error('Lỗi khi cập nhật thói quen:', error))
        .finally(() => {
            checkbox.disabled = false;
        });
    });
    

                const dayNumber = document.createElement("span");
                dayNumber.classList.add("habit-day");
                dayNumber.textContent = day;

                container.appendChild(checkbox);
                container.appendChild(dayNumber);
                grid.appendChild(container);
            }
        });
    }
    loadCheckboxes();
    

    document.querySelectorAll('.month').forEach(month => {
        month.addEventListener("click", function () {
            let selectedMonth = parseInt(this.getAttribute("data-month")); 
            document.querySelectorAll('.month').forEach(m => m.classList.remove('selected'));
            this.classList.add('selected');
    
            loadCheckboxes(selectedMonth); 
        });
    });
    
});

function loadCheckboxes(selectedMonth = currentMonth) {
    trackers.forEach(tracker => {
        const grid = tracker.querySelector(".habit-grid");
        const habitId = tracker.getAttribute("data-habit");

        grid.innerHTML = "";
        let daysInSelectedMonth = new Date(currentYear, selectedMonth, 0).getDate();

        for (let day = 1; day <= daysInSelectedMonth; day++) {
            let date = `${currentYear}-${String(selectedMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

        }
    });
}



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
