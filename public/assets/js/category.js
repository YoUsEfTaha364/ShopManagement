document.addEventListener("DOMContentLoaded", () => {
    let updateBtns = document.querySelectorAll(".update-btn");
    
    updateBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let id = btn.dataset.id;
            let name = btn.dataset.name;
            
            document.getElementById('u_id').value = id;
            document.getElementById('u_name').value = name;
        });
    });
});
