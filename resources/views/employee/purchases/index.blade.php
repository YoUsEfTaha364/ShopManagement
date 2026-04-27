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
                <p class="text-secondary mb-0">سجل إجمالي واستعراض مبسط لكل فواتير المشتريات.</p>
            </div>
        </div>
        <a href="{{route('purchase.create')}}" class="btn fw-bold px-4 py-2 rounded-pill text-white shadow d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-plus"></i> فاتورة مشتريات جديدة
        </a>
    </div>

    <!-- Purchases Table -->
    <div class="card premium-card border-0 mb-4" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid rgba(255,255,255,0.5);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-4 border-0">رقم الفاتورة</th>
                            <th class="py-4 border-0">المورد</th>
                            <th class="py-4 border-0">التاريخ</th>
                            <th class="py-4 border-0">الإجمالي</th>
                            <th class="py-4 border-0">المدفوع</th>
                            <th class="py-4 border-0">الباقي (مديونية)</th>
                            <th class="py-4 border-0">الإجراءات</th>
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
                            <td class="py-4 fw-bold text-dark">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="bg-light p-2 rounded-circle border shadow-sm" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-building text-primary opacity-75"></i></span>
                                    <span>{{$purchase->supplier->name ?? 'غير معروف'}}</span>
                                </div>
                            </td>
                            <td class="py-4 text-secondary fw-semibold" dir="ltr">
                                <i class="fa-regular fa-calendar text-primary opacity-50 me-1"></i> {{$purchase->date}}
                            </td>
                            <td class="py-4 text-dark fw-bold">{{ number_format($purchase->total_amount, 2) }} <span class="text-secondary small">ج.م</span></td>
                            <td class="py-4 text-success fw-bold">{{ number_format($purchase->paid_amount, 2) }} <span class="text-secondary small">ج.م</span></td>
                            <td class="py-4 text-danger fw-bold">
                                @if($purchase->remaining_amount > 0)
                                    {{ number_format($purchase->remaining_amount, 2) }} <span class="text-secondary small">ج.م</span>
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
                            <td colspan="7" class="py-5 text-center mt-5">
                                <div class="opacity-50">
                                    <i class="fa-solid fa-folder-open fs-1 text-secondary mb-3 mt-3"></i>
                                    <h5 class="text-secondary fw-bold">لا توجد فواتير مشتريات مسجلة بعد</h5>
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
@endsection
