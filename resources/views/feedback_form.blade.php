@extends('layouts.layout')

@section('title', 'Обратная связь')

@section('content')

    <div class="container">
        <form class="mt-5" method="post" action="{{ route('feedback.send') }}">
            @csrf
            <div class="form-group">
                <label for="name">Ваше имя</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                       placeholder="Введите ваше имя" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-1">
                <label for="email">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                       placeholder="Введите ваш почтовый адрес" name="email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-1">
                <label for="message">Текст сообщения</label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message" rows="5"
                          name="message" placeholder="Введите сообщение">{{ old('message') }}
                </textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>

        </form>
    </div>
@endsection
