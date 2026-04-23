document.addEventListener("DOMContentLoaded", () => {
    let updateBtns = document.querySelectorAll(".update-btn");
    let updateForm = document.getElementById("updateForm");
    
    updateBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let id = btn.dataset.id;
            let name = btn.dataset.name;
            let price = btn.dataset.price;
            
            document.getElementById('u_name').value = name;
            document.getElementById('u_price').value = price;
            
            updateForm.action = "/product/update/" + id;
        });
    });

    let percentBtn = document.querySelector(".addPercent");
    if(percentBtn) {
        percentBtn.addEventListener("click", () => {
            Swal.fire({
                title: 'زيادة نسبة الأسعار',
                text: 'أدخل نسبة الزيادة للأسعار (مثال: 10)',
                input: 'number',
                inputAttributes: {
                    min: 1,
                    max: 100,
                    step: 1
                },
                showCancelButton: true,
                confirmButtonText: 'تطبيق الزيادة',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    window.location.href = `/product/increase-percent?value=${result.value}`;
                }
            });
        });
    }
});
