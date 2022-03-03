@extends('layouts.main-layout')

@section('title')
    {{ $apartment -> title }}
@endsection


@section('content')

    <div class="container-xl d-flex flex-column align-items-center">
        {{-- TITOLO APPARTAMENTO, LOCALITA RECENSIONE --}}
        <div class="general_info align-self-start">
            <h3>
                {{ $apartment -> title }}
            </h3>
            <h5>
                <i class="fa-solid fa-star"></i>5.0  - {{ $apartment -> address }}
            </h5>
        </div>
        {{-- SHOW APPARTAMENTO --}}
        <div class="show_apartment">
            @if ($apartment->images) 
                <div class="img_container">

                    <img class="w-100" src="{{asset('storage/assets/'. $apartment->images)}}" alt="{{$apartment -> title}}">
                </div>
            @endif
            <p>
                {{ $apartment -> description }}
            </p>
        </div>
        {{-- SERVIZI DISPONIBILI APPARTAMENTO --}}
        <div class="services mb-5">
            <h3 class="text-center">Cosa troverai</h3>
            <ul class="row">
                @foreach ($apartment -> services as $apartmentService)       
                    <li class="list-group-item col-3">  
                        {{ $apartmentService -> name}}
                    </li>
                @endforeach <br>
            </ul>
        </div>
        {{-- MAPPA APPARTAMENTO --}}
        <div class="maps">
            @if ($apartment -> longitude != '')
                <apartment-map :lng="{{ $apartment -> longitude }}" :lat="{{ $apartment -> latitude }}"></apartment-map>
            @endif
        </div>
        {{-- FORM RICHIESTA INFO PER APPARTAMENTO --}}
        <div class="richiesta_info mt-5">
            <h3>Invia una mail al proprietario</h3>
            <form class="text-center" action="{{ route('apartment.message_send', $apartment -> id) }}" method="POST">
                @method('POST')
                @csrf
    
                <div class="form-group">
                <label for="exampleFormControlInput1">Inserisci email</label>
    
                <input type="email" name="sender" class="form-control" id="exampleFormControlInput1" placeholder="insert your email"
                @if (Auth::user())
                    value="{{$user -> email}}"
                @endif>
                </div>
    
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Inserisci il tuo messaggio</label>
                  <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
    

                <div class="buttons text-center mt-5">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-darkBlue">Indietro</a>
                    <input type="submit" value="Invia" class="btn btn-orange">
                </div>

                
            </form>
        </div>
    </div>

    <div 
        @if ($apartment-> longitude)

        <apartment-map :lng="{{ $apartment -> longitude }}" :lat="{{ $apartment -> latitude }}"></apartment-map>
        
        @endif>
    </div>

    
@endsection