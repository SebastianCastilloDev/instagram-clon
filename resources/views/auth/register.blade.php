@extends('layouts.app')
@section('titulo')
    Regístrate en Sebstagram
@endsection
@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-4/12 p-5">
            <img class="" src="{{ asset('img/register.jpeg') }}" alt="imagen registro de usuarios" />
        </div>
        <div class="md:w-4/12
         bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input id="name" name="name" type="text" placeholder="Escribe tu nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value={{ old('name') }}>
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>
                    <input id="username" name="username" type="text" placeholder="Escribe tu nombre de usuario"
                        class="border p-3 w-full rounded-lg">
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo electrónico:
                    </label>
                    <input id="email" name="email" type="email" placeholder="Escribe tu correo electrónico"
                        class="border p-3 w-full rounded-lg">
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password:
                    </label>
                    <input id="password" name="password" type="password" placeholder="Escribe tu password"
                        class="border p-3 w-full rounded-lg">
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password:
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Repite tu password" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear Cuenta"
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
