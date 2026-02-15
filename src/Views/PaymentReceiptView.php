<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$pago = $data['pago'];
$reserva = $data['reserva'];
?>

<main class="receipt-page">
    <section class="landing" style="height: auto; min-height: 100vh;">
        <div class="bg-gradient"></div>

        <div class="recibo-wrapper">
            <div class="recibo-card">
                <!-- Icono de éxito -->
                <div class="recibo-success-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <h1>¡Pago completado!</h1>
                <p class="recibo-subtitle">Tu reserva ha sido confirmada correctamente</p>

                <!-- Detalles de la transacción -->
                <div class="recibo-details">
                    <div class="recibo-row">
                        <span>Código de transacción</span>
                        <strong class="recibo-code"><?php echo htmlspecialchars($pago['codigoTransaccion']) ?></strong>
                    </div>
                    <div class="recibo-row">
                        <span>Fecha</span>
                        <strong><?php echo $pago['fechaPago'] ?></strong>
                    </div>
                    <div class="recibo-row">
                        <span>Método de pago</span>
                        <strong>
                            <i class="fa-solid fa-credit-card" style="color: #09b1be; margin-right: 4px;"></i>
                            •••• <?php echo htmlspecialchars($pago['numeroTarjeta']) ?>
                        </strong>
                    </div>
                    <?php if ($reserva) { ?>
                        <div class="recibo-row">
                            <span>Ruta</span>
                            <strong><?php echo htmlspecialchars($reserva['origen']) ?> →
                                <?php echo htmlspecialchars($reserva['destino']) ?></strong>
                        </div>
                    <?php } ?>
                    <div class="recibo-row recibo-row-total">
                        <span>Monto total</span>
                        <strong><?php echo $pago['monto'] ?> €</strong>
                    </div>
                </div>

                <!-- Nota informativa -->
                <div class="recibo-info">
                    <i class="fa-solid fa-circle-info"></i>
                    <p>Tus billetes de vuelo están disponibles en la sección <strong>Mis Reservas</strong>. Este es tu
                        comprobante de pago.</p>
                </div>

                <!-- Botones -->
                <div class="recibo-actions">
                    <a href="/my-reserves" class="recibo-btn-primary">
                        <i class="fa-solid fa-ticket"></i>
                        Ver mis reservas
                    </a>
                    <a href="/inicio" class="recibo-btn-secondary">
                        Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .recibo-wrapper {
        position: relative;
        z-index: 2;
        max-width: 520px;
        margin: 0 auto;
        padding: 120px 20px 60px;
    }

    .recibo-card {
        background: white;
        border-radius: 20px;
        padding: 2.5em 2em;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .recibo-success-icon {
        font-size: 3.5rem;
        color: #27ae60;
        margin-bottom: 0.4em;
        animation: recibo-pop 0.4s ease;
    }

    @keyframes recibo-pop {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }

        70% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .recibo-card h1 {
        color: #313131;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 0.2em;
    }

    .recibo-subtitle {
        color: #8b8b8b;
        font-size: 0.95rem;
        margin-bottom: 1.5em;
    }

    /* Detalles */
    .recibo-details {
        background: #f8f9fa;
        border-radius: 14px;
        padding: 1.2em 1.5em;
        text-align: left;
        display: flex;
        flex-direction: column;
        gap: 0.8em;
        margin-bottom: 1.5em;
    }

    .recibo-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
    }

    .recibo-row span {
        color: #8b8b8b;
    }

    .recibo-row strong {
        color: #313131;
    }

    .recibo-code {
        background: #f0fafb;
        color: #09b1be;
        padding: 0.2em 0.6em;
        border-radius: 6px;
        font-family: monospace;
        font-size: 0.85rem;
    }

    .recibo-row-total {
        border-top: 1px solid #e0e0e0;
        padding-top: 0.8em;
        margin-top: 0.3em;
    }

    .recibo-row-total strong {
        color: #09b1be;
        font-size: 1.2rem;
    }

    /* Info box */
    .recibo-info {
        background: #f0fafb;
        border: 1px solid #d4eff2;
        border-radius: 12px;
        padding: 1em 1.2em;
        display: flex;
        align-items: flex-start;
        gap: 0.7em;
        text-align: left;
        margin-bottom: 1.5em;
    }

    .recibo-info i {
        color: #09b1be;
        font-size: 1rem;
        margin-top: 0.1em;
        flex-shrink: 0;
    }

    .recibo-info p {
        color: #5b5b5b;
        font-size: 0.85rem;
        line-height: 1.4;
        margin: 0;
    }

    /* Botones */
    .recibo-actions {
        display: flex;
        flex-direction: column;
        gap: 0.7em;
    }

    .recibo-btn-primary {
        background: #09b1be;
        color: white;
        text-decoration: none;
        padding: 0.9em;
        border-radius: 50px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5em;
        transition: background 200ms ease;
    }

    .recibo-btn-primary:hover {
        background: #0ac2cf;
    }

    .recibo-btn-secondary {
        color: #5b5b5b;
        text-decoration: none;
        padding: 0.6em;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 200ms ease;
    }

    .recibo-btn-secondary:hover {
        color: #09b1be;
    }

    @media (max-width: 768px) {
        .recibo-wrapper {
            padding: 100px 15px 40px;
        }
    }
</style>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>