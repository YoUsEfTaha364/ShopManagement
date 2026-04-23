@extends('employee.layouts.layout')

@section("header-title", "فاتورة مبيعات جديدة")

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
                <i class="fa-solid fa-cash-register fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-dark mb-1">فاتورة مبيعات جديدة</h3>
                <p class="text-secondary mb-0">تسجيل مبيعات للعملاء وإصدار الفاتورة.</p>
            </div>
        </div>
    </div>


    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        
        <div class="premium-form-card">
            <h4 class="fw-bold mb-4 text-primary border-bottom pb-3"><i class="fa-solid fa-user-tag me-2"></i> بيانات العميل</h4>
            
            <div class="row mb-4 g-3 mt-2">
                <div class="col-md-6">
                    <label for="customer-name" class="form-label fw-bold text-secondary mb-2">اسم العميل</label>
                    <input type="text" name="customer_name" id="customer-name" class="form-control premium-input name" placeholder="أدخل اسم العميل (اختياري / إلزامي)" required>
                </div>
                <div class="col-md-6">
                    <label for="customer-phone" class="form-label fw-bold text-secondary mb-2">رقم الهاتف</label>
                    <input type="text" name="customer_phone" id="customer-phone" class="form-control premium-input phone" placeholder="أدخل رقم الهاتف">
                </div>
            </div>
        </div>

        <div class="premium-form-card">
            <h4 class="fw-bold mb-4 text-primary border-bottom pb-3"><i class="fa-solid fa-list-check me-2"></i> بيانات وتفاصيل الفاتورة</h4>

            <div class="table-responsive mb-4" style="overflow: visible;">
                <table class="table align-middle text-center border" id="itemsTable">
                    <thead style="background: #f8fafc; color: #64748b;">
                        <tr>
                            <th class="py-3">المنتج (العنصر)</th>
                            <th class="py-3" style="width: 15%;">الكمية</th>
                            <th class="py-3" style="width: 20%;">سعر البيع للوحدة</th>
                            <th class="py-3" style="width: 20%;">الإجمالي الفرعي</th>
                            <th class="py-3" style="width: 5%;">حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="items[0][product_id]" class="form-select premium-input product-select" required>
                                    <option value="">-- اختار منتج --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->sold_price }}">
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

            <div class="row bg-light rounded-4 p-4 border align-items-center mb-2 mt-4">
                <div class="col-md-4 inputs">
                    <label for="totalAmount" class="form-label fw-bold text-secondary mb-2">إجمالي الفاتورة المطلوب</label>
                    <div class="input-group drop-shadow-sm">
                        <span class="input-group-text bg-white border-2 border-end-0 text-primary py-3">ج.م</span>
                        <input type="number" name="total" id="totalAmount" class="form-control border-start-0 py-3 fw-bold bg-white fs-5" value="0" readonly style="border: 2px solid #dee2e6;">
                    </div>
                </div>
                <div class="col-md-4 inputs">
                    <label for="paidAmount" class="form-label fw-bold text-secondary mb-2">المبلغ المدفوع من العميل</label>
                    <div class="input-group drop-shadow-sm">
                        <span class="input-group-text bg-white border-2 border-end-0 text-success py-3">ج.م</span>
                        <input type="number" name="paid" id="paidAmount" class="form-control border-start-0 py-3 fw-bold fs-5" value="0" min="0" step="0.01" style="border: 2px solid #10b981;">
                    </div>
                </div>
                <div class="col-md-4 inputs">
                    <label for="remainingAmount" class="form-label fw-bold text-secondary mb-2">الباقي (مديونية العميل إذا وجد)</label>
                    <div class="input-group drop-shadow-sm">
                        <span class="input-group-text bg-white border-2 border-end-0 text-danger py-3">ج.م</span>
                        <input type="number" name="remaining" id="remainingAmount" class="form-control border-start-0 py-3 fw-bold bg-white fs-5 text-danger" value="0" readonly style="border: 2px solid #dee2e6;">
                    </div>
                </div>
                
                <div class="col-12 mt-5 text-end">
                    <button type="submit" class="btn rounded-pill px-5 py-3 fw-bold shadow-sm text-white" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); font-size: 1.1rem;">
                        <i class="fa-solid fa-check-double ms-2"></i> حفظ فاتورة المبيعات
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@push("scripts")
<script src="{{asset('assets/js/sale.js')}}"></script>
@endpush
