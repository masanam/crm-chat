@php
$user = \App\Models\User::find(request()->user()->id);
$profile = \App\Models\Profile::find($user->profile_id);
$client = \App\Models\Client::find($profile->client_id);
$teams = \App\Models\Team::with('members')->where('client_id', $client->id)->get();
@endphp

<section class="tab-pane fade tab-members w-100" id="members" role="tabpanel">
  <x-table
    title="Team members"
    badge="100 users"
    buttonHeaderName="Add Members"
    buttonHeaderTarget="add-team-members"
    :headers="$headersMember"
    isSelectedTable="{{ true }}"
  >
    @foreach($teams as $k => $v)
    @foreach($v->members as $key => $value)
    @php
    $profile = \App\Models\Profile::find($value->user_id);
    @endphp
    <tr class="{{ $key % 2 === 0 ? 'odd' : 'even' }}">
      <td class="control" style="display: none;" tabindex="0"></td>
      <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
      <td>
        <div class="d-flex justify-content-start align-items-center user-name">
          <div class="avatar-wrapper">
            <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">RH</span></div>
          </div>
          <span class="emp_name text-truncate">{{ $value->id }}</span>
        </div>
      </td>
      <td>
        <div class="badge-status rounded-pill {{ $value->status ? 'active' : 'inactive' }}">
          <div class="badge-status-dot {{ $value->status ? 'active' : 'inactive' }}"></div>
          <span class="text-xs">{{ $value->status ? 'Active' : 'Inactive' }}</span>
        </div>
      </td>
      <td>
        <span class="text-sm">{{ $profile->role }}</span>
      </td>
      <td>
        <span class="text-sm">{{ $profile->email }}</span>
      </td>
      <td><span class="badge bg-label-success rounded-pill">{{ $profile->team_id }}</span></td>
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
          data-bs-target="#edit-team-members"
        >
          <img src="{{asset('assets/svg/icons/pencil2.svg')}}" alt="edit">
        </a>
      </td>
    </tr>
    @endforeach
    @endforeach
  </x-table>
</section>