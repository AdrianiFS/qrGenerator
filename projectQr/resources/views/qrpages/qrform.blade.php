@extends('layouts.app')
@section('createContent')
<div class="container">
    <div class="qrContainer">
        <!-- <div id="qrcode"></div> -->

        <div class="qrContainer--header">
            <h1>QR generator</h1>
            <button class="addUrlBtn"> &#10010; Create new</button>
        </div>


        @foreach($qrgenerator as $qr)
        <form class="" method="POST" action="/qrpages/gettingValues">
            @csrf
            <div class="formInner">
                <input type="text" class=" qrInput" placeholder="generatedUrl" name="generatedUrl" id="generatedUrl" value="{{ $qr->generatedUrl }}" />
                <input type="text" class="qrInput @error('redirectionUrl') text-danger @enderror" placeholder="redirectionUrl" name="redirectionUrl" id="redirectionUrl" value="{{ $qr->redirectionUrl }}" />
                @error('redirectionUrl')
                <span class="text-danger" role="alert">
                    <small>{{ $errors->first('redirectionUrl') }}</small>
                </span>
                @enderror
                <button class="qrBtn" type="submit" value="update" name="action">Update</button>
                <button value="delete" name="action">Delete</button>
            </div>
            <hr>
        </form>
        @endforeach
    </div>
</div>
@endsection


<!-- enviar al servidor
1. tipo de action(update, delete), pq son valores q existen

2. q contienen las acciones(generatedUrl)

3. verificar ambos valores en el servidor -->