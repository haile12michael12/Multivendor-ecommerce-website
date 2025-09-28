@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>{{ __('messages.Languages') }}</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ __('messages.All Languages') }}</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.languages.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ __('messages.Create new') }}</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>{{ __('messages.Language Name') }}</th>
                            <th>{{ __('messages.Language Code') }}</th>
                            <th>{{ __('messages.Default') }}</th>
                            <th>{{ __('messages.Status') }}</th>
                            <th>{{ __('messages.Action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($languages as $language)
                            <tr>
                              <td>
                                <span class="fi fi-{{ $language->country_code }} me-2"></span>
                                {{ $language->name }}
                              </td>
                              <td>{{ $language->lang }}</td>
                              <td>
                                @if ($language->default)
                                  <span class="badge badge-success">{{ __('messages.Yes') }}</span>
                                @else
                                  <span class="badge badge-danger">{{ __('messages.No') }}</span>
                                @endif
                              </td>
                              <td>
                                @if ($language->status)
                                  <span class="badge badge-success">{{ __('messages.Active') }}</span>
                                @else
                                  <span class="badge badge-danger">{{ __('messages.Inactive') }}</span>
                                @endif
                              </td>
                              <td>
                                <a href="{{ route('admin.languages.edit', $language->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                
                                @if (!$language->default)
                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal{{ $language->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                @endif
                              </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $language->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $language->id }}" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $language->id }}">{{ __('messages.Delete Language') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    {{ __('messages.Are you sure you want to delete this language?') }}
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Close') }}</button>
                                    <form action="{{ route('admin.languages.destroy', $language->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">{{ __('messages.Delete') }}</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
@endsection