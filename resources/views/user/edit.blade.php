@extends('layouts.layout')

@section('main')
                    <section class="edit block-medium">
                        <form action="{{ route('edit.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="block-small">
                                <img src="" id="imagePreview">
                            </div>
                            <div class="input">
                                <h2>Изображение профиля</h2>
                                <input name="image" type="file" id="input__file" class="input input__file" multiple>
                                <label for="input__file" class="input__file-button">
                                   <span class="input__file-icon-wrapper"><img class="input__file-icon" src="https://image.flaticon.com/icons/png/512/51/51112.png" alt="Выбрать файл" width="25"></span>
                                   <span class="input__file-button-text">Выберите картинку</span>
                                </label>
                             </div>
                            <div class="input">
                                <h2>Описание профиля</h2>
                                <textarea type="text" class="description_edit" name="description" maxlength="800"></textarea>
                            </div>
                            <div class="input">
                                <input type="submit" class="submit_edit">
                            </div>
                        </form>
                    </section>
@endsection