@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>{{ __('messages.Edit Language') }}</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ __('messages.Edit Language') }}</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.languages.update', $language->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>{{ __('messages.Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $language->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Language Code') }}</label>
                            <input type="text" class="form-control" name="lang" value="{{ $language->lang }}" required>
                            <small class="text-muted">{{ __('messages.Example: en for English, fr for French') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Country Code') }}</label>
                            <input type="text" class="form-control" name="country_code" value="{{ $language->country_code }}" required>
                            <small class="text-muted">{{ __('messages.Example: gb for Great Britain, fr for France') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Is it default?') }}</label>
                            <select name="default" class="form-control" required>
                                <option value="0" {{ $language->default == 0 ? 'selected' : '' }}>{{ __('messages.No') }}</option>
                                <option value="1" {{ $language->default == 1 ? 'selected' : '' }}>{{ __('messages.Yes') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('messages.Status') }}</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ $language->status == 1 ? 'selected' : '' }}>{{ __('messages.Active') }}</option>
                                <option value="0" {{ $language->status == 0 ? 'selected' : '' }}>{{ __('messages.Inactive') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.Update') }}</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
@endsection