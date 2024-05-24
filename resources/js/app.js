import './bootstrap';
import $ from 'jquery';



document.addEventListener("DOMContentLoaded", function () {
  var subtotalElement = document.getElementById('subtotal');
  var subtotal = parseFloat(subtotalElement.dataset.subtotal);
  var envioElement = document.getElementById('envio');
  var totalElement = document.getElementById('total');

  function calcularTotal() {
    var total = subtotal;
    var metodoEnvio = document.querySelector('input[name="metodo_envio"]:checked').value;
    if (metodoEnvio === "envio_a_domicilio") {
      var envio = 5;
      total += envio;
      envioElement.textContent = "Envío: " + envio.toFixed(2) + "€";
    } else {
      envioElement.textContent = "Envío: ---";
    }
    totalElement.textContent = "TOTAL: " + total.toFixed(2) + "€";
  }

  calcularTotal();

  var radiosEnvio = document.querySelectorAll('input[name="metodo_envio"]');
  radiosEnvio.forEach(function (radio) {
    radio.addEventListener("change", function () {
      calcularTotal();
    });
  });
});



document.addEventListener('DOMContentLoaded', function () {
  var estadoStockElement = document.getElementById('estado-stock');
  var estado = estadoStockElement.textContent;

  if (estado === "En stock") {
    estadoStockElement.style.color = 'green';
  } else if (estado === "Sin stock") {
    estadoStockElement.style.color = 'red';
  }
});

