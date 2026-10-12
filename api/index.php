<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offria - Petites Annonces au Maroc</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-orange: #FF9500; }
        .bg-orange-main { background-color: var(--primary-orange); }
        .text-orange-main { color: var(--primary-orange); }
        .hover-orange:hover { background-color: #e08300; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

    <!-- Header Navigation -->
    <header class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="#" onclick="showSection('home')" class="flex items-center gap-2 text-2xl font-bold text-gray-900">
                <span class="bg-orange-main text-white p-2 rounded-lg text-lg"><i class="fa-solid fa-tag"></i></span>
                Offria
            </a>

            <nav class="flex items-center gap-4">
                <button onclick="showSection('home')" class="text-gray-600 hover:text-orange-main font-medium">Annonces</button>
                <button onclick="showSection('add-ad')" class="bg-orange-main text-white px-4 py-2 rounded-lg font-medium hover-orange transition">
                    <i class="fa-solid fa-plus mr-1"></i> Déposer une annonce
                </button>
                <button onclick="showSection('admin')" class="text-purple-600 font-semibold border border-purple-200 px-3 py-1.5 rounded-lg bg-purple-50">
                    <i class="fa-solid fa-user-shield mr-1"></i> Admin
                </button>
                <button onclick="showSection('login')" class="text-gray-700 font-medium hover:text-orange-main">Connexion</button>
                <button onclick="showSection('register')" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium">Inscription</button>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 py-6 flex-grow w-full">

        <!-- SECTION 1: HOME & SEARCH (Req 2, 3, 4) -->
        <section id="section-home" class="page-section">
            <!-- Search & Filters Bar -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6 flex flex-wrap gap-3 items-center">
                <div class="flex-grow min-w-[200px]">
                    <input type="text" id="search-input" placeholder="Que cherchez-vous ?" oninput="filterAds()" class="w-full border rounded-lg px-4 py-2 border-gray-300 focus:outline-none focus:border-orange-main">
                </div>
                <div class="w-48">
                    <select id="category-filter" onchange="filterAds()" class="w-full border rounded-lg px-3 py-2 border-gray-300 bg-white">
                        <option value="">Toutes les catégories</option>
                    </select>
                </div>
                <div class="w-48">
                    <select id="city-filter" onchange="filterAds()" class="w-full border rounded-lg px-3 py-2 border-gray-300 bg-white">
                        <option value="">Toutes les villes</option>
                    </select>
                </div>
            </div>

            <!-- Ads List -->
            <h2 class="text-xl font-bold mb-4">Annonces disponibles</h2>
            <div id="ads-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Injected via JavaScript -->
            </div>
        </section>

        <!-- SECTION 2: AD DETAILS & CONTACT (Req 2, 13) -->
        <section id="section-details" class="page-section hidden">
            <button onclick="showSection('home')" class="mb-4 text-gray-600 hover:text-orange-main font-medium">
                &larr; Retour aux annonces
            </button>
            <div class="bg-white border rounded-xl shadow-sm p-6 max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <img id="detail-img" src="" class="w-full h-80 object-cover rounded-lg shadow-sm" alt="Annonce">
                </div>
                <div>
                    <span id="detail-category" class="text-xs font-semibold uppercase text-orange-600 bg-orange-50 px-2 py-1 rounded"></span>
                    <h1 id="detail-title" class="text-2xl font-bold mt-2"></h1>
                    <p id="detail-price" class="text-3xl font-extrabold text-gray-900 mt-2"></p>
                    <p id="detail-city" class="text-sm text-gray-500 mt-1"></p>

                    <div class="mt-4 p-3 bg-gray-50 rounded-lg border text-sm text-gray-700">
                        <p id="detail-desc"></p>
                    </div>

                    <!-- Contact Form -->
                    <div class="mt-6 border-t pt-4">
                        <h3 class="font-bold text-md mb-2">Contacter l'annonceur</h3>
                        <form onsubmit="sendMessage(event)" class="space-y-3">
                            <input type="text" id="msg-name" required placeholder="Votre nom" class="w-full border p-2 rounded text-sm">
                            <input type="email" id="msg-email" required placeholder="Votre e-mail" class="w-full border p-2 rounded text-sm">
                            <textarea id="msg-text" required placeholder="Votre message..." class="w-full border p-2 rounded text-sm h-20"></textarea>
                            <button type="submit" class="w-full bg-orange-main text-white font-medium py-2 rounded-lg hover-orange">Envoyer le message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: POST AN AD (Req 6) -->
        <section id="section-add-ad" class="page-section hidden">
            <div class="bg-white border rounded-xl p-6 max-w-xl mx-auto shadow-sm">
                <h2 class="text-xl font-bold mb-4">Déposer une nouvelle annonce</h2>
                <form onsubmit="handlePostAd(event)" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Titre de l'annonce</label>
                        <input type="text" id="post-title" required class="w-full border p-2 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Prix (DH)</label>
                        <input type="number" id="post-price" required class="w-full border p-2 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Catégorie</label>
                        <select id="post-category" required class="w-full border p-2 rounded-lg bg-white"></select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Ville</label>
                        <select id="post-city" required class="w-full border p-2 rounded-lg bg-white"></select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Chemin de l'image (ex: /images/photo.jpg)</label>
                        <input type="text" id="post-img" value="/images/" required class="w-full border p-2 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea id="post-desc" required class="w-full border p-2 rounded-lg h-28"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-orange-main text-white font-bold py-2 rounded-lg hover-orange">Publier l'annonce</button>
                </form>
            </div>
        </section>

        <!-- SECTION 4: LOGIN VIEW (Req 5) -->
        <section id="section-login" class="page-section hidden">
            <div class="bg-white border rounded-xl p-6 max-w-md mx-auto shadow-sm">
                <h2 class="text-xl font-bold mb-4">Se connecter</h2>
                <form onsubmit="alert('Connexion réussie !'); showSection('home'); return false;" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Adresse email</label>
                        <input type="email" required class="w-full border p-2 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Mot de passe</label>
                        <input type="password" required class="w-full border p-2 rounded-lg">
                    </div>
                    <button type="submit" class="w-full bg-orange-main text-white font-bold py-2 rounded-lg hover-orange">Se connecter</button>
                </form>
            </div>
        </section>

        <!-- SECTION 5: REGISTER VIEW (Req 1) -->
        <section id="section-register" class="page-section hidden">
            <div class="bg-white border rounded-xl p-6 max-w-md mx-auto shadow-sm">
                <h2 class="text-xl font-bold mb-4">Créer un compte</h2>
                <form onsubmit="alert('Compte créé avec succès !'); showSection('home'); return false;" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom complet</label>
                        <input type="text" required class="w-full border p-2 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Adresse email</label>
                        <input type="email" required class="w-full border p-2 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Mot de passe</label>
                        <input type="password" required class="w-full border p-2 rounded-lg">
                    </div>
                    <button type="submit" class="w-full bg-orange-main text-white font-bold py-2 rounded-lg hover-orange">S'inscrire</button>
                </form>
            </div>
        </section>

        <!-- SECTION 6: ADMIN DASHBOARD (Req 7, 8, 9, 10, 11, 12) -->
        <section id="section-admin" class="page-section hidden">
            <div class="space-y-8">
                <h1 class="text-2xl font-bold text-purple-900"><i class="fa-solid fa-user-shield mr-2"></i> Espace Administration</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Manage Cities (Req 7, 8) -->
                    <div class="bg-white p-5 border rounded-xl shadow-sm">
                        <h3 class="font-bold text-lg mb-3">Gestion des Villes</h3>
                        <div class="flex gap-2 mb-4">
                            <input type="text" id="new-city-input" placeholder="Nouvelle ville..." class="border p-2 rounded flex-grow text-sm">
                            <button onclick="addCity()" class="bg-purple-600 text-white px-4 py-2 rounded text-sm font-medium">Ajouter</button>
                        </div>
                        <ul id="admin-cities-list" class="divide-y max-h-48 overflow-y-auto"></ul>
                    </div>

                    <!-- Manage Categories (Req 9, 10) -->
                    <div class="bg-white p-5 border rounded-xl shadow-sm">
                        <h3 class="font-bold text-lg mb-3">Gestion des Catégories</h3>
                        <div class="flex gap-2 mb-4">
                            <input type="text" id="new-cat-input" placeholder="Nouvelle catégorie..." class="border p-2 rounded flex-grow text-sm">
                            <button onclick="addCategory()" class="bg-purple-600 text-white px-4 py-2 rounded text-sm font-medium">Ajouter</button>
                        </div>
                        <ul id="admin-categories-list" class="divide-y max-h-48 overflow-y-auto"></ul>
                    </div>
                </div>

                <!-- Manage Members (Req 11) -->
                <div class="bg-white p-5 border rounded-xl shadow-sm">
                    <h3 class="font-bold text-lg mb-3">Gestion des Membres</h3>
                    <ul id="admin-users-list" class="divide-y max-h-48 overflow-y-auto"></ul>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
            <p>&copy; 2026 Offria - Application Web Statique (OFPPT Digital Development)</p>
        </div>
    </footer>

    <!-- JavaScript Data Logic & Routing -->
    <script>
        // Initial Mock Data configured with local public image paths
        let cities = ["Casablanca", "Rabat", "Tanger", "Marrakech", "Agadir"];
        let categories = ["Automobile", "Immobilier", "Informatique", "Maison & Déco", "Sports & Loisirs"];
        let users = [
            { id: 1, name: "Sarah Bennani", email: "sarah@gmail.com" },
            { id: 2, name: "Omar Amrani", email: "omar@gmail.com" }
        ];
        let ads = [
            {
                id: 1,
                title: "Vélo de ville vintage - Bon état",
                price: 1200,
                category: "Sports & Loisirs",
                city: "Casablanca",
                image: "/images/velo.jpg", // Path pointing to public/images/velo.jpg
                description: "Vélo vert en très bon état. Vendu avec panier avant. À récupérer sur place."
            },
            {
                id: 2,
                title: "PC Portable Lenovo LOQ RTX 3050",
                price: 7500,
                category: "Informatique",
                city: "Tanger",
                image: "/images/pc.jpg", // Path pointing to public/images/pc.jpg
                description: "PC de jeu et développement. Ryzen 5, 16 Go RAM, 1 TB SSD."
            }
        ];

        // Page Navigation
        function showSection(sectionId) {
            document.querySelectorAll('.page-section').forEach(el => el.classList.add('hidden'));
            document.getElementById(`section-${sectionId}`).classList.remove('hidden');
        }

        // Dropdown Population
        function populateDropdowns() {
            const catFilter = document.getElementById('category-filter');
            const cityFilter = document.getElementById('city-filter');
            const postCat = document.getElementById('post-category');
            const postCity = document.getElementById('post-city');

            catFilter.innerHTML = '<option value="">Toutes les catégories</option>';
            cityFilter.innerHTML = '<option value="">Toutes les villes</option>';
            postCat.innerHTML = '';
            postCity.innerHTML = '';

            categories.forEach(c => {
                catFilter.innerHTML += `<option value="${c}">${c}</option>`;
                postCat.innerHTML += `<option value="${c}">${c}</option>`;
            });

            cities.forEach(c => {
                cityFilter.innerHTML += `<option value="${c}">${c}</option>`;
                postCity.innerHTML += `<option value="${c}">${c}</option>`;
            });

            renderAdminLists();
        }

        // Render Ads Grid
        function renderAds(adsToRender = ads) {
            const grid = document.getElementById('ads-grid');
            grid.innerHTML = '';

            if (adsToRender.length === 0) {
                grid.innerHTML = '<p class="text-gray-500 col-span-full text-center py-8">Aucune annonce trouvée.</p>';
                return;
            }

            adsToRender.forEach(ad => {
                grid.innerHTML += `
                    <div class="bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                        <img src="${ad.image}" class="h-48 w-full object-cover" alt="Image">
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-semibold uppercase text-orange-600 bg-orange-50 px-2 py-1 rounded">${ad.category}</span>
                                <h3 class="font-bold text-lg text-gray-900 mt-2 line-clamp-1">${ad.title}</h3>
                                <p class="text-xl font-extrabold text-gray-900 mt-1">${ad.price} <span class="text-sm text-gray-500 font-normal">DH</span></p>
                                <p class="text-xs text-gray-400 mt-1"><i class="fa-solid fa-location-dot mr-1"></i>${ad.city}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t flex justify-between items-center">
                                <button onclick="viewAdDetails(${ad.id})" class="text-orange-main font-semibold text-sm hover:underline">Voir détails &rarr;</button>
                                <button onclick="deleteAd(${ad.id})" class="text-red-500 hover:text-red-700 text-sm"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        // Filter Logic (Req 3, 4)
        function filterAds() {
            const query = document.getElementById('search-input').value.toLowerCase();
            const cat = document.getElementById('category-filter').value;
            const city = document.getElementById('city-filter').value;

            const filtered = ads.filter(ad => {
                const matchesSearch = ad.title.toLowerCase().includes(query);
                const matchesCat = cat === '' || ad.category === cat;
                const matchesCity = city === '' || ad.city === city;
                return matchesSearch && matchesCat && matchesCity;
            });

            renderAds(filtered);
        }

        // View Ad Details
        function viewAdDetails(id) {
            const ad = ads.find(a => a.id === id);
            if (!ad) return;

            document.getElementById('detail-img').src = ad.image;
            document.getElementById('detail-category').innerText = ad.category;
            document.getElementById('detail-title').innerText = ad.title;
            document.getElementById('detail-price').innerText = `${ad.price} DH`;
            document.getElementById('detail-city').innerText = `Ville: ${ad.city}`;
            document.getElementById('detail-desc').innerText = ad.description;

            showSection('details');
        }

        // Post New Ad (Req 6)
        function handlePostAd(e) {
            e.preventDefault();
            const newAd = {
                id: Date.now(),
                title: document.getElementById('post-title').value,
                price: document.getElementById('post-price').value,
                category: document.getElementById('post-category').value,
                city: document.getElementById('post-city').value,
                image: document.getElementById('post-img').value,
                description: document.getElementById('post-desc').value
            };

            ads.unshift(newAd);
            renderAds();
            alert('Annonce publiée avec succès !');
            showSection('home');
        }

        // Delete Ad (Req 12)
        function deleteAd(id) {
            if (confirm("Supprimer cette annonce ?")) {
                ads = ads.filter(a => a.id !== id);
                renderAds();
            }
        }

        // Send Message (Req 13)
        function sendMessage(e) {
            e.preventDefault();
            alert("Message envoyé à l'annonceur avec succès !");
            document.getElementById('msg-text').value = '';
        }

        // Admin Actions (Req 7, 8, 9, 10, 11)
        function addCity() {
            const name = document.getElementById('new-city-input').value.trim();
            if (name) { cities.push(name); document.getElementById('new-city-input').value = ''; populateDropdowns(); }
        }
        function deleteCity(name) {
            cities = cities.filter(c => c !== name); populateDropdowns();
        }
        function addCategory() {
            const name = document.getElementById('new-cat-input').value.trim();
            if (name) { categories.push(name); document.getElementById('new-cat-input').value = ''; populateDropdowns(); }
        }
        function deleteCategory(name) {
            categories = categories.filter(c => c !== name); populateDropdowns();
        }
        function deleteUser(id) {
            users = users.filter(u => u.id !== id); renderAdminLists();
        }

        function renderAdminLists() {
            const citiesList = document.getElementById('admin-cities-list');
            const catList = document.getElementById('admin-categories-list');
            const usersList = document.getElementById('admin-users-list');

            citiesList.innerHTML = cities.map(c => `<li class="py-2 flex justify-between text-sm"><span>${c}</span><button onclick="deleteCity('${c}')" class="text-red-500"><i class="fa-solid fa-trash"></i></button></li>`).join('');
            catList.innerHTML = categories.map(c => `<li class="py-2 flex justify-between text-sm"><span>${c}</span><button onclick="deleteCategory('${c}')" class="text-red-500"><i class="fa-solid fa-trash"></i></button></li>`).join('');
            usersList.innerHTML = users.map(u => `<li class="py-2 flex justify-between text-sm"><span>${u.name} (${u.email})</span><button onclick="deleteUser(${u.id})" class="text-red-500"><i class="fa-solid fa-user-xmark"></i> Supprimer</button></li>`).join('');
        }

        // Initialize on load
        populateDropdowns();
        renderAds();
    </script>
</body>
</html>