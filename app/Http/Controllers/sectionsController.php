<?php

namespace App\Http\Controllers;

use App\Models\genel_stok;
use App\Models\stok;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\StokMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class sectionsController extends Controller
{

    public function home(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $alert = genel_stok::where('tenant_id', $tenantId)->get();
        $users = User::where('tenant_id', $tenantId)->where('role', 1)->get();
        $eksikStoklar = genel_stok::where('tenant_id', $tenantId)
            ->where('kalan_adet', '<', 10)
            ->get();

        $bugun = Carbon::today()->toDateString();
        $targetId = $request->query('id');
        $sayfa = 1;

        if ($targetId) {
            $index = genel_stok::where('tenant_id', $tenantId)
                ->orderBy('updated_at', 'desc')
                ->pluck('id')
                ->search($targetId);

            if ($index !== false) {
                $sayfa = floor($index / 20) + 1;
            }
        }

        $genel = genel_stok::where('tenant_id', $tenantId)
            ->orderBy('updated_at', 'desc')
            ->paginate(20, ['*'], 'page', $sayfa);

        $genel->getCollection()->transform(function ($item) use ($bugun) {
            $item->bugunGuncellendi = Carbon::parse($item->updated_at)->toDateString() === $bugun;
            return $item;
        });

        return view('genel_stok', compact('genel', 'alert', 'eksikStoklar', 'targetId', 'users'));
    }



    public function genel_stokCreate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'urun_adi' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'kw' => 'nullable|numeric',
            'onceki_siparis_adedi' => 'nullable|integer|min:0',
            'kalan_adet' => 'required|integer|min:0',
            'guncel_siparis_adedi' => 'nullable|integer|min:0',
            'siparis_verildigi_yer' => 'nullable|string|max:255',
            'siparis_tarihi' => 'required|date',
            'siparis_veren_kisi' => 'nullable|string|max:255',
        ], [
            'urun_adi.required' => 'Ürün adı alanı boş bırakılamaz.',
            'model.required' => 'Model alanı boş bırakılamaz.',
            'kalan_adet.required' => 'Kalan adet alanı boş bırakılamaz.',
            'siparis_tarihi.required' => 'Sipariş tarihi alanı boş bırakılamaz.',
            'siparis_tarihi.date' => 'Sipariş tarihi geçerli bir tarih formatında olmalıdır.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $genel_stok = genel_stok::create([
            "tenant_id" => auth()->user()->tenant_id,
            "urun_adi" => $req->urun_adi,
            "model" => $req->model,
            "kw" => $req->kw,
            "onceki_siparis_adedi" => $req->onceki_siparis_adedi,
            "kalan_adet" => $req->kalan_adet,
            "guncel_siparis_adedi" => $req->guncel_siparis_adedi,
            "siparis_verildigi_yer" => $req->siparis_verildigi_yer,
            "siparis_tarihi" => Carbon::parse($req->siparis_tarihi)->format('Y-m-d H:i'),
            "siparis_veren_kisi" => $req->siparis_veren_kisi,
            "siparis_durumu" => 'Sipariş Beklemede',
            "created_at" => now(),
        ]);

        if ($genel_stok) {
            return redirect()->back()->with('success', 'Stok Kaydı Başarıyla Oluşturuldu');
        } else {
            return redirect()->back()->with('error', 'Stok Oluşturulurken Bir Hata Oluştu');
        }
    }


    public function genel_stokdelete($id)
    {
        $userTenantId = auth()->user()->tenant_id;

        $genel_stok = genel_stok::where('id', $id)
            ->where('tenant_id', $userTenantId)
            ->first();

        if (!$genel_stok) {
            return redirect()->back()->with('error', 'Silme işlemi başarısız veya yetkisiz erişim!');
        }

        $genel_stok->delete();

        return redirect()->back()->with('success', 'İşlem başarıyla silindi.');
    }

    public function genel_stokupdate(Request $req)
    {
        $userTenantId = auth()->user()->tenant_id;

        $genel_stok = genel_stok::where('id', $req->id)
            ->where('tenant_id', $userTenantId)
            ->first();

        if ($genel_stok) {
            $genel_stok->update([
                "kalan_adet" => $req->kalan_adet,
                "guncel_siparis_adedi" => $req->guncel_siparis_adedi,
                "onceki_siparis_adedi" => $req->onceki_siparis_adedi,
                "siparis_verildigi_yer" => $req->siparis_verildigi_yer,
                "siparis_tarihi" => Carbon::parse($req->siparis_tarihi)->format('Y-m-d H:i'),
                "siparis_durumu" => 'Sipariş Beklemede',
                "updated_at" => now(),
            ]);

            return redirect()->back()->with('success', 'İşlem başarıyla düzenlendi.');
        } else {
            return redirect()->back()->with('error', 'Yetkisiz işlem veya veri bulunamadı.');
        }
    }


    public function genel_eksilt_artır(Request $request, $id)
    {
        try {
            $userTenantId = auth()->user()->tenant_id;

            // Yalnızca kullanıcının tenant'ına ait olan item çekilir
            $item = genel_stok::where('id', $id)
                ->where('tenant_id', $userTenantId)
                ->first();

            if (!$item) {
                return response()->json([
                    'success' => false,
                    'message' => 'İlgili stok bulunamadı veya yetkisiz işlem.'
                ]);
            }

            $action = $request->input('action');
            $newAdet = $request->input('new_adet');

            if ($action === 'decrease' && $newAdet < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok miktarı 0\'dan az olamaz.'
                ]);
            }

            $item->kalan_adet = $newAdet;
            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Stok başarıyla güncellendi.',
                'new_adet' => $newAdet
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage()
            ]);
        }
    }


    public function siparis_durum_guncelle(Request $request, $id)
    {
        try {
            \Log::info('Sipariş durumu güncelleme çağırıldı', [
                'id' => $id,
                'request_data' => $request->all()
            ]);

            $userTenantId = auth()->user()->tenant_id;

            // Yalnızca kullanıcının tenant'ına ait item alınır
            $item = genel_stok::where('id', $id)
                ->where('tenant_id', $userTenantId)
                ->first();

            if (!$item) {
                return response()->json([
                    'success' => false,
                    'message' => 'İlgili stok bulunamadı veya yetkisiz işlem.'
                ]);
            }

            $yeniDurum = $request->input('yeni_durum');

            $gecerliDurumlar = [
                'sipariş beklemede',
                'sipariş verildi',
                'sipariş teslim alındı'
            ];

            if (!in_array(strtolower($yeniDurum), $gecerliDurumlar)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Geçersiz sipariş durumu'
                ]);
            }

            // Eğer durum "sipariş teslim alındı" ise
            if (strtolower($yeniDurum) == 'sipariş teslim alındı') {
                $eskiGuncelAdet = $item->guncel_siparis_adedi;

                $item->kalan_adet += $eskiGuncelAdet;
                $item->onceki_siparis_adedi = $eskiGuncelAdet;
                $item->guncel_siparis_adedi = 0;
            }

            $item->siparis_durumu = $yeniDurum;
            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Sipariş durumu ve adetler başarıyla güncellendi',
                'yeni_durum' => $yeniDurum
            ]);
        } catch (\Exception $e) {
            \Log::error('Sipariş durumu güncelleme hatası', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }



    public function search(Request $request)
    {
        $query = $request->input('q');
        $userTenantId = auth()->user()->tenant_id;

        if ($query) {
            $genel = genel_stok::where('tenant_id', $userTenantId)
                ->where(function ($q1) use ($query) {
                    $q1->where('urun_adi', 'like', "%{$query}%")
                        ->orWhere('model', 'like', "%{$query}%")
                        ->orWhere('siparis_verildigi_yer', 'like', "%{$query}%");
                })
                ->paginate(20);
        } else {
            $genel = genel_stok::where('tenant_id', $userTenantId)->paginate(20);
        }

        $stok = stok::get();

        return view('genel_stok', compact('genel', 'stok'));
    }


    public function stokMailGonder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::where('id', $request->user_id)
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', 1)
            ->firstOrFail();

        $alert = genel_stok::where('tenant_id', auth()->user()->tenant_id)
            ->whereDate('updated_at', Carbon::now('Europe/Istanbul')->toDateString())
            ->get();

        Mail::to($user->email)->send(new StokMail($alert));

        return back()->with('success', $user->name . ' adlı kullanıcıya mail gönderildi.');
    }



    public function stok_mail()
    {
        $userTenantId = auth()->user()->tenant_id;

        $alert = genel_stok::where('tenant_id', $userTenantId)
            ->whereDate('updated_at', Carbon::now('Europe/Istanbul')->toDateString())
            ->get();

        return view('emails.stok_mail', compact('alert'));
    }


    public function onayla(Request $request)
    {
        $ids = explode(',', $request->query('ids'));

        if (empty($ids)) {
            return response('Geçersiz sipariş ID\'leri.', 400);
        }

        $userTenantId = auth()->user()->tenant_id;

        // Sadece kullanıcıya ait tenant ID'li stokları güncelle
        DB::table('genel_stok')
            ->whereIn('id', $ids)
            ->where('tenant_id', $userTenantId)
            ->update(['siparis_durumu' => 'Sipariş Verildi']);

        return response('
        <html>
            <head>
                <meta http-equiv="refresh" content="5;url=' . route('anasayfa') . '">
                <script>
                    let seconds = 5;
                    const countdown = setInterval(function() {
                        if (seconds <= 1) {
                            clearInterval(countdown);
                        }
                        seconds--;
                        document.getElementById("countdown").innerText = seconds;
                    }, 1000);
                </script>
            </head>
            <body style="font-family: Arial; text-align: center; padding-top: 50px;">
                <h2 style="color: green;">Sipariş(ler) başarıyla onaylandı.</h2>
                <p><span id="countdown">5</span> saniye içinde ana sayfaya yönlendiriliyorsunuz...</p>
            </body>
        </html>
    ');
    }





    public function stok()
    {
        $stok = stok::get();
        return view('stok_listesi', compact('stok'));
    }

    public function stokCreate(Request $req)
    {
        $stok = stok::create([
            "urun_adi" => $req->urun_adi,
            "model" => $req->model,
            "kw_degeri" => $req->kw_degeri,
            "onceki_siparis_adedi" => $req->onceki_siparis_adedi,
            "kalan_adet" => $req->kalan_adet,
            "guncel_siparis_adedi" => $req->guncel_siparis_adedi,
            "siparis_verildigi_yer" => $req->siparis_verildigi_yer,
            "siparis_tarihi" => Carbon::parse($req->siparis_tarihi)->format('Y-m-d'),
            "siparis_veren_kisi" => $req->siparis_veren_kisi,
            "siparis_durumu" => $req->siparis_durumu,
            "created_at" => now(),
        ]);
        if ($stok) {
            return redirect()->back()->with('success', 'Stok Kaydı Başarıyla Oluşturuldu');
        } else {
            return redirect()->back()->with('error', 'Stok Oluştururlurken Bir Hata Oluştu');
        }
    }

    public function stokdelete($id)
    {
        $stok = stok::where('id', $id)->firstOrFail();

        $stok->delete();

        if ($stok) {
            return redirect()->back()->with('success', 'İşlem Başarıyla Silindi');
        } else {
            return redirect()->back()->with('error', 'İşlem Başarıyla Silinemedi');
        }
    }
    public function stokupdate(Request $req)
    {
        $stok = stok::where('id', $req->id)->first();
        if ($stok) {
            $stok->update([
                "urun_adi" => $req->urun_adi,
                "model" => $req->model,
                "kw_degeri" => $req->kw_degeri,
                "onceki_siparis_adedi" => $req->onceki_siparis_adedi,
                "kalan_adet" => $req->kalan_adet,
                "guncel_siparis_adedi" => $req->guncel_siparis_adedi,
                "siparis_verildigi_yer" => $req->siparis_verildigi_yer,
                "siparis_tarihi" => Carbon::parse($req->siparis_tarihi)->format('Y-m-d'),
                "siparis_veren_kisi" => $req->siparis_veren_kisi,
                "siparis_durumu" => $req->siparis_durumu,
            ]);
            return redirect()->back()->with('success', 'İşlem Başarıyla Düzenlendi');
        } else {
            return redirect()->back()->with('error', 'İşlem Başarıyla Düzenlenemedi');
        }
    }

    public function create()
    {
        return view('logo_upload');
    }

    public function store(Request $request)
    {

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user = auth()->user();

        $path = $request->file('logo')->store('logos', 'public');

        if ($user && $user->tenant) {
            $tenant = $user->tenant;
            $tenant->logo = $path;
            $tenant->save();
        }

        return back()->with('success', 'Logo başarıyla yüklendi!');
    }
}
