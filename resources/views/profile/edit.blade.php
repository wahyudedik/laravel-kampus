@extends('layouts.app')
@section('menus', 'User Profil Manjemen')
@section('page-title', 'User Profil')
@section('page-subtitle', 'User profil manajemen')
@section('page-actions')
    <div class="btn-list">
        {{-- <a href="{{ route('pembayaran-mahasiswa.create') }}" class="btn btn-primary d-none d-sm-inline-block">
            <i class="ti ti-plus"></i> Tambah Pembayaran
        </a> --}}
    </div>
@endsection
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
