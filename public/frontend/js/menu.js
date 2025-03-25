document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const userProfile = document.querySelector(".user-profile");
    const logoutBtn = document.getElementById("logout-btn");
    const infoBtn = document.getElementById("info-btn");
    const thongBaoMenu = document.getElementById("thongbao-menu");
    const notificationPanel = document.getElementById("notification-panel");
    const logoutForm = document.getElementById("logout-form");

    menuItems.forEach((item) => {
        item.addEventListener("click", function (event) {
            const page = this.getAttribute("data-page");

            if (item === thongBaoMenu) {
                event.preventDefault();
                notificationPanel.style.display =
                    notificationPanel.style.display === "block" ? "none" : "block";
            } else if (page) {
                window.location.href = page;
            }
        });
    });

    const thoiQuenMenu = document.getElementById("thoiquen-menu");
    if (thoiQuenMenu) {
        thoiQuenMenu.addEventListener("click", function () {
            const submenu = this.querySelector(".submenu");
            submenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (event) {
            const submenu = document.querySelector(".submenu");
            if (submenu && !submenu.contains(event.target) && !thoiQuenMenu.contains(event.target)) {
                submenu.classList.add("hidden");
            }
        });

        document.querySelectorAll(".submenu-item").forEach((item) => {
            item.addEventListener("click", function () {
                const page = this.getAttribute("data-page");
                window.location.href = page;
            });
        });
    }

    if (notificationPanel) {
        notificationPanel.addEventListener("mouseleave", function () {
            this.style.display = "none";
        });

        notificationPanel.addEventListener("click", function (event) {
            event.stopPropagation();
        });
    }

    userProfile.addEventListener("click", function () {
        logoutBtn.classList.toggle("hidden");
        infoBtn.classList.toggle("hidden");
    });

    if (logoutBtn && logoutForm) {
        logoutBtn.addEventListener("click", function () {
            logoutForm.submit();
            
        });
    }

    infoBtn.addEventListener("click", function () {
        window.location.href = "/profile";
    });
});
