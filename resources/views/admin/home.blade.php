@extends("admin.layouts.layout")

@section("header-title", "الرئيسية")

@push("styles")
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/admin/home.css')}}">
    <style>
        .dashboard-wrapper {
            font-family: 'Tajawal', sans-serif;
            position: relative;
            z-index: 1;
        }

        /* Decorative Background Orbs */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.4;
            animation: float 10s infinite ease-in-out alternate;
        }
        .orb-1 {
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
        }
        .orb-2 {
            bottom: -100px;
            left: -50px;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-20px) scale(1.05); }
        }

        /* Welcome Banner */
        .welcome-banner {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 20px 40px -20px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, #4f46e5, #0ea5e9, #10b981);
        }

        .welcome-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .welcome-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        .date-badge {
            background: #ffffff;
            color: #4f46e5;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.15);
            border: 1px solid rgba(79, 70, 229, 0.1);
        }

        /* KPI Cards */
        .premium-kpi-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            box-shadow: 0 15px 35px -15px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            padding: 1.75rem;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        
        .premium-kpi-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            border-radius: 24px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.5);
            pointer-events: none;
        }

        .premium-kpi-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -15px rgba(0,0,0,0.1);
            background: rgba(255, 255, 255, 0.95);
        }

        .kpi-icon-box {
            width: 65px;
            height: 65px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            margin-left: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .premium-kpi-card:hover .kpi-icon-box {
            transform: scale(1.1) rotate(5deg);
        }

        .kpi-content {
            flex: 1;
        }
        .kpi-value {
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
            color: #0f172a;
            line-height: 1.1;
            letter-spacing: -0.02em;
            direction: ltr;
            text-align: right;
        }
        .kpi-label {
            font-size: 1rem;
            color: #64748b;
            margin: 0 0 0.4rem 0;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        /* Gradients */
        .bg-primary-gradient { background: linear-gradient(135deg, #4f46e5, #818cf8); box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4); }
        .bg-success-gradient { background: linear-gradient(135deg, #059669, #34d399); box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.4); }
        .bg-info-gradient { background: linear-gradient(135deg, #0ea5e9, #38bdf8); box-shadow: 0 10px 20px -5px rgba(14, 165, 233, 0.4); }
        .bg-warning-gradient { background: linear-gradient(135deg, #d97706, #fbbf24); box-shadow: 0 10px 20px -5px rgba(217, 119, 6, 0.4); }
        .bg-danger-gradient { background: linear-gradient(135deg, #e11d48, #fb7185); box-shadow: 0 10px 20px -5px rgba(225, 29, 72, 0.4); }

        /* Quick Actions & Charts Placeholder */
        .section-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1.5rem;
            position: relative;
            padding-right: 1rem;
        }
        .section-title::before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 24px;
            background: #4f46e5;
            border-radius: 4px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 2px dashed rgba(99, 102, 241, 0.3);
            border-radius: 20px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            color: #64748b;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: #4f46e5;
            color: #4f46e5;
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(79, 70, 229, 0.15);
        }
        .feature-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.7;
            transition: all 0.3s;
        }
        .feature-card:hover i {
            opacity: 1;
            transform: scale(1.1);
        }

        @media(max-width: 768px) {
            .welcome-banner { flex-direction: column; text-align: center; gap: 1rem; }
        }
    </style>
@endpush

@section("main-content")
<div class="dashboard-wrapper container-fluid py-4">
    <!-- Orbs -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <!-- Welcome Banner -->
    <div class="welcome-banner fade-in-up" style="animation-delay: 0.1s;">
        <div>
            <h1 class="welcome-title">نظرة عامة على لوحة التحكم</h1>
            <p class="welcome-subtitle">مرحباً بك مجدداً! إليك ملخص لأداء النظام اليوم.</p>
        </div>
        <div class="date-badge">
            <i class="fa-regular fa-calendar-check"></i>
            {{ \Carbon\Carbon::now()->format('Y/m/d') }}
        </div>
    </div>

    <!-- Top KPI Level (Sales & Profit) -->
    <div class="row g-4 mb-4">
        <div class="col-xl-6 col-lg-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.2s;">
                <div class="kpi-icon-box bg-primary-gradient">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">مبيعات اليوم</p>
                    <p class="kpi-value">{{ number_format($today_sales ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.3s;">
                <div class="kpi-icon-box bg-success-gradient">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">أرباح اليوم</p>
                    <p class="kpi-value">{{ number_format($today_profit ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary KPI Level -->
    <div class="row g-4 mb-5">
        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.4s;">
                <div class="kpi-icon-box bg-info-gradient">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">النقد المتوفر</p>
                    <p class="kpi-value">{{ number_format($cash_i_have ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.5s;">
                <div class="kpi-icon-box bg-warning-gradient">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">الديون لنا</p>
                    <p class="kpi-value">{{ number_format($remaining ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.6s;">
                <div class="kpi-icon-box bg-danger-gradient">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">الديون علينا</p>
                    <p class="kpi-value">{{ number_format($dept ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Area -->
    <div class="row g-4 fade-in-up" style="animation-delay: 0.7s;">
        <div class="col-12">
            <h3 class="section-title">إجراءات سريعة</h3>
        </div>
        <div class="col-lg-4">
            <a href="{{route('sales.index')}}" class="text-decoration-none">
                <div class="feature-card">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <h5 class="fw-bold mt-2 text-dark">إدارة المبيعات</h5>
                    <p class="mb-0 small">عرض تفاصيل المبيعات والفواتير</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{route('purchase.index')}}" class="text-decoration-none">
                <div class="feature-card">
                    <i class="fas fa-box-open text-success"></i>
                    <h5 class="fw-bold mt-2 text-dark">إدارة المشتريات</h5>
                    <p class="mb-0 small">مراجعة الفواتير والموردين</p>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{route('product.index')}}" class="text-decoration-none">
                <div class="feature-card">
                    <i class="fas fa-boxes-stacked text-info"></i>
                    <h5 class="fw-bold mt-2 text-dark">المخزون والمنتجات</h5>
                    <p class="mb-0 small">تحديث ومراقبة المخزون</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push("scripts")
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll('.fade-in-up');
        elements.forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            setTimeout(() => {
                el.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, (i * 100) + 100);
        });
    });
</script>
@endpush