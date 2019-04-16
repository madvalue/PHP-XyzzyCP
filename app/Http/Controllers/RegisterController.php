<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Validator;
    use App\Accounts;

    class RegisterController extends Controller {
        public function show(Request $request) {
            if ($request->session()->has("id")) return redirect("/");
            return view("register");
        }

        public function process(Request $request) {
            $rules = [
                "username" => ["required", "min:3", "max:32", "regex:/^[a-zA-Z0-9]{1,}$/", "unique:lss_users,login"],
                "email" => ["required", "email", "max:128", "unique:lss_users,email"],
                "password" => ["required", "min:6"]
            ];

            $messages = [
                "username.required" => "Nazwa użytkownika jest wymagana",
                "username.min" => "Nazwa użytkownika musi zawierać przynajmniej 3 znaki",
                "username.max" => "Nazwa użytkownika może zawierać maksymalnie 32 znaki",
                "username.regex" => "Nazwa użytkownika nie może zawierać znaków specjalnych",
                "username.unique" => "Nazwa użytkownika jest już w użyciu",

                "email.required" => "Adres E-Mail jest wymagany",
                "email.email" => "Wprowadzony adres E-Mail jest błędny",
                "email.max" => "Adres E-Mail może zawierać maksymalnie 128 znaków",
                "email.uniqe" => "Adres E-Mail jest już w użyciu",

                "password.required" => "Hasło jest wymagane",
                "password.min" => "Hasło musi zawierać przynajmniej 6 znaków"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) return redirect('register')->withErrors($validator)->withInput();

            $username = $request->input("username");
            $email = $request->input("email");
            $password = $request->input("password");

            $insert = Accounts::insertAccount($username, $password, $email);
            if ($insert->success == false) return redirect("register")->withErrors([ $insert->message ]);

            return redirect("register")->with("success_message", "Konto zostało utworzone pomyślnie");
        }
    }