document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formulario-contacto");
  const mensajeFinal = document.getElementById("mensaje-final");
  const btnDescuento = document.getElementById("calcular-descuento");
  const precioFinal = document.getElementById("resultado-descuento");

  // Validación del formulario antes de enviar al PHP
  form?.addEventListener("submit", (e) => {
    const nombre = document.getElementById("nombre").value.trim();
    const email = document.getElementById("email").value.trim();
    const asunto = document.getElementById("asunto").value;
    const mensaje = document.getElementById("mensaje").value.trim();

    // Validaciones
    if (!nombre || !email || !asunto || !mensaje) {
      e.preventDefault(); 
      alert("Por favor completá todos los campos.");
      return;
    }

    if (!email.includes("@") || !email.includes(".")) {
      e.preventDefault(); 
      alert("Por favor ingresá un email válido.");
      return;
    }

    // ✅ Si pasa la validación, se envía normalmente al archivo PHP
    // Mostrar mensaje en consola (requisito)
    console.log(`Gracias ${nombre} por contactarte por ${asunto}. Te responderemos pronto.`);
  });

  // Simulación de descuento
  btnDescuento?.addEventListener("click", () => {
    const precioBase = parseFloat(document.getElementById("precio-base").value);
    const descuento = parseFloat(document.getElementById("porcentaje-descuento").value);
    
    if (isNaN(precioBase) || isNaN(descuento)) {
      alert("Ingresá números válidos en ambos campos.");
      return;
    }

    const final = precioBase - (precioBase * descuento) / 100;
    precioFinal.textContent = `Precio final: $${final.toFixed(2)}`;
  });

  // Menú sticky con cambio de estilo (opcional)
  const nav = document.querySelector("nav");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      nav.classList.add("sticky");
    } else {
      nav.classList.remove("sticky");
    }
  });
});
