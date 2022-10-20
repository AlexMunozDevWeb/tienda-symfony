var map = L.map('map').setView([38.612477, -1.111100], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

var marker = L.marker([38.612477, -1.111100]).addTo(map);

marker.bindPopup("<b class='pin-text'>Ven a visitarnos.</b>").openPopup();