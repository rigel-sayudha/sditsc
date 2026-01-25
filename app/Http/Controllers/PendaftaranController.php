<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Registration;
use App\Models\Question;
use App\Models\RegistrationPoint;
use App\Models\TestSchedule;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function index()
    {
        $step = request()->query('step', 1);
        
        $questions = Question::all();
        return view('pendaftaran', compact('step', 'questions'));
    }

    public function store(Request $request)
    {
        // Debug: log all request data
        Log::info('Form submission received', [
            'step' => $request->query('step'),
            'method' => $request->method(),
            'all_data' => $request->all()
        ]);

        $step = $request->query('step');

        if ($step == 2) {
            try {
                // Check if NIK already exists
                $existingRegistration = Registration::where('nik', $request->nik)->first();
                
                if ($existingRegistration) {
                    if ($existingRegistration->status === 'draft') {
                        // If existing registration is draft, update it instead of creating new
                        Log::info('Updating existing draft registration', ['nik' => $request->nik, 'id' => $existingRegistration->id]);
                        
                        $validatedData = $request->validate([
                            'nama' => 'required|string|max:255',
                            'nik' => 'required|string|size:16',
                            'tempat_lahir' => 'required|string|max:255',
                            'tanggal_lahir' => [
                                'required',
                                'date',
                            ],
                            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                            'agama' => 'required|string',
                            'asal_sekolah' => 'required|string|max:255',
                            'nama_ayah' => 'required|string|max:255',
                            'nama_ibu' => 'required|string|max:255',
                            'alamat_ortu' => 'required|string',
                            'telepon_ortu' => 'required|string|max:20',
                            'pekerjaan_ayah' => 'required|string|max:255',
                            'penghasilan_ayah' => 'required|string|max:255',
                            'pekerjaan_ibu' => 'required|string|max:255',
                            'penghasilan_ibu' => 'required|string|max:255',
                            'status_pip' => 'nullable|string|max:2',
                            'file_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                            'file_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                            'nama_wali' => 'nullable|string|max:255',
                            'alamat_wali' => 'nullable|string',
                            'no_telp_wali' => 'nullable|string|max:20',
                            'pekerjaan_wali' => 'nullable|string|max:255',
                        ], [
                            'nik.size' => 'NIK harus terdiri dari 16 digit angka.',
                            'nik.required' => 'NIK wajib diisi.',
                            'nama.required' => 'Nama lengkap wajib diisi.',
                            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
                            'nama_ayah.required' => 'Nama ayah wajib diisi.',
                            'nama_ibu.required' => 'Nama ibu wajib diisi.',
                            'alamat_ortu.required' => 'Alamat orang tua wajib diisi.',
                            'telepon_ortu.required' => 'Telepon orang tua wajib diisi.',
                            'pekerjaan_ayah.required' => 'Pekerjaan ayah wajib dipilih.',
                            'penghasilan_ayah.required' => 'Penghasilan ayah wajib dipilih.',
                            'pekerjaan_ibu.required' => 'Pekerjaan ibu wajib dipilih.',
                            'penghasilan_ibu.required' => 'Penghasilan ibu wajib dipilih.'
                        ]);
                        
                        // Handle file uploads
                        if ($request->hasFile('file_kk')) {
                            $kkFile = $request->file('file_kk');
                            $kkName = uniqid('kk_').'.'.$kkFile->getClientOriginalExtension();
                            $kkFile->storeAs('public/kk', $kkName);
                            $validatedData['file_kk'] = $kkName;
                        }
                        if ($request->hasFile('file_akta')) {
                            $aktaFile = $request->file('file_akta');
                            $aktaName = uniqid('akta_').'.'.$aktaFile->getClientOriginalExtension();
                            $aktaFile->storeAs('public/akta', $aktaName);
                            $validatedData['file_akta'] = $aktaName;
                        }

                        $validatedData['alamat'] = $validatedData['alamat_ortu'] ?? '';
                        $validatedData['status_lolos'] = false;
                        $validatedData['status'] = 'draft';
                        
                        $existingRegistration->update($validatedData);
                        
                        return redirect()->route('pendaftaran', ['step' => 2, 'id' => $existingRegistration->id]);
                        
                    } else {
                        // If registration is not draft, it means it's already completed
                        return back()->withErrors(['nik' => 'NIK sudah terdaftar dan pendaftaran telah selesai. Jika ini adalah kesalahan, silakan hubungi admin.'])->withInput();
                    }
                }
                
                // If NIK doesn't exist, proceed with normal validation including unique check
                $validatedData = $request->validate([
                    'nama' => 'required|string|max:255',
                    'nik' => 'required|string|size:16|unique:registrations,nik',
                    'tempat_lahir' => 'required|string|max:255',
                    'tanggal_lahir' => [
                        'required',
                        'date',
                    ],
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'agama' => 'required|string',
                    'asal_sekolah' => 'required|string|max:255',
                    'nama_ayah' => 'required|string|max:255',
                    'nama_ibu' => 'required|string|max:255',
                    'alamat_ortu' => 'required|string',
                    'telepon_ortu' => 'required|string|max:20',
                    'pekerjaan_ayah' => 'required|string|max:255',
                    'penghasilan_ayah' => 'required|string|max:255',
                    'pekerjaan_ibu' => 'required|string|max:255',
                    'penghasilan_ibu' => 'required|string|max:255',
                    'status_pip' => 'nullable|string|max:2',
                    'file_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'nama_wali' => 'nullable|string|max:255',
                    'alamat_wali' => 'nullable|string',
                    'no_telp_wali' => 'nullable|string|max:20',
                    'pekerjaan_wali' => 'nullable|string|max:255',
                ], [
                    'nik.unique' => 'NIK sudah terdaftar. Silakan gunakan NIK yang berbeda atau hubungi admin jika ini adalah kesalahan.',
                    'nik.size' => 'NIK harus terdiri dari 16 digit angka.',
                    'nik.required' => 'NIK wajib diisi.',
                    'nama.required' => 'Nama lengkap wajib diisi.',
                    'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                    'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                    'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
                    'nama_ayah.required' => 'Nama ayah wajib diisi.',
                    'nama_ibu.required' => 'Nama ibu wajib diisi.',
                    'alamat_ortu.required' => 'Alamat orang tua wajib diisi.',
                    'telepon_ortu.required' => 'Telepon orang tua wajib diisi.',
                    'pekerjaan_ayah.required' => 'Pekerjaan ayah wajib dipilih.',
                    'penghasilan_ayah.required' => 'Penghasilan ayah wajib dipilih.',
                    'pekerjaan_ibu.required' => 'Pekerjaan ibu wajib dipilih.',
                    'penghasilan_ibu.required' => 'Penghasilan ibu wajib dipilih.'
                ]);

                Log::info('Validation passed, processing files');

                if ($request->hasFile('file_kk')) {
                    $kkFile = $request->file('file_kk');
                    $kkName = uniqid('kk_').'.'.$kkFile->getClientOriginalExtension();
                    $kkFile->storeAs('public/kk', $kkName);
                    $validatedData['file_kk'] = $kkName;
                }
                if ($request->hasFile('file_akta')) {
                    $aktaFile = $request->file('file_akta');
                    $aktaName = uniqid('akta_').'.'.$aktaFile->getClientOriginalExtension();
                    $aktaFile->storeAs('public/akta', $aktaName);
                    $validatedData['file_akta'] = $aktaName;
                }

                $validatedData['alamat'] = $validatedData['alamat_ortu'] ?? '';
                $validatedData['status_lolos'] = false;
                $validatedData['status'] = 'draft';

                Log::info('Creating registration record');
                $registration = Registration::create($validatedData);
                Log::info('Registration created with ID: ' . $registration->id);

                return redirect()->route('pendaftaran', ['step' => 2, 'id' => $registration->id]);
                
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Validation failed', [
                    'errors' => $e->errors(),
                    'input' => $request->all()
                ]);
                return back()->withErrors($e->errors())->withInput();
            } catch (\Exception $e) {
                Log::error('Form submission error', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'])->withInput();
            }
        }
        // FINAL STEP: finish (langsung simpan data dan redirect sukses)
        elseif ($step === 'finish') {
            $id = $request->query('id');
            $jadwal_abk = $request->input('jadwal_abk');
            $registration = Registration::find($id);
            
            if (!$registration || $registration->status !== 'draft') {
                return redirect()->route('pendaftaran', ['step' => 1])
                    ->withErrors(['error' => 'Data pendaftaran tidak ditemukan, silakan isi data diri terlebih dahulu.']);
            }

            if ($jadwal_abk) {
                $parts = explode(' | ', $jadwal_abk);
                if (count($parts) >= 2) {
                    $datePart = $parts[0];
                    $timePart = $parts[1]; 

                    $dateOnly = trim(str_replace(['Senin,', 'Selasa,', 'Rabu,', 'Kamis,', 'Jumat,', 'Sabtu,', 'Minggu,'], '', $datePart));
                    
                    try {
                        $scheduleDate = Carbon::createFromFormat('d M Y', $dateOnly)->format('Y-m-d');
 
                        $timeRange = str_replace(' WIB', '', $timePart);
                        $times = explode(' - ', $timeRange);
                        $startTime = str_replace('.', ':', $times[0]) . ':00';

                        $testSchedule = TestSchedule::where('date', $scheduleDate)
                            ->where('start_time', $startTime)
                            ->where('is_active', true)
                            ->first();
                        
                        if ($testSchedule) {

                            $currentCount = $testSchedule->registrations()->count();
                            $maxCapacity = $testSchedule->max_participants;
                            
                            if ($maxCapacity && $currentCount >= $maxCapacity) {
                                return redirect()->back()
                                    ->withErrors(['jadwal_abk' => 'Jadwal tes yang dipilih sudah penuh. Silakan pilih jadwal lain.']);
                            }
                            
                            $registration->test_schedule_id = $testSchedule->id;
                        }
                    } catch (\Exception $e) {
                        Log::warning('Failed to parse jadwal_abk: ' . $jadwal_abk . ' Error: ' . $e->getMessage());
                    }
                }
            }
            
            $registration->jadwal_abk = $jadwal_abk;
            $registration->status = 'final';
            $registration->save();
            
            return redirect()->route('pendaftaran.success');
        }

        return redirect()->route('pendaftaran');
    }

    public function success()
    {
        return view('pendaftaran.success');
    }

    public function selectionResults()
    {
        $acceptedRegistrations = \App\Models\Registration::where('status_lolos', 1)
            ->orderBy('nama', 'asc')
            ->get();

        $currentYear = date('Y');

        return view('hasil-seleksi', compact('acceptedRegistrations', 'currentYear'));
    }
}
