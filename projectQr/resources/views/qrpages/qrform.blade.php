@extends('layouts.app')
@section('createContent')
<div class="container">
    <div class="qrContainer">
        <!-- <div id="qrcode"></div> -->
        <div class="qrContainer--header">
            <!-- <h1>QR generator</h1> -->
        </div>
        <!-- vueJscomponent -->
        <!-- <create-form></create-form> -->
        <mega-form></mega-form>
        <div class="upAndDelFormContainer" style="display: none;">
            <h2>Update or delete URL</h2>
            @foreach($qrgenerator as $qr)
            <form method="POST" action="/qrpages/gettingValues">
                @csrf
                <div class="formInner">
                    <input type="text" class=" qrInput" name="generatedUrl" value="{{ $qr->generatedUrl }}" />
                    <input type="text" class="qrInput @error('redirectionUrl') text-danger @enderror" name="redirectionUrl" value="{{ $qr->redirectionUrl }}" />
                    @error('redirectionUrl')
                    <span class="text-danger" role="alert">
                        <small>{{ $errors->first('redirectionUrl') }}</small>
                    </span>
                    @enderror
                    <button class="qrBtn" type="submit" value="update" name="action">Update</button>
                    <button value="delete" name="action">Delete</button>
                </div>

            </form>
            @endforeach
        </div>

    </div>
</div>
@endsection

@section('UpdateAndDeleteForm')


@endsection