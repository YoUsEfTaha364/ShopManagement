@extends('employee.layouts.layout')

@section("header-title", "سجل فواتير المشتريات")

@section("main-content")
<div class="container-fluid py-4" dir="rtl">

    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-file-invoice fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">فواتير سابقة (البضائع المضافة)</h3>
                <p class="text-secondary mb-0">سجل مفصل لكل المشتريات المدخلة مسبقاً.</p>
            </div>
        </div>
        <a href="{{route('purchase.create')}}" class="btn fw-bold px-4 py-2 rounded-pill text-white shadow-sm" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
            <i class="fa-solid fa-plus ms-1"></i> فاتورة مشتريات جديدة
        </a>
    </div>

    <!-- Purchases Grid -->
    <div class="row g-4">
        @forelse($purchases as $purchase)
        <div class="col-xl-6 col-lg-12">
            <div class="card h-100 premium-card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid rgba(255,255,255,0.5); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="card-header bg-transparent border-bottom p-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center border shadow-sm" style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-building text-primary fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">{{$purchase->supplier->name ?? 'غير معروف'}}</h5>
                            <span class="text-secondary small fw-bold"><i class="fa-regular fa-calendar me-1"></i> {{$purchase->date}}</span>
                        </div>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 fw-bold shadow-sm">
                        #INV-{{ \Str::padLeft($purchase->id, 4, '0') }}
                    </span>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                        <table class="table table-hover align-middle text-center m-0" style="font-size: 0.95rem;">
                            <thead style="background: #f8fafc; color: #64748b; font-weight: 700; position: sticky; top: 0; z-index: 1;">
                                <tr>
                                    <th class="py-3 border-0">اسم المنتج</th>
                                    <th class="py-3 border-0">العدد</th>
                                    <th class="py-3 border-0">السعر</th>
                                    <th class="py-3 border-0">الإجمالي</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse ($purchase->items as $item)
                                <tr>
                                    <td class="py-3 text-dark fw-bold"><i class="fa-solid fa-box text-muted ms-2 opacity-50"></i> {{$item->product->name ?? 'منتج محذوف'}}</td>
                                    <td class="py-3 text-secondary fw-bold">{{$item->quantity}}</td>
                                    <td class="py-3 text-secondary fw-bold">{{ number_format($item->price, 2) }}</td>
                                    <td class="py-3 text-success fw-bold">{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="py-3 text-muted">لا توجد منتجات مسجلة</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light border-top-0 p-4">
                    <div class="row text-center g-3 rounded-3" style="background: white; border: 1px solid #e2e8f0;">
                        <div class="col-4 py-3">
                            <span class="d-block text-secondary small fw-bold mb-1">💰 إجمالي الفاتورة</span>
                            <span class="fw-bold fs-5 text-dark">{{ number_format($purchase->total_amount, 2) }}</span>
                        </div>
                        <div class="col-4 border-start border-end py-3">
                            <span class="d-block text-secondary small fw-bold mb-1">✅ تم دفعه</span>
                            <span class="fw-bold fs-5 text-success">{{ number_format($purchase->paid_amount, 2) }}</span>
                        </div>
                        <div class="col-4 py-3" style="background: rgba(225,29,72,0.05);">
                            <span class="d-block text-danger small fw-bold mb-1">⌛ متبقي (مديونية)</span>
                            <span class="fw-bold fs-5 text-danger">{{ number_format($purchase->remaining_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5 opacity-50 mt-5">
                <i class="fa-solid fa-folder-open fs-1 text-secondary mb-3"></i>
                <h4 class="text-secondary fw-bold">لا توجد فواتير مشتريات مسجلة بعد</h4>
            </div>
        @endforelse
    </div>
</div>
@endsection
