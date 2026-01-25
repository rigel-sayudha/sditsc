<!-- Step 1: Form Data Diri -->
<form action="{{ route('pendaftaran.store') }}?step=2" method="POST" class="space-y-8" enctype="multipart/form-data">
    @csrf
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 hover-card fade-in">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Biodata Siswa
        </h2>
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="nik">NIK (Nomor Induk Kependudukan)</label>
                <input type="number" id="nik" name="nik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required min="1000000000000000" max="9999999999999999" placeholder="16 digit angka">
                <span class="text-xs text-gray-500">Masukkan 16 digit NIK dari KTP/Kartu Keluarga</span>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="tempat_tanggal_lahir">Tempat, Tanggal Lahir</label>
                <div class="flex flex-col md:flex-row md:space-x-4">
                    <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-2 md:mb-0" required>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                <div class="flex space-x-4">
                   <label class="inline-flex items-center">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-radio text-blue-600" required>
                        <span class="ml-2">Laki-laki</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-blue-600" required>
                        <span class="ml-2">Perempuan</span>
                    </label>
                  <!-- <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required> 
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select> -->
                </div>
            </div>
            <div>
                 <!--<label class="block text-gray-700 font-medium mb-2" for="agama">Agama</label>
                  <select id="agama" name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required> 
                    <option value="Islam">Islam</option>
                </select> -->
                <input type="hidden" id="agama" name="agama" value="Islam" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" readonly> 
            </div>
            <!-- No. Telepon siswa dihapus -->
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="asal_sekolah">Asal Sekolah</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="file_kk">Upload Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                <input type="file" id="file_kk" name="file_kk" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-white">
                <span class="text-xs text-gray-500">Format: JPG, PNG, atau PDF. Maksimal 2MB. (Optional untuk testing)</span>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="file_akta">Upload Akta Kelahiran <span class="text-red-500">*</span></label>
                <input type="file" id="file_akta" name="file_akta" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-white">
                <span class="text-xs text-gray-500">Format: JPG, PNG, atau PDF. Maksimal 2MB. (Optional untuk testing)</span>
            </div>
        </div>
    </div>

    <!-- Data Orang Tua Kandung -->
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 hover-card fade-in">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h1l1 2h13l1-2h1M5 20h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/>
            </svg>
            Data Orang Tua Kandung
        </h2>
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="nama_ayah">Nama Lengkap Ayah</label>
                <input type="text" id="nama_ayah" name="nama_ayah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="nama_ibu">Nama Lengkap Ibu</label>
                <input type="text" id="nama_ibu" name="nama_ibu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="alamat_ortu">Alamat Orang Tua</label>
                <textarea id="alamat_ortu" name="alamat_ortu" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="telepon_ortu">Telepon Orang Tua</label>
                <input type="number" id="telepon_ortu" name="telepon_ortu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required min="1000000000" max="99999999999999" placeholder="08123456789">
                <span class="text-xs text-gray-500">Contoh: 08123456789</span>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="pekerjaan_ayah">Pekerjaan Ayah</label>
                <select id="pekerjaan_ayah" name="pekerjaan_ayah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required>
                    <option value="">Pilih Pekerjaan</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                    <option value="Buruh">Buruh</option>
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                </select>
            </div>
                  <div>
                <label class="block text-gray-700 font-medium mb-2" for="penghasilan_ayah">Penghasilan Ayah (per bulan)</label>
                <select id="penghasilan_ayah" name="penghasilan_ayah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required>
                    <option value="">Pilih Penghasilan</option>
                    <option value="<1.000.000">< 1.000.000</option>
                    <option value="1.000.000-1.999.999">1.000.000 - 1.999.999</option>
                    <option value="2.000.000-4.999.999">2.000.000 - 4.999.999</option>
                    <option value=">=5.000.000">&ge; 5.000.000</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="pekerjaan_ibu">Pekerjaan Ibu</label>
                <select id="pekerjaan_ibu" name="pekerjaan_ibu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required>
                    <option value="">Pilih Pekerjaan</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Buruh">Buruh</option>
                    <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="penghasilan_ibu">Penghasilan Ibu (per bulan)</label>
                <select id="penghasilan_ibu" name="penghasilan_ibu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required>
                    <option value="">Pilih Penghasilan</option>
                    <option value="<1.000.000">< 1.000.000</option>
                    <option value="1.000.000-1.999.999">1.000.000 - 1.999.999</option>
                    <option value="2.000.000-4.999.999">2.000.000 - 4.999.999</option>
                    <option value=">=5.000.000">&ge; 5.000.000</option>
                </select>
            </div>
            <div>
                <input type="hidden" id="status_pip" name="status_pip" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" readonly placeholder="Akan terisi otomatis" />
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 hover-card fade-in">
        <label class="inline-flex items-center space-x-3 cursor-pointer">
            <input type="checkbox" id="memiliki_wali" name="memiliki_wali" class="form-checkbox text-purple-600" />
            <span class="text-gray-700 font-medium">Memiliki Wali?</span>
        </label>
    </div>

    <div id="form_wali" class="bg-white rounded-xl shadow-lg p-6 md:p-8 hover-card fade-in hidden">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.5a11.952 11.952 0 01-6.825-3.443 12.083 12.083 0 01.665-6.479L12 14z"/>
            </svg>
            Data Orang Tua Wali
        </h2>
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="nama_wali">Nama Lengkap</label>
                <input type="text" id="nama_wali" name="nama_wali" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="alamat_wali">Alamat</label>
                <textarea id="alamat_wali" name="alamat_wali" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="no_telp_wali">Nomor Telepon</label>
                <input type="number" id="no_telp_wali" name="no_telp_wali" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent" min="1000000000" max="99999999999999" placeholder="08123456789">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2" for="pekerjaan_wali">Pekerjaan Wali</label>
                <select id="pekerjaan_wali" name="pekerjaan_wali" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                    <option value="">Pilih Pekerjaan</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Buruh">Buruh</option>
                    <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                </select>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 fade-in">
        <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300" onclick="console.log('Form submit clicked'); return true;">
            Lanjut ke Jadwal Tes
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Debug form submission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            console.log('Form submission event triggered');
            console.log('Form action:', this.action);
            console.log('Form method:', this.method);
            
            // Check required fields
            const requiredFields = this.querySelectorAll('[required]');
            let hasErrors = false;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    console.log('Missing required field:', field.name);
                    hasErrors = true;
                }
            });
            
            if (hasErrors) {
                console.log('Form has validation errors');
                alert('Please fill all required fields');
                e.preventDefault();
                return false;
            }
            
            console.log('Form validation passed, submitting...');
        });
        
        const checkbox = document.getElementById('memiliki_wali');
        const formWali = document.getElementById('form_wali');

        function toggleFormWali() {
            if (checkbox.checked) {
                formWali.classList.remove('hidden');
            } else {
                formWali.classList.add('hidden');
            }
        }
        checkbox.addEventListener('change', toggleFormWali);
        toggleFormWali();

        const tanggalLahirInput = document.getElementById('tanggal_lahir');
        const tempatTanggalLahirDiv = tanggalLahirInput.closest('div');

        const usiaDiv = document.createElement('div');
        usiaDiv.classList.add('mt-2');
        usiaDiv.innerHTML = `
            <label for="usia" class="block text-gray-700 font-medium mb-2">Usia</label>
            <input type="text" id="usia" readonly disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" placeholder="Usia akan muncul otomatis" />
        `;
        tempatTanggalLahirDiv.appendChild(usiaDiv);

        function hitungUsia(tanggalLahir) {
            const today = new Date();
            const birthDate = new Date(tanggalLahir);
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        tanggalLahirInput.addEventListener('change', function () {
            const tanggalLahir = this.value;
            if (tanggalLahir) {
                const usia = hitungUsia(tanggalLahir);
                document.getElementById('usia').value = usia >= 0 ? usia + ' tahun' : '';
            } else {
                document.getElementById('usia').value = '';
            }
        });

        function getPoin(penghasilan) {
            if (penghasilan === '<1.000.000') return 0;
            if (penghasilan === '1.000.000-1.999.999') return 1;
            if (penghasilan === '2.000.000-4.999.999') return 2;
            if (penghasilan === '>=5.000.000' || penghasilan === '>=5.000.000') return 3;
            return 0;
        }
        function updateStatusPIP() {
            const penghasilanAyah = document.getElementById('penghasilan_ayah').value;
            const penghasilanIbu = document.getElementById('penghasilan_ibu').value;
            const poinAyah = getPoin(penghasilanAyah);
            const poinIbu = getPoin(penghasilanIbu);
            const totalPoin = poinAyah + poinIbu;
            let status = '';
            if (totalPoin <= 1) {
                status = 'Y';
            } else {
                status = 'N';
            }
            document.getElementById('status_pip').value = status;
        }
        document.getElementById('penghasilan_ayah').addEventListener('change', updateStatusPIP);
        document.getElementById('penghasilan_ibu').addEventListener('change', updateStatusPIP);
        updateStatusPIP();
    });
</script>
