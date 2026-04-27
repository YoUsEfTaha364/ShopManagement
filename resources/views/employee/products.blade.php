@extends("employee.layouts.layout")

@push("styles")
    <link rel="stylesheet" href="{{asset('assets/css/product-category.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/product.css')}}">
@endpush 

@section("header-title", "المنتجات")
@section("header-breadcrumb", "المنتجات")

@section("main-content")
<style>
    /* Premium Modern Aesthetics for Products */
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5, #7c3aed);
        --success-gradient: linear-gradient(135deg, #059669, #10b981);
        --danger-gradient: linear-gradient(135deg, #e11d48, #f43f5e);
        --warning-gradient: linear-gradient(135deg, #f59e0b, #d97706);
        --info-gradient: linear-gradient(135deg, #0ea5e9, #2563eb);
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
    .btn-gradient {
        border: none;
        color: white;
        border-radius: 12px;
        transition: var(--transition);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        color: white;
    }
    .btn-gradient-primary { background: var(--primary-gradient); }
    .btn-gradient-primary:hover { box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4); }
    
    .btn-gradient-success { background: var(--success-gradient); }
    .btn-gradient-success:hover { box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4); }
    
    .btn-gradient-danger { background: var(--danger-gradient); }
    .btn-gradient-danger:hover { box-shadow: 0 8px 20px rgba(225, 29, 72, 0.4); }

    .btn-gradient-warning { background: var(--warning-gradient); }
    .btn-gradient-warning:hover { box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4); }

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
    .form-control-premium, .form-select-premium {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        transition: var(--transition);
        background: #f9fafb;
    }
    .form-control-premium:focus, .form-select-premium:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
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
    .badge-status {
        padding: 0.5em 1em;
        font-weight: 700;
        font-size: 0.85rem;
        border-radius: 10px;
    }
</style>

<div class="container mt-4" dir="rtl">

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-premium">
                <div class="modal-header premium-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-pen-nib me-2"></i> تعديل بيانات المنتج</h5>
                    <button type="button" class="btn-close btn-close-white m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="" method="post" id="updateForm">
                    @csrf
                    @method("patch")
                    <div class="modal-body p-4">

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary mb-2">اسم المنتج</label>
                            <input id="u_name" type="text" name="name" class="form-control form-control-premium" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary mb-2">السعر المحدث</label>
                            <div class="input-group drop-shadow-sm">
                                <span class="input-group-text bg-white border-2 border-end-0 text-primary rounded-end-pill ps-4 py-3">EGP</span>
                                <input id="u_price" type="text" name="price" class="form-control form-control-premium border-start-0 rounded-start-pill py-3" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-0 p-4 pt-0 gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-gradient btn-gradient-primary rounded-pill px-5 fw-bold shadow-sm d-flex align-items-center m-0">
                            <span>حفظ التعديلات</span>
                            <i class="fa-solid fa-check ms-2"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Product Table Card -->
    <div class="card premium-card">

        <div class="card-header premium-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-2 ms-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                    <i class="fa-solid fa-boxes-stacked fs-5"></i>
                </div>
                <h4 class="m-0 fw-bold">إدارة المنتجات</h4>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-gradient btn-gradient-warning addPercent fw-bold px-4 rounded-pill">
                    <i class="fa-solid fa-percent ms-2"></i> نسبة الزيادة
                </button>
                <button class="btn btn-gradient btn-gradient-success addproduct fw-bold px-4 rounded-pill" onclick="document.getElementById('addProductSection').scrollIntoView({ behavior: 'smooth' });">
                    <i class="fa-solid fa-plus ms-2"></i> إضافة منتج
                </button>
                <div class="bg-white rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2 text-dark fw-bold ms-2">
                    <i class="fa-solid fa-box-open text-primary"></i>
                    العدد: <span class="text-primary fs-5 ms-1">{{ $count }}</span>
                </div>
            </div>

        </div>

        <div class="card-body px-4 py-3 table-container">
            <div class="table-responsive" style="overflow-x: visible;">
                <table class="table premium-table text-center align-middle m-0">

                    <thead>
                    <tr>
                        <th>الكود</th>
                        <th>اسم المنتج</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                        <th>العدد المتوفر</th>
                        <th>سعر الشراء</th>
                        <th>سعر البيع</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($products as $product)
                        <tr class="fade-in-row" data-price="{{ $product['sold_price'] }}"
                            data-id="{{ $product['id'] }}"
                            data-name="{{ $product['name'] }}">

                            <td>
                                <span class="badge badge-soft-primary rounded-pill fs-6 px-3">
                                    #{{ str_pad($product["id"], 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td><h6 class="m-0 fw-bold text-dark">{{ $product["name"] }}</h6></td>
                            <td class="text-muted fw-bold">{{ $product->category ? $product->category->name : 'غير محدد' }}</td>

                            <td>
                                @if($product['quantity'] > 0)
                                    <span class="badge bg-success bg-opacity-25 text-success badge-status border border-success"><i class="fa-solid fa-check-circle ms-1"></i> متوفر</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-25 text-danger badge-status border border-danger"><i class="fa-solid fa-times-circle ms-1"></i> ناقص</span>
                                @endif
                            </td>

                            <td><span class="fs-5 fw-bold">{{ $product["quantity"] }}</span> وحدة</td>
                            <td class="text-secondary fw-bold">{{ number_format($product["bought_price"], 2) }} ج.م</td>
                            <td class="text-success fw-bold">{{ number_format($product["sold_price"], 2) }} ج.م</td>

                            <td>
                                <button class="btn btn-gradient btn-gradient-primary btn-sm update-btn px-3 py-2 rounded-pill shadow-sm w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateModal"
                                        data-id="{{ $product['id'] }}"
                                        data-name="{{ $product['name'] }}"
                                        data-price="{{ $product['sold_price'] }}">
                                    <i class="fa-solid fa-pen-to-square ms-1"></i> تعديل
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('product.delete', $product['id']) }}" method="post" class="d-inline">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-gradient btn-gradient-danger btn-sm px-3 py-2 rounded-pill shadow-sm w-100" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
                                        <i class="fa-solid fa-trash-can ms-1"></i> حذف
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-5 text-muted">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="bg-light p-4 rounded-circle mb-3 border">
                                        <i class="fa-solid fa-box-open fs-1 text-secondary"></i>
                                    </div>
                                    <h5 class="fw-bold">لا توجد منتجات مسجلة</h5>
                                    <p class="mb-0">قم بإضافة منتجات لتظهر هنا.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <!-- Add Product Form -->
    <div id="addProductSection" class="card premium-card mt-5 mb-5">

        <div class="card-header premium-header-success d-flex align-items-center">
            <div class="bg-white bg-opacity-25 rounded-circle p-2 ms-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fa-solid fa-box fs-5"></i>
            </div>
            <h4 class="m-0 fw-bold">إضافة منتج جديد</h4>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('product.add') }}" method="post">
                @csrf

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-muted mb-2">اسم المنتج</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0 text-secondary"><i class="fa-solid fa-tag"></i></span>
                            <input type="text" name="name" class="form-control form-control-premium border-start-0" placeholder="أدخل اسم المنتج" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold text-muted mb-2">تصنيف المنتح (النوع)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0 text-secondary"><i class="fa-solid fa-list"></i></span>
                            <select name="category_id" class="form-select form-select-premium border-start-0" required>
                                <option value="" selected disabled>-- اختر نوع المنتج --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-muted mb-2">الكمية الإبتدائية</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0 text-secondary"><i class="fa-solid fa-cubes"></i></span>
                            <input name="count" type="number" class="form-control form-control-premium border-start-0" placeholder="أدخل الكمية المتوفرة" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-muted mb-2">سعر الشراء</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0 text-secondary"><i class="fa-solid fa-money-bill-wave"></i></span>
                            <input name="b_price" type="number" class="form-control form-control-premium border-start-0" placeholder="تكلفة الشراء" min="0" step="0.01" required>
                            <span class="input-group-text bg-light border-2 border-start-0 text-secondary">ج.م</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold text-muted mb-2">سعر البيع</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-2 border-end-0 text-secondary"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                            <input name="s_price" type="number" class="form-control form-control-premium border-start-0" placeholder="سعر البيع للجمهور" min="0" step="0.01" required>
                            <span class="input-group-text bg-light border-2 border-start-0 text-secondary">ج.م</span>
                        </div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-gradient btn-gradient-success px-5 py-3 rounded-pill fw-bold shadow-sm" style="font-size: 1.1rem;">
                            <i class="fa-solid fa-check-double ms-2"></i> حفظ كمنتج جديد
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

</div>

<form id="percentageForm" action="{{ route('product.addPercentage') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="percentage" id="percentageInput">
</form>
@endsection

@push("scripts")
    <script src="{{asset('assets/js/product.js')}}"></script>
    <script>
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
            
            const rows = document.querySelectorAll('.fade-in-row');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.4s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, (index * 50) + 300);
            });
        });
    </script>
@endpush
