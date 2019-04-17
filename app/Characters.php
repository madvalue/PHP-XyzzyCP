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
        public static function new($name, $lastname, $birth, $race, $skin, $userid) {
            try {
                $check_duplicates = DB::select("SELECT count(id) c FROM lss_characters WHERE imie=:name AND nazwisko=:lastname", [ "name" => $name, "lastname" => $lastname ]);
                if ($check_duplicates[0]->c > 0) return (object)[ "success" => false, "message" => "Postać o takiej kombinacji imienia oraz nazwiska już istnieje" ];

                $fingerprint = md5(rand());
                $fingerprint = substr($fingerprint, 0, 16);

                DB::insert("INSERT INTO lss_characters (accepted, imie, nazwisko, data_urodzenia, rasa, skin, userid, fingerprint, created, stylewalki) VALUES (1, :name, :lastname, :birthdate, :race, :skin, :userid, :fingerprint, NOW(), '')", [ 
                    "name" => $name,
                    "lastname" => $lastname,
                    "birthdate" => $birth,
                    "race" => $race,
                    "skin" => $skin,
                    "userid" => $userid,
                    "fingerprint" => $fingerprint
                ]);

                return (object)[ "success" => true ];
            } catch (\Exception $e) {
                return (object)[ "success" => false, "message" => "Wystapił problem podczas tworzenia postaci [#" . $e->getLine() . "]" ];
            }
        }

        // Pobieranie informacji o konkretnej postaci
        public static function details($char_id) {
            try {
                $details = DB::select("SELECT * FROM lss_characters WHERE id=:char_id", [ "char_id" => $char_id ]);
                if (count($details) < 1) return (object)[ "success" => false, "message" => "Nie znaleziono postaci o podanym identyfikatorze" ];
                elseif (count($details) > 1) return (object)[ "success" => false, "message" => "Znaleziono więcej niż jedną postać o podanym identyfkatorze" ];

                $details[0]->friendly_playtime = self::format_online($details[0]->playtime);
                
                return (object)[ "success" => true, "data" => $details[0] ];
            } catch (\Exception $e) {
                return (object)[ "success" => false, "message" => "Wystąpił problem podczas pobierania informacji o postaci [#" . $e->getLine() . "]" ];
            }
        }

        // Tworzenie przyjaznego czasu online, $time jest czasem w minutach
        private static function format_online($time) {
            $hours = floor($time/60);
            $minutes = $time - ($hours * 60);

            return $hours . " " . self::deklin($hours, "godzina", "godziny", "godzin") . " " . $minutes . " " . self::deklin($minutes, "minuta", "minuty", "minut");
        }

        // Deklinacja
        private static function deklin($num, $g1, $g2, $g3) {
            if ($num == 1) return $g1;
            elseif ($num%10 > 1 && $num%10 < 5 && ($num%100 < 10 || $num%100 > 21)) return $g2;
            else return $g3;
        }    
    }