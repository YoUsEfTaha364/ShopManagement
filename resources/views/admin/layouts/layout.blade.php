<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - @yield('header-title', 'لوحة التحكم')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Inter:wght@300;400;500;600;700&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Core CSS (Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    
    <style>
        body {
            background-color: #f3f4f6; 
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
            width: calc(100% - 280px);
            margin-right: 280px; 
            transition: all 0.3s ease;
        }

        /* Sidebar Styling */
        .premium-sidebar {
            width: 280px; 
            min-height: 100vh;
            background: #111827; 
            color: white;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
            position: fixed;
            right: 0;
            top: 0;
        }
        .premium-sidebar-link {
            color: #9ca3af; 
            font-weight: 600;
            border-radius: 12px;
            padding: 0.9rem 1.25rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 1.05rem;
            text-decoration: none;
            margin-bottom: 0.5rem;
        }
        .premium-sidebar-link:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            transform: translateX(-5px);
        }
        .premium-sidebar-link.active {
            background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }
        .w-20px { width: 22px; text-align: center; }

        /* SweetAlert Customization */
        .swal2-popup {
            border-radius: 20px !important;
            font-family: 'Tajawal', sans-serif !important;
        }
    </style>
    @stack("styles")
</head>
<body>

    <div class="dashboard-container">
        
        <aside class="sidebar premium-sidebar p-3" dir="rtl">
            <div class="text-center py-4 mb-4 border-bottom border-secondary border-opacity-25">
                <h4 class="fw-bold m-0 d-flex align-items-center justify-content-center gap-2">
                    <div class="bg-primary bg-gradient rounded p-2 text-white shadow-sm d-flex align-items-center justify-content-center" style="width:40px;height:40px">
                        <i class="fa-solid fa-user-tie fs-5"></i>
                    </div>
                    <span>لوحة الإدارة</span>
                </h4>
            </div>

            <nav class="nav flex-column gap-2">
                <a href="#" class="premium-sidebar-link active">
                    <i class="fas fa-gauge-high me-3 w-20px"></i> الرئيسية
                </a>
                <a href="{{route('supplier.index')}}" class="premium-sidebar-link">
                    <i class="fa-solid fa-truck-field me-3 w-20px"></i> الموردون
                </a>
                <a href="{{route('admin.sales.index')}}" class="premium-sidebar-link">
                    <i class="fas fa-chart-pie me-3 w-20px"></i> المبيعات
                </a>
                <a href="{{ route('home.index') }}" class="premium-sidebar-link mt-4 border border-secondary border-opacity-50">
                    <i class="fas fa-store me-3 w-20px"></i> العودة للمتجر (الموظف)
                </a>
            </nav>
        </aside>

        <main class="main-content" dir="rtl">
            @yield("main-content")
        </main>
        
    </div>

    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    @stack("scripts")
</body>
</html>
