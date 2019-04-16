@extends('layouts.main')

@section('content')
    <style>
        .available-model {
            width: 100px;
            margin: 0 20px;
            cursor: pointer;
        }
        .available-model.selected {
            border: 2px solid #007bff55;
        }
    </style>
    @if($characters_limit <= $characters_count)
        <div class="alert alert-danger" role="alert">Limit postaci został wyczerpany</div>
    @else
        <form method="POST" action="{{ env('APP_URL') }}/characters/new">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row mb-3">
                <div class="col-md-6 m-auto">
                    <h3>Tworzenie postaci</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ml-auto mb-3">
                    <label for="name">Imię postaci</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Imię postaci" />
                </div>
                <div class="col-md-3 mr-auto mb-3">
                    <label for="lastname">Nazwisko postaci</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nazwisko postaci" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 m-auto">
                    <label for="birthdate">Data urodzin</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" />
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3 ml-auto mb-3">
                    <label for="race">Rasa postaci</label>
                    <select class="form-control" id="race" name="race" onchange="changeSkinSet();">
                        <option value="biala">Biały</option>
                        <option value="czarna">Czarny</option>
                        <option value="zolta">Azjata</option>
                    </select>
                </div>
                <div class="col-md-3 mr-auto mb-3">
                    <label for="sex">Płeć postaci</label>
                    <select class="form-control" id="sex" name="sex" onchange="changeSkinSet();">
                        <option value="male">Mężczyzna</option>
                        <option value="female">Kobieta</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 m-auto">
                    <label for="skin">Wygląd postaci</label>
                    <input type="hidden" id="skin" name="skin" value="-1"/><br>
                    <div class="text-center">
                        <script>
                            var white_male = [23,29,34,46,186];
                            var black_male = [21,22,24,67,142];
                            var asian_male = [49,57,58,227,229];
                            
                            var white_female = [55,56,91,93,192];
                            var black_female = [9,12,13,190,195];
                            var asian_female = [141,169,224,225,263];

                            function printFromArray(array) {
                                array.forEach(element => {
                                    document.write(`<img src="{{ env('APP_URL') }}/images/skins/${element}.png" skin="${element}" class="available-model" onclick="setSelected(this);" />`);
                                });
                            }
                            function setSelected(element) {
                                var selected = document.getElementsByClassName("available-model selected");
                                for (let i = 0; i < selected.length; i++) {
                                    selected[i].className = "available-model";
                                }
                                element.className = "available-model selected";
                                document.getElementById("skin").value = element.getAttribute("skin");
                            }

                            function changeSkinSet() {
                                var selected = document.getElementsByClassName("available-model selected");
                                for (let i = 0; i < selected.length; i++) {
                                    selected[i].className = "available-model";
                                }

                                var skin_blocks = ["white_male", "black_male", "asian_male", "white_female", "black_female", "asian_female"];
                                skin_blocks.forEach(block => {
                                    document.getElementById(block).className = "skin-block d-none";
                                });

                                var race = document.getElementById("race").value;
                                var sex = document.getElementById("sex").value;

                                // Pierwszy blok, rasa postaci
                                var first_block = "asian";
                                if (race === "biala") first_block = "white";
                                else if (race === "czarna") first_block = "black";

                                document.getElementById("skin").value = "-1";
                                document.getElementById(first_block + "_" + sex).className = "skin-block";
                            }

                            window.addEventListener('DOMContentLoaded', (event) => {
                                changeSkinSet()
                            });
                        </script>

                        <div id="white_male" class="skin-block"><script> printFromArray(white_male); </script></div>
                        <div id="black_male" class="skin-block d-none"><script> printFromArray(black_male); </script></div>
                        <div id="asian_male" class="skin-block d-none"><script> printFromArray(asian_male); </script></div>

                        <div id="white_female" class="skin-block d-none"><script> printFromArray(white_female); </script></div>
                        <div id="black_female" class="skin-block d-none"><script> printFromArray(black_female); </script></div>
                        <div id="asian_female" class="skin-block d-none"><script> printFromArray(asian_female); </script></div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 ml-auto"></div>
                <div class="col-md-2 mr-auto text-right">
                    <button class="btn btn-primary">Utwórz postać</button>
                </div>
            </div>
        </form>
    @endif
@endsection