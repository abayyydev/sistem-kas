</div> <!-- End of Flex Wrapper (Opened in Header) -->
    </div> <!-- End of Main Container (Opened in Header) -->

    <!-- GLOBAL SCRIPTS -->
    <script>
        // Toggle Sidebar Mobile
        const btn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar-menu');
        
        if(btn && sidebar) {
            btn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('flex');
            });
        }

        // Format Rupiah Helper Global
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR', 
                minimumFractionDigits: 0 
            }).format(number);
        };
    </script>
</body>
</html>