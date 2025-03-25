document.addEventListener("DOMContentLoaded", function () {
    const contactBtn = document.querySelector(".mail"); 
    const qsBtn = document.querySelector(".qs");

    if (qsBtn) {
        qsBtn.addEventListener("click", function () {
            window.location.href = ""; 
        });
    }

    if (contactBtn) {
        contactBtn.addEventListener("click", function () {
            window.location.href = "/ho-tro-chat"; 
        });
    }
});
function updateDate() {
    const dateElement = document.getElementById("current-date");
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    dateElement.textContent = today.toLocaleDateString('vi-VN', options);
}
updateDate();

