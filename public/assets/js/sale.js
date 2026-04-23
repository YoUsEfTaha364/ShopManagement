document.addEventListener("DOMContentLoaded", () => {
    let index = 1;
    let itemsTableBody = document.querySelector("#itemsTable tbody");
    
    // Get the initial options from the first select to avoid blade directives in JS
    let initialSelect = document.querySelector(".product-select");
    let optionsHtml = initialSelect ? initialSelect.innerHTML : '<option value="">-- اختار منتج --</option>';

    let addRowBtn = document.querySelector("#addRow");
    if(addRowBtn) {
        addRowBtn.addEventListener("click", () => {
            let newRow = document.createElement("tr");

            newRow.innerHTML = `
                <td>
                    <select required class="form-select premium-input product-select" name='items[${index}][product_id]'>
                        ${optionsHtml}
                    </select>
                </td>
                <td><input type="number" name="items[${index}][quantity]" value="1" min="1" class="form-control premium-input quantity text-center"></td>
                <td class="price"><input type="number" name="items[${index}][price]" value="0.00" class="form-control premium-input input-price text-center" step="0.01"></td>
                <td><input type="number" name="items[${index}][subtotal]" value="0.00" class="form-control premium-input subtotal text-center text-success fw-bold bg-white" readonly></td>
                <td><button type="button" class="btn btn-danger rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm remove-item" style="width: 35px; height: 35px;"><i class="fa-solid fa-trash fs-6"></i></button></td>
            `;

            itemsTableBody.appendChild(newRow);
            index++;
            updateTotals();
        });
    }

    if(itemsTableBody) {
        itemsTableBody.addEventListener("click", (e) => {
            let removeBtn = e.target.closest(".remove-item");
            if (removeBtn) {
                if (itemsTableBody.querySelectorAll("tr").length > 1) {
                    removeBtn.closest("tr").remove();
                    updateTotals();
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('تنبيه', 'يجب أن تحتوي الفاتورة على منتج واحد على الأقل.', 'warning');
                    } else {
                        alert('يجب أن تحتوي الفاتورة على منتج واحد على الأقل.');
                    }
                }
            }
        });
    }

    let itemsTable = document.getElementById("itemsTable");
    if(itemsTable) {
        // We use event delegation since rows are dynamically added
        itemsTable.addEventListener("change", (e) => {
            if (e.target.classList.contains("product-select")) {
                let row = e.target.closest("tr");
                let priceInput = row.querySelector(".input-price");
                let selectedOption = e.target.options[e.target.selectedIndex];
                
                if(selectedOption && selectedOption.dataset.price) {
                    priceInput.value = parseFloat(selectedOption.dataset.price).toFixed(2);
                } else {
                    priceInput.value = "0.00";
                }
                updateTotals();
            } else {
                updateTotals();
            }
        });

        itemsTable.addEventListener("input", (e) => {
            updateTotals();
        });
    }
    
    let paidAmount = document.getElementById("paidAmount");
    if(paidAmount) {
        paidAmount.addEventListener("input", updateTotals);
    }

    function updateTotals() {
        let total = 0;
        let rows = document.querySelectorAll("#itemsTable tbody tr");
        
        rows.forEach(row => {
            let priceInput = row.querySelector(".input-price");
            let quantityInput = row.querySelector(".quantity");
            let subtotalInput = row.querySelector(".subtotal");
            
            let price = parseFloat(priceInput.value) || 0;
            let qty = parseInt(quantityInput.value) || 0;
            
            let subtotal = price * qty;
            if(subtotalInput) subtotalInput.value = subtotal.toFixed(2);
            
            total += subtotal;
        });

        let totalAmount = document.getElementById("totalAmount");
        let pAmount = document.getElementById("paidAmount");
        let remainingAmount = document.getElementById("remainingAmount");
        
        if(totalAmount) totalAmount.value = total.toFixed(2);
        
        let paid = pAmount ? (parseFloat(pAmount.value) || 0) : 0;
        let remaining = total - paid;
        
        if(remainingAmount) remainingAmount.value = remaining >= 0 ? remaining.toFixed(2) : 0;
    }
});