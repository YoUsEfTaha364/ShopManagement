@extends('employee.layouts.layout')

@section("header-title", "تفاصيل فاتورة المبيعات")

@section('main-content')
<div class="container-fluid py-4" dir="rtl">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <button onclick="history.back()" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center border" style="width: 45px; height: 45px;">
                <i class="fa-solid fa-arrow-right text-secondary"></i>
            </button>
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-box-open fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">تفاصيل الفاتورة والعناصر</h3>
                <p class="text-secondary mb-0">عرض المنتجات المباعة داخل هذه الفاتورة.</p>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card premium-card border-0" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1); overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background-color: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-4 border-0">المنتج</th>
                            <th class="py-4 border-0">سعر الوحدة المباع به</th>
                            <th class="py-4 border-0">الكمية</th>
                            <th class="py-4 border-0">الإجمالي الفرعي</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($items as $item)
                        <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="py-4 text-dark fw-bold">
                                <i class="fa-solid fa-cube text-primary opacity-50 ms-2"></i>
                                {{ $item->product->name ?? 'منتج غير معرف' }}
                            </td>
                            <td class="py-4 text-muted fw-bold">{{ number_format($item->price, 2) }} ج.م</td>
                            <td class="py-4 fw-bold text-dark"><span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-pill">{{ $item->quantity }}</span></td>
                            <td class="py-4 fw-bold text-success">{{ number_format($item->subtotal, 2) }} ج.م</td>
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

</div>
@endsection