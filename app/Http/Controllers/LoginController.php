<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Validator;
    use Illuminate\Http\Request;
    use App\Accounts;

    class LoginController extends Controller {
        public function show(Request $request) {
            if ($request->session()->has("id")) return redirect("/");
            return view("login");
        }
        
        public function process(Request $request) {
            $rules = [
                "username" => ["required", "min:3", "max:32", "regex:/^[a-zA-Z0-9]{1,}$/"],
                "password" => ["required", "min:6"]
            ];

            $messages = [
                "username.required" => "Nazwa użytkownika jest wymagana",
                "username.min" => "Nazwa użytkownika musi zawierać przynajmniej 3 znaki",
                "username.max" => "Nazwa użytkownika może zawierać maksymalnie 32 znaki",
                "username.regex" => "Nazwa użytkownika nie może zawierać znaków specjalnych",

                "password.required" => "Hasło jest wymagane",
                "password.min" => "Hasło musi zawierać przynajmniej 6 znaków"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) return redirect('login')->withErrors($validator)->withInput();

            $username = $request->input("username");
            $password = $request->input("password");

            $account = Accounts::getAccount($username, $password);
            if ($account->success == false) return redirect('login')->withErrors([ $account->message ]);
            
            $request->session()->put("id", $account->data->id);
            $request->session()->put("nickname", $account->data->login);
            $request->session()->put("hash", $account->data->hash);

            return redirect("/");
        }
    }