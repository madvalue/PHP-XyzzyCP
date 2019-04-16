<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Accounts;
    use Illuminate\Http\Request;

    class MainController extends Controller {
        // Rysowanie strony głównej
        public function main(Request $request) {
            if (!$request->session()->has("id")) return redirect("login");

            $account_info = Accounts::getInfo($request->session()->get("id"));
            return view("main", [ "account" => $account_info, "page" => "main" ]);
        }

        // Wylogowywanie użytkownika
        public function logout(Request $request) {
            if (!$request->session()->has("id")) return redirect("login")->withErrors("Dostęp do tej sekcji mają tylko zalogowani");

            $request->session()->forget([ "id", "username", "hash" ]);
            return redirect("login")->with("success_message", "Pomyślnie wylogowano z konta");
        }

        // Wyświetlanie komunikatu błędu
        public function error(Request $request) {
            if (!$request->session()->has("id")) return redirect("login");

            return view("error", [ "page" => "error" ]);
        }
    }