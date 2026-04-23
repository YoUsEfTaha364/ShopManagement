@extends("employee.layouts.layout")

@section("header-title", "الرئيسية")

@push("styles")
<style>
    .premium-kpi-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
    }
    .kpi-value {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        color: #111827;
    }
    .kpi-label {
        font-size: 1.1rem;
        color: #6b7280;
        margin: 0;
        font-weight: 600;
    }
</style>
@endpush

@section("main-content")
<div class="container-fluid py-4" dir="rtl">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">ملخص النشاط اليومي</h2>
            <p class="text-secondary fw-bold">أهلاً بك، إليك أحدث إحصائيات المتجر لهذا اليوم.</p>
        </div>
        <div class="text-secondary fw-bold bg-white px-4 py-2 rounded-pill shadow-sm">
            <i class="fa-regular fa-calendar me-2"></i> {{ \Carbon\Carbon::now()->format('Y/m/d') }}
        </div>
    </div>

    <div class="row g-4 mb-5">
        
        <div class="col-md-6 col-lg-6">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.1s;">
                <div class="kpi-icon-box" style="background: linear-gradient(135deg, #0ea5e9, #2563eb);">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
                <div>
                    <p class="kpi-label">مبيعات اليوم</p>
                    <p class="kpi-value">{{ number_format($revenue ?? 0, 2) }} <span class="fs-5 text-muted">ج.م</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="premium-kpi-card fade-in-up" style="animation-delay: 0.2s;">
                <div class="kpi-icon-box" style="background: linear-gradient(135deg, #059669, #10b981);">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
                <div>
                    <p class="kpi-label">مكسب اليوم (الأرباح)</p>
                    <p class="kpi-value">{{ number_format($profit ?? 0, 2) }} <span class="fs-5 text-muted">ج.م</span></p>
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