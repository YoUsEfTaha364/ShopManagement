@extends('employee.layouts.layout')

@section("header-title", "تفاصيل فاتورة المشتريات")

@section('main-content')
<div class="container-fluid py-4" dir="rtl">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <button onclick="history.back()" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center border" style="width: 45px; height: 45px; transition: transform 0.2s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='none'">
                <i class="fa-solid fa-arrow-right text-secondary"></i>
            </button>
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-file-invoice fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">تفاصيل الفاتورة #INV-{{ \Str::padLeft($purchase->id, 4, '0') }}</h3>
                <p class="text-secondary mb-0">عرض المنتجات المسحوبة وتكاليف هذه الفاتورة المرتبطة بالمورد: <span class="fw-bold text-primary">{{ $purchase->supplier->name ?? 'غير معروف' }}</span></p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <div class="badge bg-light text-secondary border px-4 py-2 fs-6 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i class="fa-regular fa-calendar"></i> {{ $purchase->date }}
            </div>
        </div>
    </div>

    <!-- Purchase Summary Stats Grid -->
    <div class="row g-4 mb-5">
        <!-- Total -->
        <div class="col-md-4">
            <div class="card premium-card border-0 h-100" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 fw-bold">إجمالي قيمة الفاتورة</p>
                            <h4 class="fw-bold text-dark mb-0">{{ number_format($purchase->total_amount, 2) }} ج.م</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-calculator text-primary fs-4"></i>
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
                            <p class="text-muted mb-1 fw-bold">المدفوع من الفاتورة</p>
                            <h4 class="fw-bold text-success mb-0">{{ number_format($purchase->paid_amount, 2) }} ج.م</h4>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                            <i class="fa-solid fa-hand-holding-dollar text-success fs-4"></i>
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
                            <p class="text-white-50 mb-1 fw-bold">المتبقي (المديونية)</p>
                            @if($purchase->remaining_amount > 0)
                                <h3 class="fw-bold text-danger mb-0">{{ number_format($purchase->remaining_amount, 2) }} ج.م</h3>
                            @else
                                <h3 class="fw-bold text-success mb-0"><i class="fa-solid fa-check me-1"></i> مسددة بالكامل</h3>
                            @endif
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:50px; height:50px; border: 1px solid rgba(255,255,255,0.2);">
                            <i class="fa-solid fa-scale-unbalanced @if($purchase->remaining_amount > 0) text-danger @else text-success @endif fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Table -->
    <h4 class="fw-bold text-dark mb-4 ms-2"><i class="fa-solid fa-boxes-stacked text-primary me-2"></i> المنتجات المحتواه في الفاتورة</h4>
    
    <div class="card premium-card border-0" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1); overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background-color: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-4 border-0">اسم المنتج</th>
                            <th class="py-4 border-0">تكلفة الشراء للوحدة</th>
                            <th class="py-4 border-0">الكمية المسحوبة</th>
                            <th class="py-4 border-0">الإجمالي الفرعي</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($purchase->items as $item)
                        <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="py-4 text-dark fw-bold">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="bg-light p-2 rounded-circle"><i class="fa-solid fa-box text-primary opacity-75"></i></span>
                                    <span>{{ $item->product->name ?? 'منتج محذوف وغير معرف' }}</span>
                                </div>
                            </td>
                            <td class="py-4 text-muted fw-bold">{{ number_format($item->price, 2) }} <span class="small fw-normal text-secondary">ج.م</span></td>
                            <td class="py-4 fw-bold">
                                <span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-pill">
                                    {{ $item->quantity }}
                                </span>
                            </td>
                            <td class="py-4 fw-bold text-success">{{ number_format($item->subtotal, 2) }} <span class="small fw-normal text-secondary">ج.م</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-5 text-muted opacity-50">
                                <i class="fa-solid fa-folder-open fs-1 mb-3"></i>
                                <h5>الفاتورة خالية من المنتجات أو حدث خطأ بإدخالها</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
