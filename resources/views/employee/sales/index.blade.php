@extends('employee.layouts.layout')

@section("header-title", "سجل فواتير المبيعات")

@section('main-content')

<div class="container-fluid py-4" dir="rtl">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-receipt fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">فواتير مبيعات العملاء</h3>
                <p class="text-secondary mb-0">عرض جميع عمليات البيع وتفاصيل السداد.</p>
            </div>
        </div>
        <a href="{{route('sales.create')}}" class="btn fw-bold px-4 py-2 rounded-pill text-white shadow-sm" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
            <i class="fa-solid fa-plus ms-1"></i> فاتورة مبيعات جديدة
        </a>
    </div>

    <!-- Filters -->
    <form action="{{ route('sales.index') }}" method="GET" class="card premium-card border-0 mb-4 shadow-sm" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; padding: 1.5rem;">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-primary border-primary border-opacity-25"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="customer_name" class="form-control border-start-0 ps-0 border-primary border-opacity-25" placeholder="بحث باسم العميل..." value="{{ request('customer_name') }}" style="box-shadow: none;">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check form-switch" style="font-size: 1.1rem;">
                    <input class="form-check-input" type="checkbox" name="has_remaining" id="has_remaining" value="1" {{ request('has_remaining') ? 'checked' : '' }}>
                    <label class="form-check-label ms-2 fw-bold text-dark" for="has_remaining">فواتير بها ديون (باقي)</label>
                </div>
            </div>
            <div class="col-md-4 d-flex gap-2 justify-content-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); border: none;">
                    <i class="fa-solid fa-filter ms-1"></i> تصفية
                </button>
                <a href="{{ route('sales.index') }}" class="btn btn-light rounded-pill px-4 border shadow-sm text-dark">
                    <i class="fa-solid fa-rotate-right ms-1"></i> تفريغ
                </a>
            </div>
        </div>
    </form>

    <!-- Table Card -->
    <div class="card premium-card border-0" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08); overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background-color: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-4 border-0">رقم الفاتورة</th>
                            <th class="py-4 border-0">اسم المشتري</th>
                            <th class="py-4 border-0">إجمالي الفاتورة</th>
                            <th class="py-4 border-0">المدفوع</th>
                            <th class="py-4 border-0">المتبقي (ديون)</th>
                            <th class="py-4 border-0">تاريخ الشراء</th>
                            <th class="py-4 border-0">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($sales as $sale)
                        <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="py-3 text-secondary fw-bold">#INV-{{ \Str::padLeft($sale->id, 4, '0') }}</td>
                            <td class="py-3 text-dark fw-bold">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-regular fa-user text-muted opacity-50"></i>
                                    {{ $sale->customer_name ?: 'عميل نقدي' }}
                                    @if($sale->customer_phone)
                                        <small class="text-muted d-block" style="font-size: 0.8rem;">{{ $sale->customer_phone }}</small>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 fw-bold text-dark">{{ number_format($sale->total_price, 2) }}</td>
                            <td class="py-3 fw-bold text-success">{{ number_format($sale->paid_price, 2) }}</td>
                            <td class="py-3 fw-bold text-danger">{{ number_format($sale->remaining_price, 2) }}</td>
                            <td class="py-3 text-secondary small">{{ \Carbon\Carbon::parse($sale->created_at)->format('Y/m/d h:i A') }}</td>
                            <td class="py-3">
                                <a href="{{ route('sales.items', $sale->id) }}" class="btn btn-sm rounded-pill px-3 fw-bold shadow-sm" style="background-color: #e0e7ff; color: #4f46e5;">
                                    <i class="fa-solid fa-eye ms-1"></i> التفاصيل
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-5 text-muted opacity-50">
                                <i class="fa-solid fa-folder-open fs-1 mb-3"></i>
                                <h5>لا توجد فواتير مبيعات مسجلة</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4 mb-5" dir="ltr">
        {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection