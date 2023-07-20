let nameInput = document.getElementById('name');
let minPriceInput = document.getElementById('min_price');
let maxPriceInput = document.getElementById('max_price');
let minMileageInput = document.getElementById('min_mileage');
let maxMileageInput = document.getElementById('max_mileage');
let sortSelect = document.getElementById('sort');
let cardList = document.querySelector('.card-list');

let cards = document.querySelectorAll('.feature-card');

maxPriceInput.value = Infinity;  // initialisation du prix maximum à l'infini

maxMileageInput.value = Infinity;  // initialisation du kilométrage maximum à l'infini

function filterCards() {
    let name = nameInput.value.toLowerCase();
    let minPrice = Number(minPriceInput.value);
    let maxPrice = Number(maxPriceInput.value);
    let minMileage = Number(minMileageInput.value);
    let maxMileage = Number(maxMileageInput.value);

    for (let card of cards) {
        let cardName = card.querySelector('.feature-card-title').textContent.toLowerCase();
        let cardDescription = card.querySelector('.feature-card-description').textContent.toLowerCase();
        let cardMileage = Number(card.querySelector('.feature-card-mileage').textContent.split(' ')[0]);
        let cardPrice = Number(card.querySelector('.feature-card-price').textContent);

        if ((cardName.includes(name) || cardDescription.includes(name))
            && cardPrice >= minPrice
            && (maxPriceInput.value === '' || cardPrice <= maxPrice)
            && cardMileage >= minMileage
            && (maxMileageInput.value === '' || cardMileage <= maxMileage)
        ) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    }
}


function sortCards() {
    let sortOption = sortSelect.value;
    switch (sortOption) {
        case 'asc-price':
            sortAscendingBy('price');
            break;
        case 'desc-price':
            sortDescendingBy('price');
            break;
        case 'asc-mileage':
            sortAscendingBy('mileage');
            break;
        default:
            let cardsArray = Array.from(cards);
            cardsArray.forEach(card => cardList.appendChild(card));
            break;
    }
}

function sortAscendingBy(sortBy) {
    let cardsArray = Array.from(cards);
    cardsArray.sort((a, b) => {
        let valueA = getProperty(a, sortBy);
        let valueB = getProperty(b, sortBy);
        return valueA - valueB;
    });

    cardsArray.forEach(card => cardList.appendChild(card));
}

function sortDescendingBy(sortBy) {
    let cardsArray = Array.from(cards);

    cardsArray.sort((a, b) => {
        let valueA = getProperty(a, sortBy);
        let valueB = getProperty(b, sortBy);
        return valueB - valueA;
    });

    cardsArray.forEach(card => cardList.appendChild(card));
}

function getProperty(card, property) {
    switch (property) {
        case 'price':
            return Number(card.querySelector('.feature-card-price').textContent);
        case 'mileage':
            return Number(card.querySelector('.feature-card-mileage').textContent.split(' ')[0]);
        default:
            return 0;
    }
}
nameInput.addEventListener('input', filterCards);
minPriceInput.addEventListener('input', filterCards);
maxPriceInput.addEventListener('input', filterCards);
minMileageInput.addEventListener('input', filterCards);
maxMileageInput.addEventListener('input', filterCards);
sortSelect.addEventListener('change', sortCards);