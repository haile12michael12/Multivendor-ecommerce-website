@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Translations for') }} {{ $language->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.languages.index') }}">{{ __('Languages') }}</a></div>
            <div class="breadcrumb-item">{{ __('Translations') }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Edit Translations') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.languages.updateTranslations', $language->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="searchTranslation" placeholder="{{ __('Search translations...') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="addNewTranslation">
                                            <i class="fas fa-plus"></i> {{ __('Add New') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="translationsTable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Key') }}</th>
                                            <th>{{ __('Translation') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($translations as $key => $value)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="{{ $key }}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="translations[{{ $key }}]" value="{{ $value }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-translation">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                                <a href="{{ route('admin.languages.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Template for new translation row -->
<template id="new-translation-template">
    <tr>
        <td>
            <input type="text" class="form-control" name="translations[__KEY__]" placeholder="{{ __('Enter key') }}" required>
        </td>
        <td>
            <input type="text" class="form-control" name="translations[__KEY__]" placeholder="{{ __('Enter translation') }}" required>
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-translation">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Search translations
        $("#searchTranslation").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#translationsTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // Add new translation
        $("#addNewTranslation").click(function() {
            var template = $("#new-translation-template").html();
            var newRow = template.replace(/__KEY__/g, "");
            $("#translationsTable tbody").append(newRow);
            
            // Focus on the new key input
            $("#translationsTable tbody tr:last-child td:first-child input").focus();
            
            // Update the name attribute when key is entered
            $("#translationsTable tbody tr:last-child td:first-child input").on('blur', function() {
                var key = $(this).val();
                if (key) {
                    $(this).attr('name', 'translations[' + key + ']');
                    $(this).attr('readonly', true);
                    $("#translationsTable tbody tr:last-child td:nth-child(2) input").attr('name', 'translations[' + key + ']');
                }
            });
        });

        // Remove translation
        $(document).on("click", ".remove-translation", function() {
            $(this).closest("tr").remove();
        });
    });
</script>
@endpush