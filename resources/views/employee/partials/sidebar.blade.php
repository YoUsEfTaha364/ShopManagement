<aside class="sidebar premium-sidebar p-3" dir="rtl">
    <!-- Logo -->
    <div class="text-center py-4 mb-4 border-bottom border-secondary border-opacity-25">
        <h4 class="fw-bold m-0 d-flex align-items-center justify-content-center gap-2">
            <div class="bg-primary bg-gradient rounded p-2 text-white shadow-sm d-flex align-items-center justify-content-center" style="width:40px;height:40px">
                <i class="fa-solid fa-store fs-5"></i>
            </div>
            <span>إدارة المتجر</span>
        </h4>
    </div>

    <!-- Navigation -->
    <nav class="nav flex-column gap-2">
        <a href="{{ route('admin') }}" class="nav-link premium-sidebar-link">
            <i class="fas fa-shield-halved me-3 w-20px text-center"></i> لوحة التحكم (أدمن)
        </a>
        <a href="{{ route('home.index') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('home.index') ? 'active' : '' }}">
            <i class="fas fa-house me-3 w-20px text-center"></i> الرئيسية
        </a>
        <a href="{{ route('category.index') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('category.index') ? 'active' : '' }}">
            <i class="fas fa-layer-group me-3 w-20px text-center"></i> أنواع الموتوسيكلات
        </a>
        <a href="{{ route('product.index') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
            <i class="fas fa-boxes-stacked me-3 w-20px text-center"></i> البضائع والمنتجات
        </a>
        <a href="{{ route('sales.create') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('sales.create') ? 'active' : '' }}">
            <i class="fa-solid fa-file-invoice-dollar me-3 w-20px text-center"></i> إنشاء فاتورة
        </a>
        <a href="{{ route('sales.index') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('sales.index') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line me-3 w-20px text-center"></i> إدارة المبيعات
        </a>
        <a href="{{ route('purchase.create') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('purchase.create') ? 'active' : '' }}">
            <i class="fa-solid fa-cart-flatbed me-3 w-20px text-center"></i> إضافة مشتريات
        </a>
        <a href="{{ route('purchase.index') }}" class="nav-link premium-sidebar-link {{ request()->routeIs('purchase.index') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-list me-3 w-20px text-center"></i> سجل المشتريات
        </a>
    </nav>
</aside>

<style>
    .premium-sidebar {
        width: 280px; 
        min-height: 100vh;
        background: #111827; 
        color: white;
        box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        z-index: 1000;
        position: fixed;
        right: 0;
        top: 0;
        overflow-y: auto;
    }
    .w-20px { width: 22px; font-size: 1.1rem; }
    
    .premium-sidebar-link {
        color: #9ca3af; 
        font-weight: 600;
        border-radius: 12px;
        padding: 0.9rem 1.25rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        font-size: 1.05rem;
    }
    .premium-sidebar-link:hover {
        background: rgba(255,255,255,0.05);
        color: white;
        transform: translateX(-5px);
    }
    .premium-sidebar-link.active {
        background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
    }
</style>
