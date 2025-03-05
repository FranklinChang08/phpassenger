function togglePartial() {
    const container = document.getElementById('partial-container');
    container.style.display = (container.style.display === 'none' || !container.style.display)
        ? 'block'
        : 'none';
}

function togglePartial2() {
    const container = document.getElementById('partial-container-2');
    container.style.display = (container.style.display === 'none' || !container.style.display)
        ? 'block'
        : 'none';
}

function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        dropdown.style.maxHeight = dropdown.scrollHeight + "px";
    } else {
        dropdown.style.maxHeight = "0";
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 300); // Matches the transition duration
    }
}

const selectPlane = document.getElementById('id_plane');
const inputKursi = document.getElementById('total_kursi');

selectPlane.addEventListener('change', function () {
    const selectedOption = selectPlane.options[selectPlane.selectedIndex];

    const kapasitas = selectedOption.getAttribute('data-kursi');

    inputKursi.value = `${kapasitas}`;
});


function setDate(day) {
    const dateInput = document.getElementById('date');
    const today = new Date();
    if (day === 'today') {
        dateInput.value = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
    } else if (day === 'tomorrow') {
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        dateInput.value = tomorrow.toISOString().split('T')[0];
    }
}