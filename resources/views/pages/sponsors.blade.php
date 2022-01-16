@extends('layout.app')
@section('title', 'Тоҷик Академия - Сарпарстони мо')
@section('description', 'Сарпарастони мо шахсоне ҳастанд ки дар пешравии сомона саҳми худро мегузоранд. Бо дастгирии онҳо мо корбурдиҳои нав ба сомона ворид мекунем')
@section('url', url(route('sponsors')))

@section('content')
    <div class="container">
       <div style="margin: 10px 0">
           <h1>Сарпарастони мо!</h1>
           <p>Сарпарстон дар сомонаи мо шахсоне ҳастанд, ки барои пешравии сомона саҳми худро гузоштаанд!</p>
       </div>
        <div class="row">
            @foreach($sponsors as $sponsor)
                <div class="col-lg-3 m-3 sponsor-shadow">
                    <div class="sponsor">
                        <div class="name-img">
                            <img src="{{ asset($sponsor->image) }}" alt="{{ $sponsor->name }}" style="width: 150px" />
                            <a>{{ $sponsor->name }}</a>
                        </div>
                        <span>{{ $sponsor->about }}</span>
                        @if($sponsor->type_link == 'youtube')
                            <a href="{{ $sponsor->link }}" target="_blank" class="btn-a ins">Youtube</a>
                        @elseif($sponsor->type_link == 'instagram')
                            <a href="{{ $sponsor->link }}" target="_blank" class="btn-a ins ">Instagram</a>
                        @else
                            <a href="#instagram" class="btn-a ins">Instagram</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
