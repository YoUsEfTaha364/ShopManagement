<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include("employee.partials.head-html")
    @stack('styles')
    <style>
        body {
            background-color: #f3f4f6; /* Modern elegant background */
            font-family: 'Inter', 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            padding: 2rem;
            width: calc(100% - 280px); /* 280 is sidebar width */
            margin-right: 280px; /* Offset for absolute sidebar */
            transition: all 0.3s ease;
        }
        
        /* Global SweetAlert Customization */
        .swal2-popup {
            border-radius: 20px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
            font-family: 'Tajawal', 'Inter', sans-serif !important;
        }
        .swal2-title { font-weight: 700 !important; }
        .swal2-confirm, .swal2-cancel {
            border-radius: 12px !important;
            font-weight: 600 !important;
            padding: 0.75rem 1.5rem !important;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        @include("employee.partials.sidebar")
        
        <div class="main-content">
            @include("employee.partials.header")
            @yield("before-main")
            
            <!-- Global Flash Messages via SweetAlert -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'نجاح!',
                            text: '{{ session("success") }}',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    });
                </script>
            @endif
            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ!',
                            text: '{{ session("error") }}',
                            timer: 4000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    });
                </script>
            @endif

            @yield("main-content")
            
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    
    <!-- Setup Global Axios/Fetch CSRF if needed -->
    <script>
        window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    </script>

    @stack("scripts")
</body>
</html>