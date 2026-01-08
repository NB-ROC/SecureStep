<footer class="footer-nav">
    <a href="{{ $leftLink ?? '/dashboard' }}" class="nav-item">
        {{ $leftLabel ?? 'Dashboard' }}
    </a>

    <a href="{{ $secondaryLink ?? '/' }}" class="nav-item">
        {{ $secondaryLabel ?? 'Map' }}
    </a>

    <a href="#" class="center-btn" onclick="openSOSModal(event)">
        {{ $centerLabel ?? 'SOS' }}
    </a>

    <a href="{{ $auxLink ?? '/friends' }}" class="nav-item">
        {{ $auxLabel ?? 'Friends' }}
    </a>

    <a href="{{ $rightLink ?? '/profile' }}" class="nav-item">
        {{ $rightLabel ?? 'Profile' }}
    </a>
</footer>


<div id="sosModal" class="sos-modal">
    <div class="sos-modal-content">
        <h2>SOS Emergency</h2>
        <p>You are about to call the emergency number.</p>

        <button class="sos-confirm-btn" onclick="handleSOSConfirm()">
            Call Emergency
        </button>

        <button class="cancel-btn" onclick="hideSOSModal()">
            Cancel
        </button>
    </div>
</div>

<script>
    const sosModal = document.getElementById('sosModal');

    function openSOSModal(event) {
        event.preventDefault();
        sosModal.style.display = 'flex';
    }

    function hideSOSModal() {
        sosModal.style.display = 'none';
    }

    function handleSOSConfirm() {
        window.location.href = 'tel:446';
    }
</script>
