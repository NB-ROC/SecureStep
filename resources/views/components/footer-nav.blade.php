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
        <h2>Emergency Alert</h2>
        <p>Calling emergency number.</p>
        <button onclick="confirmSOS()">Call Now</button>
        <button class="cancel-btn" onclick="closeSOSModal()">Cancel</button>
    </div>
</div>


<script>
    function openSOSModal(event) {
        event.preventDefault();
        document.getElementById("sosModal").style.display = "flex";
    }

    function closeSOSModal() {
        document.getElementById("sosModal").style.display = "none";
    }

    function confirmSOS() {
        window.location.href = "tel:446";
    }
</script>
