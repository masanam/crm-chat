@php
$user = \App\Models\User::find(request()->user()->id);
$profile = \App\Models\Profile::find($user->profile_id);
$client = \App\Models\Client::find($profile->client_id);
$teams = \App\Models\Team::with('members')->where('client_id', $client->id)->get();
@endphp

<section class="tab-pane fade tab-team w-100" id="team" role="tabpanel">
  <x-table
    title="Teams"
    badge="5 teams"
    buttonHeaderName="Create Team"
    buttonHeaderTarget="add-team"
    :headers="$headers"
    isSelectedTable="{{ true }}"
  >
    @foreach($teams as $key => $value)
    <tr class="{{ $key % 2 === 0 ? 'odd' : 'even' }}">
      <td class="control" style="display: none;" tabindex="0"></td>
      <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
      <td>
        <div class="d-flex justify-content-start align-items-center user-name">
          <div class="avatar-wrapper">
            <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">RH</span></div>
          </div>
          <span class="emp_name text-truncate">{{ $value->name }}</span>
        </div>
      </td>
      <td>
        <div class="badge-member rounded-pill">
          <div class="badge-member-dot"></div>
          <span class="text-xs">{{ $value->members }}</span>
        </div>
      </td>
      <td><span class="badge bg-label-success rounded-pill">{{ $value->function }}</span></td>
      <td>
        <div class="d-inline-block">
          <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
            <i class="text-dark ti ti-trash"></i>
          </a>
        </div>
        <a
          href="javascript:;"
          class="btn btn-sm btn-icon item-edit"
          data-bs-toggle="modal"
          data-bs-target="#add-team"
        >
          <img src="{{asset('assets/svg/icons/pencil2.svg')}}" alt="edit">
        </a>
      </td>
    </tr>
    @endforeach
  </x-table>
</section>