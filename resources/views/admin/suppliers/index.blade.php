@extends("admin.layouts.layout")

@section("header-title", "إدارة حسابات الموردين")

@section('main-content')
<div class="container-fluid py-4" dir="rtl">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-truck-field fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">جدول حسابات الموردين</h3>
                <p class="text-secondary mb-0">عرض تفاصيل مديونيات الموردين والأقساط المدفوعة والمتبقية.</p>
            </div>
        </div>
    </div>

    <!-- Shared Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
                <div class="modal-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 1.5rem; border-radius: 20px 20px 0 0; border: none;">
                    <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-money-bill-wave me-2"></i> سداد جزء من المديونية</h5>
                    <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('payment.store')}}" method="post">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="supplier_id" id="modal_supplier_id">
                        
                        <div class="mb-4 text-center bg-light rounded-3 p-3 border">
                            <h5 class="fw-bold text-dark mb-2">المورد: <span id="modal_supplier_name" class="text-primary"></span></h5>
                            <h6 class="text-muted m-0">إجمالي المتبقي: <span id="modal_supplier_rem" class="text-danger fw-bold fs-5"></span> ج.م</h6>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">المبلغ المراد سداده الآن (ج.م)</label>
                            <div class="input-group drop-shadow-sm">
                                <span class="input-group-text bg-white border-2 border-end-0 text-success rounded-end-pill ps-4 py-3"><i class="fa-solid fa-coins"></i></span>
                                <input type="number" name="value" id="payment_value" class="form-control border-start-0 rounded-start-pill py-3 fw-bold" style="border: 2px solid #dee2e6;" placeholder="أدخل المبلغ المعطى للمورد..." required min="0.01" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn rounded-pill px-5 fw-bold shadow-sm d-flex align-items-center text-white" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <span>تسجيل العملية</span>
                            <i class="fa-solid fa-check-circle ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Cards Grid -->
    <div class="row g-4">
        @forelse ($depts as $dept)
        <div class="col-xl-4 col-lg-6 col-12">
            <div class="card premium-card h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08); overflow: hidden; border: 1px solid rgba(255,255,255,0.5); transition: all 0.3s ease;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                        <h4 class="fw-bold text-dark m-0 d-flex align-items-center">
                            <i class="fa-solid fa-building text-primary ms-2 opacity-75"></i> 
                            {{$dept->name}}
                        </h4>
                        <span class="badge bg-light text-secondary border rounded-pill">#{{$dept->supplier_id}}</span>
                    </div>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center px-1">
                            <span class="text-secondary fw-bold"><i class="fa-solid fa-tags text-muted ms-2"></i> إجمالي البضائع:</span>
                            <span class="fw-bold fs-5 text-dark">{{ number_format($dept->total, 2) }} ج.م</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center px-1">
                            <span class="text-secondary fw-bold"><i class="fa-solid fa-handshake-simple text-success ms-2"></i> إجمالي المدفوع:</span>
                            <span class="fw-bold fs-5 text-success">{{ number_format($dept->paid, 2) }} ج.م</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 mt-1 rounded-3" style="background: rgba(225, 29, 72, 0.08);">
                            <span class="text-danger fw-bold"><i class="fa-solid fa-scale-unbalanced text-danger ms-2"></i> الباقي لسداده:</span>
                            <span class="fw-bold fs-4 text-danger">{{ number_format($dept->remaining, 2) }} ج.م</span>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2 pay-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#paymentModal"
                            data-id="{{$dept->supplier_id}}"
                            data-name="{{$dept->name}}"
                            data-rem="{{$dept->remaining}}"
                            style="background: linear-gradient(135deg, #4f46e5, #7c3aed); border: none;">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        دفع قسط للمورد
                    </button>
                    
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5 opacity-50">
                <i class="fa-solid fa-box-open fs-1 mb-3"></i>
                <h5>لا توجد معاملات مسجلة مع الموردين بعد</h5>
            </div>
        @endforelse
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const payBtns = document.querySelectorAll('.pay-btn');
        const modalId = document.getElementById('modal_supplier_id');
        const modalName = document.getElementById('modal_supplier_name');
        const modalRem = document.getElementById('modal_supplier_rem');
        
        payBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                modalId.value = btn.getAttribute('data-id');
                modalName.innerText = btn.getAttribute('data-name');
                modalRem.innerText = parseFloat(btn.getAttribute('data-rem')).toLocaleString(undefined, {minimumFractionDigits: 2});
            });
        });
        
        // Hover effects on cards
        const cards = document.querySelectorAll('.premium-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-5px)');
            card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
        });
    });
</script>
<!-- supplier.js forms toggling logic replaced by Bootstrap native modals -->
@endpush
