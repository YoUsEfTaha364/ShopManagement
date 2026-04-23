@extends('employee.layouts.layout')

@section("header-title","الاقسام")
@section("header-breadcrumb","الاقسام")

@section('main-content')
<style>
    /* Premium Modern Aesthetics */
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5, #7c3aed);
        --success-gradient: linear-gradient(135deg, #059669, #10b981);
        --danger-gradient: linear-gradient(135deg, #e11d48, #f43f5e);
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.5);
        --glass-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    body {
        background-color: #f3f4f6;
        font-family: 'Inter', 'Tajawal', sans-serif;
    }

    /* Cards */
    .premium-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--glass-shadow);
        transition: var(--transition);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .premium-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.12);
    }

    /* Headers */
    .premium-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem;
        border-bottom: 0;
    }
    .premium-header-success {
        background: var(--success-gradient);
        color: white;
        padding: 1.5rem;
        border-bottom: 0;
    }

    /* Buttons */
    .btn-gradient-primary {
        background: var(--primary-gradient);
        border: none;
        color: white;
        border-radius: 12px;
        transition: var(--transition);
    }
    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
        color: white;
    }

    .btn-gradient-success {
        background: var(--success-gradient);
        border: none;
        color: white;
        border-radius: 12px;
        transition: var(--transition);
    }
    .btn-gradient-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-gradient-danger {
        background: var(--danger-gradient);
        border: none;
        color: white;
        border-radius: 12px;
        transition: var(--transition);
    }
    .btn-gradient-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(225, 29, 72, 0.4);
        color: white;
    }

    /* Table Improvements */
    .table-container {
        padding: 0 0.5rem;
    }
    .premium-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }
    .premium-table th {
        background: transparent;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.85rem;
        padding: 1rem;
        border: none;
    }
    .premium-table td {
        background: white;
        padding: 1.25rem 1rem;
        vertical-align: middle;
        color: #374151;
        border-top: 1px solid #f3f4f6;
        border-bottom: 1px solid #f3f4f6;
        transition: var(--transition);
    }
    .premium-table td:first-child {
        border-left: 1px solid #f3f4f6;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }
    .premium-table td:last-child {
        border-right: 1px solid #f3f4f6;
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    .premium-table tbody tr {
        transition: var(--transition);
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .premium-table tbody tr:hover {
        transform: scale(1.01) translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .premium-table tbody tr:hover td {
        background: #f8fafc;
    }

    /* Form Controls */
    .form-control-premium {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        transition: var(--transition);
        background: #f9fafb;
    }
    .form-control-premium:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    .input-group-text-premium {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-left: none;
        border-radius: 0 12px 12px 0;
        color: #6b7280;
    }

    /* Modal Tweaks */
    .modal-content-premium {
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .modal-backdrop.show {
        backdrop-filter: blur(5px);
        opacity: 0.6;
    }

    /* Custom Badges */
    .badge-soft-primary {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 700;
        padding: 0.5em 1em;
    }
</style>

<div class="container mt-4" dir="rtl">

    <!-- Update Category Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-premium">
                
                <div class="modal-header premium-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-pen-nib me-2"></i> تعديل تفاصيل القسم</h5>
                    <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('category.update') }}" method="post" id="updateForm">
                    @csrf
                    @method("put")

                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary mb-2">الاسم الجديد</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-premium border-end-0"><i class="fa-solid fa-list-check text-primary"></i></span>
                                <input type="text" name="name" id="u_name" class="form-control form-control-premium border-start-0" placeholder="أدخل اسم القسم المحدث" required autocomplete="off">
                            </div>
                        </div>
                        <input type="hidden" name="id" id="u_id">
                    </div>

                    <div class="modal-footer border-0 p-4 pt-0 gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-gradient-primary rounded-pill px-5 fw-bold shadow-sm d-flex align-items-center m-0">
                            <span>حفظ التعديلات</span>
                            <i class="fa-solid fa-check ms-2"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Add Category Form -->
    <div class="card premium-card">
        <div class="card-header premium-header-success d-flex align-items-center">
            <div class="bg-white bg-opacity-25 rounded-circle p-2 ms-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fa-solid fa-layer-group fs-5"></i>
            </div>
            <h4 class="m-0 fw-bold">تسجيل قسم / نوع جديد</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('category.add') }}" method="post">
                @csrf
                <div class="row g-4 align-items-end">
                    <div class="col-md-9">
                        <label class="form-label fw-bold text-muted mb-2">اسم الموتوسيكل المقترح</label>
                        <div class="input-group drop-shadow-sm">
                            <span class="input-group-text bg-white border-2 border-end-0 text-success rounded-end-pill ps-4 py-3"><i class="fa-solid fa-tag"></i></span>
                            <input type="text" name="name" class="form-control form-control-premium border-start-0 rounded-start-pill py-3" placeholder="أدخل اسم القسم الجديد هنا (مثال: هوندا، ياماها...)" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-gradient-success w-100 fw-bold py-3 rounded-pill d-flex justify-content-center align-items-center shadow-sm">
                            <i class="fa-solid fa-plus ms-2"></i>
                            إضافة نوع جديد
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Category Table Card -->
    <div class="card premium-card">
        <div class="card-header premium-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-2 ms-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-folder-tree fs-5"></i>
                </div>
                <h4 class="m-0 fw-bold">الأقسام المسجلة</h4>
            </div>
            
            <div class="bg-white rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2 text-dark fw-bold">
                <i class="fa-solid fa-chart-simple text-primary"></i>
                العدد الإجمالي: <span class="text-primary fs-5 ms-1">{{ $count }}</span>
            </div>
        </div>

        <div class="card-body px-4 py-3 table-container">
            <div class="table-responsive" style="overflow-x: visible;">
                <table class="table premium-table text-center align-middle">
                    <thead>
                        <tr>
                            <th width="15%">رقم الكود</th>
                            <th width="45%">اسم القسم / الموتوسيكل</th>
                            <th width="20%">إجراء التعديل</th>
                            <th width="20%">إجراء الحذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr data-name="{{ $category['name'] }}" data-id="{{ $category['id'] }}">
                                <td>
                                    <span class="badge badge-soft-primary rounded-pill">
                                        #{{ str_pad($category['id'], 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td>
                                    <h6 class="m-0 fw-bold text-dark">{{ $category['name'] }}</h6>
                                </td>
                                <td>
                                    <button 
                                        class="btn btn-gradient-primary btn-sm update-btn px-4 py-2 rounded-pill shadow-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateModal"
                                        data-id="{{ $category['id'] }}"
                                        data-name="{{ $category['name'] }}"
                                    >
                                        <i class="fa-solid fa-pen-to-square ms-1"></i> تعديل
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('category.delete', $category['id']) }}" method="post" class="d-inline">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-gradient-danger btn-sm px-4 py-2 rounded-pill shadow-sm" onclick="return confirm('هل أنت متأكد من حذف هذا القسم نهائياً؟');">
                                            <i class="fa-solid fa-trash-can ms-1"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-5">
                                    <div class="text-muted d-flex flex-column align-items-center justify-content-center">
                                        <div class="bg-light p-4 rounded-circle mb-3 border">
                                            <i class="fa-solid fa-inbox fs-1 text-secondary"></i>
                                        </div>
                                        <h5 class="fw-bold">لا توجد أقسام مسجلة حتى الآن</h5>
                                        <p class="mb-0">قم بإضافة أنواع موتوسيكلات جديدة من النموذج أعلاه لبدء العمل.</p>
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
    <script src="{{ asset('assets/js/category.js') }}"></script>
    <script>
        // Add subtle entrance animation
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.premium-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endpush
