<?php
include '../assets/partials/header.php';
include '../assets/partials/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taylor Automobile - Our Cars</title>
    <link rel="stylesheet" href="../assets/css/cars.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
<div class="loader">
        <div class="loader-content">
            <svg width="100" height="100" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke="#007bff" stroke-width="8" fill="none" />
                <polygon points="40,30 65,50 40,70" fill="#007bff" />
            </svg>
            <p>Taylor Automobile</p>
        </div>
    </div>
<?php renderHeader(); ?>
    <main class="cars-container">
        <h1>Our Car Collection</h1>
        
        <div class="filters">
            <input type="text" id="search" class="search-input" placeholder="Search cars...">
            <select id="category" class="filter-select">
                <option value="">All Categories</option>
                <option value="Sedan">Sedan</option>
                <option value="SUV">SUV</option>
                <option value="Sports">Sports</option>
                <option value="Electric">Electric</option>
                <option value="Truck">Truck</option>
            </select>
            <div class="price-range">
                <input type="number" id="min-price" class="price-input" placeholder="Min Price">
                <span>to</span>
                <input type="number" id="max-price" class="price-input" placeholder="Max Price">
            </div>
        </div>

        <div class="cars-grid" id="cars-grid">
        </div>
    </main>
    <?php renderFooter(); ?>
    <script src="../assets/js/cars.js"></script>
    <script src="../assets/js/index.js"></script>
    <script src="../assets/js/loader.js"></script>
</body>
</html>