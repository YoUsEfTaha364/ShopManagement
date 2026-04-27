@extends('admin.layouts.layout')

@section("header-title", "تفاصيل المورد: " . $supplier->name)

@section("main-content")
<div class="container-fluid py-4" dir="rtl">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <button onclick="history.back()" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center border" style="width: 45px; height: 45px; transition: transform 0.2s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-arrow-right text-secondary"></i>
            </button>
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-address-card fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">تفاصيل المورد: {{ $supplier->name }}</h3>
                <p class="text-secondary mb-0">عرض فواتير المشتريات سجل الديون الخاصة بهذا المورد.</p>
            </div>
        </div>

        <!-- Primary Action -->
        @if($remaining > 0)
            <button type="button" class="btn rounded-pill px-4 py-2 shadow fw-bold d-flex align-items-center gap-2 text-white" data-bs-toggle="modal" data-bs-target="#paymentModal" style="background: linear-gradient(135deg, #10b981, #059669); font-size: 1.1rem; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-money-bill-wave"></i> دفع قسط للمورد
            </button>
        @else
            <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-4 py-3 fs-6 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="fa-solid fa-check-double fs-5"></i> لا توجد ديون مستحقة لهذا المورد
            </div>
        @endif
    </div>

    <!-- Summary Stats Grid -->
    <div class="row g-4 mb-5">
        <!-- Total -->
        <div class="col-md-4">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">إجمالي البضائع المسحوبة</p>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format($total, 2) }} ج.م</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-cubes text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Paid -->
        <div class="col-md-4">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">إجمالي المسدد</p>
                            <h4 class="fw-bold text-success mb-0">{{ number_format($paid, 2) }} ج.م</h4>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-handshake-simple text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Remaining -->
        <div class="col-md-4">
            <div class="card premium-card border-0 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b, #0f172a); border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 70%); pointer-events: none;"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white-50 mb-1 fw-bold">إجمالي الباقي (مديونية)</p>
                            <h3 class="fw-bold text-danger mb-0">{{ number_format($remaining, 2) }} ج.م</h3>
                        </div>
                        <div class="bg-danger bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:50px; height:50px; border: 1px solid rgba(239,68,68,0.3);">
                            <i class="fa-solid fa-scale-unbalanced text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchases Table -->
    <h4 class="fw-bold text-dark mb-4 ms-2"><i class="fa-solid fa-receipt text-primary me-2"></i> الفواتير التفصيلية للمورد</h4>
    
    <div class="card premium-card border-0 mb-4" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid rgba(255,255,255,0.5);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-4 border-0">رقم الفاتورة</th>
                            <th class="py-4 border-0">التاريخ</th>
                            <th class="py-4 border-0">عدد المنتجات المسحوبة</th>
                            <th class="py-4 border-0">إجمالي الفاتورة</th>
                            <th class="py-4 border-0">تم دفعه</th>
                            <th class="py-4 border-0">المتبقي منها</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($purchases as $purchase)
                        <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="py-4 fw-bold text-dark">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fs-6 shadow-sm">
                                    #INV-{{ \Str::padLeft($purchase->id, 4, '0') }}
                                </span>
                            </td>
                            <td class="py-4 text-secondary fw-semibold" dir="ltr">
                                <i class="fa-regular fa-calendar text-primary opacity-50 me-1"></i> {{ $purchase->date }}
                            </td>
                            <td class="py-4 fw-bold">
                                <span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-pill shadow-sm">
                                    {{ $purchase->items->count() }} أصناف
                                </span>
                            </td>
                            <td class="py-4 text-dark fw-bold">{{ number_format($purchase->total_amount, 2) }} <span class="text-secondary small">ج.م</span></td>
                            <td class="py-4 text-success fw-bold">{{ number_format($purchase->paid_amount, 2) }} <span class="text-secondary small">ج.م</span></td>
                            <td class="py-4 text-danger fw-bold">
                                @if($purchase->remaining_amount > 0)
                                    <div class="bg-danger bg-opacity-10 text-danger px-3 py-2 border border-danger border-opacity-25 rounded-pill d-inline-block">
                                        {{ number_format($purchase->remaining_amount, 2) }} <span class="small">ج.م</span>
                                    </div>
                                @else
                                    <span class="text-success small fw-bold"><i class="fa-solid fa-check-circle me-1"></i> مسددة</span>
                                @endif
                            </td>

                              <td class="py-4">
                                <a href="{{ route('purchase.show', $purchase->id) }}" class="btn px-4 py-2 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2 text-white" 
                                        style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none; font-size: 0.95rem; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <i class="fa-solid fa-folder-open"></i> تفاصيل الفاتورة
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-5 text-center mt-5">
                                <div class="opacity-50">
                                    <i class="fa-solid fa-folder-open fs-1 text-secondary mb-3 mt-3"></i>
                                    <h5 class="text-secondary fw-bold">لا يوجد سجل مشتريات لهذا المورد</h5>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Complete Payment Modal -->
@if($remaining > 0)
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
            <div class="modal-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 1.5rem; border-radius: 20px 20px 0 0; border: none;">
                <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-money-bill-wave me-2"></i> سداد جزء من مديونية المورد</h5>
                <button type="button" class="btn-close btn-close-white m-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('payment.store') }}" method="post">
                @csrf
                <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                
                <div class="modal-body p-4">
                    <div class="mb-4 text-center bg-danger bg-opacity-10 rounded-3 p-3 border border-danger border-opacity-25">
                        <h5 class="fw-bold text-danger mb-2">إجمالي المتبقي حالياً</h5>
                        <h2 class="text-danger fw-bold m-0">{{ number_format($remaining, 2) }} <span class="fs-5">ج.م</span></h2>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary mb-2">المبلغ المراد سداده للمورد (ج.م)</label>
                        <div class="input-group drop-shadow-sm">
                            <span class="input-group-text bg-white border-2 border-end-0 text-success rounded-end-pill py-3 px-4"><i class="fa-solid fa-coins fs-5"></i></span>
                            <input type="number" name="value" id="payment_value" class="form-control border-start-0 rounded-start-pill py-3 fw-bold fs-4" style="border: 2px solid #dee2e6;" placeholder="أدخل القيمة..." required min="0.01" max="{{ $remaining }}" step="0.01">
                        </div>
                        <div class="form-text text-muted mt-2 d-flex align-items-center gap-1">
                            <i class="fa-solid fa-circle-info text-primary"></i>
                            المبلغ سيتم توزيعه على أقدم الفواتير المستحقة تلقائياً.
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4 pt-0 gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-muted border transition-all" data-bs-dismiss="modal" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background=''">إلغاء</button>
                    <button type="submit" class="btn rounded-pill px-5 py-2 fw-bold shadow-sm d-flex align-items-center text-white" style="background: linear-gradient(135deg, #10b981, #059669); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        <i class="fa-solid fa-check ms-2"></i> تأكيد السداد
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection
