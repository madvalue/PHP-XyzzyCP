<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class LogoutController extends Controller {
        public function logout(Request $request) {
            if (!$request->session()->has("id")) return redirect("login");

            $request->session()->forget([ "id", "username", "hash" ]);
            return redirect("login")->with("success_message", "Pomyślnie wylogowano z konta");
        }
    }