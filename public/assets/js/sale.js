document.addEventListener("DOMContentLoaded", () => {
    let index = 1;
    let itemsTableBody = document.querySelector("#itemsTable tbody");

    // Capture the product options HTML once from the initial select (avoids duplicating Blade logic in JS)
    let initialSelect = document.querySelector(".product-select");
    let optionsHtml = initialSelect ? initialSelect.innerHTML : '<option value="">-- اختار منتج --</option>';

    // ── Add new product row ──────────────────────────────────────────────────
    let addRowBtn = document.querySelector("#addRow");
    if (addRowBtn) {
        addRowBtn.addEventListener("click", () => {
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>
                    <select required class="form-select premium-input product-select" name="items[${index}][product_id]">
                        ${optionsHtml}
                    </select>
                </td>
                <td><input type="number" name="items[${index}][quantity]" value="1" min="1" class="form-control premium-input quantity text-center"></td>
                <td class="price"><input type="number" name="items[${index}][price]" value="0.00" class="form-control premium-input input-price text-center" step="0.01"></td>
                <td><input type="number" name="items[${index}][subtotal]" value="0.00" class="form-control premium-input subtotal text-center text-success fw-bold bg-white" readonly></td>
                <td><button type="button" class="btn btn-danger rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm remove-item" style="width:35px;height:35px;"><i class="fa-solid fa-trash fs-6"></i></button></td>
            `;
            itemsTableBody.appendChild(newRow);
            index++;
            updateTotals();
        });
    }

    // ── Remove a product row ─────────────────────────────────────────────────
    if (itemsTableBody) {
        itemsTableBody.addEventListener("click", (e) => {
            let removeBtn = e.target.closest(".remove-item");
            if (removeBtn) {
                if (itemsTableBody.querySelectorAll("tr").length > 1) {
                    removeBtn.closest("tr").remove();
                    updateTotals();
                } else {
                    if (typeof Swal !== "undefined") {
                        Swal.fire("تنبيه", "يجب أن تحتوي الفاتورة على منتج واحد على الأقل.", "warning");
                    } else {
                        alert("يجب أن تحتوي الفاتورة على منتج واحد على الأقل.");
                    }
                }
            }
        });
    }

    // ── Auto-fill price when a product is selected ───────────────────────────
    let itemsTable = document.getElementById("itemsTable");
    if (itemsTable) {
        itemsTable.addEventListener("change", (e) => {
            if (e.target.classList.contains("product-select")) {
                let row = e.target.closest("tr");
                let priceInput = row.querySelector(".input-price");
                let selectedOption = e.target.options[e.target.selectedIndex];
                priceInput.value = (selectedOption && selectedOption.dataset.price)
                    ? parseFloat(selectedOption.dataset.price).toFixed(2)
                    : "0.00";
            }
            updateTotals();
        });

        itemsTable.addEventListener("input", () => updateTotals());
    }

    // ── Listen for changes in paid amount and global discount ────────────────
    let paidAmountEl = document.getElementById("paidAmount");
    if (paidAmountEl) {
        paidAmountEl.addEventListener("input", updateTotals);
    }
    
    let discountAmountEl = document.getElementById("discountAmount");
    if (discountAmountEl) {
        discountAmountEl.addEventListener("input", updateTotals);
    }

    // ── Core calculation ─────────────────────────────────────────────────────
    function updateTotals() {
        let subtotal = 0;

        // 1. Sum each row: subtotal = price × quantity
        let rows = document.querySelectorAll("#itemsTable tbody tr");
        if (rows) {
            rows.forEach(row => {
                let priceInput = row.querySelector(".input-price");
                let qtyInput = row.querySelector(".quantity");
                
                let price = priceInput ? (parseFloat(priceInput.value) || 0) : 0;
                let qty   = qtyInput ? (parseInt(qtyInput.value) || 0) : 0;
                let rowTotal = price * qty;

                let subtotalInput = row.querySelector(".subtotal");
                if (subtotalInput) subtotalInput.value = rowTotal.toFixed(2);

                subtotal += rowTotal;
            });
        }

        // 2. Show the pre-discount subtotal
        let subtotalAmountEl = document.getElementById("subtotalAmount");
        if (subtotalAmountEl) subtotalAmountEl.value = subtotal.toFixed(2);

        // 3. Apply global discount → final total (never below 0)
        let discountEl = document.getElementById("discountAmount");
        let discount = discountEl ? (parseFloat(discountEl.value) || 0) : 0;
        let total = Math.max(subtotal - discount, 0);

        let totalAmountEl = document.getElementById("totalAmount");
        if (totalAmountEl) totalAmountEl.value = total.toFixed(2);

        // 4. Remaining = total − paid (never below 0)
        let paidEl = document.getElementById("paidAmount");
        let paid = paidEl ? (parseFloat(paidEl.value) || 0) : 0;
        let remaining = Math.max(total - paid, 0);

        let remainingEl = document.getElementById("remainingAmount");
        if (remainingEl) remainingEl.value = remaining.toFixed(2);
    }

    // Call updateTotals initially to correctly set read-only fields on page load
    updateTotals();
});
