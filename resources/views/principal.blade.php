@extends('master')
@section('content')
    <style>
       .recuadro {
            background-color: #F5F5F5;
            padding: 10px;
            margin: 5% auto; 
            width: 700px;
            border-radius: 10px;
            
        }

        .recuadro-interno {
            background-color: #FFFFFF;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .circulo {
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            margin-top:10px;
            float:right;
        }
        
    </style>

</head>
<body>
<div class="recuadro">
    <div class="recuadro-interno">
        <div class="circulo"></div>
        <h3>Título de la reserva</h3>
        <p>Estado:</p>
        <p>Fecha:</p>
        <img src="image/like.png">
    </div>

</div>
</body>
@endsection
