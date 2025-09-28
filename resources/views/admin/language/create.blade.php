@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>{{ __('messages.Create Language') }}</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ __('messages.Create Language') }}</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.languages.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('messages.Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Language Code') }}</label>
                            <input type="text" class="form-control" name="lang" value="{{ old('lang') }}" required>
                            <small class="text-muted">{{ __('messages.Example: en for English, fr for French') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Country Code') }}</label>
                            <input type="text" class="form-control" name="country_code" value="{{ old('country_code') }}" required>
                            <small class="text-muted">{{ __('messages.Example: gb for Great Britain, fr for France') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Is it default?') }}</label>
                            <select name="default" class="form-control" required>
                                <option value="0">{{ __('messages.No') }}</option>
                                <option value="1">{{ __('messages.Yes') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Status') }}</label>
                            <select name="status" class="form-control" required>
                                <option value="1">{{ __('messages.Active') }}</option>
                                <option value="0">{{ __('messages.Inactive') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.Create') }}</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
@endsection