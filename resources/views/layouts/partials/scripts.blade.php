<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

@yield('js')

<script>
$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }

    // Check if dark mode is enabled
    if (localStorage.getItem('dark-layout') === 'true') {
        document.querySelector('html').classList.add('dark-layout');
        document.querySelector('.nav-link-style .ficon').setAttribute('data-feather', 'sun');
    } else {
        document.querySelector('html').classList.remove('dark-layout');
        document.querySelector('.nav-link-style .ficon').setAttribute('data-feather', 'moon');
    }

    // Dark mode toggle
    document.querySelector('.nav-link-style').addEventListener('click', function() {
        const html = document.querySelector('html');
        const isDarkLayout = html.classList.contains('dark-layout');

        if (isDarkLayout) {
            html.classList.remove('dark-layout');
            this.querySelector('.ficon').setAttribute('data-feather', 'moon');
            localStorage.setItem('dark-layout', 'false');
        } else {
            html.classList.add('dark-layout');
            this.querySelector('.ficon').setAttribute('data-feather', 'sun');
            localStorage.setItem('dark-layout', 'true');
        }

        // Re-initialize feather icons
        feather.replace({
            width: 14,
            height: 14
        });
    });
});</script>
