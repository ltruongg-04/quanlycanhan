document.addEventListener("DOMContentLoaded", function () {
    const contactBtn = document.querySelector(".mail"); 
    const qsBtn = document.querySelector(".qs");

    if (qsBtn) {
        qsBtn.addEventListener("click", function () {
            window.location.href = "/ho-tro";
        });
    }

    if (contactBtn) {
        contactBtn.addEventListener("click", function () {
            window.location.href = ""; 
        });
    }

    const sendBtn = document.getElementById("send-btn");
    const messageInput = document.getElementById("message-input");
    const chatBox = document.querySelector(".chat-box");

    sendBtn.addEventListener("click", function () {
        sendMessage();
    });

    messageInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });

    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText === "") return;

        const messageElement = document.createElement("div");
        messageElement.classList.add("message", "sent");
        messageElement.innerHTML = `<p>${messageText}</p><span class="time">Vừa xong</span>`;

        chatBox.appendChild(messageElement);
        chatBox.scrollTop = chatBox.scrollHeight; 

        messageInput.value = ""; 
    }
});

function updateDate() {
    const dateElement = document.getElementById("current-date");
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    dateElement.textContent = today.toLocaleDateString('vi-VN', options);
}
updateDate();
