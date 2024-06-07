@php
$headerItem = (object) [
  'name' => 'Customer',
  'width' => '200px'
];

$headerItem2 = (object) [
  'name' => 'Stage',
  'width' => '40px'
];

$headerItem3 = (object) [
  'name' => 'Pipeline',
  'width' => '200px'
];

$headerItem4 = (object) [
  'name' => 'Estimated closed date',
  'width' => '700px'
];

$headerItem5 = (object) [
  'name' => 'Company',
  'width' => '200px'
];

$headerItem6 = (object) [
  'name' => 'Value',
  'width' => '100px'
];

$headerItem7 = (object) [
  'name' => 'Date created',
  'width' => '300px'
];

$headerItem8 = (object) [
  'name' => 'Date modified',
  'width' => '300px'
];

$headers = [$headerItem, $headerItem2, $headerItem3, $headerItem4, $headerItem5, $headerItem6, $headerItem7, $headerItem8];

$dummyData = (object) [
  'customer' => 'John Doe',
  'stage' => 'New',
  'pipeline' => 'Sales Executive',
  'estClosedDate' => 'Jul 24, 2024',
  'company' => 'PT Maju Mundur',
  'value' => 200,
  'createdAt' => '31 May 2024 10.00',
  'updatedAt' => '31 May 2024 15.00'
];

$dummyData2 = (object) [
  'customer' => 'Jane Doe',
  'stage' => 'In Negotiation',
  'pipeline' => 'Sales Executive',
  'estClosedDate' => 'Jul 24, 2024',
  'company' => 'PT Maju Mundur',
  'value' => 200,
  'createdAt' => '31 May 2024 10.00',
  'updatedAt' => '31 May 2024 15.00'
];

$listData = [$dummyData, $dummyData2];
@endphp

<section class="px-5 py-4">
    <x-table
    :headers="$headers"
    isSelectedTable="{{ true }}"
    isUsingTableHeader="{{ false }}"
  >
    @foreach($listData as $key => $value)
    <tr class="{{ $key % 2 === 0 ? 'odd' : 'even' }}">
      <td class="control" style="display: none;" tabindex="0"></td>
      <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
      <td>
        <div class="d-flex justify-content-start align-items-center user-name">
          <div class="avatar-wrapper">
            <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">{{ Helper::getInitial($value->customer) }}</span></div>
          </div>
          <span class="emp_name text-truncate">{{ $value->customer }}</span>
        </div>
      </td>
      <td>
        <div class="badge-status rounded-pill">
          <div class="badge-status-dot"></div>
          <x-badge-stage :type="$value->stage"></x-badge-stage>
        </div>
      </td>
      <td>
        <span class="text-sm">{{ $value->pipeline }}</span>
      </td>
      <td>
        <span class="text-sm">{{ $value->estClosedDate }}</span>
      </td>
      <td>
        <span class="text-sm">{{ $value->company }}</span>
      </td>
      <td>
        <span class="text-sm">{{ $value->value }}</span>
      </td>
      <td>
        <span class="text-sm">{{ $value->createdAt }}</span>
      </td>
      <td>
        <span class="text-sm">{{ $value->updatedAt }}</span>
      </td>
      <td>
        <a
          href="javascript:;"
          class="btn-sm btn-icon"
          data-bs-toggle="modal"
          data-bs-target="#edit-team-members"
        >
          <img src="{{asset('assets/svg/icons/pencil2.svg')}}" alt="edit">
        </a>
      </td>
    </tr>
    @endforeach
  </x-table>
</section>