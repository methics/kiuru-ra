{{-- resources\views\errors\list.blade.php --}}
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif<?php
/**
 * Created by PhpStorm.
 * User: teemu
 * Date: 26/07/2018
 * Time: 11.19
 */