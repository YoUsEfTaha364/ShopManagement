@extends('employee.layouts.layout')

@section("header-title", "تفاصيل فاتورة المبيعات")

@section('main-content')
<div class="container-fluid py-4" dir="rtl">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <button onclick="history.back()" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center border" style="width: 45px; height: 45px; transition: transform 0.2s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-arrow-right text-secondary"></i>
            </button>
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-file-invoice-dollar fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">تفاصيل الفاتورة #{{ $sale->id }}</h3>
                <p class="text-secondary mb-0">مراجعة المنتجات وسجل الدفعات الخاصة بهذه الفاتورة.</p>
            </div>
        </div>

        <!-- Primary Action -->
        @if(($sale->remaining_price ?? 0) > 0)
            <button type="button" class="btn rounded-pill px-4 py-2 shadow fw-bold d-flex align-items-center gap-2 text-white" data-bs-toggle="modal" data-bs-target="#paymentModal" style="background: linear-gradient(135deg, #ef4444, #dc2626); font-size: 1.1rem; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-money-bill-wave"></i> سداد دفعة من الباقي
            </button>
        @else
            <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-4 py-2 fs-6 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="fa-solid fa-check-circle fs-5"></i> الفاتورة مسددة بالكامل
            </div>
        @endif
    </div>

    <!-- Sale Summary Stats Grid -->
    <div class="row g-4 mb-5">
        <!-- Total -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">الإجمالي قبل الخصم</p>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format(($sale->total_price ?? 0) + ($sale->discount ?? 0), 2) }} ج.م</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-calculator text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <!-- Discount -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">الخصم الإجمالي</p>
                            <h4 class="fw-bold text-warning mb-0">{{ number_format($sale->discount ?? 0, 2) }} ج.م</h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-tags text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         {{-- total after --}}
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">الإجمالي بعد الخصم</p>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format(($sale->total_price ?? 0) ) }} ج.م</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-calculator text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- Paid -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">إجمالي المدفوعات</p>
                            <h4 class="fw-bold text-success mb-0">{{ number_format($sale->paid_price ?? 0, 2) }} ج.م</h4>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-hand-holding-dollar text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Remaining -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl">
            <div class="card premium-card border-0 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b, #0f172a); border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 70%); pointer-events: none;"></div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-white-50 mb-1 fw-bold">الباقي (مديونية)</p>
                            <h3 class="fw-bold text-danger mb-0">{{ number_format($sale->remaining_price ?? 0, 2) }} ج.م</h3>
                        </div>
                        <div class="bg-danger bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:50px; height:50px; border: 1px solid rgba(239,68,68,0.3);">
                            <i class="fa-solid fa-triangle-exclamation text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4 d-flex align-items-stretch">
        
        <!-- Right Column: Products Table -->
        <div class="col-lg-7 d-flex flex-column">
            <div class="card premium-card border-0 flex-grow-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 ms-2">
                            <i class="fa-solid fa-boxes-stacked text-primary fs-5"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-0">عناصر الفاتورة</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                            <thead style="background-color: #f8fafc; color: #64748b; font-weight: 700;">
                                <tr>
                                    <th class="py-4 border-0">المنتج</th>
                                    <th class="py-4 border-0">سعر الوحدة</th>
                                    <th class="py-4 border-0">الكمية</th>
                                    <th class="py-4 border-0">الفرعي</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($items as $item)
                                <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                                    <td class="py-4 text-dark fw-bold">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="bg-light p-2 rounded-circle"><i class="fa-solid fa-cube text-primary opacity-75"></i></span>
                                            <span>{{ $item->product->name ?? 'منتج غير معرف' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-muted fw-bold">{{ number_format($item->price, 2) }}</td>
                                    <td class="py-4 fw-bold"><span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-pill">{{ $item->quantity }}</span></td>
                                    <td class="py-4 fw-bold text-success">{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-5 text-muted opacity-50">
                                        <i class="fa-solid fa-folder-open fs-1 mb-3"></i>
                                        <h5>الفاتورة خالية من المنتجات</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-3 mb-2" dir="ltr">
                {{ $items->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Left Column: Payments History -->
        <div class="col-lg-5 d-flex flex-column">
            <div class="card premium-card border-0 flex-grow-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1); overflow: hidden;">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3 ms-2">
                            <i class="fa-solid fa-clock-rotate-left text-primary fs-5"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-0">تاريخ الدفعات</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-center m-0" style="font-size: 0.95rem;">
                            <thead style="background-color: #f8fafc; color: #64748b; font-weight: 700;">
                                <tr>
                                    <th class="py-3 border-0">الدين قبل</th>
                                    <th class="py-3 border-0 text-success">الدفع</th>
                                    <th class="py-3 border-0 text-danger">الدين بعد</th>
                                    <th class="py-3 border-0">التوقيت</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($paymentHistory ?? [] as $history)
                                <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                                    <td class="py-3 text-muted fw-bold">{{ number_format($history['total_before_pay'], 2) }}</td>
                                    <td class="py-3 text-success fw-bold bg-success bg-opacity-10">+{{ number_format($history['amount_pay'], 2) }}</td>
                                    <td class="py-3 text-danger fw-bold">{{ number_format($history['total_after_pay'], 2) }}</td>
                                    <td class="py-3 text-secondary" style="font-size: 0.85rem;" dir="ltr">{{ $history['date'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-5 text-muted opacity-50">
                                        <i class="fa-solid fa-receipt fs-2 mb-3"></i>
                                        <h6>لا يوجد دفعات جزئية حتى الآن</h6>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Payment Modal -->
@if(($sale->remaining_price ?? 0) > 0)
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true" dir="rtl">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <div class="modal-header bg-light" style="border-bottom: 0; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title fw-bold text-dark" id="paymentModalLabel">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2 ms-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-wallet text-primary"></i>
                        </div>
                        تسديد دفعة مالية
                    </div>
                </h5>
                <button type="button" class="btn-close m-0 me-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('sales.payPartial', $sale->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="bg-danger bg-opacity-10 border border-danger border-opacity-25 rounded-3 p-3 mb-4 text-center">
                        <p class="text-danger mb-1 fw-bold">الرصيد المتبقي (المديونية)</p>
                        <h2 class="text-danger fw-bold mb-0">{{ number_format($sale->remaining_price ?? 0, 2) }} <span class="fs-5">ج.م</span></h2>
                    </div>
                    
                    <div class="mb-3">
                        <label for="amount" class="form-label fw-bold text-secondary mb-2">المبلغ المراد دفعه</label>
                        <div class="input-group drop-shadow-sm">
                            <span class="input-group-text bg-white border-2 border-end-0 text-success py-3 px-4"><i class="fa-solid fa-sack-dollar fs-5"></i></span>
                            <input type="number" name="amount" id="amount" class="form-control border-start-0 py-3 fw-bold fs-4 text-dark" style="border: 2px solid #10b981; background: #f0fdf4;" step="0.01" min="0.01" max="{{ $sale->remaining_price ?? 0 }}" required placeholder="أدخل القيمة...">
                        </div>
                        <div class="form-text text-muted mt-2 d-flex align-items-center gap-1">
                            <i class="fa-solid fa-circle-info text-primary"></i>
                            لن تتمكن من دفع مبلغ يتجاوز الرصيد المتبقي.
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-light" style="border-top: 0; border-radius: 0 0 20px 20px;">
                    <button type="button" class="btn btn-light border rounded-pill px-4 py-2 fw-bold shadow-sm transition-all" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background=''" data-bs-dismiss="modal">إلغاء الأمر</button>
                    <button type="submit" class="btn rounded-pill px-5 py-2 fw-bold shadow-lg text-white d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        <i class="fa-solid fa-check"></i> تأكيد وحفظ العملية
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection