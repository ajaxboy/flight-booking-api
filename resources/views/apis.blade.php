<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                background: #262a2b;
            }
            .tilesWrap {
                padding: 0;
                margin: 50px auto;
                list-style: none;
                text-align: center;
            }
            .tilesWrap li {
                display: inline-block;
                width: 20%;
                min-width: 200px;
                max-width: 230px;
                padding: 80px 20px 40px;
                position: relative;
                vertical-align: top;
                margin: 10px;
                font-family: 'helvetica', san-serif;
                min-height: 25vh;
                background: #262a2b;
                border: 1px solid #252727;
                text-align: left;
            }
            .tilesWrap li h2 {
                font-size: 114px;
                margin: 0;
                position: absolute;
                opacity: 0.2;
                top: 50px;
                right: 10px;
                transition: all 0.3s ease-in-out;
            }
            .tilesWrap li h3 {
                font-size: 20px;
                color: #b7b7b7;
                margin-bottom: 5px;
            }
            .tilesWrap li p {
                font-size: 16px;
                line-height: 18px;
                color: #b7b7b7;
                margin-top: 5px;
            }
            .tilesWrap li button {
                background: transparent;
                border: 1px solid #b7b7b7;
                padding: 10px 20px;
                color: #b7b7b7;
                border-radius: 3px;
                position: relative;
                transition: all 0.3s ease-in-out;
                transform: translateY(-40px);
                opacity: 0;
                cursor: pointer;
                overflow: hidden;
                z-index: 999;
            }
            .tilesWrap li button:before {
                content: '';
                position: absolute;
                height: 100%;
                width: 120%;
                background: #b7b7b7;
                top: 0;
                opacity: 0;
                left: -140px;
                border-radius: 0 20px 20px 0;
                z-index: -1;
                transition: all 0.3s ease-in-out;

            }
            .tilesWrap li:hover button {
                transform: translateY(5px);
                opacity: 1;
            }
            .tilesWrap li button:hover {
                color: #262a2b;
                cursor: progress;
            }
            .tilesWrap li button:hover:before {
                left: 0;
                opacity: 1;
            }
            .tilesWrap li:hover h2 {
                top: 0px;
                opacity: 0.6;
            }

            .tilesWrap li:before {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                z-index: -1;
                background: #fff;
                transform: skew(2deg, 2deg);
            }
            .tilesWrap li:after {
                content: '';
                position: absolute;
                width: 40%;
                height: 100%;
                left: 0;
                top: 0;
                background: rgba(255, 255, 255, 0.02);
            }
            .tilesWrap li:nth-child(1):before {
                background: #C9FFBF;
                background: -webkit-linear-gradient(to right, #FFAFBD, #C9FFBF);
                background: linear-gradient(to right, #FFAFBD, #C9FFBF);
            }
            .tilesWrap li:nth-child(2):before {
                background: #f2709c;
                background: -webkit-linear-gradient(to right, #ff9472, #f2709c);
                background: linear-gradient(to right, #ff9472, #f2709c);
            }
            .tilesWrap li:nth-child(3):before {
                background: #c21500;
                background: -webkit-linear-gradient(to right, #ffc500, #c21500);
                background: linear-gradient(to right, #ffc500, #c21500);
            }
            .tilesWrap li:nth-child(4):before {
                background: #FC354C;
                background: -webkit-linear-gradient(to right, #0ABFBC, #FC354C);
                background: linear-gradient(to right, #0ABFBC, #FC354C);
            }
            .response {
                padding: 40px;
                margin: 12px;
                border: #8abeb7 dashed 1px;
                width:  60%;
                color: #4c81c9;
            }

            #response_input {
                width: 90%;
                height: 400px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
<!-- let people make clients -->
<passport-clients></passport-clients>

<!-- list of clients people have authorized to access our account -->
<passport-authorized-clients></passport-authorized-clients>

<!-- make it simple to generate a token right in the UI to play with -->
<passport-personal-access-tokens></passport-personal-access-tokens>

                <ul class="tilesWrap">
                    <li>
                        <h2>01</h2>
                        <h3>GetUsers</h3>
                        <p>
                           Get a list of users
                        </p>
                        <button url="api/users">Run API</button>
                    </li>
                    <li>
                        <h2>02</h2>
                        <h3>GetBooking</h3>
                        <p>
                           Get a list of bookings
                        </p>
                        <button  url="api/booking">Run API</button>
                    </li>
                    <li>
                        <h2>03</h2>
                        <h3>GetReservations</h3>
                        <p>
                            Get a list of Reservations
                        </p>
                        <button url="api/reservations">Run API</button>
                    </li>
                    <li>
                        <h2>04</h2>
                        <h3>GetFlights</h3>
                        <p>
                           Get a list of flights
                        </p>
                        <button url="api/flights">Run API</button>
                    </li>
                </ul>
        </div>

        <pre>
            <div id="response" class="response"></div>
        </pre>
        <script
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous"></script>
        <script>

            $(document).ready(function() {

                $('button').on('click', function() {

                    var url = $(this).attr('url');
                    $.get( url , function( data ) {
                        $("#response").text(JSON.stringify(data, null, '\t'));
                        $("#response").prepend('GET \'' + url + '\' - additional POST/PUT/PATCH/DELETE methods are available under same URL. ' +"\n\n")
                    });
                });

            });
        </script>
    </body>
</html>
