<div class="modal fade {{ $wrapperModalClass }}" id="{{ $name }}" aria-hidden="true">
    <div class="modal-dialog {{ $modalClass }}" role="document">
      <div class="modal-content">
        @if($isUsingHeaderTitle)
        <div class="d-flex align-items-center justify-content-between {{ $isUsingButtonClose ? $title ? 'border border-bottom-2' : '' : 'px-4' }}">
          <div class="d-flex align-items-center py-3">
            @if($isUsingButtonClose)
            <button
              class="btn p-0 ps-3 pe-2"
              data-bs-dismiss="modal"
              data-bs-toggle="{{ $isModalStack ? 'modal' : '' }}"
              data-bs-target="#{{ $targetNameModalStack }}"
            >
            @if($isModalStack)
            <i class="ti ti-arrow-left text-dark fw-bold"></i>
            @else
            <i class="ti ti-x text-dark fw-bold"></i>
            @endif
            </button>
            @endif
            <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel2">{{ $title }}</h5>
          </div>
          {{ $sideRightHeader }}
        </div>
        @endif
        <div class="modal-body px-4 py-3">
          {{ $slot }}
        </div>

        @if($isUsingBtnFooter)
        <div class="modal-footer {{ $buttonWrapperSubmitClass }}">
          <button type="button" data-bs-dismiss="modal" class="btn btn-primary {{ $buttonSubmitClass }}">{{ $submitText }}</button>
          @if ($isUsingBtnFooterClose)
          <button type="button" data-bs-dismiss="modal" class="btn" style="background: #667085; color: #FFF;">Close</button>
          @endif
        </div>
        @endif
      </div>
    </div>
</div>