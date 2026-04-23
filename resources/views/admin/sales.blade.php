@extends("admin.layouts.layout")

@section("header-title", "إدارة المبيعات والأرباح")

@section("main-content")

<div class="container-fluid py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-chart-pie fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">جدول الأرباح اليومية</h3>
                <p class="text-secondary mb-0">عرض تفصيلي لأرباح المبيعات على مستوى الأيام.</p>
            </div>
        </div>
        
        <div class="bg-white px-4 py-2 rounded-pill shadow-sm text-secondary fw-bold">
            <i class="fa-solid fa-filter me-2"></i> تصفية
        </div>
    </div>

    <!-- Filter Info -->
    <div class="card mb-4" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div class="card-body p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-auto">
                    <i class="fa-solid fa-circle-info text-primary fs-5 me-2"></i>
                    <span class="fw-bold text-secondary">يتم عرض أرباح جميع الأيام مرتبةً تصاعدياً بالتاريخ.</span>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label fw-bold text-secondary mb-2">تصفية حسب التاريخ:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-2 border-end-0 text-primary rounded-end-pill ps-4"><i class="fa-regular fa-calendar"></i></span>
                        <input type="date" id="date" class="form-control border-start-0 rounded-start-pill py-2" style="border: 2px solid #dee2e6;" disabled title="ميزة التصفية غير متاحة حالياً">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card premium-card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08); overflow: hidden; border: 1px solid rgba(255,255,255,0.5);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background-color: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-3 border-0">رقم التسلسل</th>
                            <th class="py-3 border-0">التاريخ</th>
                            <th class="py-3 border-0">إجمالي المكسب</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($profits as $index => $profit)
                        <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="py-3 text-muted fw-bold">#{{ $index + 1 }}</td>
                            <td class="py-3 text-dark fw-bold">{{ $profit->sale_date }}</td>
                            <td class="py-3 text-success fw-bold">
                                <span class="bg-success bg-opacity-10 px-3 py-1 rounded-pill border border-success border-opacity-25 shadow-sm">
                                    {{ number_format($profit->total_profit ?? 0, 2) }} ج.م
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-5 text-muted">
                                <div class="opacity-50">
                                    <i class="fa-solid fa-folder-open fs-1 mb-3"></i>
                                    <h5>لا توجد بيانات أرباح مسجلة</h5>
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