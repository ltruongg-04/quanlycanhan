document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector('.calendar h3');
    const dates = document.querySelector('.dates');
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");

    const months = [
        "January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"
    ];

    let date = new Date();
    let month = date.getMonth();
    let year = date.getFullYear();

    function renderCalendar() {
        const today = new Date();
        const startDay = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();
        const nextMonthDays = 42 - (startDay + totalDays);
        let datesHtml = "";

        for (let i = startDay; i > 0; i--) {
            datesHtml += `<li class="inactive fade">${prevMonthDays - i + 1}</li>`;
        }

        for (let i = 1; i <= totalDays; i++) {
            let classes = [];

            if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                classes.push("today");
            }

            datesHtml += `<li class="${classes.join(" ")}">${i}</li>`;
        }

        for (let i = 1; i <= nextMonthDays; i++) {
            datesHtml += `<li class="inactive fade">${i}</li>`;
        }

        dates.innerHTML = datesHtml;
        header.textContent = `${months[month]} ${year}`;
    }


    prevBtn.addEventListener("click", function () {
        if (month === 0) {
            year--;
            month = 11;
        } else {
            month--;
        }
        renderCalendar();
    });

    nextBtn.addEventListener("click", function () {
        if (month === 11) {
            year++;
            month = 0;
        } else {
            month++;
        }
        renderCalendar();
    });

    renderCalendar();


    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            contents.forEach(content => content.classList.add("hidden"));
            document.getElementById(`${tab.dataset.tab}-content`).classList.remove("hidden");
        });
    });

    const checkboxes = document.querySelectorAll('.task-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskText = this.nextElementSibling;
            if (this.checked) {
                taskText.classList.add('task-completed');
            } else {
                taskText.classList.remove('task-completed');
            }
        });
    });



});
