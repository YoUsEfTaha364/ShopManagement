<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>

    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#312e81]">

    <div class="w-full max-w-md p-8 rounded-2xl backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl">

        <!-- Title -->
        <h1 class="text-3xl font-bold text-white text-center mb-2">
            مرحبًا بعودتك
        </h1>

        <p class="text-gray-400 text-center mb-8">
            قم بتسجيل الدخول للوصول إلى لوحة التحكم
        </p>

        <!-- Form -->
        <form method="POST" action="#">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <input type="email"
                       placeholder="البريد الإلكتروني"
                       class="w-full px-4 py-3 rounded-xl bg-[#0f172a] text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <input type="password"
                       placeholder="كلمة المرور"
                       class="w-full px-4 py-3 rounded-xl bg-[#0f172a] text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full py-3 rounded-xl text-white font-semibold bg-gradient-to-r from-blue-500 to-indigo-600 hover:opacity-90 transition">
                تسجيل الدخول
            </button>
        </form>

        <!-- Footer -->
        <p class="text-gray-400 text-center mt-6">
            ليس لديك حساب؟
            <a href="#" class="text-blue-400 hover:underline">إنشاء حساب جديد</a>
        </p>

    </div>

</body>
</html>