@extends('layouts.app')
@section('menus', 'Settings')
@section('page-title', 'Application Settings')
@section('page-subtitle', 'Manage application logos and icons')
{{-- @section('page-actions')
    <div class="btn-list">
        <button type="button" class="btn btn-primary" onclick="document.getElementById('settings-form').submit()">
            <i class="ti ti-device-floppy"></i> Save Changes
        </button>
    </div>
@endsection --}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Logo & Icon Settings</h3>
        </div>
        <div class="card-body">
            <form id="settings-form" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Meta Icon (Favicon)</label>
                            <div class="mb-2">
                                @if (isset($settings->icon_meta))
                                    <img src="{{ asset('storage/' . $settings->icon_meta) }}" alt="Meta Icon"
                                        class="img-thumbnail" style="max-height: 60px;">
                                @else
                                    <span class="text-muted">No icon uploaded</span>
                                @endif
                            </div>
                            <input type="file" class="form-control @error('icon_meta') is-invalid @enderror"
                                name="icon_meta" accept="image/*">
                            <small class="form-hint">Recommended size: 32x32px. Format: PNG, ICO</small>
                            @error('icon_meta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Login Page Icon</label>
                            <div class="mb-2">
                                @if (isset($settings->icon_login))
                                    <img src="{{ asset('storage/' . $settings->icon_login) }}" alt="Login Icon"
                                        class="img-thumbnail" style="max-height: 60px;">
                                @else
                                    <span class="text-muted">No icon uploaded</span>
                                @endif
                            </div>
                            <input type="file" class="form-control @error('icon_login') is-invalid @enderror"
                                name="icon_login" accept="image/*">
                            <small class="form-hint">Recommended size: 120x120px. Format: PNG, JPG</small>
                            @error('icon_login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Dashboard Logo</label>
                            <div class="mb-2">
                                @if (isset($settings->logo_dashboard))
                                    <img src="{{ asset('storage/' . $settings->logo_dashboard) }}" alt="Dashboard Logo"
                                        class="img-thumbnail" style="max-height: 80px;">
                                @else
                                    <span class="text-muted">No logo uploaded</span>
                                @endif
                            </div>
                            <input type="file" class="form-control @error('logo_dashboard') is-invalid @enderror"
                                name="logo_dashboard" accept="image/*">
                            <small class="form-hint">Recommended size: 200x60px. Format: PNG, SVG</small>
                            @error('logo_dashboard')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Dashboard Logo Name</label>
                            <input type="text" class="form-control @error('nama_logo_dashboard') is-invalid @enderror"
                                name="nama_logo_dashboard" value="{{ $settings->nama_logo_dashboard ?? 'Kampus App' }}">
                            <small class="form-hint">The name displayed alongside the dashboard logo</small>
                            @error('nama_logo_dashboard')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                </div>
                
                <!-- Add the new city field -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                name="kota" value="{{ $settings->kota ?? '' }}">
                            <small class="form-hint">Nama kota untuk dokumen dan laporan</small>
                            @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-end">
            <button type="button" class="btn btn-primary no-submit-handling" onclick="document.getElementById('settings-form').submit()">
                <i class="ti ti-device-floppy"></i> Save Changes
            </button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preview uploaded images before submission
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const imgElement = input.parentElement.querySelector('img');
                            if (imgElement) {
                                imgElement.src = event.target.result;
                            } else {
                                const newImg = document.createElement('img');
                                newImg.src = event.target.result;
                                newImg.alt = 'Preview';
                                newImg.className = 'img-thumbnail';
                                newImg.style.maxHeight = '60px';
                                const textSpan = input.parentElement.querySelector(
                                    'span.text-muted');
                                if (textSpan) {
                                    textSpan.replaceWith(newImg);
                                } else {
                                    input.parentElement.querySelector('.mb-2').appendChild(
                                        newImg);
                                }
                            }
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endpush
