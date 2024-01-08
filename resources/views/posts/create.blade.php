@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">

        <div class="md:w-6/12 p-10">
            <form action="{{ route('imagenes.store') }}" id="dropzone" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center dz-clickable">
                @csrf
            </form>
        </div>

        <div class="md:w-6/12 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input id="titulo" name="titulo" type="text" placeholder="Título del post"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value={{ old('titulo') }}>
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción del post"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">
                        {{ old('descripcion') }}
                    </textarea>

                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen">
                </div>
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <input type="submit" value="Crear Publicación"
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
