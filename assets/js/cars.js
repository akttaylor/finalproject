const cars = [
    { id: 1, name: "Model S", brand: "Tesla", year: 2022, price: 94990, image: "https://via.placeholder.com/300x200", category: "Electric" },
    { id: 2, name: "F-150", brand: "Ford", year: 2023, price: 33695, image: "https://via.placeholder.com/300x200", category: "Truck" },
    { id: 3, name: "Civic", brand: "Honda", year: 2022, price: 22350, image: "https://via.placeholder.com/300x200", category: "Sedan" },
    { id: 4, name: "X5", brand: "BMW", year: 2023, price: 62500, image: "https://via.placeholder.com/300x200", category: "SUV" },
    { id: 5, name: "Mustang", brand: "Ford", year: 2022, price: 27470, image: "https://via.placeholder.com/300x200", category: "Sports" },
    { id: 6, name: "Accord", brand: "Honda", year: 2023, price: 26120, image: "https://via.placeholder.com/300x200", category: "Sedan" },
    { id: 7, name: "Model 3", brand: "Tesla", year: 2022, price: 46990, image: "https://via.placeholder.com/300x200", category: "Electric" },
    { id: 8, name: "Silverado", brand: "Chevrolet", year: 2023, price: 35600, image: "https://via.placeholder.com/300x200", category: "Truck" },
];

const carsGrid = document.getElementById('cars-grid');
const searchInput = document.getElementById('search');
const categorySelect = document.getElementById('category');
const minPriceInput = document.getElementById('min-price');
const maxPriceInput = document.getElementById('max-price');

function renderCars(carsToRender) {
    carsGrid.innerHTML = '';
    carsToRender.forEach(car => {
        const carCard = document.createElement('div');
        carCard.className = 'car-card';
        carCard.innerHTML = `
            <img src="${car.image}" alt="${car.name}" class="car-image">
            <div class="car-details">
                <h2 class="car-name">${car.name}</h2>
                <p class="car-price">$${car.price.toLocaleString()}</p>
                <p class="car-info">${car.brand} - ${car.year}</p>
                <p class="car-info">Category: ${car.category}</p>
            </div>
        `;
        carsGrid.appendChild(carCard);
    });
}

function filterCars() {
    const searchTerm = searchInput.value.toLowerCase();
    const category = categorySelect.value;
    const minPrice = Number(minPriceInput.value) || 0;
    const maxPrice = Number(maxPriceInput.value) || Infinity;

    const filteredCars = cars.filter(car => 
        (car.name.toLowerCase().includes(searchTerm) || car.brand.toLowerCase().includes(searchTerm)) &&
        (category === '' || car.category === category) &&
        car.price >= minPrice && car.price <= maxPrice
    );

    renderCars(filteredCars);
}

searchInput.addEventListener('input', filterCars);
categorySelect.addEventListener('change', filterCars);
minPriceInput.addEventListener('input', filterCars);
maxPriceInput.addEventListener('input', filterCars);

// Initial render
renderCars(cars);