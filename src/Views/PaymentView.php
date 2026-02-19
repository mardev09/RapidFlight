<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$reserva = $data['reserva'];
$vuelo = $data['vuelo'];
$discounts = $data['discounts'] ?? [];
?>

<main class="payment-page">
    <section class="landing" style="height: auto; min-height: 100vh;">
        <div class="bg-gradient"></div>

        <div class="pago-wrapper">
            <!-- Resumen de reserva -->
            <div class="pago-summary">
                <div class="pago-summary-header">
                    <i class="fa-solid fa-plane-departure"></i>
                    <div>
                        <h3>Resumen de tu reserva</h3>
                        <span class="pago-ticket">#<?php echo htmlspecialchars($reserva['numBillete']) ?></span>
                    </div>
                </div>

                <div class="pago-route">
                    <div class="pago-route-point">
                        <span class="pago-route-code"><?php echo htmlspecialchars($reserva['origen']) ?></span>
                        <span class="pago-route-label">Origen</span>
                    </div>
                    <div class="pago-route-line">
                        <div class="pago-route-dot"></div>
                        <div class="pago-route-bar"></div>
                        <i class="fa-solid fa-plane" style="color: #09b1be;"></i>
                        <div class="pago-route-bar"></div>
                        <div class="pago-route-dot"></div>
                    </div>
                    <div class="pago-route-point">
                        <span class="pago-route-code"><?php echo htmlspecialchars($reserva['destino']) ?></span>
                        <span class="pago-route-label">Destino</span>
                    </div>
                </div>

                <div class="pago-details">
                    <div class="pago-detail-row">
                        <span>Salida</span>
                        <strong><?php echo $reserva['fechaHoraSalida'] ?></strong>
                    </div>
                    <div class="pago-detail-row">
                        <span>Llegada</span>
                        <strong><?php echo $reserva['fechaHoraLlegada'] ?></strong>
                    </div>
                    <?php if ($vuelo) { ?>
                        <div class="pago-detail-row">
                            <span>Vuelo</span>
                            <strong><?php echo htmlspecialchars($vuelo['numeroVuelo'] ?? '') ?> ·
                                <?php echo htmlspecialchars($vuelo['aerolinea'] ?? '') ?></strong>
                        </div>
                    <?php } ?>
                </div>

                <?php if (!empty($discounts)) { ?>
                    <div class="pago-detail-row text-center"
                        style="align-items: center; margin-top: 1em; padding-top: 1em; border-top: 1px dashed #eee;">
                        <span>Descuento</span>
                        
                        <!-- Custom Dropdown Wrapper -->
                        <div class="custom-select-wrapper" style="position: relative; width: 60%; text-align: left;">
                            <button type="button" class="search-select" id="discountTrigger" style="width: 100%; justify-content: space-between; padding: 0.5em 1em; background: #fafafa; border: 1px solid #e0e0e0; border-radius: 8px; display: flex; align-items: center; cursor: pointer;">
                                <span style="display: flex; flex-direction: column; align-items: flex-start; gap: 0;">
                                    <p style="font-size: 0.7rem; color: #09b1be; margin: 0; font-weight: bold; text-transform: uppercase;">Cupón</p>
                                    <p class="selected-text" style="margin: 0; font-size: 0.9rem; color: #8b8b8b; font-weight: 500;">Seleccionar...</p>
                                </span>
                                <i class="fa-solid fa-chevron-down" style="font-size: 0.8rem; color: #3b3b3b; transition: transform 0.2s;"></i>
                            </button>
                            
                            <div class="custom-options" id="discountOptions" style="display: none; position: absolute; top: 110%; left: 0; width: 100%; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); z-index: 10; overflow: hidden; border: 1px solid #f0f0f0;">
                                <button type="button" class="discount-option" data-value="" data-percent="0" data-name="Sin descuento" style="width: 100%; text-align: left; padding: 0.8em 1em; background: white; border: none; border-bottom: 1px solid #f9f9f9; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: background 200ms;">
                                    <span style="font-weight: 500; color: #8b8b8b;">Sin descuento</span>
                                </button>
                                <?php foreach ($discounts as $d) { ?>
                                    <button type="button" class="discount-option" data-value="<?php echo $d['idTransaccion'] ?>" data-percent="<?php echo $d['valor'] ?>" data-name="<?php echo htmlspecialchars($d['nombre']) ?>" style="width: 100%; text-align: left; padding: 0.8em 1em; background: white; border: none; border-bottom: 1px solid #f9f9f9; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: background 200ms;">
                                        <span style="font-weight: 600; color: #313131;"><?php echo htmlspecialchars($d['nombre']) ?></span>
                                        <span style="background: #e8f8f9; color: #09b1be; padding: 0.2em 0.6em; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">-<?php echo $d['valor'] ?>%</span>
                                    </button>
                                <?php } ?>
                            </div>
                            <input type="hidden" name="idDescuento" id="idDescuentoInput">
                        </div>
                    </div>
                <?php } ?>

                <div class="pago-total">
                    <span>Total a pagar</span>
                    <strong><?php echo $reserva['precio'] ?> €</strong>
                </div>
            </div>

            <!-- Formulario de pago -->
            <div class="pago-form-card">
                <div class="pago-form-header">
                    <h2>Datos de pago</h2>
                    <div class="pago-cards-icons">
                        <i class="fa-brands fa-cc-visa"></i>
                        <i class="fa-brands fa-cc-mastercard"></i>
                        <i class="fa-brands fa-cc-amex"></i>
                    </div>
                </div>

                <form id="paymentForm" class="pago-form">
                    <?php if ($reserva['idReserva']) { ?>
                        <input type="hidden" name="idReserva" value="<?php echo $reserva['idReserva'] ?>">
                    <?php } ?>
                    <?php if (isset($reserva['idVuelo']) && $reserva['idVuelo']) { ?>
                        <input type="hidden" name="idVuelo" value="<?php echo $reserva['idVuelo'] ?>">
                    <?php } ?>

                    <div class="pago-field">
                        <label for="pago-holder">Nombre del titular</label>
                        <div class="pago-input-wrap">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" id="pago-holder" name="holder" placeholder="Como aparece en la tarjeta"
                                required>
                        </div>
                    </div>

                    <div class="pago-field">
                        <label for="pago-number">Número de tarjeta</label>
                        <div class="pago-input-wrap">
                            <i class="fa-solid fa-credit-card"></i>
                            <input type="text" id="pago-number" name="number" placeholder="0000 0000 0000 0000"
                                maxlength="19" required>
                        </div>
                    </div>

                    <div class="pago-row">
                        <div class="pago-field">
                            <label for="pago-expiry">Expiración</label>
                            <div class="pago-input-wrap">
                                <i class="fa-solid fa-calendar"></i>
                                <input type="text" id="pago-expiry" name="expiry" placeholder="MM/YY" maxlength="5"
                                    required>
                            </div>
                        </div>
                        <div class="pago-field">
                            <label for="pago-cvv">CVV</label>
                            <div class="pago-input-wrap">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" id="pago-cvv" name="cvv" placeholder="•••" maxlength="3"
                                    required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="pago-submit" id="payBtn">
                        <i class="fa-solid fa-shield-check"></i>
                        Pagar <?php echo $reserva['precio'] ?> €
                    </button>

                    <p class="pago-secure">
                        <i class="fa-solid fa-lock"></i>
                        Pago seguro con cifrado SSL de 256 bits
                    </p>
                </form>
            </div>
        </div>
    </section>
</main>

<style>
    /* ===== LAYOUT ===== */
    .pago-wrapper {
        position: relative;
        z-index: 2;
        display: flex;
        gap: 2em;
        max-width: 900px;
        margin: 0 auto;
        padding: 120px 20px 60px;
        align-items: flex-start;
    }

    /* ===== RESUMEN ===== */
    .pago-summary {
        flex: 1;
        background: white;
        border-radius: 20px;
        padding: 2em;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 1.5em;
    }

    .pago-summary-header {
        display: flex;
        align-items: center;
        gap: 0.8em;
    }

    .pago-summary-header i {
        font-size: 1.8rem;
        color: #09b1be;
    }

    .pago-summary-header h3 {
        color: #313131;
        font-weight: bold;
        font-size: 1.1rem;
        margin: 0;
    }

    .pago-ticket {
        font-size: 0.8rem;
        color: #8b8b8b;
    }

    /* Ruta visual */
    .pago-route {
        display: flex;
        align-items: center;
        gap: 0.8em;
        padding: 1em 0;
    }

    .pago-route-point {
        text-align: center;
        min-width: 60px;
    }

    .pago-route-code {
        display: block;
        font-weight: bold;
        color: #313131;
        font-size: 1.1rem;
    }

    .pago-route-label {
        font-size: 0.7rem;
        color: #8b8b8b;
        text-transform: uppercase;
    }

    .pago-route-line {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .pago-route-dot {
        width: 8px;
        height: 8px;
        background: #09b1be;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .pago-route-bar {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #09b1be, #0ac2cf);
    }

    .pago-route-line i {
        margin: 0 0.3em;
        font-size: 0.9rem;
    }

    /* Detalles */
    .pago-details {
        display: flex;
        flex-direction: column;
        gap: 0.6em;
    }

    .pago-detail-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
    }

    .pago-detail-row span {
        color: #8b8b8b;
    }

    .pago-detail-row strong {
        color: #313131;
    }

    .pago-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 2px solid #f0f0f0;
        padding-top: 1em;
    }

    .pago-total span {
        color: #5b5b5b;
        font-weight: 600;
    }

    .pago-total strong {
        font-size: 1.5rem;
        color: #09b1be;
    }

    /* ===== FORMULARIO ===== */
    .pago-form-card {
        flex: 1.2;
        background: white;
        border-radius: 20px;
        padding: 2em;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .pago-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5em;
    }

    .pago-form-header h2 {
        font-weight: bold;
        color: #313131;
        font-size: 1.3rem;
    }

    .pago-cards-icons {
        display: flex;
        gap: 0.5em;
        font-size: 1.6rem;
        color: #b0b0b0;
    }

    .pago-form {
        display: flex;
        flex-direction: column;
        gap: 1.2em;
    }

    .pago-row {
        display: flex;
        gap: 1em;
    }

    .pago-row .pago-field {
        flex: 1;
    }

    .pago-field {
        display: flex;
        flex-direction: column;
        gap: 0.3em;
    }

    .pago-field label {
        font-size: 0.75rem;
        color: #09b1be;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .pago-input-wrap {
        display: flex;
        align-items: center;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background: #fafafa;
        padding: 0 1em;
        transition: border 200ms ease, background 200ms ease;
    }

    .pago-input-wrap:focus-within {
        border-color: #09b1be;
        background: white;
    }

    .pago-input-wrap i {
        color: #b0b0b0;
        font-size: 0.85rem;
        margin-right: 0.7em;
        transition: color 200ms ease;
    }

    .pago-input-wrap:focus-within i {
        color: #09b1be;
    }

    .pago-input-wrap input {
        border: none;
        background: transparent;
        padding: 0.8em 0;
        font-size: 0.95rem;
        color: #313131;
        width: 100%;
        outline: none;
    }

    .pago-input-wrap input::placeholder {
        color: #c0c0c0;
    }

    /* Submit */
    .pago-submit {
        background: #09b1be;
        color: white;
        border: none;
        padding: 1em;
        border-radius: 50px;
        font-size: 1.05rem;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5em;
        transition: background 200ms ease;
        margin-top: 0.5em;
    }

    .pago-submit:hover {
        background: #0ac2cf;
    }

    .pago-submit:disabled {
        background: #b0b0b0;
        cursor: not-allowed;
    }

    .pago-secure {
        text-align: center;
        font-size: 0.75rem;
        color: #8b8b8b;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4em;
    }

    .pago-secure i {
        color: #27ae60;
        font-size: 0.7rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .pago-wrapper {
            flex-direction: column;
            padding: 100px 15px 40px;
        }

        .pago-row {
            flex-direction: column;
        }
    }
</style>

<script>
    // Formatear número de tarjeta con espacios
    document.getElementById('pago-number').addEventListener('input', function (e) {
        let val = this.value.replace(/\D/g, '').substring(0, 16);
        this.value = val.replace(/(.{4})/g, '$1 ').trim();
    });

    // Formatear expiración MM/YY
    document.getElementById('pago-expiry').addEventListener('input', function (e) {
        let val = this.value.replace(/\D/g, '').substring(0, 4);
        if (val.length >= 2) val = val.substring(0, 2) + '/' + val.substring(2);
        this.value = val;
    });

    // Custom Dropdown Logic
    const trigger = document.getElementById('discountTrigger');
    const optionsMenu = document.getElementById('discountOptions');
    const hiddenInput = document.getElementById('idDescuentoInput');
    const originalPrice = <?php echo json_encode((float)$reserva['precio']); ?>;

    if (trigger && optionsMenu) {
        // Toggle dropdown
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const isVisible = optionsMenu.style.display === 'block';
            optionsMenu.style.display = isVisible ? 'none' : 'block';
            trigger.querySelector('i').style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
        });

        // Close on outside click
        window.addEventListener('click', function(e) {
            if (!trigger.contains(e.target)) {
                optionsMenu.style.display = 'none';
                trigger.querySelector('i').style.transform = 'rotate(0deg)';
            }
        });

        // Option selection
        document.querySelectorAll('.discount-option').forEach(option => {
            option.addEventListener('mouseover', function() {
                this.style.background = '#f5f5f5';
            });
            option.addEventListener('mouseout', function() {
                this.style.background = 'white';
            });

            option.addEventListener('click', function() {
                const val = this.dataset.value;
                const percent = parseFloat(this.dataset.percent) || 0;
                const name = this.dataset.name;
                
                // Update trigger text
                const textEl = trigger.querySelector('.selected-text');
                textEl.textContent = name;
                textEl.style.color = val ? '#313131' : '#8b8b8b';
                
                // Update hidden input
                hiddenInput.value = val;
                
                // Recalculate price
                let finalPrice = originalPrice;
                if (percent > 0) {
                     finalPrice = originalPrice * (1 - percent / 100);
                }
                
                // Update display
                document.querySelector('.pago-total strong').textContent = finalPrice.toFixed(2) + ' €';
                
                // Update Pay Button
                const payBtn = document.getElementById('payBtn');
                if (payBtn && !payBtn.disabled) {
                    payBtn.innerHTML = '<i class="fa-solid fa-shield-check"></i> Pagar ' + finalPrice.toFixed(2) + ' €';
                }
                
                // Close menu
                optionsMenu.style.display = 'none';
                trigger.querySelector('i').style.transform = 'rotate(0deg)';
            });
        });
    }

    // Submit
    document.getElementById('paymentForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const btn = document.getElementById('payBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Procesando...';

        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        if (hiddenInput && hiddenInput.value) {
            data.idDescuento = hiddenInput.value;
        }

        fetch('/process-payment', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    window.location.href = '/comprobante?idPago=' + res.idPago;
                } else {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-shield-check"></i> Pagar <?php echo $reserva['precio'] ?> €';
                    rpfPopup('error', 'Error en el pago', res.message);
                }
            })
            .catch(err => {
                console.error(err);
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-shield-check"></i> Pagar <?php echo $reserva['precio'] ?> €';
            });
    });
</script>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>