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




    <!-- Suppliers Table Card -->
    <div class="card premium-card border-0 mb-4" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-radius: 20px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid rgba(255,255,255,0.5);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center m-0" style="font-size: 1.05rem;">
                    <thead style="background: #f8fafc; color: #64748b; font-weight: 700;">
                        <tr>
                            <th class="py-4 border-0">رقم التعريف</th>
                            <th class="py-4 border-0">إسم المورد</th>
                            <th class="py-4 border-0">إجمالي البضائع</th>
                            <th class="py-4 border-0">إجمالي المدفوع</th>
                            <th class="py-4 border-0">الباقي (مديونية)</th>
                            <th class="py-4 border-0">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($depts as $dept)
                        <tr style="transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="py-4 fw-bold text-secondary">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm fs-6">
                                    #{{ $dept->supplier_id }}
                                </span>
                            </td>
                            <td class="py-4 fw-bold text-dark">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="bg-primary bg-opacity-10 p-2 rounded-circle border shadow-sm" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-building text-primary opacity-75"></i>
                                    </span>
                                    <span>{{ $dept->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 text-dark fw-bold">{{ number_format($dept->total, 2) }} <span class="text-secondary small">ج.م</span></td>
                            <td class="py-4 text-success fw-bold">{{ number_format($dept->paid, 2) }} <span class="text-secondary small">ج.م</span></td>
                            <td class="py-4 text-danger fw-bold">
                                @if($dept->remaining > 0)
                                    <div class="bg-danger bg-opacity-10 text-danger px-3 py-2 border border-danger border-opacity-25 rounded-pill d-inline-block">
                                        {{ number_format($dept->remaining, 2) }} <span class="small">ج.م</span>
                                    </div>
                                @else
                                    <span class="text-success small fw-bold"><i class="fa-solid fa-check-circle me-1"></i> لا يوجد ديون</span>
                                @endif
                            </td>
                            <td class="py-4">
                                <a href="{{ route('supplier.show', $dept->supplier_id) }}" class="btn px-4 py-2 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2 text-white" 
                                        style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none; font-size: 0.95rem; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <i class="fa-solid fa-folder-open"></i> تفاصيل المورد
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-5 text-center mt-5">
                                <div class="opacity-50">
                                    <i class="fa-solid fa-box-open fs-1 text-secondary mb-3 mt-3"></i>
                                    <h5 class="text-secondary fw-bold">لا توجد معاملات مسجلة مع الموردين بعد</h5>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hover effects on cards if missing
    });
</script>
@endpush
