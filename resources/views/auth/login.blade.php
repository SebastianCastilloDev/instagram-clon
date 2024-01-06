@extends('layouts.app')
@section('titulo')
    Inicia sesión en Sebstagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-4/12 p-5">
            <img class="" src="{{ asset('img/login.jpeg') }}" alt="imagen login de usuarios" />
        </div>
        <div class="md:w-4/12
         bg-white p-6 rounded-lg shadow-xl">
            <form novalidate>
                @csrf

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo electrónico:
                    </label>
                    <input id="email" name="email" type="email" placeholder="Escribe tu correo electrónico"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value={{ old('email') }}>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password:
                    </label>
                    <input id="password" name="password" type="password" placeholder="Escribe tu password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Iniciar sesión"
                    class="
                    bg-sky-600
                    hover:bg-sky-700
                    transition-colors
                    cursor-pointer
                    uppercase
                    font-bold
                    w-full
                    p-3
                    rounded
                    text-white">
            </form>
        </div>
    </div>
@endsection
