<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
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
        $tenantId = session('selected_tenant_id'); // Firma ID'sini session'dan al

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

        if ($validator->fails()) {
            $message = $validator->errors()->all();
            return redirect()->back()->withErrors($message)->withInput();
        }

        // Şifresiz kullanıcı kontrolü (aynı tenant içinde)
        $nopassword_user = User::where('email', $req->email)
            ->where('tenant_id', $tenantId)
            ->whereNull('password')
            ->first();

        if ($nopassword_user) {
            return redirect(route('set_password'));
        }

        // Tenant kontrolü dahil giriş
        if (Auth::attempt([
            'email' => $req->email,
            'password' => $req->password,
            'tenant_id' => $tenantId
        ])) {
            if (is_null(Auth::user()->password)) {
                return redirect(route('set_password'));
            } else {
                return redirect(route('anasayfa'));
            }
        } else {
            return back()->withErrors(['email' => 'E-posta, şifre veya firma hatalı olabilir.']);
        }
    }


    public function destroy()
    {

        Auth::logout();


        return redirect('/welcome')->with(['success' => 'Başarılı Çıkış Yaptınız']);
    }

    //REGİSTER -------

    public function registercreate()
    {

        return view('auth.register');
    }



    public function registerstore(Request $req)
    {
        $tenantId = session('selected_tenant_id'); // Firma ID'sini session'dan al

        $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required|max:255',
                'phone' => 'required|max:13',
                'email' => 'required|max:255|unique:users,email',
                'password' => 'required',
            ],
            [
                'name.required' => 'İsim alanı boş geçilemez!',
                'name.max' => 'İsim alanı en fazla 255 karakter olabilir!',
                'phone.required' => 'Telefon alanı boş geçilemez!',
                'phone.max' => 'Telefon alanı en fazla 13 karakter olabilir!',
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

        // Kayıt işlemi
        $user = User::create([
            "name" => $req->name,
            "email" => $req->email,
            "phone" => $req->phone,
            "password" => Hash::make($req->password),
            "role" => 2,
            "tenant_id" => $tenantId, // seçilen firma burada bağlanır
        ]);

        session()->flash('success', 'Başarıyla Kayıt Edildi.');

        return redirect('/login');
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


    // --------------sayfaya ilk girildiğinde karşına çıkan firma seçim sayfası----------------------

    public function welcomeget()
    {
        $tenant = Tenant::get();

        return view('auth.welcome', compact('tenant'));
    }

    public function welcomestore(Request $request)
    {
        $tenantId = $request->tenant_id;

        if (!$tenantId) {
            return response()->json(['error' => 'Tenant ID yok.'], 400);
        }

        session(['selected_tenant_id' => $tenantId]);

        return response()->json(['success' => true]);
    }









    public $timestamps = false;
}
