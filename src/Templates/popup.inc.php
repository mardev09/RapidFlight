<!-- GLOBAL POPUP / TOAST SYSTEM -->
<div id="rpf-popup-overlay" class="rpf-popup-overlay">
    <div class="rpf-popup">
        <div id="rpf-popup-icon" class="rpf-popup-icon"></div>
        <h3 id="rpf-popup-title" class="rpf-popup-title"></h3>
        <p id="rpf-popup-message" class="rpf-popup-message"></p>
        <button id="rpf-popup-ok" class="rpf-popup-btn" type="button">Aceptar</button>
    </div>
</div>

<style>
    .rpf-popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .rpf-popup-overlay.active {
        display: flex;
    }

    .rpf-popup {
        background: white;
        border-radius: 20px;
        padding: 2.5em 2em 2em;
        max-width: 380px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        animation: rpf-popupIn 0.3s ease;
    }

    @keyframes rpf-popupIn {
        from {
            transform: scale(0.9) translateY(10px);
            opacity: 0;
        }

        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }

    .rpf-popup-icon {
        font-size: 3rem;
        margin-bottom: 0.4em;
    }

    .rpf-popup-icon.error {
        color: #e74c3c;
    }

    .rpf-popup-icon.success {
        color: #27ae60;
    }

    .rpf-popup-icon.warning {
        color: #f39c12;
    }

    .rpf-popup-icon.info {
        color: #09b1be;
    }

    .rpf-popup-title {
        color: #313131;
        font-size: 1.15rem;
        font-weight: bold;
        margin-bottom: 0.4em;
    }

    .rpf-popup-message {
        color: #5b5b5b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.5em;
    }

    .rpf-popup-btn {
        background: #09b1be;
        color: white;
        border: none;
        padding: 0.7em 2.5em;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background 200ms ease;
    }

    .rpf-popup-btn:hover {
        background: #0ac2cf;
    }
</style>

<script>
    /**
     * rpfPopup — Global styled popup to replace alert()
     * Usage: rpfPopup('error', 'Título', 'Mensaje', callbackOpcional)
     * Types: 'error', 'success', 'warning', 'info'
     */
    function rpfPopup(type, title, message, onClose) {
        const overlay = document.getElementById('rpf-popup-overlay');
        const iconEl = document.getElementById('rpf-popup-icon');
        const titleEl = document.getElementById('rpf-popup-title');
        const msgEl = document.getElementById('rpf-popup-message');
        const okBtn = document.getElementById('rpf-popup-ok');

        const icons = {
            error: '<i class="fa-solid fa-circle-xmark"></i>',
            success: '<i class="fa-solid fa-circle-check"></i>',
            warning: '<i class="fa-solid fa-triangle-exclamation"></i>',
            info: '<i class="fa-solid fa-circle-info"></i>'
        };

        iconEl.innerHTML = icons[type] || icons.info;
        iconEl.className = 'rpf-popup-icon ' + (type || 'info');
        titleEl.textContent = title || '';
        msgEl.textContent = message || '';

        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';

        function close() {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            okBtn.removeEventListener('click', close);
            document.removeEventListener('keydown', escHandler);
            if (typeof onClose === 'function') onClose();
        }

        function escHandler(e) {
            if (e.key === 'Escape') close();
        }

        okBtn.addEventListener('click', close);
        document.addEventListener('keydown', escHandler);

        overlay.addEventListener('click', function handler(e) {
            if (e.target === overlay) {
                close();
                overlay.removeEventListener('click', handler);
            }
        });
    }
</script>