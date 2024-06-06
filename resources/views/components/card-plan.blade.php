<section class="card-plan" style="min-width: {{ $customWidth }}">
  <header class="card-plan-header">
    <div class="d-flex align-items-center justify-content-between card-plan-header-wrapper">
      <div class="d-flex align-items-center gap-3">
        <img src="{{ asset('assets/svg/icons/stack-layer.svg') }}" alt="icon-stack">
        <span>{{ $headerTitle }}</span>
      </div>
      <input name="{{ $id }}" class="form-check-input rounded-pill custom-radio" type="radio" value="" id="{{ $id }}" />
    </div>
  </header>
  <div class="card-plan-content d-flex justify-content-between">
    <div class="d-flex flex-column gap-1">
      <div class="title d-flex {{ $isUsingDollarSign ? 'dollar-sign' : '' }}">
          @if($isUsingDollarSign)
          <b>&#65284;</b>
          @endif
          <span>{{ $contentTitle }}</span>
      </div>
      <small class="subtitle">{{ $contentSubtitle }}</small>
    </div>
    {{ $contentRight }}
  </div>
</section>