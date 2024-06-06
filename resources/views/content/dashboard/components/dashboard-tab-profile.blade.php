<section class="tab-pane fade active show" id="profile" role="tabpanel">
  <div class="d-flex flex-column gap-4 tab-users">
    <div class="border-bottom">
      <h5 class="text-dark fw-bold">Company information</h5>
      <span class="text-sm text-subtitle">Update your company details here.</span>
    </div>
    <div class="border-bottom d-flex flex-wrap form-wrapper">
      <label for="companyName" class="form-label text-dark font-medium">
        Company Name
      </label>
      <input id="companyName" type="text" class="form-control" placeholder="Please input company name">
    </div>
    <div class="border-bottom form-wrapper-file d-flex">
      <div class="d-flex flex-column">
        <span class="text-sm text-dark font-medium">Company Logo</span>
        <span class="text-sm text-subtitle">This will be displayed on your profile.</span>
      </div>
      <div class="d-flex gap-3 w-100">
        <div class="img-user">
          <i class="ti ti-user user-icon"></i>
        </div>
        <div id="drop-area" class="drop-area d-flex flex-column">
          <input type="file" id="file" accept="image/*" hidden>
          <div class="d-flex flex-column text-center align-items-center">
            <img src="{{ asset('assets/svg/icons/upload.svg') }}" alt="upload" />
            <span class="text-sm mt-2"><b>Click to upload</b> or drag and drop</span>
            <small class="text-grey text-xs">SVG, PNG, JPG or GIF (max. 800x400px)</small>
          </div>
        </div>
      </div>
    </div>
    <div class="border-bottom d-flex align-items-center gap-3">
      <button class="btn btn-outlined-gray text-dark">Cancel</button>
      <button class="btn btn-primary">Save</button>
    </div>
  </div>
</section>