<nav class="bg-white shadow flex items-center justify-between px-6 py-4 border-b border-gray-200">
    <div class="flex items-center space-x-4">
        <span class="font-bold text-green-700 text-xl">Admin Panel</span>
    </div>
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.profile') }}" class="text-gray-700 hover:text-green-700 font-semibold">Profil</a>
        <button onclick="confirmLogout()" class="text-red-500 hover:text-red-700 font-semibold">Logout</button>
        
        <!-- Hidden Form untuk Logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Konfirmasi Logout',
        text: 'Apakah Anda yakin ingin keluar dari sistem?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Logout...',
                text: 'Sedang memproses logout',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form logout
            document.getElementById('logout-form').submit();
        }
    });
}
</script>
