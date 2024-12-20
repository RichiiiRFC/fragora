import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    alternarPassword();
    inicializarCalculoEnvio();
    inicializarEstadoStock();
    inicializarAlertaTemporal();
    inicializarMenuParametros();
    inicializarMostrarContrasena();
    actualizarCarrito();
});

function alternarPassword() {
    const checkboxAlternarPassword =
        document.getElementById("alternar_password");
    const camposPassword = document.getElementById("password_fields");

    if (checkboxAlternarPassword && camposPassword) {
        if (localStorage.getItem("mostrarCamposPassword") === "true") {
            checkboxAlternarPassword.checked = true;
            camposPassword.style.display = "block";
        } else {
            camposPassword.style.display = "none";
        }

        checkboxAlternarPassword.addEventListener("click", function () {
            if (checkboxAlternarPassword.checked) {
                camposPassword.style.display = "block";
                localStorage.setItem("mostrarCamposPassword", "true");
            } else {
                camposPassword.style.display = "none";
                localStorage.setItem("mostrarCamposPassword", "false");
            }
        });
    }
}

function inicializarMostrarContrasena() {
    const togglePasswordButtons = document.querySelectorAll(".password-toggle");
    const passwordInputs = document.querySelectorAll(".password-input");

    togglePasswordButtons.forEach((toggleButton, index) => {
        const passwordInput = passwordInputs[index];

        toggleButton.addEventListener("click", function () {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            toggleButton.textContent = isPassword ? "Ocultar" : "Mostrar";
        });
    });
}

function inicializarCalculoEnvio() {
    const subtotalElement = document.getElementById("subtotal");
    const envioElement = document.getElementById("envio");
    const totalElement = document.getElementById("total");

    if (subtotalElement && envioElement && totalElement) {
        const subtotal = parseFloat(subtotalElement.dataset.subtotal);

        function calcularTotal() {
            let total = subtotal;
            const metodoEnvio = document.querySelector(
                'input[name="metodo_envio_id"]:checked'
            );

            if (metodoEnvio) {
                const envio = parseFloat(metodoEnvio.dataset.costo);
                total += envio;
                envioElement.textContent = "Envío: " + envio.toFixed(2) + "€";
            } else {
                envioElement.textContent = "Envío: ---";
            }

            totalElement.textContent = "TOTAL: " + total.toFixed(2) + "€";
        }

        calcularTotal();

        const radiosEnvio = document.querySelectorAll(
            'input[name="metodo_envio_id"]'
        );
        radiosEnvio.forEach(function (radio) {
            radio.addEventListener("change", calcularTotal);
        });
    }
}

function inicializarEstadoStock() {
    const estadoStockElement = document.getElementById("estado-stock");
    if (estadoStockElement) {
        const estado = estadoStockElement.textContent;
        estadoStockElement.style.color =
            estado === "En stock" ? "green" : "red";
    }
}

function inicializarAlertaTemporal() {
    const alertMessage = document.querySelector(".alerta-superpuesta");
    if (alertMessage) {
        setTimeout(function () {
            alertMessage.style.display = "none";
        }, 5000);
    }
}

function inicializarMenuParametros() {
    const parametrosToggle = document.getElementById("menu-toggle");
    const submenu = document.querySelector(".submenu");

    if (parametrosToggle && submenu) {
        parametrosToggle.addEventListener("click", function (e) {
            e.preventDefault();

            if (
                submenu.style.display === "none" ||
                submenu.style.display === ""
            ) {
                submenu.style.display = "block";
            } else {
                submenu.style.display = "none";
            }

            console.log("Submenú visible:", submenu.style.display === "block");
        });
    }
}

function actualizarCarrito() {
    const urlCarrito = document
        .getElementById("carrito-url")
        .getAttribute("data-url");

    let cantidad = 0;

    if (localStorage.getItem("carrito_temporal")) {
        cantidad = obtenerCantidadCarritoTemporal();

        cantidad = Math.min(cantidad, 99);

        actualizarUI(cantidad);
    } else {
        fetch(urlCarrito)
            .then((response) => response.json())
            .then((data) => {
                cantidad = data.cantidad;

                cantidad = Math.min(cantidad, 99);

                actualizarUI(cantidad);
            })
            .catch((error) =>
                console.error(
                    "Error al obtener la cantidad de productos en el carrito:",
                    error
                )
            );
    }
}

function actualizarUI(cantidad) {
    if (cantidad > 0) {
        document.querySelector(".numero-productos").textContent = cantidad;
        document.querySelector(".numero-productos").style.display =
            "inline-block";
    } else {
        document.querySelector(".numero-productos").style.display = "none";
    }
}

function obtenerCantidadCarritoTemporal() {
    const carrito = JSON.parse(localStorage.getItem("carrito_temporal")) || [];
    return carrito.reduce((total, producto) => total + producto.amount, 0);
}
