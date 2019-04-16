<?php
    namespace App;

    use Illuminate\Support\Facades\DB;

    class Accounts {
        // Pobieranie podstawowych danych konta po jego loginie oraz haśle 
        public static function getAccount($username, $password) {
            $check = DB::select("SELECT id, login, hash FROM lss_users WHERE login=:username AND hash=:password", [ "username" => $username, "password" => self::hashPassword($username, $password) ]);
            try {
                if (count($check) < 1) return (object)[ "success" => false, "message" => "Wprowadzona kombinacja loginu oraz hasła jest błędna" ];
                elseif (count($check) > 1) return (object)[ "success" => false, "message" => "Znaleziono więcej niż jedno konto pasujące do wprowadzonej kombinacji"]; // Nie powinno się zdarzyć
                else return (object)[ "success" => true, "data" => $check[0] ];
            } catch (Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił nieoczkeiwany błąd" ];
            }
        }

        // Pobieranie wszystkich informacji o koncie po jego identyfikatorze
        public static function getInfo($id) {
            try {
                $info = DB::select("SELECT * FROM lss_users WHERE id=:id", [ "id" => $id ]);
                
                if (count($info) < 1) return (object)[ "success" => false, "message" => "Wprowadzony identyfikator konta jest błędny" ];
                elseif (count($info) > 1) return (object)[ "success" => false, "message" => "Znaleziono więcej niż jedno konto o podanym identyfikatorze" ]; // Nie powinno się zdarzyć
                else return (object)[ "success" => true, "data" => $info[0] ];
            } catch (Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił nieoczekiwany błąd, podczas pobierania danych" ];
            }
        }

        // Wrzucanie nowego konta do bazy danych
        public static function insertAccount($username, $password, $email) {
            try {
                DB::insert("INSERT INTO lss_users (login, hash, email, blokada_ooc, blokada_bicia, blokada_pm, premium, quiz) VALUES(:login, :hash, :email, '2018-05-11 00:00:00', '2018-05-11 00:00:00', '2018-05-11 00:00:00', '2018-05-11 00:00:00', 1)", [ "login" => $username, "hash" => self::hashPassword($username, $password), "email" => $email ]);
                return (object)[ "success" => true ];
            } catch (Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił nieoczekiwany błąd, poczas tworzenia konta" ];
            }
        }

        // Hashowanie hasła
        private static function hashPassword($username, $password) {
            return md5(strtolower($username) . "MRFX_01" . $password);
        }
    }