document.addEventListener('DOMContentLoaded', function() {
    const itemsContainer = document.getElementById('invoice_items');
    if (!itemsContainer) return;

    const prototype = itemsContainer.getAttribute('data-prototype');
    let index = parseInt(itemsContainer.getAttribute('data-index'), 10);

    document.getElementById('add-item').addEventListener('click', function() {
        if (!prototype) return;

        const newForm = prototype.replace(/__name__/g, index);
        index++;
        itemsContainer.setAttribute('data-index', index);

        const newDiv = document.createElement('div');
        newDiv.classList.add('item-row');
        newDiv.innerHTML = newForm + '<button type="button" class="btn btn-danger remove-item">-</button>';
        itemsContainer.appendChild(newDiv);
    });

    itemsContainer.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-item')) {
            event.target.closest('.item-row').remove();
        }
    });
});