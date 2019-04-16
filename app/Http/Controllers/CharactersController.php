<?php
    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Validator;
    use Illuminate\Validation\Rule;
    use App\Accounts;
    use App\Characters;

    class CharactersController extends Controller {
        private static $valid_skins = [
            "male_biala" => [23,29,34,46,186], // Biały mężczyzna
            "male_czarna" => [21,22,24,67,142], // Czarny mężczyzna
            "male_zolta" => [49,57,58,227,229], // Azjata
            "female_biala" => [55,56,91,93,192], // Biała kobieta
            "female_czarna" => [9,12,13,190,195], // Czarna kobieta
            "female_zolta" => [141,169,224,225,263] // Azjatka
        ];

        public function list(Request $request) {
            if (!$request->session()->has("id")) return redirect("login")->withErrors("Dostęp do tej sekcji mają tylko zalogowani");

            $characters = Characters::getList($request->session()->get("id"));
            return view("characters", [ "page" => "characters", "characters" => $characters ]);
        }

        public function new(Request $request) {
            if (!$request->session()->has("id")) return redirect("login")->withErrors("Dostęp do tej sekcji mają tylko zalogowani");

            $characters_limit = Characters::getLimit($request->session()->get("id"));
            if ($characters_limit->success == false) return redirect("error")->with("error_message", $characters_limit->message);

            $characters_count = Characters::getCount($request->session()->get("id"));
            if ($characters_count->success == false) return redirect("error")->with("error_message", $characters_count->message);

            return view("characters_new", [ "page" => "characters_new", "characters_limit" => $characters_limit->data, "characters_count" => $characters_count->data ]);
        }

        public function new_process(Request $request) {
            if (!$request->session()->has("id")) return redirect("login")->withErrors("Dostęp do tej sekcji mają tylko zalogowani");

            $characters_limit = Characters::getLimit($request->session()->get("id"));
            if ($characters_limit->success == false) return redirect("error")->with("error_message", $characters_limit->message);

            $characters_count = Characters::getCount($request->session()->get("id"));
            if ($characters_count->success == false) return redirect("error")->with("error_message", $characters_count->message);

            if ($characters_limit->data <= $characters_count->data) return redirect("error")->with("error_message", "Limit postaci został wyczerpany");

            $race = $request->input("race");
            $sex = $request->input("sex");
            $array_with_skins = $sex . "_" . $race;

            $last_valid_date = date("Y-n-j", time() - 504921600);

            $rules = [
                "name" => ["required", "min:1", "max:16", "regex:/^[a-zA-Z]{1,}$/"],
                "lastname" => ["required", "min:1", "max:16", "regex:/^[a-zA-Z]{1,}$/"],
                "birthdate" => ["required", "before:" . $last_valid_date],
                "race" => ["required", Rule::in(["biala", "czarna", "zolta"])],
                "sex" => ["required", Rule::in(["male", "female"])],
                "skin" => ["required", "numeric", Rule::in(self::$valid_skins[$array_with_skins])]
            ];

            $messages = [
                "name.required" => "Imię postaci jest wymagane",
                "name.min" => "Imię postaci musi zawierać przynajmniej jedną literę",
                "name.max" => "Imię postaci może zawierać maksymalnie 16 liter",
                "name.regex" => "Imię postaci może zawierać tylko litery",

                "lastname.required" => "Nazwisko postaci jest wymagane",
                "lastname.min" => "Nazwisko postaci musi zawierać przynajmniej jedną literę",
                "lastname.max" => "Nazwisko postaci może zawierać maksymalnie 16 liter",
                "lastname.regex" => "Nazwisko postaci może zawierać tylko litery",

                "birthdate.required" => "Data urodzenia jest wymagana",
                "birthdate.before" => "Wiek postaci nie może być mniejszy niż 16 lat",
                
                "race.required" => "Rasa postaci jest wymagana",
                "race.in" => "Wybrana rasa postaci jest błędna",

                "sex.required" => "Płec postaci jest wymagana",
                "sex.in" => "Wybrana płeć postaci jest błędna",

                "skin.required" => "Wygląd postaci jest wymagany",
                "skin.in" => "Wybrany wygląd postaci jest błędny"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) return redirect('/characters/new')->withErrors($validator)->withInput();

            return redirect("/characters/new")->withErrors("Testowy błędzik essa");
        }
    }
