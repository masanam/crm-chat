<section class="tab-pane fade tab-purchase w-100" id="purchase" role="tabpanel">
  <div class="d-flex flex-column gap-5">
    <div class="d-flex flex-column gap-2">
      <header class="d-flex justify-content-between align-items-center">
        <h5>Users plan</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkout">
          Proceed to Checkout
        </button>
      </header>
      <div class="wrapper-card-user-plan gap-3">
        <x-card-plan
          id="user-plan"
          headerTitle="Individual"
          contentTitle="15"
          contentSubtitle="per user"
        >
        </x-card-plan>
        <x-card-plan
          id="user-plan"
          headerTitle="10 users"
          contentTitle="120"
          contentSubtitle="per 10 users"
        >
        </x-card-plan>
        <x-card-plan
          id="user-plan"
          headerTitle="Custom"
          contentTitle="Talk to us"
          contentSubtitle="unlimited number of users"
          isUsingDollarSign="{{ false }}"
        >
        </x-card-plan>
      </div>
    </div>
    <div class="d-flex flex-column gap-2">
      <header class="d-flex justify-content-between align-items-center">
        <h5>Conversation plan</h5>
      </header>
      <div class="wrapper-card-user-plan gap-3">
        <x-card-plan
          id="conversation-plan"
          headerTitle="Basic Plan"
          contentTitle="100"
          contentSubtitle="100,000 conversation credit"
          customWidth="482px"
        >
          <x-slot name="contentRight">
            <div class="wrapper-card-plan-limited">
              <small>Limited time only</small>
            </div>
          </x-slot>
        </x-card-plan>
        <x-card-plan
          id="conversation-plan"
          headerTitle="Advanced Plan"
          contentTitle="400"
          contentSubtitle="100,000 conversation credit"
          customWidth="482px"
        >
        </x-card-plan>
      </div>
    </div>
  </div>
</section>