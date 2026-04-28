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
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.12);
    }

    /* Headers */
    .premium-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: 0;
    }
    .premium-header-success {
        background: var(--success-gradient);
        color: white;
        padding: 1.25rem 1.5rem;
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

    .btn-gradient-info { background: var(--info-gradient); }
    .btn-gradient-info:hover { box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4); }

    /* Search & Filter Toolbar */
    .toolbar-section {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 1.5rem;
    }
    .search-input-wrapper {
        position: relative;
        flex: 1;
        max-width: 420px;
    }
    .search-input-wrapper .search-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
        z-index: 2;
    }
    .search-input-wrapper input {
        padding-right: 42px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.65rem 1rem 0.65rem 1rem;
        padding-right: 42px;
        background: white;
        transition: var(--transition);
        font-size: 0.95rem;
    }
    .search-input-wrapper input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition);
        border: 2px solid transparent;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .filter-btn-outline {
        background: white;
        color: #6b7280;
        border-color: #e5e7eb;
    }
    .filter-btn-outline:hover {
        border-color: #6366f1;
        color: #4f46e5;
        background: #eef2ff;
    }
    .filter-btn-active {
        background: #4f46e5;
        color: white;
        border-color: #4f46e5;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .filter-btn-active:hover {
        color: white;
    }
    .filter-btn-danger-active {
        background: #e11d48;
        color: white;
        border-color: #e11d48;
        box-shadow: 0 4px 12px rgba(225, 29, 72, 0.3);
    }
    .filter-btn-danger-active:hover {
        color: white;
    }

    /* Table */
    .table-container {
        padding: 0 0.5rem;
    }
    .premium-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0 0.4rem;
    }
    .premium-table th {
        background: transparent;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.8rem;
        padding: 0.75rem 1rem;
        border: none;
        white-space: nowrap;
    }
    .premium-table td {
        background: white;
        padding: 1rem 0.85rem;
        vertical-align: middle;
        color: #374151;
        border-top: 1px solid #f3f4f6;
        border-bottom: 1px solid #f3f4f6;
        transition: var(--transition);
        font-size: 0.95rem;
    }
    .premium-table td:first-child {
        border-right: 1px solid #f3f4f6;
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    .premium-table td:last-child {
        border-left: 1px solid #f3f4f6;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }
    .premium-table tbody tr {
        transition: var(--transition);
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .premium-table tbody tr:hover {
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
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

    /* Modal */
    .modal-content-premium {
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Badges */
    .badge-soft-primary {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 700;
        padding: 0.4em 0.85em;
    }
    .badge-status {
        padding: 0.4em 0.85em;
        font-weight: 700;
        font-size: 0.8rem;
        border-radius: 10px;
    }

    /* Pagination Styling */
    .pagination-wrapper {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid #f0f1f3;
    }
    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }
    .pagination-wrapper .pagination {
        margin: 0;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .pagination-wrapper .page-item .page-link {
        border: none;
        border-radius: 10px !important;
        color: #6b7280;
        font-weight: 600;
        padding: 0.5rem 0.9rem;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        background: #f3f4f6;
        min-width: 38px;
        text-align: center;
        line-height: 1.4;
    }
    .pagination-wrapper .page-item .page-link:hover {
        background: #eef2ff;
        color: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.15);
    }
    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        border: none;
    }
    .pagination-wrapper .page-item.disabled .page-link {
        background: transparent;
        color: #d1d5db;
        box-shadow: none;
        transform: none;
    }
    .pagination-wrapper .page-item:first-child .page-link,
    .pagination-wrapper .page-item:last-child .page-link {
        font-size: 1.1rem;
        padding: 0.4rem 0.75rem;
    }

    /* Count Badge */
    .count-badge {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 12px;
        padding: 0.4rem 1rem;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Action Buttons in Table */
    .action-btn {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .action-btn:hover {
        transform: translateY(-1px);
    }
    .action-btn-edit {
        background: #eef2ff;
        color: #4f46e5;
    }
    .action-btn-edit:hover {
        background: #4f46e5;
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .action-btn-delete {
        background: #fef2f2;
        color: #e11d48;
    }
    .action-btn-delete:hover {
        background: #e11d48;
        color: white;
        box-shadow: 0 4px 12px rgba(225, 29, 72, 0.3);
    }
</style>

<div class="container-fluid mt-3 px-0" dir="rtl">

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

        {{-- Card Header --}}
        <div class="card-header premium-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-2 ms-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="fa-solid fa-boxes-stacked fs-5"></i>
                </div>
                <h5 class="m-0 fw-bold">إدارة المنتجات</h5>
            </div>

            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="count-badge">
                    <i class="fa-solid fa-box-open"></i>
                    {{ $count }} منتج
                </span>
                <button class="btn btn-gradient btn-gradient-warning btn-sm addPercent fw-bold px-3 rounded-pill">
                    <i class="fa-solid fa-percent ms-1"></i> نسبة زيادة
                </button>
                <button class="btn btn-gradient btn-gradient-success btn-sm addproduct fw-bold px-3 rounded-pill" onclick="document.getElementById('addProductSection').scrollIntoView({ behavior: 'smooth' });">
                    <i class="fa-solid fa-plus ms-1"></i> إضافة منتج
                </button>
            </div>
        </div>

        {{-- Search & Filter Toolbar --}}
        <div class="toolbar-section d-flex align-items-center gap-3 flex-wrap">
            {{-- Search --}}
            <form action="{{ route('product.index') }}" method="GET" class="d-flex align-items-center gap-2 flex-grow-1" style="max-width: 480px;">
                @if(request()->has('dangerous_count'))
                    <input type="hidden" name="dangerous_count" value="1">
                @endif
                @if(request()->has('empty'))
                    <input type="hidden" name="empty" value="1">
                @endif
                <div class="search-input-wrapper w-100">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" name="search" class="form-control w-100"
                           placeholder="ابحث عن منتج بالاسم..."
                           value="{{ request('search') }}"
                           list="productsList"
                           autocomplete="off">
                </div>
                <datalist id="productsList">
                    @foreach($productNames as $name)
                        <option value="{{ $name }}">
                    @endforeach
                </datalist>
                <button type="submit" class="btn btn-gradient btn-gradient-primary btn-sm px-3 rounded-pill fw-bold" style="white-space: nowrap;">
                    <i class="fa-solid fa-search ms-1"></i> بحث
                </button>
                @if(request()->filled('search'))
                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-light border rounded-pill px-3 fw-bold text-muted" style="white-space: nowrap;">
                        <i class="fa-solid fa-xmark ms-1"></i> مسح
                    </a>
                @endif
            </form>

            {{-- Filter Buttons --}}
            <div class="d-flex align-items-center gap-2 me-auto">
                <a href="{{ route('product.index') }}" class="filter-btn {{ !request()->has('dangerous_count') && !request()->has('empty') ? 'filter-btn-active' : 'filter-btn-outline' }}">
                    <i class="fa-solid fa-layer-group"></i> الكل
                </a>
                <a href="{{ route('product.index', ['dangerous_count' => 1]) }}" class="filter-btn {{ request()->has('dangerous_count') ? 'filter-btn-active' : 'filter-btn-outline' }}">
                    <i class="fa-solid fa-triangle-exclamation"></i> نواقص
                </a>
                <a href="{{ route('product.index', ['empty' => 1]) }}" class="filter-btn {{ request()->has('empty') ? 'filter-btn-danger-active' : 'filter-btn-outline' }}">
                    <i class="fa-solid fa-circle-xmark"></i> منتهية
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="card-body px-4 py-3 table-container">
            <div class="table-responsive">
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
                        <th>إجراءات</th>
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
                            <td><span class="fw-bold text-dark">{{ $product["name"] }}</span></td>
                            <td class="text-muted fw-semibold">{{ $product->category ? $product->category->name : 'غير محدد' }}</td>

                            <td>
                                @if($product['quantity'] > 5)
                                    <span class="badge bg-success bg-opacity-15 text-success badge-status border border-success border-opacity-25"><i class="fa-solid fa-check-circle ms-1"></i> متوفر</span>
                                @elseif($product['quantity'] > 0)
                                    <span class="badge bg-warning bg-opacity-15 text-warning badge-status border border-warning border-opacity-25"><i class="fa-solid fa-exclamation-triangle ms-1"></i> ينفد</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-15 text-danger badge-status border border-danger border-opacity-25"><i class="fa-solid fa-times-circle ms-1"></i> منتهي</span>
                                @endif
                            </td>

                            <td><span class="fs-6 fw-bold">{{ $product["quantity"] }}</span> <small class="text-muted">وحدة</small></td>
                            <td class="text-secondary fw-semibold">{{ number_format($product["bought_price"], 2) }} <small>ج.م</small></td>
                            <td class="text-success fw-bold">{{ number_format($product["sold_price"], 2) }} <small>ج.م</small></td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <button class="action-btn action-btn-edit update-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#updateModal"
                                            data-id="{{ $product['id'] }}"
                                            data-name="{{ $product['name'] }}"
                                            data-price="{{ $product['sold_price'] }}">
                                        <i class="fa-solid fa-pen-to-square"></i> تعديل
                                    </button>
                                    <form action="{{ route('product.delete', $product['id']) }}" method="post" class="d-inline m-0">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="action-btn action-btn-delete" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
                                            <i class="fa-solid fa-trash-can"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-5 text-muted">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="bg-light p-4 rounded-circle mb-3 border">
                                        <i class="fa-solid fa-box-open fs-1 text-secondary"></i>
                                    </div>
                                    <h5 class="fw-bold">لا توجد منتجات مسجلة</h5>
                                    <p class="mb-0 text-muted">قم بإضافة منتجات لتظهر هنا.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="pagination-wrapper d-flex justify-content-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif

    </div>

    <!-- Add Product Form -->
    <div id="addProductSection" class="card premium-card mt-4 mb-5">

        <div class="card-header premium-header-success d-flex align-items-center">
            <div class="bg-white bg-opacity-25 rounded-circle p-2 ms-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fa-solid fa-box fs-5"></i>
            </div>
            <h5 class="m-0 fw-bold">إضافة منتج جديد</h5>
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
                        <label class="form-label fw-bold text-muted mb-2">تصنيف المنتج (النوع)</label>
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
