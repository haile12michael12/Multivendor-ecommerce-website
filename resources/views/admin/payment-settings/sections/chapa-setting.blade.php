<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.chapa-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Chapa Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{$chapa->status === 1 ? 'selected' : ''}} value="1">Enable</option>
                        <option {{$chapa->status === 0 ? 'selected' : ''}} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" id="" class="form-control">
                        <option {{$chapa->mode === 0 ? 'selected' : ''}} value="0">Sandbox</option>
                        <option {{$chapa->mode === 1 ? 'selected' : ''}} value="1">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{$country === $chapa->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.currecy_list') as $key => $currency)
                            <option {{$currency === $chapa->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency rate ( Per {{$settings->currency_name}} )</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{$chapa->currency_rate}}">
                </div>
                <div class="form-group">
                    <label>chapa Client Id</label>
                    <input type="text" class="form-control" name="client_id" value="{{$chapa->client_id}}">
                </div>
                <div class="form-group">
                    <label>chapa Secret Key</label>
                    <input type="text" class="form-control" name="secret_key" value="{{$chapa->secret_key}}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    </div>
