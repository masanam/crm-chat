@extends('layouts/layoutMaster')

@section('title', 'Add Lead')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<!-- Form Validation -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<!-- Form Validation -->
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
@endsection

@section('content')

<div class="row">
  <div class="col-md-6 offset-md-3">
    @if (session('succcess'))
        <div class="alert alert-success" role="alert">
          <strong>{{session('success')}}/strong>
        </div>

    @endif
    <div class="card">
      <div class="card-body">
        <form class="add-new-record pt-0 row g-2" id="" action="{{route('lead.store')}}" method="POST">
          @csrf
          <div class="col-sm-12">
            <label class="form-label">Dealer </label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-building-store"></i></span>
              <select class="form-select" aria-label="Default select example" name="dealer_id">
                <option value="1">Jaya Motor</option>
                <option value="2">Kerabat Bintang Motor</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12">
            <label class="form-label" >Nama Klien</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-user"></i></span>
              <input type="text" class="form-control" placeholder="John Doe"  name="client_name"/>
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label">Lokasi Klien</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-location"></i></span>
              <input type="text" class="form-control" placeholder="Jakarta Pusat" name="location" />
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label">Nomor Whatsapp</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-phone"></i></span>
              <input type="number" class="form-control" placeholder="628xxxxxxxxx" name="phone_number" />
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label">Unit Mobil</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-car"></i></span>
              <input type="text" class="form-control" placeholder="HRV" name="interest" />
            </div>
          </div>
          <div class="col-sm-12">
            <label class="form-label">Progress</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-clock-hour-10"></i></span>
              <select class="form-select" aria-label="Default select " name="progress">
                <option value="1">Dikontak</option>
                <option value="2">Diberikan</option>
              </select>
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label">Budget</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-coins"></i></span>
              <select class="form-select" aria-label="Default select example" name="budget">
                <option value="1">Ok</option>
                <option value="2">Belum Dibicarakan</option>
                <option value="3">Nego</option>
              </select>
            </div>
          </div>


           <div class="col-sm-12">
            <label class="form-label">Metode Pembayaran</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-cash"></i></span>
                <select class="form-select" aria-label="Default select" name="payment_method">
                <option value="1">Cash</option>
                <option value="2">Kredit</option>
                <option value="3">Tuker Tambah</option>
              </select>
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label">Kapan Butuh Mobilnya ? </label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-clock-question"></i></span>
              <select class="form-select" aria-label="Default select example" name="need_car">
                <option value="1">Tanya Tanya Dulu</option>
                <option value="2">1 Bulan</option>
              </select>
            </div>
          </div>

          <div class="col-sm-12">
            <label class="form-label">Notes</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-notes"></i></span>
              <input type="text" class="form-control" placeholder="" name="notes" />
            </div>
          </div>
          <div class="col-sm-12">
            <label class="form-label">Showroom Handler</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="ti ti-user-check"></i></span>
              <input type="text" class="form-control" placeholder="" name="showroom_handler" />
            </div>
          </div>
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
