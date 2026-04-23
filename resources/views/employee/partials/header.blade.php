<header class="modern-header d-flex justify-content-between align-items-center p-3 mb-4 dropdown-container" dir="rtl">

    <!-- Search Bar -->
    <div class="search-wrapper d-flex align-items-center">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" class="form-control search-input" placeholder="... بحث في النظام">
        <div class="shortcut-box">⌘F</div>
    </div>

    <!-- Icons + User -->
    <div class="d-flex align-items-center gap-3">

        <!-- Email Dropdown -->
        <div class="dropdown">
            <button class="icon-btn dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa-regular fa-envelope"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm premium-dropdown border-0">
                <li><h6 class="dropdown-header text-primary fw-bold">الرسائل</h6></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square ms-2 text-muted"></i> رسالة جديدة</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-inbox ms-2 text-muted"></i> علبة الوارد</a></li>
            </ul>
        </div>

        <!-- Notification Dropdown -->
        <div class="dropdown">
            <button class="icon-btn dropdown-toggle position-relative" data-bs-toggle="dropdown">
                <i class="fa-regular fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm premium-dropdown border-0">
                <li><h6 class="dropdown-header text-primary fw-bold">الإشعارات</h6></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-circle-exclamation ms-2 text-warning"></i> إشعار جديد</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bullhorn ms-2 text-info"></i> تحديثات النظام</a></li>
            </ul>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown ms-2 ps-2 border-start">
            <div class="d-flex align-items-center user-info dropdown-toggle" data-bs-toggle="dropdown" style="cursor: pointer;">
                <div class="ms-2 text-end">
                    <div class="fw-bold text-dark fs-6" style="line-height: 1;">المدير العام</div>
                    <small class="text-muted" style="font-size: 0.8rem;">admin@shop.com</small>
                </div>
                <div class="rounded-circle bg-primary bg-gradient ms-2 d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width:42px;height:42px; border: 2px solid white;">
                    م
                </div>
            </div>

            <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm premium-dropdown border-0 mt-2">
                <li><h6 class="dropdown-header text-primary fw-bold">الحساب الخـاص بي</h6></li>
                <li><a class="dropdown-item" href="#"><i class="fa-regular fa-user ms-2"></i> الملف الشخصي</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear ms-2"></i> الإعدادات</a></li>
                <li><hr class="dropdown-divider"></li>

                {{-- Logout --}}
                <li>
                    <form action="#" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger fw-bold"><i class="fa-solid fa-arrow-right-from-bracket ms-2"></i> تسجيل الخروج</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</header>


<style>
.modern-header {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(12px);
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}

/* Search bar */
.search-wrapper {
    background: #f8fafc;
    padding: 8px 16px;
    border-radius: 12px;
    width: 350px;
    position: relative;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}
.search-wrapper:focus-within {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.search-input {
    border: none;
    background: transparent !important;
    box-shadow: none !important;
    padding-right: 30px;
}

.search-input:focus {
    outline: none !important;
}

.search-icon {
    position: absolute;
    right: 14px;
    color: #94a3b8;
}

.shortcut-box {
    background: #f1f5f9;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
}

/* Icons */
.icon-btn {
    background: transparent;
    width: 42px;
    height: 42px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #475569;
    transition: all 0.3s ease;
}

.icon-btn:hover {
    background: #f1f5f9;
    color: #6366f1;
    border-color: #cbd5e1;
}

/* Dropdown tweaks */
.dropdown-toggle::after {
    display: none;
}
.premium-dropdown {
    border-radius: 16px;
    padding: 0.8rem 0;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1) !important;
    min-width: 200px;
}
.premium-dropdown .dropdown-item {
    padding: 0.6rem 1.25rem;
    font-weight: 500;
    color: #475569;
    transition: all 0.2s;
}
.premium-dropdown .dropdown-item:hover {
    background: #f8fafc;
    color: #6366f1;
    padding-right: 1.5rem;
}
</style>
