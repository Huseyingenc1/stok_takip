<?php

namespace App\Http\Controllers;

use App\Models\genel_stok;
use App\Models\stok;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class sectionsController extends Controller
{

    public function home()
    {
        $alert = genel_stok::get();
        $bugun = Carbon::today()->toDateString();

        $genel = genel_stok::orderBy('updated_at', 'desc')->paginate(20);

        $genel->getCollection()->transform(function ($item) use ($bugun) {
            $updatedAt = Carbon::parse($item->updated_at)->toDateString();
            $item->bugunGuncellendi = $updatedAt === $bugun;
            return $item;
        });

        $stok = stok::get();
        return view('genel_stok', compact('genel', 'stok', 'alert'));
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
        $genel_stok = genel_stok::where('id', $id)->firstOrFail();

        $genel_stok->delete();

        if ($genel_stok) {
            return redirect()->back()->with('success', 'İşlem Başarıyla Silindi');
        } else {
            return redirect()->back()->with('error', 'İşlem Başarıyla Silinemedi');
        }
    }
    public function genel_stokupdate(Request $req)
    {
        $genel_stok = genel_stok::where('id', $req->id)->first();
        if ($genel_stok) {
            $genel_stok->update([
                "kalan_adet" => $req->kalan_adet,
                "guncel_siparis_adedi" => $req->guncel_siparis_adedi,
                "onceki_siparis_adedi" => $req->onceki_siparis_adedi,
                "siparis_verildigi_yer" => $req->siparis_verildigi_yer,
                "siparis_tarihi" => Carbon::parse($req->siparis_tarihi)->format('Y-m-d H:i'),
                "updated_at" => Carbon::parse(now())->format('Y-m-d H:i'),

            ]);
            return redirect()->back()->with('success', 'İşlem Başarıyla Düzenlendi');
        } else {
            return redirect()->back()->with('error', 'İşlem Başarıyla Düzenlenemedi');
        }
    }

    public function genel_eksilt_artır(Request $request, $id)
    {
        try {
            // İlgili item'ı bul
            $item = genel_stok::findOrFail($id); // YourModel yerine kendi model adınızı yazın

            $action = $request->input('action');
            $newAdet = $request->input('new_adet');

            // Güvenlik kontrolü
            if ($action === 'decrease' && $newAdet < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok miktarı 0\'dan az olamaz'
                ]);
            }

            // Veritabanını güncelle
            $item->kalan_adet = $newAdet;
            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Stok başarıyla güncellendi',
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

            $item = genel_stok::findOrFail($id); // Model adını doğru yazdığından emin ol

            $yeniDurum = $request->input('yeni_durum');

            $gecerliDurumlar = [
                'sipariş beklemede',
                'sipariş verildi',
                'sipariş teslim alındı'
            ];

            if (!in_array($yeniDurum, $gecerliDurumlar)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Geçersiz sipariş durumu'
                ]);
            }

            // Eğer durum "sipariş teslim alındı" ise kalan adeti güncelle
            if (strtolower($yeniDurum) == 'sipariş teslim alındı') {
                $item->kalan_adet = $item->kalan_adet + $item->guncel_siparis_adedi;
            }

            // Sipariş durumunu güncelle
            $item->siparis_durumu = $yeniDurum;
            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Sipariş durumu ve kalan adet başarıyla güncellendi',
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

        if ($query) {
            $genel = genel_stok::where(function ($q) use ($query) {
                $q->where('urun_adi', 'like', "%{$query}%")
                    ->orWhere('model', 'like', "%{$query}%")
                    ->orWhere('siparis_verildigi_yer', 'like', "%{$query}%");
            })->paginate(20);
        } else {
            $genel = genel_stok::paginate(20);
        }

        $stok = stok::get();

        return view('genel_stok', compact('genel', 'stok'));
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
}
