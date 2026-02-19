<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$user = isset($data['user']) ? $data['user'] : [];
$puntos = isset($data['puntos']) ? $data['puntos'] : 0;
?>

<main class="account">
    <section class="account-navbar">
        <div class="email-points-box">
            <i class="fa-solid fa-user usr-icon"></i>
            <p>
                <?php echo $_SESSION['email'] ?>
            </p>
            <div class="account-points">
                <div class="points-box">
                    <p>
                        <?php echo $puntos ?> puntos
                    </p>
                    <i class="fa-light fa-circle-info"></i>
                </div>
                <a href="/tienda" class="claim-points">
                    Canjear puntos
                    <i class="fa-light fa-angle-right"></i>
                </a>
            </div>
        </div>
        <div class="account-navbar-links">
            <a href="/mis-canjes">
                Mis cupones
                <i class="fa-light fa-angle-right"></i>
            </a>
            <a href="/logout" style="color: #e74c3c;">
                Cerrar sesión
                <i class="fa-light fa-right-from-bracket"></i>
            </a>
        </div>
    </section>
    <section class="account-main">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Información personal</h1>
            <button id="editInfoBtn"
                style="background: none; border: 1px solid #09b1be; color: #09b1be; padding: 0.5em 1.2em; border-radius: 50px; cursor: pointer; font-weight: 600; font-size: 0.85rem; transition: 200ms ease; display: flex; align-items: center; gap: 0.4em;">
                <i class="fa-solid fa-pen" style="font-size: 0.75rem;"></i>
                Editar
            </button>
        </div>
        <div class="personal-info">
            <div class="personal-info-box">
                <p>
                    Nombre legal
                    <span id="display-nombre">
                        <?php echo (!empty($user['nombre']) || !empty($user['apellidos'])) ? htmlspecialchars($user['nombre'] . ' ' . $user['apellidos']) : 'No proporcionado' ?>
                    </span>
                </p>
            </div>
            <div class="personal-info-box">
                <p>
                    Correo electrónico
                    <span>
                        <?php echo $_SESSION['email'] ?>
                    </span>
                </p>
            </div>
            <div class="personal-info-box">
                <p>
                    Fecha de nacimiento
                    <span id="display-fecha">
                        <?php echo !empty($user['fechaNacimiento']) ? $user['fechaNacimiento'] : 'No proporcionado' ?>
                    </span>
                </p>
            </div>
            <div class="personal-info-box">
                <p>
                    Número de teléfono
                    <span id="display-telefono">
                        <?php echo !empty($user['telefono']) ? htmlspecialchars($user['telefono']) : 'No proporcionado' ?>
                    </span>
                </p>
            </div>
            <div class="personal-info-box">
                <p>
                    Dirección
                    <span id="display-direccion">
                        <?php echo !empty($user['direccion']) ? htmlspecialchars($user['direccion']) : 'No proporcionado' ?>
                    </span>
                </p>
            </div>
            <div class="personal-info-box">
                <p>
                    Pasaporte / DNI
                    <span id="display-pasaporte">
                        <?php echo !empty($user['pasaporte']) ? htmlspecialchars($user['pasaporte']) : 'No proporcionado' ?>
                    </span>
                </p>
            </div>
        </div>
    </section>
</main>

<!-- MODAL EDITAR PERFIL -->
<div id="editProfileModal" class="rpf-modal-overlay">
    <div class="rpf-modal">
        <div class="rpf-modal-header">
            <h2>Editar información personal</h2>
            <button class="rpf-modal-close" id="closeEditModal">&times;</button>
        </div>
        <form id="editProfileForm" class="rpf-modal-body">
            <div class="rpf-modal-row">
                <div class="rpf-modal-field">
                    <label for="edit-nombre">Nombre</label>
                    <input type="text" id="edit-nombre" name="nombre"
                        value="<?php echo htmlspecialchars($user['nombre'] ?? '') ?>" placeholder="Tu nombre">
                </div>
                <div class="rpf-modal-field">
                    <label for="edit-apellidos">Apellidos</label>
                    <input type="text" id="edit-apellidos" name="apellidos"
                        value="<?php echo htmlspecialchars($user['apellidos'] ?? '') ?>" placeholder="Tus apellidos">
                </div>
            </div>
            <div class="rpf-modal-row">
                <div class="rpf-modal-field">
                    <label for="edit-fechaNacimiento">Fecha de nacimiento</label>
                    <input type="date" id="edit-fechaNacimiento" name="fechaNacimiento"
                        value="<?php echo $user['fechaNacimiento'] ?? '' ?>">
                </div>
                <div class="rpf-modal-field">
                    <label for="edit-telefono">Teléfono</label>
                    <input type="tel" id="edit-telefono" name="telefono"
                        value="<?php echo htmlspecialchars($user['telefono'] ?? '') ?>" placeholder="+34 600 000 000">
                </div>
            </div>
            <div class="rpf-modal-row">
                <div class="rpf-modal-field" style="flex: 2;">
                    <label for="edit-direccion">Dirección</label>
                    <input type="text" id="edit-direccion" name="direccion"
                        value="<?php echo htmlspecialchars($user['direccion'] ?? '') ?>" placeholder="Tu dirección">
                </div>
                <div class="rpf-modal-field">
                    <label for="edit-codigoPostal">Código Postal</label>
                    <input type="text" id="edit-codigoPostal" name="codigoPostal"
                        value="<?php echo htmlspecialchars($user['codigoPostal'] ?? '') ?>" placeholder="28001">
                </div>
            </div>
            <div class="rpf-modal-row">
                <div class="rpf-modal-field">
                    <label for="edit-ciudad">Ciudad</label>
                    <input type="text" id="edit-ciudad" name="ciudad"
                        value="<?php echo htmlspecialchars($user['ciudad'] ?? '') ?>" placeholder="Madrid">
                </div>
                <div class="rpf-modal-field">
                    <label for="edit-pais">País</label>
                    <input type="text" id="edit-pais" name="pais"
                        value="<?php echo htmlspecialchars($user['pais'] ?? 'España') ?>" placeholder="España">
                </div>
            </div>
            <div class="rpf-modal-field">
                <label for="edit-pasaporte">Pasaporte / DNI</label>
                <input type="text" id="edit-pasaporte" name="pasaporte"
                    value="<?php echo htmlspecialchars($user['pasaporte'] ?? '') ?>" placeholder="12345678A">
            </div>
            <div class="rpf-modal-actions">
                <button type="button" class="rpf-btn-cancel" id="cancelEditModal">Cancelar</button>
                <button type="submit" class="rpf-btn-save">Guardar cambios</button>
            </div>
        </form>
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
        max-width: 560px;
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

    /* ===== MODAL BODY (FORM) ===== */
    .rpf-modal-body {
        padding: 1em 2em 2em;
        display: flex;
        flex-direction: column;
        gap: 1em;
    }

    .rpf-modal-row {
        display: flex;
        gap: 1em;
    }

    .rpf-modal-field {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.3em;
    }

    .rpf-modal-field label {
        font-size: 0.8rem;
        color: #09b1be;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .rpf-modal-field input {
        border: 1px solid #d4d4d4;
        padding: 0.8em 1em;
        border-radius: 10px;
        font-size: 0.95rem;
        color: #313131;
        transition: border 200ms ease;
        outline: none;
        width: 100%;
    }

    .rpf-modal-field input:focus {
        border-color: #09b1be;
    }

    /* ===== MODAL ACTIONS ===== */
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

    /* ===== ANIMATIONS ===== */
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

    /* ===== EDIT BUTTON HOVER ===== */
    #editInfoBtn:hover {
        background: #09b1be !important;
        color: white !important;
    }
</style>

<script>
    // ===== MODAL LOGIC =====
    const modal = document.getElementById('editProfileModal');
    const openBtns = [document.getElementById('editInfoBtn'), document.getElementById('openEditModal')];
    const closeBtns = [document.getElementById('closeEditModal'), document.getElementById('cancelEditModal')];

    openBtns.forEach(btn => {
        btn?.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    closeBtns.forEach(btn => {
        btn?.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // Close on overlay click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // ===== FORM SUBMIT =====
    document.getElementById('editProfileForm').addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);
        const payload = {};
        formData.forEach((val, key) => { payload[key] = val; });

        fetch('/actualizar-perfil', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update displayed values without reload
                    document.getElementById('display-nombre').textContent =
                        (payload.nombre || payload.apellidos) ? (payload.nombre + ' ' + payload.apellidos).trim() : 'No proporcionado';
                    document.getElementById('display-fecha').textContent = payload.fechaNacimiento || 'No proporcionado';
                    document.getElementById('display-telefono').textContent = payload.telefono || 'No proporcionado';
                    document.getElementById('display-direccion').textContent = payload.direccion || 'No proporcionado';
                    document.getElementById('display-pasaporte').textContent = payload.pasaporte || 'No proporcionado';

                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                    rpfPopup('success', 'Datos actualizados', 'Tu información personal se ha guardado correctamente.');
                } else {
                    rpfPopup('error', 'Error al guardar', data.message || 'No se pudieron guardar los cambios');
                }
            })
            .catch(err => {
                console.error(err);
                rpfPopup('error', 'Error de conexión', 'No se pudo conectar con el servidor');
            });
    });
</script>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>