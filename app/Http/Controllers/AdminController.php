<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Registration;
use App\Models\RegistrationPoint;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AcceptedRegistrationsExport;

class AdminController extends Controller
{
    public function printRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $pdf = Pdf::loadView('admin.print.registration', compact('registration'));
        return $pdf->stream('pendaftaran-'.$registration->nama.'.pdf');
    }
    /**
     * Meloloskan siswa (total poin < 21) secara manual oleh admin
     */
    public function loloskanSiswa($id)
    {
        $registration = Registration::findOrFail($id);
        if (!$registration->status_lolos) {
            $registration->status_lolos = 1;
            $registration->save();
            return redirect()->back()->with('success', 'Siswa berhasil diloloskan!');
        }
        return redirect()->back()->with('error', 'Siswa sudah diloloskan.');
    }

    /**
     * Mengubah status siswa menjadi belum lolos (status_lolos = 0)
     */
    public function belumLoloskanSiswa($id)
    {
        $registration = Registration::findOrFail($id);
        if ($registration->status_lolos) {
            $registration->status_lolos = 0;
            $registration->save();
            return redirect()->back()->with('success', 'Status siswa diubah menjadi belum lolos!');
        }
        return redirect()->back()->with('error', 'Siswa sudah berstatus belum lolos.');
    }

    public function leaderboard(Request $request)
    {
        $sort = $request->get('sort', 'desc');
        $registrations = Registration::orderBy('total_poin', $sort)->get();
        return view('admin.leaderboard', compact('registrations', 'sort'));
    }

    public function articles()
    {
        $articles = \App\Models\Article::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.articles.index', compact('articles'));
    }

    public function announcements()
    {
        return view('admin.pages.announcements.index');
    }

    public function registrations()
    {
        return view('admin.pages.registrations.index');
    }

    public function organization()
    {
        $organizationImage = Storage::disk('public')->exists('organization/struktur.png')
            ? '/storage/organization/struktur.png'
            : '/images/struktur-placeholder.png';
        return view('admin.organization', compact('organizationImage'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists(str_replace('/storage/', '', $user->avatar))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar));
            }
            
            // Store new avatar
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $updateData['avatar'] = '/storage/' . $avatar;
        }

        $user->update($updateData);

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateOrganization(Request $request)
    {
        $request->validate([
            'organization_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);
        if ($request->hasFile('organization_image')) {
            $path = $request->file('organization_image')->storeAs('organization', 'struktur.png', 'public');
        }
        return redirect()->route('admin.organization')->with('success', 'Struktur organisasi berhasil diperbarui!');
    }

    public function exportAcceptedRegistrations()
    {
        $filename = 'rekap_siswa_lolos_seleksi.xlsx';
        return Excel::download(new AcceptedRegistrationsExport, $filename);
    }
    public function printAcceptedRegistrations()
    {
        $registrations = Registration::where('status_lolos', 1)->orderBy('nama')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.print.accepted-registrations', compact('registrations'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('rekap-siswa-lolos.pdf');
    }

    // Hapus satu data siswa
    public function deleteRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    }

    // Hapus semua data siswa
    public function deleteAllRegistrations()
    {
        Schema::disableForeignKeyConstraints();
        Registration::truncate();
        return redirect()->back()->with('success', 'Semua data siswa berhasil dihapus.');
        Schema::enableForeignKeyConstraints();
    }

    // Tampilkan form edit nilai tes
    public function editTes($id)
    {
        $registration = Registration::findOrFail($id);
        return view('admin.edit-tes', compact('registration'));
    }

    // Update nilai tes
    public function updateTes(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        $validated = $request->validate([
            'tes_warna' => 'required|integer|min:0',
            'interaksi' => 'required|integer|min:0',
            'tes_baca_tulis' => 'required|integer|min:0',
            'abk' => 'required|integer|min:0',
        ]);
        $validated['total_poin'] = $validated['tes_warna'] + $validated['interaksi'] + $validated['tes_baca_tulis'] + $validated['abk'];
        $registration->update($validated);
        return redirect()->route('admin.leaderboard')->with('success', 'Nilai tes berhasil diperbarui.');
    }
}
