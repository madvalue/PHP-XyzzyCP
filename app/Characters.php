<?php
    namespace App;

    use Illuminate\Support\Facades\DB;

    class Characters {
        // Pobieranie listy postaci
        public static function getList($user) {
            try {
                $uid = intval($user);
                $characters = DB::select("SELECT id, imie, nazwisko, skin, money, bank_money, accepted FROM lss_characters WHERE userid=:id", [ "id" => $uid ]);
                return (object)[ "success" => true, "data" => $characters ];
            } catch (\Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił problem podczas pobierania listy postaci [#" . $e->getLine() . "]" ];
            }
        }

        // Pobieranie limitu postaci na koncie
        public static function getLimit($user) {
            try {
                $uid = intval($user);
                $limit = DB::select("SELECT character_limit FROM lss_users WHERE id=:user", [ "user" => $uid ]);

                if (count($limit) < 1) return (object)[ "success" => false, "logout" => true, "message" => "Wprowadzony identyfikator konta jest błedny" ];
                elseif (count($limit) > 1) return (object)[ "success" => false, "logout" => true, "message" => "Znaleziono wiecej niż jedno konto z wprowadzonym identyfikatorem" ]; // Nie powinno się zdarzyć
                return (object)[ "success" => true, "data" => $limit[0]->character_limit ];
            } catch (\Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił problem podczas pobierania limtu postaci [#" . $e->getLine() . "]" ];
            }
        }

        // Pobieranie liczby postaci gracza
        public static function getCount($user) {
            try {
                $uid = intval($user);
                $count = DB::select("SELECT count(id) c FROM lss_characters WHERE userid=:user", [ "user" => $uid ]);

                return (object)[ "success" => true, "data" => $count[0]->c ];
            } catch (\Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił problem podczas pobierania liczby postaci [#" . $e->getLine() . "]" ];
            }
        }

        // Dodawanie nowej postaci do bazy danych
        public static function new($name, $lastname, $birth, $race, $sex, $skin) {

        }
    }