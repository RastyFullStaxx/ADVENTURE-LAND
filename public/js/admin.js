// public/js/admin.js

// Toggles visibility of units and dimension fields based on selected category
function toggleFields() {
    const select = document.getElementById('categorySelect');
    if (!select) return;

    const selectedOption = select.options[select.selectedIndex];
    let categoryName = selectedOption.dataset.name;

    // Fallback: use visible text if data-name is missing
    categoryName = (categoryName || selectedOption.text).toLowerCase().trim();

    const dimensionField = document.getElementById('dimensionField');
    const unitsField = document.getElementById('unitsField');

    if (categoryName === 'package' || categoryName === 'packages') {
        dimensionField?.classList.add('d-none');
        unitsField?.classList.remove('d-none');
    } else {
        dimensionField?.classList.remove('d-none');
        unitsField?.classList.add('d-none');
    }
}

// Called when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    toggleFields();

    const categorySelect = document.getElementById('categorySelect');
    if (categorySelect) {
        categorySelect.addEventListener('change', toggleFields);
    }
});

/**
 * SweetAlert confirmation for delete buttons.
 * Works for both products and categories.
 */
function confirmDelete(itemId, isCategory = false) {
    const label = isCategory ? 'category' : 'product';
    Swal.fire({
        title: `Are you sure?`,
        text: `This will permanently delete the ${label}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: `Yes, delete it!`
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${itemId}`).submit();
        }
    });
}

/**
 * SweetAlert confirmation for canceling a form.
 * Used in create/edit forms.
 */
function confirmCancel(redirectUrl) {
    Swal.fire({
        title: 'Discard changes?',
        text: "All unsaved progress will be lost.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, go back',
        cancelButtonText: 'Stay here'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = redirectUrl;
        }
    });
}
