document.addEventListener("DOMContentLoaded", function () {
    const trackers = document.querySelectorAll(".habit-tracker");
    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonth = today.getMonth() + 1; 
    const daysInMonth = new Date(currentYear, currentMonth, 0).getDate(); 

    function loadCheckboxes() {
        trackers.forEach(tracker => {
            const grid = tracker.querySelector(".habit-grid");
            const habitName = tracker.getAttribute("data-habit");

            grid.innerHTML = ""; 

            for (let day = 1; day <= daysInMonth; day++) {
                const container = document.createElement("div");
                container.classList.add("habit-checkbox-container");

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.classList.add("habit-checkbox");
                checkbox.dataset.day = day;

                const storageKey = `habit-${habitName}-${currentYear}-${currentMonth}-${day}`;
                checkbox.checked = localStorage.getItem(storageKey) === "true";

                checkbox.addEventListener("change", function () {
                    localStorage.setItem(storageKey, this.checked);
                    drawChart(); 
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

    const habitColors = {
        "day-som": "#FF5733",       
        "tap-the-duc": "#33FF57",   
        "doc-sach": "#3385FF",      
        "ngu-som": "#FFC300"        
    };

    function getHabitColor(habitName) {
        if (!habitColors[habitName]) {
            habitColors[habitName] = '#' + Math.floor(Math.random() * 16777215).toString(16);
        }
        return habitColors[habitName];
    }





    loadCheckboxes();
    drawChart();
});











document.querySelectorAll(".custom-button").forEach(button => {
    button.addEventListener("click", function () {
        this.classList.toggle("active");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("confirmModal");
    const cancelBtn = document.getElementById("cancelBtn");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function () {
            modal.style.display = "flex"; // Hiện modal
        });
    });

    cancelBtn.addEventListener("click", function () {
        modal.style.display = "none"; // Ẩn modal khi nhấn Hủy
    });

    confirmDeleteBtn.addEventListener("click", function () {
        modal.style.display = "none"; // Ẩn modal khi nhấn Xóa
    });


    document.querySelectorAll(".custom-button").forEach(button => {
        button.addEventListener("click", function () {
            const habitContainer = this.closest(".habit-tracker");
            const habitType = habitContainer.getAttribute("data-habit"); 

            // Điều hướng đến trang chỉnh sửa tương ứng
            if (habitType) {
                window.location.href = `chinhsuathoiquen.html?habit=${habitType}`;
            }
        });
    });

    // Bắt sự kiện khi nhấn "Quay lại"
    document.querySelector(".back").addEventListener("click", function () {
        window.location.href = "thoiquen.html";
    });



});