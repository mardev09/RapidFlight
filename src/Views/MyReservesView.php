<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$reserves = is_array($data) ? $data : [];
?>

<main class="reserves-page">
    <section class="landing" style="height: auto; min-height: 40vh;">
        <div class="bg-gradient"></div>
        <div class="landing-container" style="padding-top: 100px; padding-bottom: 3em; position: relative; z-index: 2;">
            <h1>Mis Reservas</h1>
            <p style="color: rgba(255,255,255,0.8); font-size: 1.1rem; margin-top: 0.5em;">
                <?php echo count($reserves); ?> billete<?php echo count($reserves) !== 1 ? 's' : ''; ?>
                registrado<?php echo count($reserves) !== 1 ? 's' : ''; ?>
            </p>
        </div>
    </section>

    <section class="reserves-section">
        <div class="reserves-container">
            <?php if (empty($reserves)) { ?>
                <div class="reserves-empty">
                    <i class="fa-solid fa-ticket-simple"></i>
                    <h3>No tienes reservas</h3>
                    <p>Cuando reserves un vuelo, aparecerá aquí como un billete</p>
                    <a href="/vuelos" class="reserves-empty-btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Buscar vuelos
                    </a>
                </div>
            <?php } else { ?>
                <div class="tickets-list">
                    <?php foreach ($reserves as $r) {
                        $salida = DateTime::createFromFormat('Y-m-d H:i:s', $r['fechaHoraSalida']);
                        $llegada = DateTime::createFromFormat('Y-m-d H:i:s', $r['fechaHoraLlegada']);
                        if (!$salida)
                            $salida = DateTime::createFromFormat('Y-m-d H:i', $r['fechaHoraSalida']);
                        if (!$llegada)
                            $llegada = DateTime::createFromFormat('Y-m-d H:i', $r['fechaHoraLlegada']);

                        $horaSalida = $salida ? $salida->format('H:i') : '--:--';
                        $horaLlegada = $llegada ? $llegada->format('H:i') : '--:--';
                        $fechaSalida = $salida ? $salida->format('d M Y') : '';
                        $fechaLlegada = $llegada ? $llegada->format('d M Y') : '';

                        // Calcular duración
                        $duracion = '';
                        if ($salida && $llegada) {
                            $diff = $salida->diff($llegada);
                            $duracion = $diff->h . 'h ' . $diff->i . 'm';
                        }

                        // Estado con colores
                        // Estado con colores
                        $dbStatus = $r['estado'] ?? 'pendiente_pago';

                        // Default values
                        $estadoLabel = ucfirst($dbStatus);
                        $estadoClass = 'status-default';

                        // Si está confirmada, calculamos estado dinámico por fecha
                        if ($dbStatus === 'confirmada' && $salida && $llegada) {
                            $now = new DateTime();

                            if ($now < $salida) {
                                $estadoLabel = 'Pendiente'; // Aún no sale
                                $estadoClass = 'status-pending'; // Usamos color pendiente (amarillo) o podríamos definir uno específico (azul/verde)
                                // Para distinguir de "pendiente de pago", usaremos un azul o el default
                                $estadoClass = 'status-confirmed'; // Mantener azul/verde de confirmada
                            } elseif ($now >= $salida && $now < $llegada) {
                                $estadoLabel = 'En vuelo';
                                $estadoClass = 'status-inflight'; // Nuevo estilo si se quiere, o reusar
                            } else {
                                $estadoLabel = 'Finalizado';
                                $estadoClass = 'status-finished'; // Nuevo estilo
                            }
                        } else {
                            // Fallback para otros estados de DB (pendiente_pago, cancelada)
                            switch ($dbStatus) {
                                case 'confirmada': // Caso fallback si fallan fechas
                                    $estadoLabel = 'Confirmada';
                                    $estadoClass = 'status-confirmed';
                                    break;
                                case 'pendiente_pago':
                                    $estadoLabel = 'Pendiente de pago';
                                    $estadoClass = 'status-pending';
                                    break;
                                case 'cancelada':
                                    $estadoLabel = 'Cancelada';
                                    $estadoClass = 'status-cancelled';
                                    break;
                                default:
                                    $estadoLabel = ucfirst($dbStatus);
                                    $estadoClass = 'status-default';
                            }
                        }

                        $aerolinea = $r['aerolinea'] ?? 'RapidFlight';
                        $numVuelo = $r['numeroVuelo'] ?? '';
                        ?>
                        <div class="ticket <?php echo $estadoClass; ?>">
                            <!-- Left: Ticket stub -->
                            <div class="ticket-stub">
                                <div class="ticket-stub-airline">
                                    <i class="fa-solid fa-plane"></i>
                                    <span><?php echo htmlspecialchars($aerolinea); ?></span>
                                </div>
                                <div class="ticket-stub-number">
                                    <span class="ticket-label">Nº Billete</span>
                                    <span class="ticket-value"><?php echo htmlspecialchars($r['numBillete']); ?></span>
                                </div>
                                <?php if ($numVuelo) { ?>
                                    <div class="ticket-stub-flight">
                                        <span class="ticket-label">Vuelo</span>
                                        <span class="ticket-value"><?php echo htmlspecialchars($numVuelo); ?></span>
                                    </div>
                                <?php } ?>
                                <div class="ticket-stub-status">
                                    <span class="ticket-status-badge <?php echo $estadoClass; ?>">
                                        <?php echo $estadoLabel; ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Serrated edge -->
                            <div class="ticket-tear"></div>

                            <!-- Right: Ticket body -->
                            <div class="ticket-body">
                                <div class="ticket-route">
                                    <div class="ticket-city">
                                        <span class="ticket-iata"><?php echo htmlspecialchars($r['origen']); ?></span>
                                        <span class="ticket-time"><?php echo $horaSalida; ?></span>
                                    </div>
                                    <div class="ticket-route-line">
                                        <span class="ticket-duration"><?php echo $duracion; ?></span>
                                        <div class="ticket-line-visual">
                                            <span class="dot"></span>
                                            <span class="line"></span>
                                            <i class="fa-solid fa-plane"></i>
                                            <span class="line"></span>
                                            <span class="dot"></span>
                                        </div>
                                    </div>
                                    <div class="ticket-city">
                                        <span class="ticket-iata"><?php echo htmlspecialchars($r['destino']); ?></span>
                                        <span class="ticket-time"><?php echo $horaLlegada; ?></span>
                                    </div>
                                </div>

                                <div class="ticket-details">
                                    <div class="ticket-detail">
                                        <span class="ticket-label"><i class="fa-regular fa-calendar"></i> Fecha</span>
                                        <span class="ticket-value"><?php echo $fechaSalida; ?></span>
                                    </div>
                                    <div class="ticket-detail">
                                        <span class="ticket-label"><i class="fa-solid fa-euro-sign"></i> Precio</span>
                                        <span class="ticket-value"><?php echo number_format($r['precio'], 2); ?> €</span>
                                    </div>
                                    <?php if (!empty($r['puntosGanados'])) { ?>
                                        <div class="ticket-detail">
                                            <span class="ticket-label"><i class="fa-solid fa-star"></i> Puntos</span>
                                            <span class="ticket-value">+<?php echo $r['puntosGanados']; ?> pts</span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<style>
    /* ===== RESERVES PAGE ===== */
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

    /* ===== EMPTY STATE ===== */
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

    /* ===== TICKET LIST ===== */
    .tickets-list {
        display: flex;
        flex-direction: column;
        gap: 1.5em;
    }

    /* ===== TICKET CARD ===== */
    .ticket {
        display: flex;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        transition: transform 200ms ease, box-shadow 200ms ease;
    }

    .ticket:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
    }

    /* ===== TICKET STUB (left) ===== */
    .ticket-stub {
        background: linear-gradient(135deg, #09b1be 0%, #0891a0 100%);
        color: white;
        padding: 1.5em 1.3em;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.8em;
        min-width: 180px;
        position: relative;
    }

    .ticket-stub-airline {
        display: flex;
        align-items: center;
        gap: 0.5em;
        font-weight: 700;
        font-size: 1rem;
    }

    .ticket-stub-airline i {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .ticket-stub-number .ticket-label,
    .ticket-stub-flight .ticket-label {
        display: block;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        opacity: 0.7;
    }

    .ticket-stub-number .ticket-value {
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: 0.05em;
    }

    .ticket-stub-flight .ticket-value {
        font-size: 0.95rem;
        font-weight: 600;
    }

    .ticket-stub-status {
        margin-top: 0.2em;
    }

    /* ===== TICKET STATUS BADGES ===== */
    .ticket-status-badge {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.3em 0.7em;
        border-radius: 20px;
    }

    .ticket-status-badge.status-confirmed {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .ticket-status-badge.status-pending {
        background: rgba(255, 200, 50, 0.3);
        color: #fff8dc;
    }

    .ticket-status-badge.status-cancelled {
        background: rgba(255, 80, 80, 0.3);
        color: #ffd4d4;
    }

    .ticket-status-badge.status-default {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .ticket-status-badge.status-inflight {
        background: rgba(0, 180, 255, 0.3);
        color: #e0f7fa;
    }

    .ticket-status-badge.status-finished {
        background: rgba(0, 200, 80, 0.3);
        color: #e0f2f1;
    }

    /* ===== TEAR LINE ===== */
    .ticket-tear {
        width: 2px;
        background-image: repeating-linear-gradient(to bottom,
                transparent,
                transparent 6px,
                #e0e0e0 6px,
                #e0e0e0 12px);
        position: relative;
    }

    .ticket-tear::before,
    .ticket-tear::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #f4f5f7;
        left: -7px;
    }

    .ticket-tear::before {
        top: -8px;
    }

    .ticket-tear::after {
        bottom: -8px;
    }

    /* ===== TICKET BODY (right) ===== */
    .ticket-body {
        flex: 1;
        padding: 1.5em 2em;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 1.2em;
    }

    /* ===== ROUTE ===== */
    .ticket-route {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1em;
    }

    .ticket-city {
        text-align: center;
    }

    .ticket-iata {
        display: block;
        font-size: 1.6rem;
        font-weight: 800;
        color: #2d2d2d;
        letter-spacing: 0.05em;
    }

    .ticket-time {
        display: block;
        font-size: 0.95rem;
        color: #8b8b8b;
        margin-top: 0.15em;
    }

    .ticket-route-line {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.3em;
    }

    .ticket-duration {
        font-size: 0.8rem;
        color: #09b1be;
        font-weight: 600;
    }

    .ticket-line-visual {
        display: flex;
        align-items: center;
        width: 100%;
        gap: 0;
    }

    .ticket-line-visual .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #09b1be;
        flex-shrink: 0;
    }

    .ticket-line-visual .line {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #09b1be, #b8e8ec);
    }

    .ticket-line-visual i {
        color: #09b1be;
        font-size: 0.85rem;
        margin: 0 0.3em;
        flex-shrink: 0;
    }

    /* ===== DETAILS ROW ===== */
    .ticket-details {
        display: flex;
        gap: 2em;
        border-top: 1px solid #f0f0f0;
        padding-top: 1em;
    }

    .ticket-detail {
        display: flex;
        flex-direction: column;
        gap: 0.2em;
    }

    .ticket-detail .ticket-label {
        font-size: 0.75rem;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 0.3em;
    }

    .ticket-detail .ticket-label i {
        font-size: 0.7rem;
    }

    .ticket-detail .ticket-value {
        font-size: 1rem;
        font-weight: 700;
        color: #2d2d2d;
    }

    /* ===== CANCELLED TICKET ===== */
    .ticket.status-cancelled {
        opacity: 0.6;
    }

    .ticket.status-cancelled .ticket-stub {
        background: linear-gradient(135deg, #888 0%, #666 100%);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .reserves-container {
            width: 90%;
        }

        .ticket {
            flex-direction: column;
        }

        .ticket-stub {
            min-width: auto;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 0.5em 1.5em;
            padding: 1em 1.3em;
        }

        .ticket-tear {
            width: auto;
            height: 2px;
            background-image: repeating-linear-gradient(to right,
                    transparent,
                    transparent 6px,
                    #e0e0e0 6px,
                    #e0e0e0 12px);
        }

        .ticket-tear::before,
        .ticket-tear::after {
            top: -7px;
            left: auto;
            bottom: auto;
        }

        .ticket-tear::before {
            left: -8px;
        }

        .ticket-tear::after {
            right: -8px;
            left: auto;
        }

        .ticket-body {
            padding: 1.2em 1.3em;
        }

        .ticket-details {
            flex-wrap: wrap;
            gap: 1em;
        }
    }
</style>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>