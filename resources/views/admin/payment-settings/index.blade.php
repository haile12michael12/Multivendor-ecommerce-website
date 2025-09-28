@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Settings</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Paypal</a>
                            <a class="list-group-item list-group-item-action" id="list-chapa-list" data-toggle="list" href="#list-stripe" role="tab">chapa</a>
                            <a class="list-group-item list-group-item-action" id="list-Telebirr-list" data-toggle="list" href="#list-razorpay" role="tab">Telebirr</a>
                            <a class="list-group-item list-group-item-action" id="list-CEB-settings-list" data-toggle="list" href="#list-settings" role="tab">CEB</a>
                          </div>
                        </div>
                        <div class="col-10">
                          <div class="tab-content" id="nav-tabContent">
                            @include('admin.payment-settings.sections.chapa-setting')


                            @include('admin.payment-settings.sections.telebirr-setting')

                            @include('admin.payment-settings.sections.cbe-setting')

                            @include('admin.payment-settings.sections.paypal-setting')





                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
        </section>

@endsection
