@extends('employee.layouts.layout')

@section("header-title", "إضافة مشتريات بضائع")

@push('styles')
    <style>
        .premium-form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .premium-input {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.8rem 1.25rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        .premium-input:focus {
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
    </style>
@endpush

@section("main-content")
<div class="container-fluid py-4" dir="rtl">

    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white rounded-circle p-3 shadow-sm d-flex justify-content-center align-items-center text-primary" style="width: 55px; height: 55px;">
                <i class="fa-solid fa-cart-flatbed fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">فاتورة مشتريات جديدة</h3>
                <p class="text-secondary mb-0">إدخال بضائع جديدة للمخزن وتسجيل الدفع للمورد.</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn fw-bold px-4 rounded-pill text-white shadow-sm" style="background: linear-gradient(135deg, #10b981, #059669);" data-bs-toggle="modal" data-bs-target="#supplierModal" id="openSupplierModal">
                <i class="fa-solid fa-plus ms-1"></i> إضافة مورد
            </button>
            <button type="button" class="btn fw-bold px-4 rounded-pill text-white shadow-sm" style="background: linear-gradient(135deg, #3b82f6, #2563eb);" data-bs-toggle="modal" data-bs-target="#productModal" id="addProductBtn">
                <i class="fa-solid fa-box ms-1"></i> إضافة منتج للنظام
            </button>
        </div>
    </div>

    <!-- Supplier Modal (Bootstrap) -->
    <div class="modal fade" id="supplierModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
                <div class="modal-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 1.5rem; border-radius: 20px 20px 0 0; border: none;">
                    <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-truck-field me-2"></i> إضافة مورد جديد</h5>
                    <button type="button" class="btn-close btn-close-white m-0 closeSupplier" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('supplier.store') }}">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">اسم المورد</label>
                            <input type="text" name="supplier_name" id="name" class="form-control premium-input" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">رقم الهاتف</label>
                            <input type="text" name="supplier_phone" id="phone" class="form-control premium-input">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn rounded-pill px-5 fw-bold shadow-sm d-flex align-items-center text-white" style="background: linear-gradient(135deg, #10b981, #059669);">
                            حفظ المورد
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Product Modal (Bootstrap) -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
                <div class="modal-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 1.5rem; border-radius: 20px 20px 0 0; border: none;">
                    <h5 class="modal-title fw-bold m-0"><i class="fa-solid fa-box me-2"></i> إضافة منتج جديد بالنظام</h5>
                    <button type="button" class="btn-close btn-close-white m-0 closeProduct" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('product.add') }}" method="POST" id="productForm">
                    @csrf
                    <input hidden type="text" name="redirect" value="purchase">
                    <div class="modal-body p-4 g-3 row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">اسم المنتج</label>
                            <input name="name" type="text" id="product-name" class="form-control premium-input" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">النوع</label>
                            <select name="category_id" id="category" class="form-select premium-input" required>
                                <option value="">اختر النوع</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">رصيد افتتاحي</label>
                            <input name="count" type="number" id="count" min="1" class="form-control premium-input" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">سعر الشراء</label>
                            <input name="b_price" type="number" id="b-price" step="0.01" class="form-control premium-input" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-secondary mb-2">سعر البيع</label>
                            <input name="s_price" type="number" id="s-price" step="0.01" class="form-control premium-input">
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold text-muted border" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn rounded-pill px-5 fw-bold shadow-sm d-flex align-items-center text-white" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                            حفظ المنتج
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <form action="{{ route('purchase.store') }}" method="POST">
        @csrf
        
        <div class="premium-form-card">
            <h4 class="fw-bold mb-4 text-primary border-bottom pb-3"><i class="fa-solid fa-list-check me-2"></i> بيانات وتفاصيل الفاتورة</h4>
            
            <div class="row mb-5">
                <div class="col-md-4">
                    <label class="form-label fw-bold text-secondary mb-2">أختر اسم المورد</label>
                    <select name="supplier_id" class="form-select premium-input" required>
                        <option value="">-- اختار المورد --</option>
                        @foreach ($suppliers as $supplier )
                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive mb-4" style="overflow: visible;">
                <table class="table align-middle text-center border" id="itemsTable">
                    <thead style="background: #f8fafc; color: #64748b;">
                        <tr>
                            <th class="py-3">المنتج (العنصر)</th>
                            <th class="py-3" style="width: 15%;">الكمية</th>
                            <th class="py-3" style="width: 20%;">سعر الوحدة</th>
                            <th class="py-3" style="width: 20%;">الإجمالي الفرعي</th>
                            <th class="py-3" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="items[0][product_id]" class="form-select premium-input product-select" required>
                                    <option value="">-- اختار منتج --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[0][quantity]" value="1" min="1" class="form-control premium-input quantity text-center"></td>
                            <td class="price"><input type="number" name="items[0][price]" value="0.00" class="form-control premium-input input-price text-center" step="0.01"></td>
                            <td><input type="number" name="items[0][subtotal]" class="form-control premium-input subtotal text-center text-success fw-bold bg-white" value="0.00" readonly></td>
                            <td><button type="button" class="btn btn-danger rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm remove-item" style="width: 35px; height: 35px;"><i class="fa-solid fa-trash fs-6"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <button type="button" id="addRow" class="btn btn-light border rounded-pill px-4 py-2 fw-bold text-primary mb-5 shadow-sm transition-all" onmouseover="this.style.background='#e0e7ff'" onmouseout="this.style.background='white'">
                <i class="fa-solid fa-plus ms-1"></i> سطر منتج جديد
            </button>

            <div class="row bg-light rounded-4 p-4 border align-items-center mb-2">
                <div class="col-md-4 inputs">
                    <label for="totalAmount" class="form-label fw-bold text-secondary mb-2">إجمالي الفاتورة</label>
                    <div class="input-group drop-shadow-sm">
                        <span class="input-group-text bg-white border-2 border-end-0 text-primary py-3">ج.م</span>
                        <input type="number" name="total" id="totalAmount" class="form-control border-start-0 py-3 fw-bold bg-white fs-5" value="0" readonly style="border: 2px solid #dee2e6;">
                    </div>
                </div>
                <div class="col-md-4 inputs">
                    <label for="paidAmount" class="form-label fw-bold text-secondary mb-2">المدفوع من الخزنة</label>
                    <div class="input-group drop-shadow-sm">
                        <span class="input-group-text bg-white border-2 border-end-0 text-success py-3">ج.م</span>
                        <input type="number" name="paid" id="paidAmount" class="form-control border-start-0 py-3 fw-bold fs-5" value="0" min="0" step="0.01" style="border: 2px solid #10b981;">
                    </div>
                </div>
                <div class="col-md-4 inputs">
                    <label for="remainingAmount" class="form-label fw-bold text-secondary mb-2">الباقي يسجل כمديونية</label>
                    <div class="input-group drop-shadow-sm">
                        <span class="input-group-text bg-white border-2 border-end-0 text-danger py-3">ج.م</span>
                        <input type="number" name="remaining" id="remainingAmount" class="form-control border-start-0 py-3 fw-bold bg-white fs-5 text-danger" value="0" readonly style="border: 2px solid #dee2e6;">
                    </div>
                </div>
                
                <div class="col-12 mt-5 text-end">
                    <button type="submit" class="btn rounded-pill px-5 py-3 fw-bold shadow-sm text-white" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); font-size: 1.1rem;">
                        <i class="fa-solid fa-check-double ms-2"></i> حفظ فاتورة المشتريات
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@push("scripts")
<script src="{{asset('assets/js/purchase.js')}}"></script>
@endpush
