<footer class="footer-nav">
    <a href="{{ $leftLink ?? '/dashboard' }}" class="nav-item">
        {{ $leftLabel ?? 'Dashboard' }}
    </a>

    <a href="{{ $secondaryLink ?? '/' }}" class="nav-item">
        {{ $secondaryLabel ?? 'Map' }}
    </a>

    <button class="center-btn">
        {{ $centerLabel ?? 'SOS' }}
    </button>

    <a href="{{ $auxLink ?? '/friends' }}" class="nav-item">
        {{ $auxLabel ?? 'Friends' }}
    </a>

    <a href="{{ $rightLink ?? '/profile' }}" class="nav-item">
        {{ $rightLabel ?? 'Profile' }}
    </a>
</footer>
