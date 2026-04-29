<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include("employee.partials.head-html")
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            font-family: 'Inter', 'Tajawal', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        /* Abstract shapes */
        .shape {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
        }
        .shape-1 {
            width: 400px;
            height: 400px;
            background: rgba(14, 165, 233, 0.4); /* Sky blue */
            top: -100px;
            left: -100px;
            border-radius: 50%;
        }
        .shape-2 {
            width: 500px;
            height: 500px;
            background: rgba(16, 185, 129, 0.3); /* Emerald */
            bottom: -150px;
            right: -100px;
            border-radius: 50%;
        }

        .auth-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 480px;
            z-index: 1;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-header h1 {
            color: #f8fafc;
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: #94a3b8;
            font-size: 1rem;
        }

        .form-floating > label {
            padding: 1rem;
            color: #94a3b8;
            transition: all 0.2s ease-in-out;
        }

        .form-floating > .form-control {
            height: 3.5rem;
            padding: 1rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #f8fafc;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-floating > .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #10b981;
            transform: scale(0.85) translateY(-0.75rem) translateX(0.5rem);
            background: transparent;
        }

        .btn-auth {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.5);
            color: white;
        }

        .auth-links {
            text-align: center;
            margin-top: 2rem;
            color: #94a3b8;
        }

        .auth-links a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .auth-links a:hover {
            color: #34d399;
            text-decoration: underline;
        }

        .swal2-popup {
            background: #1e293b !important;
            color: #f8fafc !important;
        }
        .swal2-title { color: #f8fafc !important; }
    </style>
    @section('header-title', 'إنشاء حساب جديد')
</head>
<body>

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <div class="auth-card">
        <div class="auth-header">
            <h1>انضم إلينا</h1>
            <p>أنشئ حسابك الجديد للبدء</p>
        </div>

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'نجاح!',
                        text: '{{ session("success") }}',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                });
            </script>
        @endif
        @if(session('error') || $errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ!',
                        text: '{{ session("error") ?? $errors->first() }}',
                        timer: 4000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                });
            </script>
        @endif

        <form action="{{ route("employee.register") }}" method="POST">
            @csrf
            
            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                <label for="name">الاسم الكامل</label>
            </div>

            <div class="form-floating mb-4">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                <label for="email">البريد الإلكتروني</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">كلمة المرور</label>
            </div>

            <button class="btn btn-auth" type="submit">إنشاء الحساب</button>
        </form>

        <div class="auth-links">
            <p>لديك حساب بالفعل؟ <a href="{{ route("employee.show.login") }}">تسجيل الدخول</a></p>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</body>
</html>
