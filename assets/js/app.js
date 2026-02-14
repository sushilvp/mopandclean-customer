// MopAndClean Customer App - JavaScript

document.addEventListener('DOMContentLoaded', function() {

    // Auto-calculate booking costs
    const calcFields = document.querySelectorAll('.calc-field');
    if (calcFields.length > 0) {
        calcFields.forEach(function(field) {
            field.addEventListener('input', calculateTotals);
        });
        calculateTotals();
    }

    function calculateTotals() {
        // Sqft calculation
        var sqft = parseFloat(document.getElementById('sqft').value) || 0;
        var sqftCost = parseFloat(document.getElementById('sqft_cost').value) || 0;
        var subTotal = sqft * sqftCost;
        document.getElementById('sub_total').value = subTotal.toFixed(2);

        // Sofa calculation
        var sofa = parseFloat(document.getElementById('sofa').value) || 0;
        var sofaCost = parseFloat(document.getElementById('sofa_cost').value) || 0;
        var subTotal1 = sofa * sofaCost;
        document.getElementById('sub_total1').value = subTotal1.toFixed(2);

        // Others calculation
        var others = parseFloat(document.getElementById('others').value) || 0;
        var othersCost = parseFloat(document.getElementById('others_cost').value) || 0;
        var subTotal2 = others * othersCost;
        document.getElementById('sub_total2').value = subTotal2.toFixed(2);

        // Total
        var total = subTotal + subTotal1 + subTotal2;
        document.getElementById('total_cost').value = total.toFixed(2);
        document.getElementById('total_display').textContent = '$' + total.toFixed(2);
    }

    // Set minimum date for date picker to today
    var dateInput = document.getElementById('assigned_date');
    if (dateInput && !dateInput.value) {
        var today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
});
