<?php

namespace App\Http\Controllers;

use App\Models\genel_stok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class authController extends Controller
{
    public function loginget()
    {
        if (auth()->user()) {
            return redirect()->route('anasayfa');
        }
        return view('auth.login');
    }

    public function loginstore(Request $req)
    {
        // Doğrulama kuralları
        $validator = Validator::make(
            $req->all(),
            [
                'email' => 'required|max:255',
                'password' => 'required',
            ],
            [
                'email.required' => 'E-posta alanı boş geçilemez!',
                'email.max' => 'E-posta alanı en fazla 255 karakter olabilir!',
                'password.required' => 'Şifre alanı boş geçilemez!',
            ]
        );

        // Doğrulama hatalıysa geri dön
        if ($validator->fails()) {
            $message = $validator->errors()->all();
            return redirect()->back()->withErrors($message)->withInput();
        }

        // Şifresi olmayan kullanıcı kontrolü
        $nopassword_user = User::where('email', $req->email)->whereNull('password')->first();
        if ($nopassword_user) {
            return redirect(route('set_password'));
        }

        // Kullanıcı doğrulama
        if (Auth::attempt(["email" => $req->email, "password" => $req->password])) {
            $user = Auth::user();

            // tenant_id'yi oturuma kaydet
            session(['tenant_id' => $user->tenant_id]);

            // Şifre null ise yönlendir
            if (is_null($user->password)) {
                return redirect(route('set_password'));
            } else {
                return redirect(route('anasayfa'));
            }
        } else {
            // Giriş başarısız
            return back()->withErrors(['email' => 'E-posta veya şifre geçersiz.']);
        }
    }


    public function destroy()
    {

        Auth::logout();


        return redirect('/login')->with(['success' => 'Başarılı Çıkış Yaptınız']);
    }

    //REGİSTER -------

    public function registercreate()
    {
        $tenantId = auth()->user()->tenant_id;
        $alert = genel_stok::where('tenant_id', $tenantId)->get();
        $user = User::where('tenant_id', $tenantId)->get();
        return view('auth.register', compact('alert', 'user'));
    }



    public function registerstore(Request $req)
    {

        $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required|max:255',
                'telefon' => 'required|max:13',
                'email' => 'required|max:255|unique:users,email',
                'password' => 'required',

            ],
            [
                'name.required' => 'İsim alanı boş geçilemez!',
                'name.max' => 'İsim alanı en fazla 255 karakter olabilir!',
                'telefon.required' => 'Telefon alanı boş geçilemez!',
                'telefon.min' => 'Telefon alanı en az 11 karakter olabilir!',
                'telefon.max' => 'Telefon alanı en fazla 13 karakter olabilir!',
                'email.required' => 'E-posta alanı boş geçilemez!',
                'email.max' => 'E-posta alanı en fazla 255 karakter olabilir!',
                'email.unique' => 'E-posta adresi farklı bir kullanıcı tarafından kullanılıyor!',
                'password.required' => 'Şifre alanı boş geçilemez!',
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
            return redirect()->back()->withErrors($message)->withInput();
        }


        session()->flash('success', 'Başarıyla Kayıt Edildi.');
        $user = User::create([

            "name" => $req->name,
            "email" => $req->email,
            "telefon" => $req->telefon,
            "password" => Hash::make($req->password),
            "role" => 2,
            "tenant_id" => auth()->user()->tenant_id
        ]);
        return redirect('/register');
    }



    //SET PASSWORD ------------------------

    public function index()
    {
        return view('auth.setpassword');
    }
    public function update(Request $request)
    {
        $user = User::where('email', $request->email);
        $user->update([
            "password" => Hash::make($request->password),
        ]);
        return redirect('/login');
    }

    //İNFO USER


    public function infousercreate()
    {
        return view('auth.profile');
    }

    public function profilStore(Request $request)
    {

        $request = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'password'     => ['max:50'],
        ]);

        User::where('id', Auth::user()->id)
            ->update([
                'name'    => $request['name'],
                'email' => $request['email'],
            ]);


        return redirect('profile')->with('success', 'Profil başarıyla düzenlendi');
    }
    public function storePassword(Request $request)
    {

        if (Hash::check($request->current_password, Auth::user()->password)) {
            $update = User::where('id', Auth::user()->id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);

            if ($update) {
                'Güncelleme işlemi başarılı oldu';
            } else {
                'Güncelleme işlemi başarısız oldu';
            }
        }


        return redirect('/profile')->with('success', 'Profil başarıyla değişti');
    }

    //RESET PASSWORD
    public function resetcreate()
    {
        return view('auth.forgot_password');
    }

    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return redirect()->back()->with('success', 'Şifre sıfırlama linki e-posta adresinize gönderildi. Lütfen e-posta kutunuzu kontrol edin.');
    }


    public function resetPass($token)
    {
        return view('auth.passwordChange', compact('token'));
    }

    public function changePassword(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login');
    }

    public function user_update(Request $req)
    {
        $user = User::where('id', $req->id)->first();
        if ($user) {
            $user->update([
                "name" => $req->name,
                "email" => $req->email,
                "role" => $req->role,
                "telefon" => $req->telefon,

            ]);
            return redirect()->back()->with('success', 'İşlem Başarıyla Düzenlendi');
        } else {
            return redirect()->back()->with('error', 'İşlem Başarıyla Düzenlenemedi');
        }
    }

    public function user_delete($id)
    {
        $user = user::where('id', $id)->firstOrFail();
        $user->delete();

        if ($user) {
            return redirect()->back()->with('success', 'İşlem Başarıyla Silindi');
        } else {
            return redirect()->back()->with('error', 'İşlem Başarıyla Silinemedi');
        }
    }







    public $timestamps = false;
}
