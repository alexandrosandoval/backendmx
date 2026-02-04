$(function () {
    const tray = $("#notificationTray");
    const notifyBtn = $("#notifyBtn");
    const closeTray = $("#closeTray");
    const loginForm = $("#loginForm");

    notifyBtn.on("click", function () {
        tray.toggleClass("active");
    });

    closeTray.on("click", function () {
        tray.removeClass("active");
    });

    $(".soft-delete").on("click", function () {
        const row = $(this).closest("[data-item]");
        row.addClass("soft-deleted");
        row.find(".soft-delete").prop("disabled", true).text("Marcado");
    });

    if (loginForm.length) {
        const emailInput = $("#email");
        const passwordInput = $("#password");

        function validarEmail(value) {
            return /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/.test(value);
        }

        function marcarEstado(input, valido) {
            input.toggleClass("is-valid", valido);
            input.toggleClass("is-invalid", !valido);
        }

        emailInput.on("input", function () {
            marcarEstado(emailInput, validarEmail(emailInput.val()));
        });

        passwordInput.on("input", function () {
            marcarEstado(passwordInput, passwordInput.val().length >= 6);
        });
    }

    const ctx = document.getElementById("progressChart");
    if (ctx) {
        if (window.jChart) {
            window.jChart.drawLine(
                ctx,
                ["Semana 1", "Semana 2", "Semana 3", "Semana 4", "Semana 5"],
                [18, 32, 45, 62, 78]
            );
        }
    }
});
