@extends("admin.layouts.layout")

@section("header-title", "الرئيسية")

@push("styles")
    <link rel="stylesheet" href="{{asset('assets/css/admin/home.css')}}">
    <style>
        .premium-kpi-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            padding: 1.5rem;
            display: flex;
            align-items: center;
        }
        .premium-kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.12);
        }
        .kpi-icon-box {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-left: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 8px 16px -4px rgba(0,0,0,0.2);
        }
        .kpi-content {
            flex: 1;
        }
        .kpi-value {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            color: #111827;
            line-height: 1.2;
        }
        .kpi-label {
            font-size: 1.1rem;
            color: #6b7280;
            margin: 0;
            font-weight: 600;
        }
        
        .bg-primary-gradient { background: linear-gradient(135deg, #4f46e5, #7c3aed); }
        .bg-success-gradient { background: linear-gradient(135deg, #059669, #10b981); }
        .bg-warning-gradient { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .bg-info-gradient { background: linear-gradient(135deg, #0ea5e9, #2563eb); }
    </style>
@endpush

@section("main-content")

<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">نظرة عامة على لوحة التحكم</h2>
            <p class="text-secondary fw-bold">مرحباً بك مجدداً في لوحة إدارة النظام.</p>
        </div>
        <div class="text-secondary fw-bold bg-white px-4 py-2 rounded-pill shadow-sm">
            <i class="fa-regular fa-calendar me-2"></i> {{ \Carbon\Carbon::now()->format('Y/m/d') }}
        </div>
    </div>

    <!-- KPI Grid -->
    <div class="row g-4 mb-5">
        
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.1s;">
                <div class="kpi-icon-box bg-primary-gradient">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">إجمالي المبيعات</p>
                    <p class="kpi-value">1,250</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.2s;">
                <div class="kpi-icon-box bg-info-gradient">
                    <i class="fas fa-users"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">مستخدمين جدد</p>
                    <p class="kpi-value">45</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.3s;">
                <div class="kpi-icon-box bg-success-gradient">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">الأرباح الشهرية</p>
                    <p class="kpi-value">£15.5k</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.4s;">
                <div class="kpi-icon-box bg-warning-gradient">
                    <i class="fas fa-truck-fast"></i>
                </div>
                <div class="kpi-content">
                    <p class="kpi-label">طلبات معلقة</p>
                    <p class="kpi-value">25</p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@push("scripts")
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.fade-in-up');
        cards.forEach((card, i) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, (i * 100) + 100);
        });
    });
</script>
@endpush