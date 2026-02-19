<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$redeemed = isset($data['redeemed']) ? $data['redeemed'] : [];
$puntos = isset($data['puntos']) ? $data['puntos'] : 0;
?>

<main class="reserves-page">
    <section class="landing" style="height: auto; min-height: 40vh;">
        <div class="bg-gradient"></div>
        <div class="landing-container" style="padding-top: 100px; padding-bottom: 3em; position: relative; z-index: 2;">
            <h1>Mis Canjes</h1>
            <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-top: 0.5em;">
                <?php echo count($redeemed); ?> producto
                <?php echo count($redeemed) !== 1 ? 's' : ''; ?> canjeado
                <?php echo count($redeemed) !== 1 ? 's' : ''; ?>
            </p>
        </div>
    </section>

    <section class="reserves-section">
        <div class="reserves-container">
            <?php if (empty($redeemed)) { ?>
                <div class="reserves-empty">
                    <i class="fa-solid fa-gift"></i>
                    <h3>No has canjeado ningún producto</h3>
                    <p>Visita la tienda de puntos para canjear tus puntos por descuentos y tarjetas regalo</p>
                    <a href="/tienda" class="reserves-empty-btn">
                        <i class="fa-solid fa-store"></i>
                        Ir a la tienda
                    </a>
                </div>
            <?php } else { ?>
                <div class="redeemed-list">
                    <?php foreach ($redeemed as $item) {
                        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $item['fecha']);
                        $fechaStr = $fecha ? $fecha->format('d M Y, H:i') : $item['fecha'];

                        $iconClass = '';
                        $typeLabel = '';
                        switch ($item['tipo']) {
                            case 'descuento_vuelo':
                                $iconClass = 'fa-solid fa-plane-up';
                                $typeLabel = 'Descuento en vuelo';
                                break;
                            case 'tarjeta_regalo':
                                $iconClass = 'fa-solid fa-gift';
                                $typeLabel = 'Tarjeta de regalo';
                                break;
                            case 'upgrade':
                                $iconClass = 'fa-solid fa-arrow-up';
                                $typeLabel = 'Upgrade';
                                break;
                            default:
                                $iconClass = 'fa-solid fa-tag';
                                $typeLabel = 'Producto';
                        }

                        $isUsed = isset($item['usado']) && $item['usado'] == 1;
                        ?>
                        <div class="redeemed-card <?php echo $isUsed ? 'used' : ''; ?>">
                            <div class="redeemed-card-icon">
                                <i class="<?php echo $iconClass; ?>"></i>
                            </div>
                            <div class="redeemed-card-info">
                                <div class="redeemed-card-header">
                                    <h3>
                                        <?php echo htmlspecialchars($item['nombre']); ?>
                                    </h3>
                                    <span class="redeemed-type-badge">
                                        <?php echo $typeLabel; ?>
                                    </span>
                                </div>
                                <?php if (!empty($item['prodDescripcion'])) { ?>
                                    <p class="redeemed-desc">
                                        <?php echo htmlspecialchars($item['prodDescripcion']); ?>
                                    </p>
                                <?php } ?>
                                <div class="redeemed-card-meta">
                                    <span><i class="fa-regular fa-calendar"></i>
                                        <?php echo $fechaStr; ?>
                                    </span>
                                    <span><i class="fa-solid fa-coins"></i>
                                        <?php echo $item['puntos']; ?> puntos
                                    </span>
                                    <?php if ($item['tipo'] === 'descuento_vuelo' && !empty($item['valor'])) { ?>
                                        <span class="redeemed-value"><i class="fa-solid fa-percent"></i>
                                            <?php echo $item['valor']; ?>% descuento
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="redeemed-card-status">
                                <?php if ($isUsed) { ?>
                                    <span class="status-used"><i class="fa-solid fa-check-circle"></i> Usado</span>
                                <?php } else if ($item['tipo'] === 'descuento_vuelo') { ?>
                                        <span class="status-available"><i class="fa-solid fa-ticket"></i> Disponible</span>
                                <?php } else { ?>
                                        <span class="status-redeemed"><i class="fa-solid fa-circle-check"></i> Canjeado</span>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<style>
    .reserves-section {
        padding: 3em 0 4em;
        background-color: #f4f5f7;
        min-height: 50vh;
    }

    .reserves-container {
        width: 70%;
        max-width: 900px;
        margin: 0 auto;
    }

    .reserves-empty {
        text-align: center;
        padding: 5em 2em;
        color: #8b8b8b;
    }

    .reserves-empty>i {
        font-size: 3.5rem;
        color: #d4d4d4;
        margin-bottom: 0.5em;
    }

    .reserves-empty-btn i {
        font-size: 1rem;
    }

    .reserves-empty h3 {
        color: #5b5b5b;
        font-size: 1.3rem;
        margin-bottom: 0.3em;
    }

    .reserves-empty p {
        margin-bottom: 1.5em;
    }

    .reserves-empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5em;
        background-color: #09b1be;
        color: white;
        padding: 0.8em 1.5em;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: background 200ms ease;
    }

    .reserves-empty-btn:hover {
        background-color: #0899a4;
    }

    /* ===== REDEEMED LIST ===== */
    .redeemed-list {
        display: flex;
        flex-direction: column;
        gap: 1em;
    }

    .redeemed-card {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 16px;
        padding: 1.3em 1.5em;
        gap: 1.2em;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 200ms ease, box-shadow 200ms ease;
    }

    .redeemed-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .redeemed-card.used {
        opacity: 0.6;
    }

    .redeemed-card-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, #09b1be 0%, #0891a0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .redeemed-card-icon i {
        color: white;
        font-size: 1.2rem;
    }

    .redeemed-card-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.3em;
    }

    .redeemed-card-header {
        display: flex;
        align-items: center;
        gap: 0.8em;
        flex-wrap: wrap;
    }

    .redeemed-card-header h3 {
        font-size: 1.05rem;
        color: #2d2d2d;
        font-weight: 700;
    }

    .redeemed-type-badge {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #e8f8f9;
        color: #09b1be;
        padding: 0.25em 0.6em;
        border-radius: 20px;
    }

    .redeemed-desc {
        font-size: 0.85rem;
        color: #8b8b8b;
    }

    .redeemed-card-meta {
        display: flex;
        gap: 1.2em;
        flex-wrap: wrap;
    }

    .redeemed-card-meta span {
        font-size: 0.8rem;
        color: #aaa;
        display: flex;
        align-items: center;
        gap: 0.3em;
    }

    .redeemed-card-meta span i {
        font-size: 0.7rem;
    }

    .redeemed-value {
        color: #27ae60 !important;
        font-weight: 600;
    }

    .redeemed-card-status {
        flex-shrink: 0;
    }

    .status-available {
        font-size: 0.8rem;
        font-weight: 700;
        color: #27ae60;
        display: flex;
        align-items: center;
        gap: 0.3em;
    }

    .status-used {
        font-size: 0.8rem;
        font-weight: 700;
        color: #999;
        display: flex;
        align-items: center;
        gap: 0.3em;
    }

    .status-redeemed {
        font-size: 0.8rem;
        font-weight: 700;
        color: #09b1be;
        display: flex;
        align-items: center;
        gap: 0.3em;
    }

    @media (max-width: 768px) {
        .reserves-container {
            width: 90%;
        }

        .redeemed-card {
            flex-direction: column;
            text-align: center;
        }

        .redeemed-card-header {
            justify-content: center;
        }

        .redeemed-card-meta {
            justify-content: center;
        }
    }
</style>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>