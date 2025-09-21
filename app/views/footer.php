<footer class="relative mt-auto bg-[#5D726F] bg-opacity-90 backdrop-blur-md text-[#DCDED6] 
               shadow-inner py-6 px-4 text-center animate__animated animate__fadeInUp">

    <!-- Ligne décorative -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-[#CED0C3] rounded-full mb-4"></div>

    <!-- Contenu principal -->
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-4">

        <!-- Logo / Nom entreprise -->
        <div class="flex items-center gap-2 text-lg font-semibold tracking-wide">
            <i class="bi bi-flower3 text-xl text-[#DCDED6]"></i>
            MonEntreprise Paysagiste
        </div>

        <!-- Liens -->
        <div class="flex gap-6 text-sm">
            <a href="/contact" class="hover:text-white transition flex items-center gap-1">
                <i class="bi bi-envelope-fill"></i> Contact
            </a>
            <a href="/privacy" class="hover:text-white transition flex items-center gap-1">
                <i class="bi bi-shield-lock-fill"></i> Politique de confidentialité
            </a>
        </div>

        <!-- Copyright -->
        <div class="text-xs md:text-sm opacity-80">
            &copy; <?= date('Y') ?> MonEntreprise. Tous droits réservés.
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
