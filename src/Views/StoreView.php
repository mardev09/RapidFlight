<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$puntos = $data['puntos'];
$productos = $data['productos'];
?>

<main class="store-page">
    <section class="landing" style="height: auto; min-height: 100vh; padding-top: 100px;">
        <div class="bg-gradient"></div>

        <div class="store-container"
            style="max-width: 1200px; width: 100%; margin: 0 auto; padding: 20px; position: relative; z-index: 2; align-self: stretch;">
            <div class="store-header" style="text-align: center; color: white; margin-bottom: 40px;">
                <h1>Tienda de Puntos</h1>
                <div class="points-display"
                    style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); padding: 15px 30px; border-radius: 50px; display: inline-block; margin-top: 20px;">
                    <span style="font-size: 1.5rem;">Tienes <strong id="user-points-display">
                            <?php echo $puntos ?> puntos
                        </strong></span>
                </div>
            </div>

            <div class="tienda-grid">
                <?php foreach ($productos as $prod) { ?>
                    <div class="tienda-card">
                        <div class="tienda-card-icon">
                            <?php if ($prod['tipo'] == 'descuento_vuelo') { ?>
                                <i class="fa-solid fa-plane-up"></i>
                            <?php } else { ?>
                                <i class="fa-brands fa-amazon"></i>
                            <?php } ?>
                        </div>
                        <div class="tienda-card-body">
                            <h3><?php echo htmlspecialchars($prod['nombre']) ?></h3>
                            <p><?php echo htmlspecialchars($prod['descripcion']) ?></p>
                        </div>
                        <div class="tienda-card-action">
                            <span class="tienda-cost"><?php echo $prod['puntosRequeridos'] ?> pts</span>
                            <button class="redeemBtn" data-id="<?php echo $prod['idProducto'] ?>"
                                data-cost="<?php echo $prod['puntosRequeridos'] ?>"
                                data-name="<?php echo htmlspecialchars($prod['nombre']) ?>"
                                <?php echo ($puntos < $prod['puntosRequeridos']) ? 'disabled' : '' ?>>
                                Canjear
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<!-- MODAL CONFIRMACIÓN DE CANJE -->
<div id="confirmRedeemModal" class="rpf-modal-overlay">
    <div class="rpf-modal" style="max-width: 420px;">
        <div class="rpf-modal-header">
            <h2>Confirmar canje</h2>
            <button class="rpf-modal-close" id="closeConfirmModal">&times;</button>
        </div>
        <div class="rpf-modal-body" style="text-align: center;">
            <div style="font-size: 3rem; color: #09b1be; margin-bottom: 0.5em;">
                <i class="fa-solid fa-gift"></i>
            </div>
            <p style="color: #313131; font-size: 1.05rem; margin-bottom: 0.3em;">
                ¿Quieres canjear <strong id="confirm-product-name"></strong>?
            </p>
            <p style="color: #5b5b5b; font-size: 0.9rem;">
                Se descontarán <strong id="confirm-product-cost" style="color: #e74c3c;"></strong> puntos de tu saldo.
            </p>
            <div class="rpf-modal-actions" style="justify-content: center; margin-top: 1.5em;">
                <button type="button" class="rpf-btn-cancel" id="cancelConfirmModal">Cancelar</button>
                <button type="button" class="rpf-btn-save" id="proceedRedeemBtn">Canjear</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL RESULTADO -->
<div id="resultModal" class="rpf-modal-overlay">
    <div class="rpf-modal" style="max-width: 400px;">
        <div class="rpf-modal-body" style="text-align: center; padding: 2.5em 2em;">
            <div id="result-icon" style="font-size: 3.5rem; margin-bottom: 0.8em;"></div>
            <h2 id="result-title" style="color: #313131; margin-bottom: 0.5em;"></h2>
            <p id="result-message" style="color: #5b5b5b; font-size: 0.95rem;"></p>
            <button type="button" class="rpf-btn-save" id="resultOkBtn" style="margin-top: 1.5em; min-width: 120px;">
                OK
            </button>
        </div>
    </div>
</div>

<style>
    /* ===== MODAL OVERLAY ===== */
    .rpf-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(4px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        animation: rpf-fadeIn 0.25s ease;
    }

    .rpf-modal-overlay.active {
        display: flex;
    }

    /* ===== MODAL BOX ===== */
    .rpf-modal {
        background: white;
        border-radius: 20px;
        width: 95%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        animation: rpf-slideUp 0.3s ease;
    }

    .rpf-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5em 2em 0.5em;
    }

    .rpf-modal-header h2 {
        font-size: 1.25rem;
        color: #313131;
        font-weight: bold;
    }

    .rpf-modal-close {
        background: none;
        border: none;
        font-size: 1.8rem;
        color: #8b8b8b;
        cursor: pointer;
        line-height: 1;
        transition: color 200ms ease;
        padding: 0 0.2em;
    }

    .rpf-modal-close:hover {
        color: #313131;
    }

    .rpf-modal-body {
        padding: 1em 2em 2em;
        display: flex;
        flex-direction: column;
        gap: 0.5em;
    }

    .rpf-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.8em;
        margin-top: 0.5em;
    }

    .rpf-btn-cancel {
        background: none;
        border: 1px solid #d4d4d4;
        color: #5b5b5b;
        padding: 0.7em 1.5em;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: 200ms ease;
    }

    .rpf-btn-cancel:hover {
        background: #f5f5f5;
    }

    .rpf-btn-save {
        background: #09b1be;
        color: white;
        border: none;
        padding: 0.7em 1.5em;
        border-radius: 50px;
        cursor: pointer;
        font-weight: 600;
        transition: 200ms ease;
    }

    .rpf-btn-save:hover {
        background: #0ac2cf;
    }

    @keyframes rpf-fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes rpf-slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* ===== TIENDA GRID — ROW LAYOUT ===== */
    .tienda-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        width: 100%;
    }

    .tienda-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: white;
        border-radius: 15px;
        padding: 1.8em 1.5em;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .tienda-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .tienda-card-icon {
        font-size: 2.5rem;
        color: #09b1be;
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0fbfc;
        border-radius: 14px;
        margin-bottom: 0.8em;
    }

    .tienda-card-body {
        flex: 1;
        padding: 0;
        margin-bottom: 1em;
    }

    .tienda-card-body h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #313131;
        margin-bottom: 0.2em;
    }

    .tienda-card-body p {
        color: #777;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .tienda-card-action {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5em;
    }

    .tienda-cost {
        color: #27ae60;
        font-weight: 700;
        font-size: 1.05rem;
    }

    .redeemBtn {
        padding: 0.5em 1.3em;
        background: #09b1be;
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background 200ms ease;
    }

    .redeemBtn:disabled {
        background: #bdc3c7;
        cursor: not-allowed;
    }

    .redeemBtn:not(:disabled):hover {
        background: #0ac2cf;
    }

    @media (max-width: 600px) {
        .tienda-grid {
            grid-template-columns: 1fr;
        }
    }

    .product-card:hover {
        transform: translateY(-5px);
    }
</style>

<script>
    // State
    let selectedProductId = null;
    let selectedProductCost = 0;

    // ===== CONFIRM MODAL =====
    const confirmModal = document.getElementById('confirmRedeemModal');
    const resultModal = document.getElementById('resultModal');

    function openModal(modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Redeem buttons
    document.querySelectorAll('.redeemBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            selectedProductId = btn.dataset.id;
            selectedProductCost = btn.dataset.cost;
            document.getElementById('confirm-product-name').textContent = btn.dataset.name;
            document.getElementById('confirm-product-cost').textContent = btn.dataset.cost;
            openModal(confirmModal);
        });
    });

    // Close confirm modal
    document.getElementById('closeConfirmModal')?.addEventListener('click', () => closeModal(confirmModal));
    document.getElementById('cancelConfirmModal')?.addEventListener('click', () => closeModal(confirmModal));
    confirmModal.addEventListener('click', (e) => { if (e.target === confirmModal) closeModal(confirmModal); });

    // Proceed to redeem
    document.getElementById('proceedRedeemBtn')?.addEventListener('click', () => {
        closeModal(confirmModal);

        fetch('/canjear-producto', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idProducto: selectedProductId })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('result-icon').innerHTML = '<i class="fa-solid fa-circle-check" style="color: #27ae60;"></i>';
                    document.getElementById('result-title').textContent = '¡Canje exitoso!';
                    document.getElementById('result-message').textContent = 'Tu producto ha sido canjeado correctamente. Se han descontado ' + selectedProductCost + ' puntos.';
                    document.getElementById('resultOkBtn').onclick = () => {
                        closeModal(resultModal);
                        location.reload();
                    };
                } else {
                    document.getElementById('result-icon').innerHTML = '<i class="fa-solid fa-circle-xmark" style="color: #e74c3c;"></i>';
                    document.getElementById('result-title').textContent = 'Error';
                    document.getElementById('result-message').textContent = data.message || 'No se pudo completar el canje.';
                    document.getElementById('resultOkBtn').onclick = () => closeModal(resultModal);
                }
                openModal(resultModal);
            })
            .catch(err => {
                console.error(err);
                document.getElementById('result-icon').innerHTML = '<i class="fa-solid fa-triangle-exclamation" style="color: #e67e22;"></i>';
                document.getElementById('result-title').textContent = 'Error de conexión';
                document.getElementById('result-message').textContent = 'No se pudo conectar con el servidor.';
                document.getElementById('resultOkBtn').onclick = () => closeModal(resultModal);
                openModal(resultModal);
            });
    });

    // Close result modal
    resultModal.addEventListener('click', (e) => { if (e.target === resultModal) closeModal(resultModal); });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (resultModal.classList.contains('active')) closeModal(resultModal);
            if (confirmModal.classList.contains('active')) closeModal(confirmModal);
        }
    });
</script>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>